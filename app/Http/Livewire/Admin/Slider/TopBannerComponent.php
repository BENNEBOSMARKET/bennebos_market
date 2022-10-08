<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Models\TopBanner;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class TopBannerComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm;
    public $festival_name, $title, $slug, $url, $banner, $new_banner;
    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed' => 'deleteData'];

    public function generateSlug()
    {
        $this->slug = Str::slug($this->title);
    }

    public function storeData()
    {
        $this->validate([
            'festival_name' => 'required',
            'title' => 'required',
            'slug' => 'required|unique:top_banners',
            'url' => 'required',
        ]);

        $data = new TopBanner();
        $data->festival_name = $this->festival_name;
        $data->title = $this->title;
        $data->slug = $this->slug;
        $data->url = $this->url;

        $imageName = Carbon::now()->timestamp . '.' . $this->banner->extension();
        $this->banner->storeAs('imgs/topbanner', $imageName, 's3');
        $data->banner = env('AWS_BUCKET_URL') . 'imgs/topbanner/' . $imageName;

        $data->save();

        $this->dispatchBrowserEvent('success', ['message' => 'Top Banner created successfully']);
        $this->dispatchBrowserEvent('closeModal');
    }

    public function editData($id)
    {
        $getData = TopBanner::where('id', $id)->first();

        $this->edit_id = $getData->id;
        $this->festival_name = $getData->festival_name;
        $this->title = $getData->title;
        $this->slug = $getData->slug;
        $this->url = $getData->url;
        $this->new_banner = $getData->banner;
        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'festival_name' => 'required',
            'title' => 'required',
            'slug' => 'required|unique:top_banners,slug,' . $this->edit_id . '',
            'url' => 'required',
        ]);

        $data = TopBanner::where('id', $this->edit_id)->first();
        $data->festival_name = $this->festival_name;
        $data->title = $this->title;
        $data->slug = $this->slug;
        $data->url = $this->url;

        if ($this->banner != '') {
            $imageName = Carbon::now()->timestamp . '.' . $this->banner->extension();
            $this->banner->storeAs('imgs/topbanner', $imageName, 's3');
            $data->banner = env('AWS_BUCKET_URL') . 'imgs/topbanner/' . $imageName;
        }

        $data->save();

        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message' => 'Top Banner updated successfully']);
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteData()
    {
        $data = TopBanner::find($this->delete_id);
        $data->delete();
        $this->dispatchBrowserEvent('topBannerDeleted');
    }

    public function render()
    {
        $topBanners = TopBanner::orderBy('id', 'DESC')->paginate($this->sortingValue);
        return view('livewire.admin.slider.top-banner-component', ['topBanners' => $topBanners])->layout('livewire.admin.layouts.base');
    }
}
