<?php

namespace App\Http\Livewire\Admin\Qutotation;

use App\Imports\QuotationImport;
use App\Models\Qutotation;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class QutotationComponent extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $sortingValue = 10, $searchTerm, $delete_id, $excel;
    protected $listeners = ['deleteConfirmed'=>'deleteData'];

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'excel'=>'required',
        ]);
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function publishStatus($id)
    {
        $getQutotationr = Qutotation::where('id', $id)->first();

        if($getQutotationr->status == 0){
            $getQutotationr->status = 1;
            $getQutotationr->save();
        }
        else{
            $getQutotationr->status = 0;
            $getQutotationr->save();
        }

        $this->dispatchBrowserEvent('success', ['message'=>'Qutotation updated successfully']);
    }

    public function deleteData()
    {
        $data = Qutotation::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('qutotationDeleted');
        $this->delete_id = '';
    }

    //csv Import
    public function uploadExcel()
    {
        $this->validate([
            'excel'=>'required',
        ]);

        Excel::import(new QuotationImport, $this->excel);

        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>'Quotation imported successfully!']);

        $this->excel = '';
    }

    public function close()
    {
        $this->excel = '';
    }
    public function render()
    {
        $qutotations = Qutotation::where('name', 'like', '%'.$this->searchTerm.'%')
            ->orWhere('sourcing_type', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('quantity', 'LIKE', '%' . $this->searchTerm . '%')
            ->orderBy('id', 'DESC')->paginate($this->sortingValue);

        return view('livewire.admin.qutotation.qutotation-component', ['qutotations'=> $qutotations])->layout('livewire.admin.layouts.base');
    }
}
