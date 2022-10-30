<?php

namespace App\Http\Livewire\Admin\Product\Brand;

use Carbon\Carbon;
use App\Models\Brand;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class IndexComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm;

    public $name, $slug, $logo, $meta_title, $meta_description, $uploadedLogo, $category_id, $selected_category;

    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed' => 'deleteData'];

    public function mount()
    {
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|unique:brands,name,' . $this->edit_id . '',
            'slug' => 'required|unique:brands,slug,' . $this->edit_id . '',
            'logo' => 'required',
            'category_id' => 'required',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'name' => 'required|unique:brands',
            'slug' => 'required|unique:brands',
            'logo' => 'required',
            'category_id' => 'required',
        ]);

        $data = new Brand();
        $data->name = $this->name;
        $data->slug = $this->slug;
        $data->meta_title = $this->meta_title;
        $data->meta_description = $this->meta_description;
        $data->category_id = json_encode($this->category_id);

        $imageName = Carbon::now()->timestamp . '.' . $this->logo->extension();
        $this->logo->storeAs('imgs/brand', $imageName, 's3');
        $data->logo = env('AWS_BUCKET_URL') . 'imgs/brand/' . $imageName;

        $data->save();

        $this->dispatchBrowserEvent('success', ['message' => 'Brand added successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->edit_id = '';
        $this->delete_id = '';
        $this->name = '';
        $this->slug = '';
        $this->meta_title = '';
        $this->meta_description = '';
        $this->logo = '';
        $this->uploadedLogo = '';
        $this->category_id = '';
    }


    public function editData($id)
    {
        $getData = Brand::where('id', $id)->first();

        $this->edit_id = $getData->id;
        $this->name = $getData->name;
        $this->slug = $getData->slug;
        $this->meta_title = $getData->meta_title;
        $this->meta_description = $getData->meta_description;
        $this->uploadedLogo = $getData->logo;
        $this->selected_category = $getData->category_id;

        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'name' => 'required|unique:brands,name,' . $this->edit_id . '',
            'slug' => 'required|unique:brands,slug,' . $this->edit_id . '',
        ]);

        $data = Brand::where('id', $this->edit_id)->first();
        $data->name = $this->name;
        $data->slug = $this->slug;
        $data->meta_title = $this->meta_title;
        $data->meta_description = $this->meta_description;
        $data->logo = $this->uploadedLogo;
        if ($this->category_id != '') {
            $data->category_id = json_encode($this->category_id);
        }

        if ($this->logo != '') {
            $imageName = Carbon::now()->timestamp . '.' . $this->logo->extension();
            $this->logo->storeAs('imgs/brand', $imageName, 's3');
            $data->logo = env('AWS_BUCKET_URL') . 'imgs/brand/' . $imageName;
        }

        $data->save();

        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message' => 'Brand updated successfully']);

        $this->resetInputs();
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteData()
    {
        $data = Brand::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('brandDeleted');
        $this->resetInputs();
    }

    public function render()
    {
        $categories = DB::table('categories')->select('id', 'name')->where('parent_id', 0)->where('sub_parent_id', 0)->get();
        $brands = DB::table('brands')->select('id', 'logo', 'name', 'category_id', 'created_at')->where('name', 'like', '%' . $this->searchTerm . '%')->paginate($this->sortingValue);

        return view('livewire.admin.product.brand.index-component', ['brands' => $brands, 'categories' => $categories])->layout('livewire.admin.layouts.base');
    }
}
