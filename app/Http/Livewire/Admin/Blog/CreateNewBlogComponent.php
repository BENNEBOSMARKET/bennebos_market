<?php

namespace App\Http\Livewire\Admin\Blog;

use App\Models\Blog;
use App\Models\BlogCategory;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class CreateNewBlogComponent extends Component
{
    use WithFileUploads;
    public $title, $slug, $category, $banner, $short_description, $content, $meta_title, $meta_description;

    public function generateSlug()
    {
        $this->slug = Str::slug($this->title);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'title' => 'required',
            'slug' => 'required|unique:blogs',
            'category' => 'required',
            'banner' => 'required',
            'short_description' => 'required',
            'content' => 'required',
        ]);
    }

    public function storeBlog()
    {
        $this->validate([
            'title' => 'required',
            'slug' => 'required|unique:blogs',
            'category' => 'required',
            'banner' => 'required',
            'short_description' => 'required',
            'content' => 'required',
        ]);

        $blog = new Blog();
        $blog->category_id = $this->category;
        $blog->title = $this->title;
        $blog->slug = $this->slug;
        $blog->short_description = $this->short_description;
        $blog->content = $this->content;
        $blog->meta_title = $this->meta_title;
        $blog->meta_description = $this->meta_description;

        if ($this->banner != '') {
            $imageName = Carbon::now()->timestamp . '.' . $this->banner->extension();
            $this->banner->storeAs('imgs/blogs', $imageName, 's3');
            $blog->banner = env('AWS_BUCKET_URL') . 'imgs/blogs/' . $imageName;
        }

        $blog->save();

        return redirect()->route('admin.allBlogs')->with('success', 'New blog added successfully');
    }

    public function render()
    {
        $categories = BlogCategory::all();

        return view('livewire.admin.blog.create-new-blog-component', ['categories' => $categories])->layout('livewire.admin.layouts.base');
    }
}
