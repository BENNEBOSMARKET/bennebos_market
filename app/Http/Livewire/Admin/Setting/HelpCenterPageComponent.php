<?php

namespace App\Http\Livewire\Admin\Setting;


use App\Models\HelpCenterPage;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class HelpCenterComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm,$title,$description;
    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed'=>'deleteData'];



    public function storeData()
    {
        $this->validate([


            'title'=>'required',
            'description'=>'required',

        ]);


        $data = new HelpCenterPage();





        $data->title=$this->title;
        $data->description=$this->description;

        $data->save();

        $this->dispatchBrowserEvent('success', ['message'=>' created successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }
    public function editData($id)
    {
        $getData = HelpCenterPage::where('id', $id)->first();

        $this->edit_id = $getData->id;

        $this->title = $getData->title;
        $this->description = $getData->description;

        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
//

            'description'=>'required',
            'title'=>'required',
        ]);

        $data = HelpCenterPage::where('id', $this->edit_id)->first();




        $data->title = $this->title;
        $data->description = $this->description;


        $data->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>' updated successfully']);
        $this->resetInputs();
    }
    public function resetInputs()
    {


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
        $data = HelpCenterPage::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('sliderDeleted');
        $this->resetInputs();

    }

    public function render()
    {
//        $categories = Category::where('parent_id', 0)->where('sub_parent_id', 0)->get();
//        $sliders = Slider::orderBy('id', 'DESC')->paginate($this->sortingValue);
        $HelpCenter=HelpCenterPage::all();
        return view('livewire.admin.setting.features-edit-component',['HelpCenter'=>$HelpCenter])->layout('livewire.admin.layouts.base');
    }
}
