<?php

namespace App\Http\Livewire\Admin\Slider;

use App\Models\ElectroniSlider;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ElectronicSliderComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm;
    public $title, $banner, $new_banner;
    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed'=>'deleteData'];

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

        $data = new ElectroniSlider();
        $data->title = $this->title;

        $imageName = Carbon::now()->timestamp. '.' . $this->banner->extension();
        $this->banner->storeAs('imgs/eslider',$imageName, 's3');
        $data->banner = env('AWS_BUCKET_URL') . 'imgs/eslider/'.$imageName;

        $data->save();

        $this->dispatchBrowserEvent('success', ['message'=>'Electronic slider created successfully']);
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
        $getData = ElectroniSlider::where('id', $id)->first();

        $this->edit_id = $getData->id;
        $this->title = $getData->title;
        $this->new_banner = $getData->banner;
        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'banner' => 'required',
        ]);

        $data = ElectroniSlider::where('id', $this->edit_id)->first();
        $data->title = $this->title;
        $data->banner = $this->new_banner;

        if($this->banner != ''){
            $imageName = Carbon::now()->timestamp. '.' . $this->banner->extension();
            $this->banner->storeAs('imgs/eslider',$imageName, 's3');
            $data->banner = env('AWS_BUCKET_URL') . 'imgs/eslider/'.$imageName;
        }

        $data->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>'Electronic slider updated successfully']);
        $this->resetInputs();
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteData()
    {
        $data = ElectroniSlider::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('sliderDeleted');
        $this->resetInputs();
    }

    public function render()
    {
        $electronicSliders = ElectroniSlider::where('title', 'LIKE', '%' . $this->searchTerm . '%')->orderBy('id', 'DESC')->paginate($this->sortingValue);
        return view('livewire.admin.slider.electronic-slider-component', ['electronicSliders' => $electronicSliders])->layout('livewire.admin.layouts.base');
    }
}
