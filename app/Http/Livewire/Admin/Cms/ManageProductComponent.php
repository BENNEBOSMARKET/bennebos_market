<?php

namespace App\Http\Livewire\Admin\Cms;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ManageProductComponent extends Component
{
    public $new_arrival, $top_ranked, $persona_protective, $dropshipping, $global_original_sources, $true_view;

    use WithPagination;
    public $sortingValue = 10, $searchTerm, $delete_id, $sort_category;

    public function rightSlider($id)
    {
        $getProduct = Product::where('id', $id)->first();

        if($getProduct->right_slider == 0){
            $getProduct->right_slider = 1;
            $getProduct->save();
        }
        else{
            $getProduct->right_slider = 0;
            $getProduct->save();
        }

        $this->dispatchBrowserEvent('success', ['message'=>'Right slider added!']);
    }

    public function newArrival($id)
    {
        $getProduct = Product::where('id', $id)->first();

        if($getProduct->new_arrival == 0){
            $getProduct->new_arrival = 1;
            $getProduct->save();
        }
        else{
            $getProduct->new_arrival = 0;
            $getProduct->save();
        }

        $this->dispatchBrowserEvent('success', ['message'=>'Added New Arrival Product']);
    }

    public function topRanked($id)
    {
        $getProduct = Product::where('id', $id)->first();

        if($getProduct->top_ranked == 0){
            $getProduct->top_ranked = 1;
            $getProduct->save();
        }
        else{
            $getProduct->top_ranked = 0;
            $getProduct->save();
        }

        $this->dispatchBrowserEvent('success', ['message'=>'Added Top Ranked Product']);
    }

    public function dropShipping($id)
    {
        $getProduct = Product::where('id', $id)->first();

        if($getProduct->dropshipping == 0){
            $getProduct->dropshipping = 1;
            $getProduct->save();
        }
        else{
            $getProduct->dropshipping = 0;
            $getProduct->save();
        }

        $this->dispatchBrowserEvent('success', ['message'=>'Added Dropshipping Product']);
    }


    public function trueView($id)
    {
        $getProduct = Product::where('id', $id)->first();

        if($getProduct->true_view == 0){
            $getProduct->true_view = 1;
            $getProduct->save();
        }
        else{
            $getProduct->true_view = 0;
            $getProduct->save();
        }

        $this->dispatchBrowserEvent('success', ['message'=>'Added True View Product']);
    }

    public function bestSelling($id)
    {
        $getProduct = Product::where('id', $id)->first();

        if($getProduct->best_selling == 0){
            $getProduct->best_selling = 1;
            $getProduct->save();
        }
        else{
            $getProduct->best_selling = 0;
            $getProduct->save();
        }

        $this->dispatchBrowserEvent('success', ['message'=>'Added to Best Selling Product']);
    }

    public function render()
    {
        $products = DB::table('products')->where('id', '!=', '');

        if($this->sort_category != ''){
            $categories = [$this->sort_category];

            $subcategories = DB::table('categories')->where('parent_id', $this->sort_category)->where('sub_parent_id', 0)->pluck("id")->toArray();
            $categories = array_merge($categories, $subcategories);
            $subsubcategories = DB::table('categories')->whereIn('sub_parent_id', $categories)->pluck("id")->toArray();
            $categories = array_merge($categories, $subsubcategories);

            $products = $products->whereIn('category_id', $categories)->where('status', 1);
        }

        $products = $products->where('name', 'like', '%'.$this->searchTerm.'%')->orderBy('id', 'DESC')->paginate($this->sortingValue);

        $categories = Category::where('parent_id', 0)->where('sub_parent_id', 0)->get();
        return view('livewire.admin.cms.manage-product-component', ['products'=>$products, 'categories'=>$categories])->layout('livewire.admin.layouts.base');
    }
}
