<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Category;
use App\Models\ContactUs;
use App\Models\HowBuyPage;
use App\Models\Photo;
use App\Models\Slider;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ContectUsComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm,$select,$input;
    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed'=>'deleteData'];



    public function storeData()
    {
        $this->validate([

            'select' => 'required',
            'input'=>'required',


        ]);


        $data = new ContactUs();


        $data->select=$this->select;
        $data->input=$this->input;

        $data->save();

        $this->dispatchBrowserEvent('success', ['message'=>' created successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }
    public function editData($id)
    {
        $getData = ContactUs::where('id', $id)->first();

        $this->edit_id = $getData->id;

        $this->input = $getData->input;
        $this->select = $getData->select;

        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
//

            'select' => 'required',
            'input'=>'required',
        ]);

        $data = ContactUs::where('id', $this->edit_id)->first();




        $data->select=$this->select;
        $data->input=$this->input;

        $data->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>' updated successfully']);
        $this->resetInputs();
    }
    public function resetInputs()
    {

        $this->banner = '';
        $this->new_banner = '';
        $this->title='';
        $this->description='';

    }


    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteData()
    {
        $data = ContactUs::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('sliderDeleted');
        $this->resetInputs();

    }

    public function render()
    {
//        $categories = Category::where('parent_id', 0)->where('sub_parent_id', 0)->get();
//        $sliders = Slider::orderBy('id', 'DESC')->paginate($this->sortingValue);
        $Contacts=ContactUs::all();
        return view('livewire.admin.setting.contact-us-component',['Contacts'=>$Contacts])->layout('livewire.admin.layouts.base');
    }
}
