<?php

namespace App\Http\Livewire\Admin\CompanyInfo;

use App\Imports\CompanyCategoryImport;
use App\Models\CompanyCategory;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class CompanyCategoryComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $category_id, $category_name, $formStatus;
    public $sortingValue = 10, $searchTerm;
    public $edit_id, $delete_id;
    public $excel;

    protected $listeners = ['deleteConfirmed'=>'deleteData'];

    public function mount()
    {
        //
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'excel'=>'required',
        ]);
    }

    public function resetInputs()
    {
        $this->category_id = '';
        $this->category_name = '';
        $this->delete_id = '';
        $this->edit_id = '';
        $this->excel = '';
    }

    public function close()
    {
        $this->resetInputs();
    }

    public function storeData()
    {
        $this->validate([
            'category_name' => 'required',
            'category_id' => 'required|numeric',
        ]);

        $data = new CompanyCategory();
        $data->category_id = $this->category_id;
        $data->name = $this->category_name;
        $data->save();

        $this->dispatchBrowserEvent('success', ['message'=>'Category created successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }

    public function editData($id)
    {
        $getData = CompanyCategory::where('id', $id)->first();
        $this->category_id = $getData->category_id;
        $this->category_name = $getData->name;
        $this->edit_id = $getData->id;

        $this->formStatus = 'Update';

        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'category_name' => 'required',
            'category_id' => 'required|numeric',
        ]);

        $data = CompanyCategory::where('id', $this->edit_id)->first();
        $data->category_id = $this->category_id;
        $data->name = $this->category_name;
        $data->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>'Category updated successfully']);

        $this->resetInputs();
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteData()
    {
        $data = CompanyCategory::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('categoryDeleted');
        $this->resetInputs();

    }

    public function changeSearch()
    {
        $this->resetPage();
    }

    //csv Import
    public function uploadExcel()
    {
        $this->validate([
            'excel'=>'required',
        ]);

        Excel::import(new CompanyCategoryImport, $this->excel);

        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>'Category imported successfully!']);

        $this->excel = '';
    }

    public function render()
    {
        $categories = CompanyCategory::where('name', 'like', '%'.$this->searchTerm.'%')->paginate($this->sortingValue);
        return view('livewire.admin.company-info.company-category-component',['categories' => $categories])->layout('livewire.admin.layouts.base');
    }
}
