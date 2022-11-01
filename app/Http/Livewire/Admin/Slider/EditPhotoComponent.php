<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Models\Category;
use App\Models\Photo;
use App\Models\Slider;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class EditPhotoComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm;
    public $slider_link, $status, $banner, $new_banner, $category,$place,$type,$home;
    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed'=>'deleteData'];



    public function storeData()
    {
        $this->validate([

            'banner' => 'required',
            'category'=>'required',
            'place'=>'required',

        ]);


        $data = new Photo();


        $imageName = Carbon::now()->timestamp. '.' . $this->banner->extension();

        $this->banner->storeAs('imgs/photoPages/'.$this->category,$imageName, 's3');
        $data->banner = env('AWS_BUCKET_URL') . 'imgs/photoPages/'.$this->category.'/'.$imageName;



//        $data->banner =  $imageName;
        $data->category_id=$this->category;
        $data->place=$this->place;


        $data->save();

        $this->dispatchBrowserEvent('success', ['message'=>'Slider created successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }
    public function storePhotoHome()
    {
        $this->validate([

            'banner' => 'required',
            'place'=>'required',

        ]);


        $data = new Photo();


        $imageName = Carbon::now()->timestamp. '.' . $this->banner->extension();

        $this->banner->storeAs('imgs/photoPages/',$imageName, 's3');
        $data->banner = env('AWS_BUCKET_URL') . 'imgs/photoPages/'.$imageName;



//        $data->banner =  $imageName;
        $data->home='home';
        $data->place=$this->place;


        $data->save();

        $this->dispatchBrowserEvent('success', ['message'=>'Slider created successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }
    public function editData($id)
    {
        $getData = Photo::where('id', $id)->first();

        $this->edit_id = $getData->id;

        $this->category = $getData->category_id;
        $this->new_banner = $getData->banner;
        $this->place = $getData->place;
        $this->home = $getData->home;
        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'new_banner' => 'required',
            'category'=>'required'
        ]);

        $data = Photo::where('id', $this->edit_id)->first();




        $data->category_id = $this->category;
        $data->place=$this->place;
        $data->banner = $this->new_banner;

        if($this->banner != ''){
            $imageName = Carbon::now()->timestamp. '.' . $this->banner->extension();
            $this->banner->storeAs('imgs/photoPages/'.$this->category,$imageName, 's3');
            $data->banner = env('AWS_BUCKET_URL') . 'imgs/photoPages/'.$this->category.'/'.$imageName;
        }

        $data->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>'Slider updated successfully']);
        $this->resetInputs();
    }


    public function editHomePhotoData($id)
    {
        $getData = Photo::where('id', $id)->first();

        $this->edit_id = $getData->id;


        $this->new_banner = $getData->banner;
        $this->place = $getData->place;
        $this->home = $getData->home;
        $this->dispatchBrowserEvent('showEditHomePhotoModal');
    }
    public function updateHomePhoto()
    {
        $this->validate([
            'home' => 'required',
            'place' => 'required',

        ]);

        $data = Photo::where('id', $this->edit_id)->first();

        $data->place = $this->place;
        $data->banner = $this->new_banner;

        if($this->banner != ''){
            $imageName = Carbon::now()->timestamp. '.' . $this->banner->extension();
            $this->banner->storeAs('imgs/photoHomePages',$imageName, 's3');
            $data->banner = env('AWS_BUCKET_URL') . 'imgs/photoHomePages/'.$imageName;
        }

        $data->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>'Slider updated successfully']);
        $this->resetInputs();
    }
    public function resetInputs()
    {

        $this->banner = '';
        $this->new_banner = '';
        $this->place='';

    }
//
//    public function editData($id)
//    {
//        $getData = Slider::where('id', $id)->first();
//
//        $this->edit_id = $getData->id;
//        $this->slider_link = $getData->shop_link;
//        $this->status = $getData->status;
//        $this->category = $getData->category_id;
//        $this->new_banner = $getData->banner;
//        $this->dispatchBrowserEvent('showEditModal');
//    }
//
//    public function updateData()
//    {
//        $this->validate([
//            'slider_link' => 'required',
//            'category' => 'required',
//        ]);
//
//        $data = Slider::where('id', $this->edit_id)->first();
//        $data->shop_link = $this->slider_link;
//        $data->category_id = $this->category;
//        $data->banner = $this->new_banner;
//
//        if($this->banner != ''){
//            $imageName = Carbon::now()->timestamp. '.' . $this->banner->extension();
//            $this->banner->storeAs('imgs/slider',$imageName, 's3');
//            $data->banner = env('AWS_BUCKET_URL') . 'imgs/slider/'.$imageName;
//        }
//
//        $data->save();
//        $this->dispatchBrowserEvent('closeModal');
//        $this->dispatchBrowserEvent('success', ['message'=>'Slider updated successfully']);
//        $this->resetInputs();
//    }
//
//    public function deleteConfirmation($id)
//    {
//        $this->delete_id = $id;
//        $this->dispatchBrowserEvent('show-delete-confirmation');
//    }
//
//    public function deleteData()
//    {
//        $data = Slider::find($this->delete_id);
//        $data->delete();
//
//        $this->dispatchBrowserEvent('sliderDeleted');
//        $this->resetInputs();
//
//    }

    public function render()
    {
        $categories = Category::where('parent_id', 0)->where('sub_parent_id', 0)->get();
        $photosCategory=Photo::where('category_id','!=',null)->orderBy('category_id','asc')->get();
        $photosHome=Photo::where('home','home')->get();
        return view('livewire.admin.slider.edit-photo-component',['photosCategory' => $photosCategory,'categories'=>$categories,'photosHome'=>$photosHome])->layout('livewire.admin.layouts.base');
    }
}
