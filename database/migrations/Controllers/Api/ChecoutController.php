<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductCollection;
use App\Models\Address;
use App\Models\BusinessSetting;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Wallet;
use App\Services\IyzicoPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ChecoutController extends Controller
{
    //
    public function __construct(ApiResponse $apiResponse, Address $addressModel, Order $orderModel, OrderDetails $orderDetailsModel, Cart $cartModel)
    {
        $this->apiResponse = $apiResponse;
        $this->addressModel = $addressModel;
        $this->orderModel = $orderModel;
        $this->orderDetailsModel = $orderDetailsModel;
        $this->cartModel = $cartModel;
    }

    public function getAddresses()
    {
        $addresses = $this->addressModel->where('user_id', Auth::id())->get();
        return $this->apiResponse->setSuccess("Addresses Has been loaded successfully")->setData($addresses)->getJsonResponse();
    }
    public function createAddresses(Request $request)
    {
        $rules = [
            "first_name" => "required|string|min:2",
            "last_name" => "required|string|min:2",
            "address" => "required|string|min:2",
            "country" => "required|string|min:2",
            "state" => "required|string|min:2",
            "email" => "required|email|min:2",
            "phone" => "required|string|min:2",
            "post_code" => "required|string|min:2",
        ];

        $validations = Validator::make($request->all(), $rules);

        if ($validations->errors()->first()) {
            return $this->apiResponse->setError($validations->errors()->first())->setData()->getJsonResponse();
        }
        $data = array_merge($validations->validated(), ["user_id" => Auth::id()]);

        $address = $this->addressModel->create($data);
        return $this->apiResponse->setSuccess("Address Has been added successfully")->setData($address)->getJsonResponse();
    }

    public function updateAddress(Request $request)
    {
        $rules = [
            "address_id" => "required|integer|min:1|exists:addresses,id",
            "first_name" => "nullable|string|min:2",
            "last_name" => "nullable|string|min:2",
            "address" => "nullable|string|min:2",
            "country" => "nullable|string|min:2",
            "state" => "nullable|string|min:2",
            "email" => "nullable|email|min:2",
            "phone" => "nullable|string|min:2",
            "post_code" => "nullable|string|min:2",
        ];

        $validations = Validator::make($request->all(), $rules);

        if ($validations->errors()->first()) {
            return $this->apiResponse->setError($validations->errors()->first())->setData()->getJsonResponse();
        }
        $data = $validations->validated();
        $address = $this->addressModel->find($data['address_id']);
        $address->update($data);
        return $this->apiResponse->setSuccess("Address Has been updated successfully")->setData($address)->getJsonResponse();
    }

    public function deleteAddress(Address $address)
    {
        $address->delete();
        return $this->apiResponse->setSuccess("Address Has been deleted successfully")->setData($address)->getJsonResponse();
    }

    public function makeOrder(Request $request)
    {

        $rules = [
            "address_id" => "required|integer|exists:addresses,id",
            "payment_method" => "required|string|in:master_card,cod,visa",
            "seller_ids" => "required|array",
            "seller_ids.*" => "required|integer|exists:sellers,id",
            "coupon_id" => "nullable|integer|exists:coupons,id",
            "use_coupon" => "required|in:1,0",
            "use_my_points" => "required|in:1,0",
        ];

        $validations = Validator::make($request->all(), $rules);

        if ($validations->errors()->first()) {
            return $this->apiResponse->setError($validations->errors()->first())->setData()->getJsonResponse();
        }
        foreach ($request->seller_ids as $seller_id) {
            $data = [
                "user_id" => Auth::id(),
                "seller_id" => $seller_id,
                "address_id" => $request->address_id,
                "delivery_status" => "pending",
                "payment_type" => $request->payment_method,
                "code" => strtoupper(Str::random(14)),
            ];

            $cart = $this->cartModel::where("user_id", Auth::id())->where("owner_id", $seller_id);
            $cart_count = $cart->count();
            $total_price = $cart->sum("price");
            $total_discount = $cart->sum("discount");
            $subtotal = $total_price - $total_discount;

            if ($request->use_coupon) {
                $coupon = Coupon::find($request->coupon_id);
                if ($coupon->type == 'Percentage' || $coupon->discount_type == 'Percentage') {
                    $couponDiscount = ($subtotal * $coupon->discount) / 100;
                } else {
                    $couponDiscount = (($coupon->discount) /  $this->cartModel->where("user_id", Auth::id())->count()) * $cart_count;
                }
            } else {
                $couponDiscount = 0;
            }

            $user_points = Wallet::where('user_id', Auth::id())->first()->points;
            if ($request->use_my_points) {
                if ($total_price <= $user_points) {
                    $used_points = round($total_price, 2);
                } else {
                    $used_points = $user_points;
                }
                $point_value = BusinessSetting::orderBy('id', "DESC")->first()->point_value;
                $point_amount = $point_value * $used_points;
                $subtotal -= $point_amount;
            }

            $data['grand_total'] = $subtotal - $couponDiscount;
            $data['discount'] = $total_discount;
            $data['date'] = Carbon::now();
            $data['payment_status'] = "unpaid";
            $order = $this->orderModel->create($data);

            foreach ($cart->get() as $cItem) {
                $order_detail = [
                    "order_id" => $order->id,
                    "seller_id" => $seller_id,
                    "product_id" => $cItem->product_id,
                    "color" => $cItem->color,
                    "size" => $cItem->size,
                    "price" => product($cItem->product_id)->unit_price,
                    "quantity" => $cItem->quantity,
                    "total" => product($cItem->product_id)->unit_price * $cItem->quantity,
                ];
                $order_details = $this->orderDetailsModel->create($order_detail);
            }
        }
        $busketTotalPrice = 0;
        $sellersCart = $this->cartModel->where('user_id', Auth::id())->whereIn("owner_id",$request->seller_ids)->get();
        if ($couponDiscount != 0) {
            $cdiscount = $couponDiscount / count($sellersCart);
        } else {
            $cdiscount = 0;
        }
        foreach ($sellersCart as $cItem) {
            $productInfo = product($cItem->product_id);
            $categoryInfo = category($productInfo->category_id);
            $unitPrice = round(discountPrice($productInfo->id) - $cdiscount, 2);
            $cartItemPrice = round($unitPrice * $cItem->quantity, 2);

            $cartproduct[] = [
                "id" => $cItem->product_id,
                "name" => $productInfo->name,
                "category" => $categoryInfo->name,
                "price" => $cartItemPrice
            ];

            $busketTotalPrice += $cartItemPrice;
        }

        if ($request->payment_method == 'visa' || $request->payment_method == 'master_card') {
            //get address
            $buyerAdd = $this->addressModel::find($request->address_id);
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
                $this->cartModel->whereIn('owner_id',$request->seller_ids)->delete();
                return $this->apiResponse->setError($response->getErrorMessage())->setData()->getJsonResponse();
            } else {
                $this->cartModel->whereIn('owner_id',$request->seller_ids)->delete();
                $response = [
                    "html_content" => $response->getCheckoutFormContent(),
                    "token" => $response->getToken(),
                    "status" => $response->getStatus(),
                    "url_page" => $response->getPaymentPageUrl(),
                ];
                return $this->apiResponse->setSuccess("order created Successfully")->setData($response)->getJsonResponse();
            }
        }
        else{
            $this->cartModel->whereIn('owner_id',$request->seller_ids)->delete();
            return $this->apiResponse->setSuccess("order created Successfully")->setData()->getJsonResponse();
        }
        
    }
    
    public function deleteOrder(Order $order){
        if($order->delivery_status == 'pending'){
            $order->update(['order_status' => "canceled"]);
            return $this->apiResponse->setSuccess("order Canceled")->setData($order)->getJsonResponse();
        }
        return $this->apiResponse->setSuccess("order cannot be canceled because its shipping status")->setData($order)->getJsonResponse();
    }
    
    public function getOrders(){
        return $this->apiResponse->setSuccess("orders loaded successfully")->setData($this->orderModel->where('user_id',Auth::id())->get())->getJsonResponse();
    }
    public function getOrderProducts(Order $order){
        $order_details_products = $this->orderDetailsModel->where('order_id',$order->id)->pluck("product_id");
        return $this->apiResponse->setSuccess("order products loaded successfully")->setData(new ProductCollection(Product::whereIn('id',$order_details_products)->get()))->getJsonResponse();
        

    }
}
