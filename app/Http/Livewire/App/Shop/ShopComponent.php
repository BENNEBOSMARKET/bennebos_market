<?php

namespace App\Http\Livewire\App\Shop;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Shop;
use App\Models\WishList;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    use WithPagination;
    public $shop_id, $tab = 'home';

    public function mount($slug){
        $shop = Shop::where('slug', $slug)->first();
        $this->shop_id = $shop->id;
    }

    public function changeTab($name)
    {
        $this->tab = $name;
    }
    public function addToCartSingle($id)
    {
        if (Auth::guard('web')->user()) {
            $product = Product::find($id);
            $checkCart = Cart::where('user_id', user()->id)->where('product_id', $id)->first();

            if ($checkCart != '') {
                $checkCart->price = $checkCart->price + ($product->unit_price * 1);
                $checkCart->quantity = $checkCart->quantity + 1;
                $checkCart->discount = $checkCart->discount + (($product->unit_price * $product->discount) / 100) * 1;
                $checkCart->save();
            } else {
                $cart = new Cart();
                $cart->owner_id = $product->user_id;
                $cart->product_id = $id;
                $cart->user_id = user()->id;
                $cart->price = $product->unit_price;
                $cart->quantity = 1;
                $cart->discount = (($product->unit_price * $product->discount) / 100) * 1;
                $cart->color = '';
                $cart->size = '';
                $cart->status = 0;
                $cart->save();
            }

            $this->dispatchBrowserEvent('success', ['message' => 'Item added to cart successfully']);
            $this->emit('refreshCartIcon');
        } else {
            return redirect()->route('customerLogin');
        }
    }

    public function wishlist($id)
    {
        if (Auth::guard('web')->user()) {
            if (checkIfWishlisted($id) > 0) {
                $wishlist = WishList::where('product_id', $id)->where('user_id', user()->id)->first();
                $wishlist->delete();

                $this->dispatchBrowserEvent('warning', ['message' => 'Product removed from wishlist']);
            } else {
                $wishlist = new WishList();
                $wishlist->user_id = user()->id;
                $wishlist->product_id = $id;
                $wishlist->save();

                $this->dispatchBrowserEvent('success', ['message' => 'Product added to wishlist']);
            }
        } else {
            return redirect()->route('customerLogin');
        }
    }

    public function render()
    {
        $shop = Shop::where('id', $this->shop_id)->first();
        $shop_products = Product::where('user_id', $shop->seller_id)->where('status', 1)->get()->count();
        $shop_all_products = Product::where('user_id', $shop->seller_id)->where('status', 1)->paginate(16);

        $shop_recent_products = Product::where('user_id', $shop->seller_id)->where('status', 1)->orderBy('id', 'DESC')->take(8)->get();
        $shop_recomand_products = Product::where('user_id', $shop->seller_id)->where('status', 1)->inRandomOrder()->take(8)->get();
        $shop_popular_products = Product::where('user_id', $shop->seller_id)->where('status', 1)->orderBy('total_review', 'DESC')->take(8)->get();

        return view('livewire.app.shop.shop-component', ['shop' => $shop, 'shop_products' => $shop_products, 'shop_all_products' => $shop_all_products, 'shop_recent_products' => $shop_recent_products, 'shop_recomand_products' => $shop_recomand_products, 'shop_popular_products' => $shop_popular_products])->layout('livewire.layouts.base');
    }
}
