<?php

namespace App\Http\Livewire\App;

use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\WishList;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsPageComponent extends Component
{
    use WithPagination;

    public $sortByPrice,
        $sortByBrand,
        $orderByMinOrder,
        $sortByReview,
        $sortByCategory = '',
        $sortBySubCategory = '',
        $sortBySubSubCategory = '',
        $sortByPriceRange,
        $selected_category = '';

    public $allCategories = [];

    public $sortCategoryID = '', $sortSubCategoryID = '', $sortSubSubCategoryID = '', $uiStatus = '0';

    public $maincategory, $sub_category, $sub_sub_category, $sQuery;

    public function mount($slug)
    {
        if($slug == 'all'){
            $this->allCategories = [];
        }
        elseif($slug == 'search'){
            $this->sQuery = request()->get('q');
        }
        else{
            if(request()->is('products/brand/*')){
                $brand = Brand::where('slug', $slug)->first();
                if ($brand) {
                    $this->sortByBrand = $brand->id;
                    $this->allCategories = [];
                }
                else{
                    abort(404);
                }
            }
            if(request()->is('products/category/*')){
                $cat = Category::where('slug', $slug)->first();
                if( $cat ) {
                    $this->selected_category = $cat->id;
                    $this->allCategories = [$cat->id];

                    if($cat->parent_id == 0 && $cat->sub_parent_id == 0){
                        $subcategories = Category::where('parent_id', $cat->id)->pluck("id")->toArray();
                        $this->allCategories = array_merge($this->allCategories, $subcategories);
                    }
                    if($cat->parent_id != 0 && $cat->sub_parent_id == 0){
                        $subsubcategories = Category::where('sub_parent_id', $cat->id)->pluck("id")->toArray();
                        $this->allCategories = array_merge($this->allCategories, $subsubcategories);
                    }

                    $this->sortByBrand = '';

                    $categorytag = Category::where('slug', $slug)->first();
                    if($categorytag->parent_id == 0 && $categorytag->sub_parent_id == 0){
                        $this->maincategory = $categorytag;
                    }
                    else if($categorytag->parent_id != 0 && $categorytag->sub_parent_id == 0){
                        $this->sub_category = $categorytag;
                        $this->maincategory = Category::where('id', $categorytag->parent_id)->first();
                    }
                    else if($categorytag->parent_id != 0 && $categorytag->sub_parent_id != 0){
                        $this->sub_sub_category = $categorytag;
                        $this->maincategory = Category::where('id', $categorytag->parent_id)->first();
                        $this->sub_category = Category::where('id', $categorytag->sub_parent_id)->first();
                    }

                }
                else{
                    abort(404);
                }
            }
        }
    }

    public function selectBrand($id)
    {
        $this->sortByBrand = $id;
    }

    public function selectCategory($id)
    {
        $cat = Category::find($id);

        if($cat){
            $this->selected_category = $cat->id;
            $this->allCategories = [$cat->id];

            if($cat->parent_id == 0 && $cat->sub_parent_id == 0){
                $subcategories = Category::where('parent_id', $cat->id)->pluck("id")->toArray();
                $this->allCategories = array_merge($this->allCategories, $subcategories);
            }
            else if($cat->parent_id != 0 && $cat->sub_parent_id == 0){
                $subsubcategories = Category::where('sub_parent_id', $cat->id)->pluck("id")->toArray();
                $this->allCategories = array_merge($this->allCategories, $subsubcategories);
            }
            else if($cat->parent_id != 0 && $cat->sub_parent_id != 0){

            }

            $categorytag = Category::where('id', $id)->first();
            if($categorytag->parent_id == 0 && $categorytag->sub_parent_id == 0){
                $this->maincategory = $categorytag;
                $this->sub_category = '';
                $this->sub_sub_category = '';
            }
            else if($categorytag->parent_id != 0 && $categorytag->sub_parent_id == 0){
                $this->sub_category = $categorytag;
                $this->maincategory = Category::where('id', $categorytag->parent_id)->first();
                $this->sub_sub_category = '';
            }
            else if($categorytag->parent_id != 0 && $categorytag->sub_parent_id != 0){
                $this->sub_sub_category = $categorytag;
                $this->maincategory = Category::where('id', $categorytag->parent_id)->first();
                $this->sub_category = Category::where('id', $categorytag->sub_parent_id)->first();
            }
        }
        else{
            $this->resetCategory();
        }

    }


    // public function selectMainCategory($id)
    // {
    //     $categories = [$id];

    //     $subcategories = Category::where('parent_id', $id)->where('sub_parent_id', 0)->pluck('id')->toArray();
    //     $categories = array_merge($categories, $subcategories);
    //     $subsubcategories = Category::where('parent_id', $id)->whereIn('sub_parent_id', $categories)->pluck('id')->toArray();
    //     $categories = array_merge($categories, $subsubcategories);

    //     $this->allCategories = $categories;

    //     $this->sortByCategory = $id;
    //     $this->sortCategoryID = $id;
    //     $this->uiStatus = 1;
    // }

    // public function selectSubCategory($id)
    // {
    //     $categories = [$id];
    //     $subsubcategories = Category::whereIn('sub_parent_id', $categories)->pluck('id')->toArray();
    //     $categories = array_merge($categories, $subsubcategories);

    //     $this->allCategories = $categories;

    //     $this->sortByCategory = $id;
    //     $this->sortSubCategoryID = $id;
    //     $this->uiStatus = 2;
    // }
    // public function selectSubSubCategory($id)
    // {
    //     $categories = [$id];
    //     $this->allCategories = $categories;

    //     $this->sortByCategory = $id;
    //     $this->sortSubSubCategoryID = $id;
    //     $this->uiStatus = 3;
    // }

    public function resetCategory()
    {
        $this->allCategories = [];
        $this->uiStatus = 0;
        $this->sortByCategory = '';
        $this->sortCategoryID = '';
        $this->sortSubCategoryID = '';
        $this->sortSubSubCategoryID = '';
        $this->selected_category = '';
    }

    // public function changeUiStatus()
    // {
    //     if($this->uiStatus == 1){
    //         $this->uiStatus = 0;
    //         $this->sortByCategory = '';
    //         $this->sortCategoryID = '';
    //         $this->sortSubCategoryID = '';
    //         $this->sortSubSubCategoryID = '';
    //     } else if($this->uiStatus == 2){
    //         $this->uiStatus = 1;
    //         $this->sortByCategory = $this->sortCategoryID;
    //         $this->sortSubCategoryID = '';
    //         $this->sortSubSubCategoryID = '';
    //     } else if($this->uiStatus == 3){
    //         $this->uiStatus = 2;
    //         $this->sortByCategory = $this->sortSubCategoryID;
    //         $this->sortSubSubCategoryID = '';
    //     }
    // }

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
        DB::statement("SET SQL_MODE=''");
        $local = Lang::locale() == "tur"? "tr": Lang::locale();

        // $products_db =  DB::table('products')
        // ->leftJoin('products_descriptions', "products.id", 'products_descriptions.product_id')
        // ->leftJoin('items_languages', "items_languages.id", 'products_descriptions.language_id')
        // ->where('items_languages.local', $local);

        $products_db =  DB::table('products');
        $product = $products_db->where('products.id','!=', '');
        if($this->sortByPrice == 'low_to_high'){
            $product = $product->orderBy('products.unit_price', 'ASC');
        }
        if($this->sortByPrice == 'high_to_low'){
            $product = $product->orderBy('products.unit_price', 'DESC');
        }
        if($this->sortByBrand != ''){
            $product = $product->where('products.brand_id', $this->sortByBrand);
        }
        if($this->orderByMinOrder != ''){
            $product = $product->where('products.min_qty', $this->orderByMinOrder);
        }
        if($this->sortByReview != ''){
            $product = $product->where('products.avg_review', $this->sortByReview);
        }
        if($this->sortByPriceRange != ''){
            $min = explode(',', $this->sortByPriceRange)[0];
            $max= explode(',', $this->sortByPriceRange)[1];

            $product = $product->whereBetween('products.unit_price', [$min, $max]);
        }
        if($this->allCategories){
            $product = $product->whereIn('products.category_id', $this->allCategories);
        }
        if($this->sQuery != ''){
            $product = $product->where('products.name', 'like', '%'.$this->sQuery.'%');
        }
//        ->select("products.slug", "products.unit_price","products.id","products_descriptions.name","products.thumbnail");

        $products = $product
        ->where('status', 1)
        ->select("products.slug", "products.unit_price", "products.discount", "products.min_qty", "products.id","products.name","products.thumbnail")
        ->groupBy('main_product_id')
        ->groupBy('size_id')
        ->paginate(16);

        /*if ( empty($this->sortByPrice)
            && empty($sortByReview)
            && empty($sortByPriceRange)) {

            $products = $products->groupBy('main_product_id')
                ->groupBy('size_id');

            $products = $products->paginate(16);

        } else {
            $products = $products->paginate(16);
        }*/


        $brands = DB::table('brands')->select('id', 'name')->where('status', 1)->get();
        $minQuantities = $product->select('min_qty')->groupBy('products.min_qty')->get();
        $categories = Category::select('id', 'name')->get();
        // $subcategories = Category::where('parent_id', $this->sortCategoryID)->where('sub_parent_id', 0)->get();
        // $subsubcategories = Category::where('parent_id', $this->sortCategoryID)->where('sub_parent_id', $this->sortSubCategoryID)->get();

        return view('livewire.app.products-page-component', ['products'=>$products, 'brands'=>$brands, 'minQuantities'=>$minQuantities, 'categories'=>$categories])->layout('livewire.layouts.base');
    }
}
