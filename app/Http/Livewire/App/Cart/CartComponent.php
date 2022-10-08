<?php

namespace App\Http\Livewire\App\Cart;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CartComponent extends Component
{
    public $SelectedCartItems = [], $selectAll, $size;
    public $quantity = 0;
    public $totalItem = 0, $subtotal = 0, $totalDiscount = 0, $shippingfee = 0, $couponDiscount = 0, $grandTotal = 0;


    public function mount()
    {
        $items = Cart::where('user_id', user()->id)->get();
        foreach ($items as $item) {
            if (!in_array($item->id, $this->SelectedCartItems)) {
                array_push($this->SelectedCartItems, $item->id);
            }
        }
        $this->selectAll = 1;
    }

    public function selectSingleItem()
    {
        $count = Cart::where('user_id', user()->id)->get()->count();
        if (count($this->SelectedCartItems) == $count) {
            $this->selectAll = 1;
        } else {
            $this->selectAll = '';
        }
    }

    public function selectAll()
    {
        if ($this->selectAll == 1) {
            $items = Cart::where('user_id', user()->id)->get();
            foreach ($items as $item) {
                if (!in_array($item->id, $this->SelectedCartItems)) {
                    array_push($this->SelectedCartItems, $item->id);
                }
            }
        } else {
            $this->SelectedCartItems = [];
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'coupon' => 'required',
        ], [
            'coupon.*' => 'Enter a coupon code',
        ]);
    }

    public function increase($id)
    {
        $cart = Cart::where('id', $id)->first();

        $product = Product::where('id', $cart->product_id)->first();
        $discount = ($product->unit_price * $product->discount) / 100;

        $cart->quantity += 1;
        $cart->discount += $discount;
        $cart->price = $cart->price + $product->unit_price;
        $cart->save();
    }

    public function decrease($id)
    {
        $cart = Cart::where('id', $id)->first();

        $product = Product::where('id', $cart->product_id)->first();
        $discount = ($product->unit_price * $product->discount) / 100;

        if ($cart->quantity > $product->min_qty) {
            $cart->quantity -= 1;
            $cart->discount -= $discount;
            $cart->price = $cart->price - $product->unit_price;
            $cart->save();
        }
    }

    public function deleteItem($id)
    {
        $cart = Cart::where('id', $id)->first();
        $cart->delete();

        if(($key = array_search($id ,$this->SelectedCartItems)) !== false){
            unset($this->SelectedCartItems[$key]);
        }

        $this->dispatchBrowserEvent('success', ['message' => 'Item removed from cart']);
        $this->emit('refreshCartIcon');
    }

    public function deleteAll()
    {
        if ($this->SelectedCartItems != []) {
            foreach ($this->SelectedCartItems as $cartItem) {
                $cart = Cart::where('id', $cartItem)->first();
                $cart->delete();

                if(($key = array_search($cartItem ,$this->SelectedCartItems)) !== false){
                    unset($this->SelectedCartItems[$key]);
                }
            }
            $this->dispatchBrowserEvent('success', ['message' => 'Item(s) removed from cart']);
        } else {
            $this->dispatchBrowserEvent('error', ['message' => 'Select your item(s)']);
        }

        $this->emit('refreshCartIcon');
    }

    public $coupon;
    public function applyCoupon()
    {
        $this->validate([
            'coupon' => 'required',
        ], [
            'coupon.*' => 'Enter a valid coupon code',
        ]);

        $coupon = Coupon::where('coupon_code', $this->coupon)->first();

        if ($coupon != '') {
            $date = explode(' - ', $coupon->date);
            $dateFrom = $date[0];
            $dateTo = $date[1];
            if ($dateFrom < Carbon::now()->format('m/d/Y') && $dateTo > Carbon::now()->format('m/d/Y')) {
                session()->put('coupon', [
                    'code' => $coupon->coupon_code,
                    'value' => $coupon->discount,
                    'type' => $coupon->discount_type,
                ]);

                $this->dispatchBrowserEvent('success', ['message' => 'Coupon code applied']);
            } else {
                $this->dispatchBrowserEvent('error', ['message' => 'Invalid Coupon Code!']);
            }
        } else {
            $this->dispatchBrowserEvent('error', ['message' => 'Invalid Coupon Code!']);
        }
    }

    public function removeCoupon()
    {
        session()->forget('coupon');
        $this->dispatchBrowserEvent('success', ['message' => 'Coupon discount removed']);
    }

    public function proceedToCheckout()
    {
        if ($this->SelectedCartItems != []) {
            session()->put('checkout', [
                'status' => 1,
                'cartItems' => $this->SelectedCartItems,
                'totalItem' => $this->totalItem,
                'subtotal' => $this->subtotal,
                'totalDiscount' => $this->totalDiscount,
                'coupon_discount' => $this->couponDiscount,
                'grand_total' => $this->grandTotal,
            ]);

            return redirect()->route('front.checkout');
        } else {
            $this->dispatchBrowserEvent('error', ['message' => 'Select your item(s)']);
        }
    }

    public function render()
    {
        DB::statement("SET SQL_MODE=''");

        $qty = 0;
        $price = 0;
        $discount = 0;

        foreach ($this->SelectedCartItems as $selectedItem) {
            $qty = $qty + Cart::where('id', $selectedItem)->first()->quantity;
            $price = $price + Cart::where('id', $selectedItem)->first()->price;
            $discount = $discount + Cart::where('id', $selectedItem)->first()->discount;
        }

        $this->totalItem = $qty;
        $this->subtotal = $price;
        $this->totalDiscount = $discount;

        if (session('coupon')) {
            if (Session::get('coupon')['type'] == 'Percentage') {
                $this->couponDiscount = (($price-$discount) * Session::get('coupon')['value']) / 100;
            } else {
                $this->couponDiscount = Session::get('coupon')['value'];
            }
        } else {
            $this->couponDiscount = 0;
        }

        $this->grandTotal = $this->subtotal + $this->shippingfee - $this->totalDiscount - $this->couponDiscount;

        $cartItems = Cart::where('user_id', user()->id)->orderBy('id', 'DESC')->get();
        $cartGroups = Cart::where('user_id', user()->id)->groupBy('owner_id')->get();

        return view('livewire.app.cart.cart-component', ['cartItems' => $cartItems, 'cartGroups'=>$cartGroups])->layout('livewire.layouts.base');
    }
}
