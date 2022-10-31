<?php

namespace App\Http\Livewire\Admin\Cms;

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
    public $title, $banner, $new_banner;
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
    }

    public function editData($id)
    {
        $getData = MiddleBanner::where('id', $id)->first();

        $this->edit_id = $getData->id;
        $this->title = $getData->title;
        $this->new_banner = $getData->banner;
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
        $middleBanners = MiddleBanner::orderBy('id', 'DESC')->where('title', 'LIKE', '%' . $this->searchTerm . '%')->paginate($this->sortingValue);
        return view('livewire.admin.cms.middle-banner-component', ['middleBanners' => $middleBanners])->layout('livewire.admin.layouts.base');
    }
}
