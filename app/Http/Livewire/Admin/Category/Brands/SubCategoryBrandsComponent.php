<?php

namespace App\Http\Livewire\Admin\Category\Brands;

use App\Models\Brand;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class SubCategoryBrandsComponent extends Component
{
    use WithPagination;

    public $subcategory_id, $category, $sortBy, $sortingValue, $searchTerm;
    public function mount($id)
    {
        $cat = Category::find($id);

        $this->subcategory_id = $cat->id;
    }

    public function brandPinned($id)
    {
        $category = Category::where('id', $this->subcategory_id)->first();
        $brands = $category->brands;

        if(count(json_decode($category->brands)) > 20){
            $this->dispatchBrowserEvent('error', ['message'=>'Max number of brands added']);
        }
        else{
            if(!in_array($id, json_decode($category->brands))){
                $category->brands = array_merge([$id], json_decode($category->brands));
                $category->save();
            } else{
                $category->brands = array_merge(array_diff(json_decode($brands), [$id]));
                $category->save();
            }
            $this->dispatchBrowserEvent('success', ['message'=>'Added Pinned Category brand']);
        }
        
    }
    
    public function render()
    {
        $this->category = Category::find($this->subcategory_id);

        $brands = $brands =  Brand::where('id', '!=', null);
        if($this->sortBy == 'pinned'){
            $brands = $brands->whereIn('id', json_decode($this->category->brands));
        }
        $brands =  $brands->where('name', 'like', '%'.$this->searchTerm.'%')->paginate($this->sortingValue);
        return view('livewire.admin.category.brands.sub-category-brands-component', ['brands'=>$brands])->layout('livewire.admin.layouts.base');
    }
}
