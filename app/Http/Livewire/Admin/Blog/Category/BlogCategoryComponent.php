<?php

namespace App\Http\Livewire\Admin\Blog\Category;

use App\Models\BlogCategory;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class BlogCategoryComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm;

    public $name, $slug;

    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed'=>'deleteData'];

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
            'name' => 'required',
            'slug' => 'required|unique:blog_categories,slug,'.$this->edit_id.'',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:blog_categories',
        ]);

        $data = new BlogCategory();
        $data->name = $this->name;
        $data->slug = $this->slug;
        $data->save();

        $this->dispatchBrowserEvent('success', ['message'=>'Category created successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->edit_id = '';
        $this->delete_id = '';
        $this->name = '';
        $this->slug = '';
    }


    public function editData($id)
    {
        $getData = BlogCategory::where('id', $id)->first();

        $this->edit_id = $getData->id;
        $this->name = $getData->name;
        $this->slug = $getData->slug;

        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:blog_categories,slug,'.$this->edit_id.'',
        ]);

        $data = BlogCategory::where('id', $this->edit_id)->first();
        $data->name = $this->name;
        $data->slug = $this->slug;
        $data->save();

        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>'Category updated successfully']);
        $this->resetInputs();
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteData()
    {
        $data = BlogCategory::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('categoryDeleted');
        $this->resetInputs();
    }

    public function render()
    {
        $categories = BlogCategory::where('name', 'like', '%'.$this->searchTerm.'%')->paginate($this->sortingValue);

        return view('livewire.admin.blog.category.blog-category-component', ['categories' => $categories])->layout('livewire.admin.layouts.base');
    }
}
