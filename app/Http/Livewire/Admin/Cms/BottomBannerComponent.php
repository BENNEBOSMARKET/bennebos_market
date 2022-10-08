<?php

namespace App\Http\Livewire\Admin\Cms;

use App\Models\BottomBanner;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class BottomBannerComponent extends Component
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

        $data = new BottomBanner();
        $data->title = $this->title;

        $imageName = Carbon::now()->timestamp . '.' . $this->banner->extension();
        $this->banner->storeAs('imgs/banner', $imageName, 's3');
        $data->banner = env('AWS_BUCKET_URL') . 'imgs/banner/' . $imageName;

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
        $getData = BottomBanner::where('id', $id)->first();

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

        $data = BottomBanner::where('id', $this->edit_id)->first();
        $data->title = $this->title;
        $data->banner = $this->new_banner;

        if ($this->banner != '') {
            $imageName = Carbon::now()->timestamp . '.' . $this->banner->extension();
            $this->banner->storeAs('imgs/banner', $imageName, 's3');
            $data->banner = env('AWS_BUCKET_URL') . 'imgs/category/' . $imageName;
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
        $data = BottomBanner::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('bottomBannerDeleted');
        $this->resetInputs();
    }

    public function render()
    {
        $bottomBanners = BottomBanner::orderBy('id', 'DESC')->paginate($this->sortingValue);
        return view('livewire.admin.cms.bottom-banner-component', ['bottomBanners' => $bottomBanners])->layout('livewire.admin.layouts.base');
    }
}
