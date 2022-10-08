<?php

namespace App\Http\Livewire\Admin\Marketing;

use App\Models\Partner;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class PartnerComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm;
    public $name, $logo, $uploadedLogo;
    public $edit_id, $delete_id;
    protected $listeners = ['deleteConfirmed' => 'deleteData'];

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:partners,name,' . $this->edit_id . '',
            'logo' => 'required',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'name' => 'required|unique:partners',
            'logo' => 'required',
        ]);

        $data = new Partner();
        $data->name = $this->name;
        $imageName = Carbon::now()->timestamp . '.' . $this->logo->extension();
        $this->logo->storeAs('imgs/partner', $imageName, 's3');
        $data->logo = env('AWS_BUCKET_URL') . 'imgs/partner/' . $imageName;

        $data->save();

        $this->dispatchBrowserEvent('success', ['message' => 'Partner logo added successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->name = '';
        $this->logo = '';
        $this->uploadedLogo = '';
    }


    public function editData($id)
    {
        $getData = Partner::where('id', $id)->first();
        $this->edit_id = $getData->id;
        $this->name = $getData->name;
        $this->uploadedLogo = $getData->logo;
        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'name' => 'required',
        ]);

        $data = Partner::where('id', $this->edit_id)->first();
        $data->name = $this->name;
        $data->logo = $this->uploadedLogo;
       
        if ($this->logo != '') {
            $imageName = Carbon::now()->timestamp . '.' . $this->logo->extension();
            $this->logo->storeAs('imgs/partner', $imageName, 's3');
            $data->logo = env('AWS_BUCKET_URL') . 'imgs/partner/' . $imageName;
        }

        $data->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message' => 'Partner logo updated successfully']);

        $this->resetInputs();
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteData()
    {
        $data = Partner::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('partnerDeleted');
        $this->resetInputs();
    }

    public function render()
    {
        $partners = Partner::orderBy('id', 'DESC')->paginate($this->sortingValue);
        return view('livewire.admin.marketing.partner-component', ['partners'=>$partners])->layout('livewire.admin.layouts.base');
    }
}
