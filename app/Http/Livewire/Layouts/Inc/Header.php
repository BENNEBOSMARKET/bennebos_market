<?php

namespace App\Http\Livewire\Layouts\Inc;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Language;
use App\Models\Product;
use App\Models\Searches;
use App\Models\Shop;
use App\Models\Slider;
use App\Models\TopBanner;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Header extends Component
{
    public $cartQty = 0, $fixed = 0;
    public $setting, $homeSliders, $tab = 'allProducts', $query, $recentSearches = [], $recentQueries;

    protected $listeners = ['refreshCartIcon' => '$refresh'];

    public $category_id;
    public function mount()
    {
        if (request()->is('category/*')) {
            $this->category_id = Category::where('slug', session('slugMsg'))->first()->id;
        }
    }

    public function deleteFromCart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();

        $this->dispatchBrowserEvent('success', ['message' => 'Item removed from cart!']);
    }

    public function addQuery()
    {
        if (session()->get('recentSearches') != '') {
            $this->recentSearches = session()->get('recentSearches');
        } else {
            $this->recentSearches = [];
        }

        $this->validate([
            'query' => 'required',
        ]);

        $getQuery = Searches::where('query', $this->query)->first();

        if ($getQuery != '') {
            $query = Searches::find($getQuery->id);
            $query->count += 1;
            $query->save();
        } else {
            $query = new Searches();
            $query->query = $this->query;
            $query->count = 1;
            $query->save();
        }

        if (in_array($this->query, $this->recentSearches)) {
        } else {
            if (count($this->recentSearches) > 5) {
                array_shift($this->recentSearches);
                array_push($this->recentSearches, $this->query);
            } else {
                array_push($this->recentSearches, $this->query);
            }
        }

        session()->put('recentSearches', $this->recentSearches);

        return redirect()->route('front.allProducts', ['slug' => 'search', 'q=' . $this->query . '']);
    }

    public function clearSearches()
    {
        session()->forget('recentSearches');
    }

    public $showSearch = 0;
    public function render()
    {
        $cartItems = [];

        $this->setting = WebsiteSetting::where('id', 1)->first();

        $brands = collect([]);
        $allCategories = Category::select('slug', 'name')
            ->where('parent_id', 0)
            ->where('sub_parent_id', 0)
            ->get();

        if ($this->category_id != '') {
            $hotsellers = Shop::where('verification_status', 1)->orderBy('total_sale', 'DESC')->where('category_id', $this->category_id)->first();
            $new_trends = Product::where('status', 1)->orderBy('created_at', 'DESC')->where('category_id', $this->category_id)->inRandomOrder()->first();
            $discount_products = Product::where('status', 1)->where('category_id', $this->category_id)->where('discount', '!=', 0)->first();
            $this->homeSliders = Slider::select('shop_link', 'banner')->where('category_id', $this->category_id)->where('status', 1)->get();
            $allSubCategories = Category::select('icon', 'name', 'id')->where('parent_id', $this->category_id)->where('sub_parent_id', 0)->limit(7)->get();
            $getBrands = DB::table('brands')->select('slug', 'logo', 'name', 'category_id')->get();

            foreach ($getBrands as $brnd) {

                if (!is_null(json_decode($brnd->category_id)) && in_array($this->category_id, json_decode($brnd->category_id))) {
                    $brands->push($brnd);
                }
            }
        } else {
            $hotsellers = Shop::where('verification_status', 1)->orderBy('total_sale', 'DESC')->first();
            $new_trends = DB::table('products')->where('status', 1)->orderBy('created_at', 'DESC')->first();
            $discount_products = DB::table('products')->where('discount', '!=', 0)->where('status', 1)->first();
            $this->homeSliders = Slider::select('shop_link', 'banner')->where('status', 1)->get();
            $allSubCategories = Category::select('icon', 'name', 'id')->where('parent_id', '!=', 0)->where('sub_parent_id', 0)->where('featured', 1)->limit(7)->get();
            $getBrands = DB::table('brands')->limit('20')->get();
            foreach ($getBrands as $brnd) {
                $brands->push($brnd);
            }
        }

        $popularSearches = Searches::select('query')->orderBy('count', 'DESC')->limit(25)->get();

        $topBanner = TopBanner::select('title', 'festival_name', 'banner', 'url')->orderBy('id', 'DESC')->first();

        $right_sliders = Product::where('right_slider', 1)
            ->select('slug', 'thumbnail')
            ->where('status', 1)
            ->limit(6)
            ->get();

        if (Auth::guard('web')->user()) {
            $this->cartQty = Cart::where('user_id', user()->id)->get()->count();

            $cartItems = DB::table('carts')
                ->leftJoin('products', 'products.id', '=', 'carts.product_id')
                ->leftJoin('sellers', 'sellers.id', '=', 'products.user_id')
                ->where('carts.user_id', user()->id)
                ->select(
                    'products.slug',
                    'products.thumbnail',
                    'products.name',
                    'sellers.name as seller_name',
                    'products.discount',
                    'products.unit_price',
                    'carts.id as cart_id',

                )
                ->get();
        }

        return view('livewire.layouts.inc.header', [
            'cartItems' => $cartItems,
            'allCategories' => $allCategories,
            'popularSearches' => $popularSearches,
            'brands' => $brands,
            'allSubCategories' => $allSubCategories,
            'hotsellers' => $hotsellers,
            'new_trends' => $new_trends,
            'discount_products' => $discount_products,
            'topBanner' => $topBanner,
            'right_sliders' => $right_sliders
        ]);
    }
}
