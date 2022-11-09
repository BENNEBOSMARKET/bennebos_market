<?php

namespace App\Http\Livewire\Admin\Cms;

use App\Models\Category;
use App\Models\MiddleBanner;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class MiddleBannerComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm;
    public $title, $banner, $new_banner,$category;
    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed' => 'deleteData'];

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required',
            'banner' => 'required',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'title' => 'required',
            'banner' => 'required',
        ]);

        $data = new MiddleBanner();
        $data->title = $this->title;
        if ($this->category == null){
            $data->category_id = null;
        }
        else{
            $data->category_id = $this->category;
        }

        $imageName = Carbon::now()->timestamp . '.' . $this->banner->extension();
        $this->banner->storeAs('imgs/banner', $imageName, 's3');
        $data->banner = env('AWS_BUCKET_URL') . 'imgs/banner/'. $imageName;
        $data->save();

        $this->dispatchBrowserEvent('success', ['message' => 'Banner created successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->title = '';
        $this->banner = '';
        $this->new_banner = '';
        $this->category='';
    }

    public function editData($id)
    {
        $getData = MiddleBanner::where('id', $id)->first();

        $this->edit_id = $getData->id;
        $this->title = $getData->title;
        $this->new_banner = $getData->banner;
        $this->category = $getData->category_id;
        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'title' => 'required',
        ]);

        $data = MiddleBanner::where('id', $this->edit_id)->first();
        $data->title = $this->title;
        $data->banner = $this->new_banner;
        if ($this->category == null){
            $data->category_id = null;
        }
        else{
            $data->category_id = $this->category;
        }

        if ($this->banner != '') {
            $imageName = Carbon::now()->timestamp . '.' . $this->banner->extension();
            $this->banner->storeAs('imgs/banner', $imageName, 's3');
            $data->banner = env('AWS_BUCKET_URL') . 'imgs/banner/'.$imageName;
        }

        $data->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message' => 'Banner updated successfully']);
        $this->resetInputs();
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteData()
    {
        $data = MiddleBanner::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('middleBannerDeleted');
        $this->resetInputs();
    }

    public function render()
    {
        $categories=Category::all();
        $middleBanners = MiddleBanner::orderBy('id', 'DESC')->where('title', 'LIKE', '%' . $this->searchTerm . '%');

        $category=Category::where('name','LIKE', '%' . $this->searchTerm . '%')->first();
        if ($category and $this->searchTerm != ''){
            $middleBanners=$middleBanners->orWhere('category_id',$category->id)->orderBy('middle_banners.created_at', 'DESC')->paginate($this->sortingValue);
        }
        else{
            $middleBanners=$middleBanners->orderBy('middle_banners.created_at', 'DESC')->paginate($this->sortingValue);
        }




        return view('livewire.admin.cms.middle-banner-component', ['middleBanners' => $middleBanners,'categories'=>$categories])->layout('livewire.admin.layouts.base');
    }
}
