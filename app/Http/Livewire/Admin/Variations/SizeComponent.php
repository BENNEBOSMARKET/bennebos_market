<?php

namespace App\Http\Livewire\Admin\Variations;

use App\Models\Size;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class SizeComponent extends Component
{
    use WithPagination;
    public $sortingValue = 10, $searchTerm;
    public $size;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'size' => 'required|unique:sizes',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'size' => 'required|unique:sizes',
        ]);

        $data = new Size();
        $data->size = $this->size;
        $data->save();
        $this->dispatchBrowserEvent('success', ['message'=>'Size added successfully']);
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->size = '';
    }

    public function deleteData($id)
    {
        $data = Size::find($id);
        $data->delete();

        $this->dispatchBrowserEvent('sizeDeleted');
    }

    public function render()
    {
        $productSize = Size::where('size', 'like', '%'.$this->searchTerm.'%')->get();
        return view('livewire.admin.variations.size-component', ['productSize'=>$productSize])->layout('livewire.admin.layouts.base');
    }
}
