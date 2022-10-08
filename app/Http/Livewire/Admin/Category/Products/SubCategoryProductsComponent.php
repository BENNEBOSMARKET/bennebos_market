<?php

namespace App\Http\Livewire\Admin\Category\Products;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class SubCategoryProductsComponent extends Component
{
    use WithPagination;

    public $subcategory_id, $category, $sort_product, $sortingValue = 10, $searchTerm;
    public function mount($id)
    {
        $this->subcategory_id = $id;
        $this->category = Category::find($id);
    }

    public function categoryPinned($id)
    {
        $getProduct = Product::where('id', $id)->first();

        if($getProduct->category_pinned == 0){
            $getProduct->category_pinned = 1;
            $getProduct->save();
        }
        else{
            $getProduct->category_pinned = 0;
            $getProduct->save();
        }

        $this->dispatchBrowserEvent('success', ['message'=>'Added Pinned Category Product']);
    }
    public function categoryFeatured($id)
    {
        $getProduct = Product::where('id', $id)->first();

        if($getProduct->category_featured == 0){
            $getProduct->category_featured = 1;
            $getProduct->save();
        }
        else{
            $getProduct->category_featured = 0;
            $getProduct->save();
        }

        $this->dispatchBrowserEvent('success', ['message'=>'Added Pinned Category Product']);
    }

    public function render()
    {
        $categories = [$this->subcategory_id];
        $subcategories = DB::table('categories')->where('sub_parent_id', $this->subcategory_id)->pluck("id")->toArray();
        $categories = array_merge($categories, $subcategories);

        $products =  DB::table('products')->whereIn('category_id', $categories);

        if($this->sort_product == 'pinned'){
            $products = $products->where('category_pinned', 1);
        }
        if($this->sort_product == 'featured'){
            $products = $products->where('category_featured', 1);
        }

        $products = $products->where('status', 1)->where('name', 'like', '%'.$this->searchTerm.'%')
            ->latest()
            ->paginate($this->sortingValue);
            

        return view('livewire.admin.category.products.sub-category-products-component', ['products'=>$products])->layout('livewire.admin.layouts.base');
    }
}
