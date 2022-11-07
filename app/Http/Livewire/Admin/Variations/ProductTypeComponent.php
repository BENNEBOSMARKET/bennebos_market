<?php

namespace App\Http\Livewire\Admin\Variations;

use App\Models\ProductType;
use App\Models\Size;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class  ProductTypeComponent extends Component
{
    use WithPagination;
    public $sortingValue = 10, $searchTerm;
    public $type;


    public function storeData()
    {
        $this->validate([
            'type' => 'required|unique:product_types',
        ]);

        $data = new ProductType();
        $data->type = $this->type;
        $data->save();
        $this->dispatchBrowserEvent('success', ['message'=>'Type added successfully']);
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->size = '';
    }

    public function deleteData($id)
    {
        $data = ProductType::find($id);
        $data->delete();

        $this->dispatchBrowserEvent('sizeDeleted');
    }

    public function render()
    {
        $productType = ProductType::where('type', 'like', '%'.$this->searchTerm.'%')->get();
        return view('livewire.admin.variations.product-type-component', ['productType'=>$productType])->layout('livewire.admin.layouts.base');
    }
}
