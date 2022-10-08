<?php

namespace App\Http\Livewire\App\Checkout;

use App\Models\Notification;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Point;
use App\Models\State;
use App\Models\Wallet;
use App\Models\Address;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\OrderDetails;
use App\Models\BusinessSetting;
use App\Services\IyzicoPayment;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Stevebauman\Location\Facades\Location;

class CheckoutComponentV2 extends Component
{
    public $first_name, $last_name, $email, $phone, $country, $state, $address, $formStatus = 0, $edit_id, $address_id, $payment_method = 'cod';
    public $totalItem, $subtotal, $totalDiscount, $shippingfee = 0, $couponDiscount = 0, $grandTotal = 0, $accept_terms, $use_point, $point_amount, $use_my_points;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'state' => 'required',
            'address' => 'required',
            'accept_terms' => 'required|min:1|max:1',
        ], [
            'accept_terms.*' => 'You must accept our terms & conditions',
        ]);
    }

    public function storeAddress()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'state' => 'required',
            'address' => 'required',
        ]);

        $data = new Address();
        $data->user_id = user()->id;
        $data->first_name = $this->first_name;
        $data->last_name = $this->last_name;
        $data->email = $this->email;
        $data->phone = $this->phone;
        $data->country = $this->country;
        $data->state = $this->state;
        $data->address = $this->address;
        $data->save();

        $this->dispatchBrowserEvent('success', ['message' => 'New address added successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->phone = '';
        $this->country = '';
        $this->state = '';
        $this->address = '';
        $this->formStatus = '';
        $this->edit_id = '';
    }

    public function editData($id)
    {
        $data = Address::where('id', $id)->first();

        $this->edit_id = $data->id;
        $this->first_name = $data->first_name;
        $this->last_name = $data->last_name;
        $this->email = $data->email;
        $this->phone = $data->phone;
        $this->country = $data->country;
        $this->state = $data->state;
        $this->address = $data->address;

        $this->dispatchBrowserEvent('showEditModal');
        $this->formStatus = 1;
    }

    public function updateAddress()
    {
        $data = Address::where('id', $this->edit_id)->first();
        $data->user_id = user()->id;
        $data->first_name = $this->first_name;
        $data->last_name = $this->last_name;
        $data->email = $this->email;
        $data->phone = $this->phone;
        $data->country = $this->country;
        $data->state = $this->state;
        $data->address = $this->address;
        $data->save();

        $this->resetInputs();
        $this->dispatchBrowserEvent('success', ['message' => 'Address updated successfully']);
        $this->dispatchBrowserEvent('closeModal');
    }

    public function close()
    {
        $this->resetInputs();
    }

    public function deleteAddress($id)
    {
        $data = Address::where('id', $id)->first();
        $data->delete();

        $this->dispatchBrowserEvent('success', ['message' => 'Address deleted successfully']);
    }

    public function selectDeliveryType($val)
    {
        $this->payment_method = $val;
    }

    public $sellers = [], $myPoint;

    public function mount()
    {
        if(Session::has('checkout')){
            foreach (Session::get('checkout')['cartItems'] as $item) {
                $cItem = Cart::where('id', $item)->first();
                if (!in_array($cItem->owner_id, $this->sellers)) {
                    array_push($this->sellers, $cItem->owner_id);
                }
            }
        }
        
        $ip = request()->ip();
        $location = Location::get($ip);

        if ($location == false) {
            $this->country = 'Turkey';
        } else {
            $this->country = Country::where('name', $location->countryName)->first()->name;
        }
        $this->first_name = user()->first_name;
        $this->last_name = user()->last_name;
        $this->phone = user()->phone;
        $this->email = user()->email;
        $this->state = user()->state;
        $this->address = user()->address;


        $this->myPoint = Wallet::where('user_id', user()->id)->first()->points;

        if(Session::has('checkout')){
            if (Session::get('checkout')['grand_total'] <= $this->myPoint) {
                $this->use_point = round(Session::get('checkout')['grand_total'], 2);
            } else {
                $this->use_point = $this->myPoint;
            }
        }

        $point_value = BusinessSetting::where('id', 1)->first()->point_value;
        $this->point_amount = $point_value * $this->use_point;
    }

    public $card_holder_name, $card_number, $expDate, $card_csv;
    public $master_card_holder_name, $master_card_number, $master_card_expDate, $master_card_csv;


    public function confirmCheckout()
    {

        $this->validate([
            'address_id' => 'required',
            'payment_method' => 'required',
            'accept_terms' => 'required|min:1|max:1',
        ], [
            'accept_terms.*' => 'You must accept our terms & conditions',
            'address_id.*' => 'Select your address',
            'payment_method.*' => 'Select payment method',
        ]);

        $apiUrl = 'http://localhost/api/create/payment';

        foreach ($this->sellers as $seller) {
            $order = new Order();
            $order->user_id = user()->id;
            $order->seller_id = $seller;
            $order->address_id = $this->address_id;
            $order->delivery_status = 'pending';
            $order->payment_type = $this->payment_method;

            $orderCode = strtoupper(Str::random(14));

            $ttl = 0;
            $ttlDis = 0;
            $itm = 0;
            $cartproduct = [];
            foreach (Session::get('checkout')['cartItems'] as $itemID) {
                $cItemS = Cart::where('owner_id', $seller)->where('id', $itemID)->first();
                if ($cItemS != '') {
                    $ttl = $ttl + $cItemS->price;
                    $ttlDis = $ttlDis + $cItemS->discount;
                    $itm += 1;
                }
            }

            $subtotal = $ttl - $ttlDis;
            if (session('coupon')) {
                if (Session::get('coupon')['type'] == 'Percentage') {
                    $couponDiscount = ($subtotal * Session::get('coupon')['value']) / 100;
                } else {
                    $couponDiscount = ((Session::get('coupon')['value']) / count(Session::get('checkout')['cartItems'])) * $itm;
                }
            } else {
                $couponDiscount = 0;
            }

            if ($this->use_my_points == 1) {
                $subtotal -= $this->point_amount;
            }

            $order->grand_total = $subtotal - $couponDiscount;
            $order->discount = $ttlDis;
            $order->coupon_discount = $couponDiscount;
            $order->code = $orderCode;
            $order->date = Carbon::now();
            $order->payment_status = 'unpaid';

            if ($couponDiscount != 0) {
                $cdiscount = $couponDiscount / count(Session::get('checkout')['cartItems']);
            } else {
                $cdiscount = 0;
            }

            $busketTotalPrice = 0;
            foreach (Session::get('checkout')['cartItems'] as $itmID) {
                $cItemS = Cart::where('id', $itmID)->first();
                if (is_null($cItemS))
                    continue;

                $productInfo = product($cItemS->product_id);
                $categoryInfo = category($productInfo->category_id);

                $unitPrice = round(discountPrice($productInfo->id) - $cdiscount, 2);
                $cartItemPrice = round($unitPrice * $cItemS->quantity, 2);

                $cartproduct[] = [
                    "id" => $cItemS->product_id,
                    "name" => $productInfo->name,
                    "category" => $categoryInfo->name,
                    "price" => $cartItemPrice
                ];

                $busketTotalPrice += $cartItemPrice;
            }

            if ($order->save()) {
                foreach (Session::get('checkout')['cartItems'] as $itemID) {
                    $cItem = Cart::where('id', $itemID)->where('owner_id', $seller)->first();

                    if ($cItem != '') {
                        $orderDetails = new OrderDetails();
                        $orderDetails->order_id = $order->id;
                        $orderDetails->seller_id = $seller;
                        $orderDetails->product_id = $cItem->product_id;
                        $orderDetails->color = $cItem->color;
                        $orderDetails->size = $cItem->size;
                        $orderDetails->price = product($cItem->product_id)->unit_price;
                        $orderDetails->quantity = $cItem->quantity;
                        $orderDetails->total = product($cItem->product_id)->unit_price * $cItem->quantity;
                        $orderDetails->save();
                    }
                }
            }


            if ($this->payment_method == 'visa' || $this->payment_method == 'master_card') {
                //get address
                $buyerAdd = Address::find($this->address_id);
                $insertData['conversation_id'] = rand(100000, 999999) . time();
                $insertData['price'] = ($busketTotalPrice);
                $insertData['paid_price'] =  ($busketTotalPrice);
                $insertData['order_id'] = $order->id;
                $insertData['save_card'] = 0;
                $insertData['buyer_id'] = $buyerAdd->user_id;
                $insertData['buyer_first_name'] = $buyerAdd->first_name;
                $insertData['buyer_last_name'] = $buyerAdd->last_name;
                $insertData['buyer_phone'] = 01712345674;
                $insertData['buyer_email'] = $buyerAdd->email;
                $insertData['buyer_identity_number'] = rand(10000000000, 99999999999);
                $insertData['buyer_address'] = $buyerAdd->address;
                $insertData['buyer_ip'] = request()->ip();
                $insertData['buyer_city'] = $buyerAdd->state;
                $insertData['buyer_country'] = $buyerAdd->country;
                $insertData['shipping_contact_name'] = $buyerAdd->first_name . ' ' . $buyerAdd->last_name;
                $insertData['shipping_city'] = $buyerAdd->state;
                $insertData['shipping_country'] = $buyerAdd->country;
                $insertData['shipping_address'] = $buyerAdd->address;
                $insertData['billing_contact_name'] = $buyerAdd->first_name . ' ' . $buyerAdd->last_name;
                $insertData['billing_city'] = $buyerAdd->state;
                $insertData['billing_country'] = $buyerAdd->country ?? 'Turkey';
                $insertData['billing_address'] = $buyerAdd->address;
                $insertData['basket_items'] = $cartproduct;

                $response = (new IyzicoPayment())->create($insertData);
                if ($response->getErrorCode() != null) {
                    $this->dispatchBrowserEvent('paymentFailed');
                } else {

                    $response = [
                        "html_content" => $response->getCheckoutFormContent(),
                        "token" => $response->getToken(),
                        "status" => $response->getStatus(),
                        "url_page" => $response->getPaymentPageUrl(),
                    ];

                    $this->dispatchBrowserEvent('showPaymentModal', $response['html_content']);
                }
            }
            else{
                $this->forgetSession();
                return redirect()->route('front.checkoutSuccess');
            }
        }
        if ($this->use_my_points == 1) {
            $wallet = Wallet::where('user_id', user()->id)->first();
            $wallet->points -= $this->use_point;
            $wallet->save();

            $order = Order::find($order->id);
            $order->points_used = $this->use_point;
            $order->save();
        }

        $mail_data = user();
        $mail_order_details = OrderDetails::where('order_id', $order->id)->get();
        $order_address = Address::where('id', $order->address_id)->first();

        dispatch(function () use ($mail_data, $order, $mail_order_details, $order_address) {
            $mailData['email'] = $mail_data->email;
            $mailData['name'] = $mail_data->name;
            $mailData['delivery_status'] = 'Your Order Placed Successfully!';
            $mailData['code'] = $order->code;
            $mailData['order_address'] = $order_address;
            $mailData['mail_order_details'] = $mail_order_details;

            Mail::send('emails.delevery-status', $mailData, function ($message) use ($mailData) {
                $message->to($mailData['email'])
                    ->subject($mailData['delivery_status']);
            });
        });

        $this->sendNotification($order, 'customer');
        if ($order->seller_id != 0) {
            $this->sendNotification($order, 'seller');
            $this->sendNotification($order, 'admin');
        } else {
            $this->sendNotification($order, 'admin');
        }
    }

    private function sendNotification($order, $for = 'seller')
    {
        if ($for == 'customer') {
            $message['title'] = 'Your order has been placed';
            $message['body'] = 'You have a new order';
        } else {
            $message['title'] = 'New order';
            $message['body'] = 'A new order has been placed';
        }

        $message['order'] = $order;


        $notification = new Notification();
        if ($for == 'customer') {
            $notification->user_id = $order->user_id;
        } else {
            $notification->user_id = $order->seller_id;
        }
        $notification->user_type = $for;
        $notification->subject = 'New Order';
        $notification->content = json_encode($message);
        $notification->save();
    }

    public function forgetSession()
    {
        foreach (Session::get('checkout')['cartItems'] as $itemID) {
            $cItemD = Cart::where('id', $itemID)->first();
            $cItemD->delete();
        }
        session()->forget('coupon');
        session()->forget('checkout');
    }

    public function usePoints()
    {
        if ($this->use_my_points == 1) {
            session()->put('checkout', [
                'status' => 1,
                'cartItems' => Session::get('checkout')['cartItems'],
                'totalItem' => Session::get('checkout')['totalItem'],
                'subtotal' => Session::get('checkout')['subtotal'],
                'totalDiscount' => Session::get('checkout')['totalDiscount'],
                'coupon_discount' => Session::get('checkout')['coupon_discount'],
                'grand_total' => Session::get('checkout')['grand_total'] - $this->point_amount,
            ]);
        } else {
            session()->put('checkout', [
                'status' => 1,
                'cartItems' => Session::get('checkout')['cartItems'],
                'totalItem' => Session::get('checkout')['totalItem'],
                'subtotal' => Session::get('checkout')['subtotal'],
                'totalDiscount' => Session::get('checkout')['totalDiscount'],
                'coupon_discount' => Session::get('checkout')['coupon_discount'],
                'grand_total' => Session::get('checkout')['grand_total'] + $this->point_amount,
            ]);
        }
    }

    public function render()
    {
        $addresses = Address::where('user_id', user()->id)->orderBy('created_at', 'DESC')->get();
        $countries = Country::all();
        $states = State::where('country_id', $this->country)->get();

        if (Session::has('checkout')) {
            return view('livewire.app.checkout.checkout-component-v2', ['addresses' => $addresses, 'countries' => $countries, 'states' => $states])->layout('livewire.layouts.base');
        } else {
            abort(404);
        }
    }
}
