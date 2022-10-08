<?php

namespace App\Http\Livewire\Admin\Qutotation;

use App\Models\QutotationCategory;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class QutotationCategoryComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm;

    public $name, $slug, $icon_image, $new_icon_image;

    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed'=>'deleteData'];

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required|unique:qutotation_categories,slug,'.$this->edit_id.'',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:qutotation_categories',
        ]);

        $data = new QutotationCategory();
        $data->name = $this->name;
        $data->slug = $this->slug;

        $imageName = Carbon::now()->timestamp. '.' . $this->icon_image->extension();
        $this->icon_image->storeAs('imgs/qutotation',$imageName,'s3');
        $data->icon_image = env('AWS_BUCKET_URL') . 'imgs/qutotation/'.$imageName;

        $data->save();
        $this->dispatchBrowserEvent('success', ['message'=>'Qutotation Category created successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->name = '';
        $this->slug = '';
        $this->icon_image = '';
    }


    public function editData($id)
    {
        $getData = QutotationCategory::where('id', $id)->first();

        $this->edit_id = $getData->id;
        $this->name = $getData->name;
        $this->slug = $getData->slug;
        $this->new_icon_image = $getData->icon_image;

        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:qutotation_categories,slug,'.$this->edit_id.'',
        ]);

        $data = QutotationCategory::where('id', $this->edit_id)->first();
        $data->name = $this->name;
        $data->slug = $this->slug;

        $imageName = Carbon::now()->timestamp. '.' . $this->icon_image->extension();
        $this->icon_image->storeAs('imgs/qutotation',$imageName,'s3');
        $data->icon_image = env('AWS_BUCKET_URL') . 'imgs/qutotation/'.$imageName;

        $data->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>'Qutotation Category updated successfully']);
        $this->resetInputs();
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteData()
    {
        $data = QutotationCategory::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('QutotationCategoryDeleted');
    }

    public function render()
    {
       $qutotationCategory = QutotationCategory::orderBy('id', 'DESC')->paginate($this->sortingValue);
        return view('livewire.admin.qutotation.qutotation-category-component', ['qutotationCategory'=>$qutotationCategory])->layout('livewire.admin.layouts.base');
    }
}
