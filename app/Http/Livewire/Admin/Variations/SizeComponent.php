<?php

namespace App\Http\Livewire\Admin\Variations;

use App\Models\Category;
use App\Models\ProductType;
use App\Models\Size;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class  SizeComponent extends Component
{
    use WithPagination;
    public $sortingValue = 10, $searchTerm;
    public $size,$sub_sub_category_id,$category,$subCategory_id;



    public function storeData()
    {
        $this->validate([
            'size' => 'required|unique:sizes',
            'sub_sub_category_id' => 'required',
        ]);

        $data = new Size();
        $data->size = $this->size;
        $data->sub_sub_category_id = $this->sub_sub_category_id;
        $data->save();
        $this->dispatchBrowserEvent('success', ['message'=>'Size added successfully']);
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->size = '';
        $this->sub_sub_category_id = '';
    }

    public function deleteData($id)
    {
        $data = Size::find($id);
        $data->delete();

        $this->dispatchBrowserEvent('sizeDeleted');
    }

    public function render()
    {
        $categories = Category::get();

        $subCategories = Category::where("parent_id", $this->category)->where('sub_parent_id',0)->get();
        $subSubCategories = Category::where("parent_id", $this->category)->where('sub_parent_id',$this->subCategory_id)->get();

        $productSize = Size::where('size', 'like', '%'.$this->searchTerm.'%')->orderBy('sub_sub_category_id','desc')->get();
        return view('livewire.admin.variations.size-component', ['productSize'=>$productSize,'categories'=>$categories,'subCategories'=>$subCategories,'subSubCategories'=>$subSubCategories])->layout('livewire.admin.layouts.base');
    }
}
