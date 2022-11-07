<?php

namespace App\Http\Livewire\Admin\Variations;

use App\Models\ProductType;
use App\Models\Size;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class  SizeComponent extends Component
{
    use WithPagination;
    public $sortingValue = 10, $searchTerm;
    public $size,$type_id;



    public function storeData()
    {
        $this->validate([
            'size' => 'required|unique:sizes',
            'type_id' => 'required',
        ]);

        $data = new Size();
        $data->size = $this->size;
        $data->type_id = $this->type_id;
        $data->save();
        $this->dispatchBrowserEvent('success', ['message'=>'Size added successfully']);
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->size = '';
        $this->type_id = '';
    }

    public function deleteData($id)
    {
        $data = Size::find($id);
        $data->delete();

        $this->dispatchBrowserEvent('sizeDeleted');
    }

    public function render()
    {
        $productType = ProductType::get();

        $productSize = Size::where('size', 'like', '%'.$this->searchTerm.'%')->orderBy('type_id','desc')->get();
        return view('livewire.admin.variations.size-component', ['productSize'=>$productSize,'productType'=>$productType])->layout('livewire.admin.layouts.base');
    }
}
