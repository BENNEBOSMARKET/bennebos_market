<?php

namespace App\Http\Livewire\Admin\Setting\Color;

use App\Models\Color;
use Livewire\Component;
use Livewire\WithPagination;

class ColorComponent extends Component
{
    use WithPagination;

    public $sortingValue = 10, $searchTerm;

    public $name, $code;

    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed'=>'deleteData'];

    public function mount()
    {
        
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:colors,name,'.$this->edit_id.'',
            'code' => 'required|unique:colors,code,'.$this->edit_id.'',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'name' => 'required|unique:colors',
            'code' => 'required|unique:colors',
        ]);

        $data = new Color();
        $data->name = $this->name;
        $data->code = $this->code;

        $data->save();

        $this->dispatchBrowserEvent('success', ['message'=>'New color added successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->edit_id = '';
        $this->delete_id = '';
        $this->name = '';
        $this->code = '';
    }


    public function editData($id)
    {
        $getData = Color::where('id', $id)->first();

        $this->edit_id = $getData->id;
        $this->name = $getData->name;
        $this->code = $getData->code;

        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'name' => 'required|unique:colors,name,'.$this->edit_id.'',
            'code' => 'required|unique:colors,code,'.$this->edit_id.'',
        ]);

        $data = Color::where('id', $this->edit_id)->first();
        $data->name = $this->name;
        $data->code = $this->code;
        
        $data->save();

        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>'Color updated successfully']);
        
        $this->resetInputs();
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteData()
    {
        $data = Color::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('colorDeleted');
        $this->resetInputs();

    }

    public function render()
    {
        $colors = Color::where('name', 'like', '%'.$this->searchTerm.'%')->where('code', 'like', '%'.$this->searchTerm.'%')->paginate($this->sortingValue);

        return view('livewire.admin.setting.color.color-component', ['colors'=>$colors])->layout('livewire.admin.layouts.base');
    }
}
