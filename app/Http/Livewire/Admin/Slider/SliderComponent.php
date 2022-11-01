<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Models\Category;
use App\Models\Slider;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class SliderComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm;
    public $slider_link, $status, $banner, $new_banner, $category;
    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed'=>'deleteData'];

    public function publishStatus($id)
    {
        $getSlider = Slider::where('id', $id)->first();

        if($getSlider->status == 0){
            $getSlider->status = 1;
            $getSlider->save();
        }
        else{
            $getSlider->status = 0;
            $getSlider->save();
        }

        $this->dispatchBrowserEvent('success', ['message'=>'Published reviews updated successfully']);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'slider_link' => 'required',
            'banner' => 'required',
            'category' => 'required',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'slider_link' => 'required',
            'banner' => 'required',
            'category' => 'required',
        ]);

        $data = new Slider();
        $data->shop_link = $this->slider_link;
        $data->category_id = $this->category;

        $imageName = Carbon::now()->timestamp. '.' . $this->banner->extension();
        $this->banner->storeAs('imgs/slider',$imageName, 's3');
        $data->banner = env('AWS_BUCKET_URL') . 'imgs/slider/'.$imageName;

        $data->save();

        $this->dispatchBrowserEvent('success', ['message'=>'Slider created successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->slider_link = '';
        $this->status = '';
        $this->banner = '';
        $this->new_banner = '';
        $this->category = '';
    }

    public function editData($id)
    {
        $getData = Slider::where('id', $id)->first();

        $this->edit_id = $getData->id;
        $this->slider_link = $getData->shop_link;
        $this->status = $getData->status;
        $this->category = $getData->category_id;
        $this->new_banner = $getData->banner;
        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'slider_link' => 'required',
            'category' => 'required',
        ]);

        $data = Slider::where('id', $this->edit_id)->first();
        $data->shop_link = $this->slider_link;
        $data->category_id = $this->category;
        $data->banner = $this->new_banner;

        if($this->banner != ''){
            $imageName = Carbon::now()->timestamp. '.' . $this->banner->extension();
            $this->banner->storeAs('imgs/slider',$imageName, 's3');
            $data->banner = env('AWS_BUCKET_URL') . 'imgs/slider/'.$imageName;
        }

        $data->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>'Slider updated successfully']);
        $this->resetInputs();
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteData()
    {
        $data = Slider::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('sliderDeleted');
        $this->resetInputs();

    }

    public function render()
    {
        $categories = Category::where('parent_id', 0)->where('sub_parent_id', 0)->get();
        $sliders = Slider::where('shop_link', 'LIKE', '%' . $this->searchTerm . '%')->orderBy('id', 'DESC')->paginate($this->sortingValue);
        return view('livewire.admin.slider.slider-component', ['sliders' => $sliders, 'categories'=>$categories])->layout('livewire.admin.layouts.base');
    }
}
