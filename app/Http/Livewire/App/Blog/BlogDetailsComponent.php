<?php

namespace App\Http\Livewire\App\Blog;

use App\Models\Blog;
use Livewire\Component;

class BlogDetailsComponent extends Component
{
    public $blogDetails;
    
    public function mount($slug)
    {
        $this->blogDetails = Blog::where('slug', $slug)->first();
    }

    public function render()
    {
        $blogsForYou = Blog::where('id', '!=', $this->blogDetails->id)->where('status', 1)->take(4)->get();
        $topBlogs = Blog::where('id', '!=', $this->blogDetails->id)->where('status', 1)->inRandomOrder()->take(4)->get();

        return view('livewire.app.blog.blog-details-component', ['blogsForYou'=>$blogsForYou, 'topBlogs'=>$topBlogs])->layout('livewire.layouts.base');
    }
}
