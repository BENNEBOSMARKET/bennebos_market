<?php

namespace App\Http\Livewire\App\Checkout;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\SubOrder;
use App\Models\SubOrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Support\Str;
use Stevebauman\Location\Facades\Location;

class CheckoutComponent extends Component
{
    public $payment_method;
    public $first_name, $last_name, $email, $phone, $country, $state, $address, $formStatus = 0, $edit_id, $address_id, $delivery_type;
    public $totalItem, $subtotal, $totalDiscount, $shippingfee = 0, $couponDiscount = 0, $grandTotal = 0;


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
        $this->delivery_type = $val;
    }

    public $sellers = [];

    public function mount()
    {
        foreach (Session::get('checkout')['cartItems'] as $item) {
            $cItem = Cart::where('id', $item)->first();
            if (!in_array($cItem->owner_id, $this->sellers)) {
                array_push($this->sellers, $cItem->owner_id);
            }
        }

        $ip = request()->ip();

        // $ip = '162.159.24.227';
        $location = Location::get($ip);

        if($location == false){
            $this->country = 'Turkey';
        }

        else{
            $this->country = Country::where('name', $location->countryName)->first()->name;
        }
        $this->first_name = user()->first_name;
        $this->last_name = user()->last_name;
        $this->phone = user()->phone;
        $this->email = user()->email;
        $this->state = user()->state;
        $this->address = user()->address;

    }


    public function confirmCheckout()
    {
        $this->validate([
            'address_id' => 'required',
            'delivery_type' => 'required',
        ], [
            'address_id.*' => 'Select your address',
            'delivery_type.*' => 'Select delivery type',
        ]);

        DB::statement("SET SQL_MODE=''");

        $order = new Order();
        $order->user_id = user()->id;
        $order->address_id = $this->address_id;
        $order->delivery_status = 'pending';
        $order->payment_type = $this->delivery_type;
        if ($this->delivery_type == 'cod') {
            $order->payment_status = 'unpaid';
        }

        $trxId = strtoupper(Str::random(10));

        $order->grand_total = Session::get('checkout')['grand_total'];
        $order->discount = Session::get('checkout')['totalDiscount'];
        $order->coupon_discount = Session::get('checkout')['coupon_discount'];
        $order->code = $trxId;
        $order->date = Carbon::now();
        $order->save();

        //Add Order Details
        foreach (Session::get('checkout')['cartItems'] as $itemID) {
            $cItem = Cart::where('id', $itemID)->first();

            $orderDetails = new OrderDetails();
            $orderDetails->order_id = $order->id;
            $orderDetails->seller_id = $cItem->owner_id;
            $orderDetails->product_id = $cItem->product_id;
            $orderDetails->color = $cItem->color;
            $orderDetails->size = $cItem->size;
            $orderDetails->price = product($cItem->product_id)->unit_price;
            $orderDetails->quantity = $cItem->quantity;
            $orderDetails->total = product($cItem->product_id)->unit_price * $cItem->quantity;
            // $orderDetails->payment_status = 'unpaid';
            // $orderDetails->delivery_status = 'pending';
            $orderDetails->save();
        }


        //Sub Orders
        foreach ($this->sellers as $seller) {
            $subOrder = new SubOrder();
            $subOrder->order_id = $order->id;
            $subOrder->seller_id = $seller;
            $subOrder->status = 'pending';
            if ($seller == 0) {
                $subOrder->manufacture_by = 'In-House';
            } else {
                $subOrder->manufacture_by = 'Seller';
            }

            $ttl = 0;
            $ttlDis = 0;
            $itm = 0;
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

            $subOrder->total = $subtotal - $couponDiscount;
            $subOrder->discount = $ttlDis;
            $subOrder->coupon_discount = $couponDiscount;

            if ($subOrder->save()) {
                foreach (Session::get('checkout')['cartItems'] as $itemID) {
                    $cItemSub = Cart::where('id', $itemID)->where('owner_id', $seller)->first();

                    if ($cItemSub != '') {
                        $subOrderItem = new SubOrderItem();
                        $subOrderItem->sub_order_id = $subOrder->id;
                        $subOrderItem->seller_id = $seller;
                        $subOrderItem->product_id = $cItemSub->product_id;
                        $subOrderItem->color = $cItemSub->color;
                        $subOrderItem->size = $cItemSub->size;
                        $subOrderItem->price = product($cItemSub->product_id)->unit_price;
                        $subOrderItem->quantity = $cItemSub->quantity;
                        $subOrderItem->total = product($cItemSub->product_id)->unit_price * $cItemSub->quantity;
                        $subOrderItem->save();
                    }
                }
            }
        }

        foreach (Session::get('checkout')['cartItems'] as $itemID) {
            $cItem = Cart::where('id', $itemID)->first();
            $cItem->delete();
        }

        session()->forget('coupon');
        session()->forget('checkout');

        return redirect()->route('front.checkoutSuccess');
    }


    public function order()
    {
        $insertData['conversation_id'] = Str::random(10);

        $cartInfo = Session::get('checkout')['cartItems'];
        $price = 0;

        foreach ($cartInfo as $item) {
//            $price += product($item)->unit_price * ;
        }
    }


    public function render()
    {
        $addresses = Address::where('user_id', user()->id)->orderBy('created_at', 'DESC')->get();
        $countries = Country::all();

        if (Session::has('checkout')) {
            return view('livewire.app.checkout.checkout-component', ['addresses' => $addresses, 'countries'=>$countries])->layout('livewire.layouts.base');
        } else {
            abort(404);
        }
    }
}
