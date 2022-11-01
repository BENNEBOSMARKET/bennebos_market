<?php

namespace App\Http\Livewire\Admin\Cms;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class BigDealsComponent extends Component
{
    public $new_arrival, $top_ranked, $persona_protective, $dropshipping, $global_original_sources, $true_view;

    use WithPagination;
    public $sortingValue = 10, $searchTerm, $delete_id, $sort_category;

    public function bestBigDeal($id)
    {
        $getProduct = Product::where('id', $id)->first();

        if($getProduct->best_big_deal == 0){
            $getProduct->best_big_deal = 1;
            $getProduct->save();
        }
        else{
            $getProduct->best_big_deal = 0;
            $getProduct->save();
        }

        $this->dispatchBrowserEvent('success', ['message'=>'Right slider added!']);
    }

    public function newArrival($id)
    {
        $getProduct = Product::where('id', $id)->first();

        if($getProduct->big_deal_new_arrival == 0){
            $getProduct->big_deal_new_arrival = 1;
            $getProduct->save();
        }
        else{
            $getProduct->big_deal_new_arrival = 0;
            $getProduct->save();
        }

        $this->dispatchBrowserEvent('success', ['message'=>'Added to Big Deals']);
    }

    public function mostViewed($id)
    {
        $getProduct = Product::where('id', $id)->first();

        if($getProduct->big_deal_most_viewed == 0){
            $getProduct->big_deal_most_viewed = 1;
            $getProduct->save();
        }
        else{
            $getProduct->big_deal_most_viewed = 0;
            $getProduct->save();
        }

        $this->dispatchBrowserEvent('success', ['message'=>'Added to Big Deals']);
    }

    public function dealOfSesion($id)
    {
        $getProduct = Product::where('id', $id)->first();

        if($getProduct->deal_of_season == 0){
            $getProduct->deal_of_season = 1;
            $getProduct->save();
        }
        else{
            $getProduct->deal_of_season = 0;
            $getProduct->save();
        }

        $this->dispatchBrowserEvent('success', ['message'=>'Added to Big Deals']);
    }


    public function bigNeeds($id)
    {
        $getProduct = Product::where('id', $id)->first();

        if($getProduct->big_needs == 0){
            $getProduct->big_needs = 1;
            $getProduct->save();
        }
        else{
            $getProduct->big_needs = 0;
            $getProduct->save();
        }

        $this->dispatchBrowserEvent('success', ['message'=>'Added to Big Deals']);
    }

    public function bigQuantity($id)
    {
        $getProduct = Product::where('id', $id)->first();

        if($getProduct->big_quantity == 0){
            $getProduct->big_quantity = 1;
            $getProduct->save();
        }
        else{
            $getProduct->big_quantity = 0;
            $getProduct->save();
        }

        $this->dispatchBrowserEvent('success', ['message'=>'Added to Big Deals']);
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

        $products = $products->where('name', 'like', '%'.$this->searchTerm.'%')
            ->orderBy('id', 'DESC')->paginate($this->sortingValue);

        $categories = Category::where('parent_id', 0)->where('sub_parent_id', 0)->get();

        return view('livewire.admin.cms.big-deals-component', ['products'=>$products, 'categories'=>$categories])->layout('livewire.admin.layouts.base');
    }
}
