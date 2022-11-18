<?php

namespace App\Http\Livewire\Admin\Variations;

use App\Models\Category;
use App\Models\ProductsColor;
use App\Models\ProductType;
use App\Models\Size;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class  ColorsComponent extends Component
{
    use WithPagination;
    public $sortingValue = 10, $searchTerm;
    public $color,$sub_sub_category_id;



    public function storeData()
    {
        $this->validate([
            'color' => 'required|unique:products_colors',
            'sub_sub_category_id' => 'required',
        ]);

        $data = new ProductsColor();
        $data->color = $this->color;
        $data->sub_sub_category_id = $this->sub_sub_category_id;
        $data->save();
        $this->dispatchBrowserEvent('success', ['message'=>'Size added successfully']);
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->color = '';
        $this->sub_sub_category_id = '';
    }

    public function deleteData($id)
    {
        $data = ProductsColor::find($id);
        $data->delete();

        $this->dispatchBrowserEvent('sizeDeleted');
    }

    public function render()
    {
        $productType = Category::where('parent_id','!=',0)->where('sub_parent_id','!=',0)->get();

        $productColor = ProductsColor::where('color', 'like', '%'.$this->searchTerm.'%')->orderBy('sub_sub_category_id','desc')->get();
        return view('livewire.admin.variations.colors-component', ['productColor'=>$productColor,'productType'=>$productType])->layout('livewire.admin.layouts.base');
    }
}
