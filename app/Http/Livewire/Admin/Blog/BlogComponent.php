<?php

namespace App\Http\Livewire\Admin\Blog;

use App\Models\Blog;
use Livewire\Component;

class BlogComponent extends Component
{
    public $sortingValue = 10, $searchTerm;
    public $delete_id;
    protected $listeners = ['deleteConfirmed'=>'deleteData'];

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteData()
    {
        $data = Blog::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('blogDeleted');
    }

    public function changeStatus($id)
    {
        $data = Blog::find($id);
        if($data->status == 1){
            $data->status = 0;
        }
        else{
            $data->status = 1;
        }
        $data->save();

        $this->dispatchBrowserEvent('success', ['message'=>'Blog updated successfully']);
    }


    public function render()
    {
        $blogs = Blog::orderBy('created_at', 'DESC')->paginate($this->sortingValue);
        return view('livewire.admin.blog.blog-component', ['blogs' => $blogs])->layout('livewire.admin.layouts.base');
    }
}
