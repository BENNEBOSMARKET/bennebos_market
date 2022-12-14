<?php

namespace App\Http\Livewire\App;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\WishList;
use App\Models\Subscriber;
use App\Models\BottomBanner;
use App\Models\MiddleBanner;
use App\Models\Partner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class IndexComponentV3 extends Component
{
    // public $email;

    protected $listeners = ['load-more' => 'loadMore'];

    public function mount()
    {

    }

    public function subscribe($email)
    {
        $getSubscriber = Subscriber::where('email', $email)->first();

        if ($getSubscriber == '') {
            $subscriber = new Subscriber();
            $subscriber->email = $email;
            $subscriber->save();

            $this->dispatchBrowserEvent('success', ['message' => 'You have subscribed successfully']);
            $this->dispatchBrowserEvent('resetInput');
        } else {
            $this->dispatchBrowserEvent('warning', ['message' => 'You are already a subscriber']);
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

    public $paginateValue = 9;
    public function loadMore()
    {
        $this->paginateValue = $this->paginateValue + 9;
    }

    public function render()
    {
        return view('livewire.app.index-component-v3', $this->getAllQueries())->layout('livewire.layouts.base');
    }


    private function getAllQueries(){

        $new_arrivals = Product::leftJoin("categories","products.category_id", "=","categories.id")
            ->select('products.name', 'products.slug', 'products.id', 'products.thumbnail', 'products.unit_price', 'discount')
            ->where('products.new_arrival', 1)
            ->where('categories.country_id', Session::get("delivery_country_id"))
            ->where('products.status', 1)
            ->limit(20)
            ->orderBy('products.updated_at', 'DESC')
            ->get();

        $top_products = Product::leftJoin("categories","products.category_id", "=","categories.id")
            ->where('products.top_ranked', 1)
            ->where('categories.country_id', Session::get("delivery_country_id"))
            ->select('products.name', 'products.slug', 'products.id', 'products.thumbnail', 'products.unit_price', 'discount')
            ->where('products.status', 1)
            ->limit(20)
            ->orderBy('products.updated_at', 'DESC')
            ->get();

        $dropshippings = Product::leftJoin("categories","products.category_id", "=","categories.id")
        ->where('products.dropshipping', 1)
        ->select('products.name', 'products.slug', 'products.id', 'products.thumbnail', 'products.unit_price', 'discount')
        ->where('categories.country_id', Session::get("delivery_country_id"))
        ->where('products.status', 1)
        ->limit(20)
        ->orderBy('products.updated_at', 'DESC')
        ->get();

        $opportunities = Product::leftJoin("categories","products.category_id", "=","categories.id")
        ->where('products.true_view', 1)
        ->select('products.name', 'products.slug', 'products.id', 'products.thumbnail', 'products.unit_price', 'discount')
        ->where('categories.country_id', Session::get("delivery_country_id"))
        ->where('products.status', 1)
        ->limit(20)
        ->orderBy('products.updated_at', 'DESC')
        ->get();

        $best_selling = Product::leftJoin("categories","products.category_id", "=","categories.id")
        ->select('products.name', 'products.slug', 'products.id', 'products.thumbnail', 'products.unit_price', 'discount')
        ->where('products.best_selling', 1)
        ->where('categories.country_id', Session::get("delivery_country_id"))
        ->where('products.status', 1)
        ->limit(20)
        ->orderBy('products.updated_at', 'DESC')
        ->get();


        $middle_banner = MiddleBanner::select('banner', 'title')->orderBy('created_at', 'DESC')->first();
        $bottom_banner = BottomBanner::select('banner', 'title')->orderBy('created_at', 'DESC')->first();
        $subCategorytopFive = Category::select('name', 'slug', 'featured_image', 'id', 'featured_image')
            ->where('country_id', Session::get("delivery_country_id"))
            ->where('parent_id', '!=', 0)
            ->where('sub_parent_id', 0)
            ->take(5)
            ->get();

        $subCategoryF9 = Category::select('name', 'slug', 'featured_image', 'id', 'banner')
            ->where('country_id', Session::get("delivery_country_id"))
            ->where('parent_id', '!=', 0)
            ->where('sub_parent_id', 0)
            ->take(9)
            ->get();

        $subCategoryT_all = Category::select('id', 'slug', 'banner', 'name')
            ->where('country_id', Session::get("delivery_country_id"))
            ->where('parent_id', '!=', 0)
            ->where('sub_parent_id', 0)
            
            ->paginate($this->paginateValue);

        $deals_of_day = DB::table('products')
            ->where('products.status', 1)
            ->where('products.deal_of_day', 1)
            ->orderBy('products.id', 'DESC')
            ->leftJoin("categories","products.category_id", "=","categories.id")
            ->leftJoin('shops', 'shops.seller_id', '=', 'products.user_id')
            ->leftJoin('reviews', 'reviews.product_id', '=', 'products.id')
            ->leftJoin('deals_of_days', 'deals_of_days.product_id', '=', 'products.id')
            ->where('categories.country_id', Session::get("delivery_country_id"))
            ->limit(7)
            ->select(
                "products.slug", "products.name","products.thumbnail",
                "products.unit_price","products.id","products.user_id",
                'shops.logo as shop_logo', 'shops.name as shop_name',
                "products.discount", 'products.id',
                'deals_of_days.date_to',
                // count total reviews
                DB::raw('(SELECT COUNT(id) FROM reviews WHERE reviews.product_id = products.id) as total_reviews'),
                // count total ratings
                DB::raw('(SELECT SUM(rating) FROM reviews WHERE reviews.product_id = products.id) as total_ratings'),
            )
            ->get();

        // Partner
        $partners = Partner::where('status', 1)->get();

        //BigDeals
        $bd_best_deals = DB::table('products')
        ->leftJoin("categories","products.category_id", "=","categories.id")
        ->select('products.name', 'products.slug', 'products.thumbnail', 'products.unit_price', 'products.id', 'discount')
        ->where('categories.country_id', Session::get("delivery_country_id"))
        ->where('products.best_big_deal', 1)
        ->where('products.status', 1)
        ->limit(8)
        ->get();
        $bd_new_arrivals = DB::table('products')->leftJoin("categories","products.category_id", "=","categories.id")
        ->select('products.name', 'products.slug', 'products.thumbnail', 'products.unit_price', 'products.id', 'discount')
        ->where('categories.country_id', Session::get("delivery_country_id"))
        ->where('products.big_deal_new_arrival', 1)
        ->where('products.status', 1)
        ->limit(8)->get();
        $bd_most_viewed = DB::table('products')
        ->leftJoin("categories","products.category_id", "=","categories.id")
        ->select('products.name', 'products.slug', 'products.thumbnail', 'products.unit_price', 'products.id', 'discount')
        ->where('categories.country_id', Session::get("delivery_country_id"))
        ->where('products.big_deal_most_viewed', 1)
        ->where('status', 1)
        ->limit(8)
        ->get();
        $bd_deal_of_seasons = DB::table('products')
        ->leftJoin("categories","products.category_id", "=","categories.id")
        ->select('products.name', 'products.slug', 'products.thumbnail', 'products.unit_price', 'products.id', 'discount')
        ->where('categories.country_id', Session::get("delivery_country_id"))
        ->where('products.deal_of_season', 1)
        ->where('products.status', 1)
        ->limit(8)
        ->get();
        $bd_big_needs = DB::table('products')
        ->leftJoin("categories","products.category_id", "=","categories.id")
        ->select('products.name', 'products.slug', 'products.thumbnail', 'products.unit_price', 'products.id', 'discount')
        ->where('categories.country_id', Session::get("delivery_country_id"))
        ->where('products.big_needs', 1)
        ->where('products.status', 1)
        ->limit(8)
        ->get();
        $bd_big_quantity = DB::table('products')
        ->leftJoin("categories","products.category_id", "=","categories.id")
        ->select('products.name', 'products.slug', 'products.thumbnail', 'products.unit_price', 'products.id', 'discount')
        ->where('products.big_quantity', 1)
        ->where('products.status', 1)
        ->limit(8)
        ->get();
        
        return [
            'new_arrivals' => $new_arrivals,
            'top_products' => $top_products,
            'dropshippings' => $dropshippings,
            'opportunities' => $opportunities,
            'best_selling' => $best_selling,
            'middle_banner' => $middle_banner,
            'bottom_banner' => $bottom_banner,
            'subCategorytopFive' => $subCategorytopFive,
            'subCategoryF9' => $subCategoryF9,
            'subCategoryT_all' => $subCategoryT_all,
            'deals_of_day' => $deals_of_day,
            'bd_best_deals' => $bd_best_deals,
            'bd_new_arrivals' => $bd_new_arrivals,
            'bd_most_viewed' => $bd_most_viewed,
            'bd_deal_of_seasons' => $bd_deal_of_seasons,
            'bd_big_needs' => $bd_big_needs,
            'bd_big_quantity' => $bd_big_quantity,
            'partners' => $partners,
        ];
    }
}
