<?php

namespace App\Http\Livewire\App\Pages;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\WishList;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BestSellingProducts extends Component
{
    use WithPagination;

    public $category_id, $slug, $category;
    public function mount($slug)
    {
        $this->slug = $slug;
        if($slug != 'all'){
            $this->category_id = Category::where('slug', $slug)->first()->id;
            $this->category = Category::where('slug', $slug)->first();
        }
        
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


    public $total, $sortType;
    public function render()
    {
        if($this->slug == 'all'){
            $bestSellingProducts = Product::where('id', '!=', null);
            $this->total = Product::where('status', 1)->where('best_selling', 1)->get()->count();
        }
        else{
            $category_id = Category::where('slug', $this->slug)->first()->id;
            $categories = [$category_id];
            $subcategories = DB::table('categories')->where('parent_id', $category_id)->where('sub_parent_id', 0)->pluck("id")->toArray();
            $categories = array_merge($categories, $subcategories);
            $subsubcategories = DB::table('categories')->whereIn('sub_parent_id', $categories)->pluck("id")->toArray();
            $categories = array_merge($categories, $subsubcategories);


            $bestSellingProducts = DB::table('products')->whereIn('category_id', $categories);


            $this->total = DB::table('products')->whereIn('category_id', $categories)->where('status', 1)->where('best_selling', 1)->get()->count();
        }
        

        if($this->sortType == 1){
            $bestSellingProducts = $bestSellingProducts->orderBy('unit_price', 'ASC');
        }
        if($this->sortType == 2){
            $bestSellingProducts = $bestSellingProducts->orderBy('unit_price', 'DESC');
        }
        if($this->sortType == null){
            $bestSellingProducts = $bestSellingProducts->orderBy('id', 'DESC');
        }

        $bestSellingProducts = $bestSellingProducts->where('status', 1)->where('best_selling', 1)->paginate(20);

        
        return view('livewire.app.pages.best-selling-products', ['bestSellingProducts'=>$bestSellingProducts])->layout('livewire.layouts.base');
    }
}
