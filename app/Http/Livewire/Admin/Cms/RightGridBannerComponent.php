<?php

namespace App\Http\Livewire\Admin\Cms;

use App\Models\RightGridBanner;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class RightGridBannerComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm;
    public $banner, $new_banner;
    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed' => 'deleteData'];

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'banner' => 'required',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'banner' => 'required',
        ]);

        $data = new RightGridBanner();

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
        $getData = RightGridBanner::where('id', $id)->first();

        $this->edit_id = $getData->id;
        $this->new_banner = $getData->banner;
        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'banner' => 'required',
        ]);

        $data = RightGridBanner::where('id', $this->edit_id)->first();
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
        $data = RightGridBanner::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('middleBannerDeleted');
        $this->resetInputs();
    }

    public function render()
    {
        $gridBanners = RightGridBanner::orderBy('id', 'DESC')->paginate($this->sortingValue);
        return view('livewire.admin.cms.right-grid-banner-component', ['gridBanners' => $gridBanners])->layout('livewire.admin.layouts.base');
    }
}
