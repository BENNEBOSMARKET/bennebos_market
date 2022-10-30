<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class CategoryComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm;

    public $parent_id = 0, $sub_parent_id = 0, $name, $slug, $commision_rate, $banner, $meta_title, $meta_description, $uploadedBanner, $mega_banner, $uploadedMegaBanner;

    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed' => 'deleteData'];

    public function mount()
    {
    }

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name) . '-' . Str::lower(Str::random(5));
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $this->edit_id . '',
            'commision_rate' => 'required',
            'banner' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories',
            'commision_rate' => 'required',
            'banner' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
        ]);

        $data = new Category();
        $data->parent_id = $this->parent_id;
        $data->sub_parent_id = $this->sub_parent_id;
        $data->name = $this->name;
        $data->slug = $this->slug;
        $data->commision_rate = $this->commision_rate;
        $data->meta_title = $this->meta_title;
        $data->meta_description = $this->meta_description;

        $imageName = Carbon::now()->timestamp . '.' . $this->banner->extension();
        $this->banner->storeAs('imgs/category', $imageName, 's3');
        $data->banner = env('AWS_BUCKET_URL') . 'imgs/category/' . $imageName;

        $data->save();

        $this->dispatchBrowserEvent('success', ['message' => 'Category created successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->edit_id = '';
        $this->delete_id = '';
        $this->name = '';
        $this->slug = '';
        $this->commision_rate = '';
        $this->meta_title = '';
        $this->meta_description = '';
        $this->banner = '';
        $this->mega_banner = '';
        $this->uploadedBanner = '';
        $this->uploadedMegaBanner = '';
    }


    public function editData($id)
    {
        $getData = Category::where('id', $id)->first();

        $this->edit_id = $getData->id;
        $this->parent_id = $getData->parent_id;
        $this->sub_parent_id = $getData->sub_parent_id;
        $this->name = $getData->name;
        $this->slug = $getData->slug;
        $this->commision_rate = $getData->commision_rate;
        $this->meta_title = $getData->meta_title;
        $this->meta_description = $getData->meta_description;
        $this->uploadedBanner = $getData->banner;
        $this->uploadedMegaBanner = $getData->mega_banner;

        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $this->edit_id . '',
            'commision_rate' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
        ]);

        $data = Category::where('id', $this->edit_id)->first();
        $data->parent_id = $this->parent_id;
        $data->sub_parent_id = $this->sub_parent_id;
        $data->name = $this->name;
        $data->slug = $this->slug;
        $data->commision_rate = $this->commision_rate;
        $data->meta_title = $this->meta_title;
        $data->meta_description = $this->meta_description;
        $data->banner = $this->uploadedBanner;

        if ($this->banner != '') {
            $imageName = Carbon::now()->timestamp . '.' . $this->banner->extension();
            $this->banner->storeAs('imgs/category', $imageName, 's3');
            $data->banner = env('AWS_BUCKET_URL') . 'imgs/category/' . $imageName;
        }

        $data->save();

        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message' => 'Category updated successfully']);

        $this->resetInputs();
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteData()
    {
        $products = Product::where('category_id', $this->delete_id)->get();
        $subCategory = Category::where('parent_id', $this->delete_id)->get();

        if ($products->count() > 0 || $subCategory->count() > 0) {
            $this->dispatchBrowserEvent('categoryDeleteError');
        } else {
            $data = Category::find($this->delete_id);
            $data->delete();

            $this->dispatchBrowserEvent('categoryDeleted');
            $this->resetInputs();
        }
    }


    // public function deleteChild()
    // {
    //     $id = 281;
    //     $categories = [$id];

    //     $subCategories = Category::where('parent_id', $id)->where('sub_parent_id', 0)->pluck('id')->toArray();
    //     $categories = array_merge($categories, $subCategories);
    //     $subCategories = Category::whereIn('sub_parent_id', $categories)->pluck('id')->toArray();
    //     $categories = array_merge($categories, $subCategories);


    //     foreach($categories as $category){
    //         $products = Product::where('category_id', $category)->get();
    //         foreach($products as $product){
    //             $pro = Product::find($product->id);
    //             $pro->delete();
    //         }

    //         $category = Category::find($category);
    //         $category->delete();
    //     }

    //     $this->dispatchBrowserEvent('success', ['message'=>'Deleted']);

    // }


    public function render()
    {
        $categories = Category::where('parent_id', 0)->where('sub_parent_id', 0)->where('name', 'like', '%' . $this->searchTerm . '%')->paginate($this->sortingValue);
        return view('livewire.admin.category.category-component', ['categories' => $categories])->layout('livewire.admin.layouts.base');
    }
}
