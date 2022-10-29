<?php

namespace App\Http\Livewire\Admin\Setting;


use App\Models\HelpCenterPage;

use App\Models\OurServicePage;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class OurServiceComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm,$title,$description,$banner,$new_banner;
    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed'=>'deleteData'];



    public function storeData()
    {
        $this->validate([

            'banner'=>'required',
            'title'=>'required',
            'description'=>'required',

        ]);


        $data = new OurServicePage();



        $imageName = Carbon::now()->timestamp. '.' . $this->banner->extension();
        $this->banner->storeAs('imgs/service',$imageName, 's3');
        $data->banner = env('AWS_BUCKET_URL') . 'imgs/service/'.$imageName;

        $data->title=$this->title;
        $data->description=$this->description;

        $data->save();

        $this->dispatchBrowserEvent('success', ['message'=>' created successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }
    public function editData($id)
    {
        $getData = OurServicePage::where('id', $id)->first();

        $this->edit_id = $getData->id;

        $this->title = $getData->title;
        $this->description = $getData->description;
        $this->new_banner = $getData->banner;

        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
//

            'description'=>'required',
            'title'=>'required',
        ]);

        $data = OurServicePage::where('id', $this->edit_id)->first();

        $data->banner = $this->new_banner;

        if($this->banner != ''){
            $imageName = Carbon::now()->timestamp. '.' . $this->banner->extension();
            $this->banner->storeAs('imgs/service',$imageName, 's3');
            $data->banner = env('AWS_BUCKET_URL') . 'imgs/service/'.$imageName;
        }


        $data->title = $this->title;
        $data->description = $this->description;


        $data->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>' updated successfully']);
        $this->resetInputs();
    }
    public function resetInputs()
    {
        $this->new_banner = '';
        $this->banner='';
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
        $data = OurServicePage::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('sliderDeleted');
        $this->resetInputs();

    }

    public function render()
    {

        $services=OurServicePage::all();
        return view('livewire.admin.setting.our-service-component',['services'=>$services])->layout('livewire.admin.layouts.base');
    }
}
