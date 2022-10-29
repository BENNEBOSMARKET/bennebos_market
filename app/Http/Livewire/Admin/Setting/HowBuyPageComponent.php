<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Category;
use App\Models\HowBuyPage;
use App\Models\Photo;
use App\Models\Slider;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class HowBuyPageComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm,$title,$description,$banner,$new_banner;
    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed'=>'deleteData'];



    public function storeData()
    {
        $this->validate([

            'banner' => 'required',
            'title'=>'required',
            'description'=>'required',

        ]);


        $data = new HowBuyPage();


        $imageName = Carbon::now()->timestamp. '.' . $this->banner->extension();

        $this->banner->storeAs('imgs/howBuyPages/',$imageName, 's3');
        $data->banner = env('AWS_BUCKET_URL') . 'imgs/howBuyPages/'.$imageName;


        $data->title=$this->title;
        $data->description=$this->description;

        $data->save();

        $this->dispatchBrowserEvent('success', ['message'=>' created successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }
    public function editData($id)
    {
        $getData = HowBuyPage::where('id', $id)->first();

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

        $data = HowBuyPage::where('id', $this->edit_id)->first();




        $data->title = $this->title;
        $data->description = $this->description;
        $data->banner = $this->new_banner;



        if($this->banner != ''){
            $imageName = Carbon::now()->timestamp. '.' . $this->banner->extension();
            $this->banner->storeAs('imgs/howBuyPages',$imageName, 's3');
            $data->banner = env('AWS_BUCKET_URL') . 'imgs/howBuyPages/'.$imageName;
        }

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
        $data = HowBuyPage::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('sliderDeleted');
        $this->resetInputs();

    }

    public function render()
    {
//        $categories = Category::where('parent_id', 0)->where('sub_parent_id', 0)->get();
//        $sliders = Slider::orderBy('id', 'DESC')->paginate($this->sortingValue);
        $howBuyPages=HowBuyPage::all();
        return view('livewire.admin.setting.how-buy-page-component',['howBuyPages'=>$howBuyPages])->layout('livewire.admin.layouts.base');
    }
}
