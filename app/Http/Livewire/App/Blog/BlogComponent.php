<?php

namespace App\Http\Livewire\App\Blog;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithPagination;

class BlogComponent extends Component
{
    use WithPagination;
    public function render()
    {
        $blogs = Blog::where('status', 1)->latest()->get();
        return view('livewire.app.blog.blog-component', ['blogs'=>$blogs])->layout('livewire.layouts.base');
    }
}
