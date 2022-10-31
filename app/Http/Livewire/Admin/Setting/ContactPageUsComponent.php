<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Category;
use App\Models\ContactUs;
use App\Models\ContactUsPage;
use App\Models\HowBuyPage;
use App\Models\Photo;
use App\Models\Slider;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ContactPageUsComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm,$email,$phone,$address;
    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed'=>'deleteData'];



    public function storeData()
    {
        $this->validate([

            'email' => 'required',
            'phone'=>'required',
            'address'=>'required',

        ]);


        $data = new ContactUsPage();


        $data->email=$this->email;
        $data->phone=$this->phone;
        $data->address=$this->address;

        $data->save();

        $this->dispatchBrowserEvent('success', ['message'=>' created successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }
    public function editData($id)
    {
        $getData = ContactUsPage::where('id', $id)->first();

        $this->edit_id = $getData->id;

        $this->email = $getData->email;
        $this->phone= $getData->phone;
        $this->address = $getData->address;
        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
//
            'email' => 'required',
            'phone'=>'required',
            'address'=>'required',
        ]);

        $data = ContactUsPage::where('id', $this->edit_id)->first();




        $data->email=$this->email;
        $data->phone=$this->phone;
        $data->address=$this->address;
        $data->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>' updated successfully']);
        $this->resetInputs();
    }
    public function resetInputs()
    {

        $this->email = '';
        $this->phone = '';
        $this->address='';


    }


    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteData()
    {
        $data = ContactUsPage::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('sliderDeleted');
        $this->resetInputs();

    }

    public function render()
    {

        $Contacts=ContactUsPage::all();

        return view('livewire.admin.setting.contact-us-component',['Contacts'=>$Contacts])->layout('livewire.admin.layouts.base');
    }
}
