<?php

namespace App\Http\Livewire\Admin\Blog;

use App\Models\Category;
use App\Models\NewsPage;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class NewsPgaeComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm;
    public $status, $banner, $new_banner, $category,$title,$news,$type;
    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed'=>'deleteData'];



    public function storeData()
    {
        $this->validate([
            'title' => 'required',
            'news' => 'required',
            'category' => 'required',
            'banner' => 'required',
            'type'=> 'required',

        ]);

//            $employee = technicalOffice::where('id',$request->id)->get();
//
//            $users = DB::table('employes_users_relations')->where('employee_id', '=', $employee[0]->id)->get();


        // move pic

        $data = new NewsPage();


        $data->title = $this->title;
        $data->category = $this->category;
        $data->type =$this->type;
        $data->news =$this->news;

        $imageName = Carbon::now()->timestamp. '.' . $this->banner->extension();
        $this->banner->storeAs('imgs/slider/news',$imageName, 's3');
        $data->banner = 'https://bennebos.s3.amazonaws.com/imgs/slider/news/'.$imageName;

        $data->save();

        $this->dispatchBrowserEvent('success', ['message'=>'News created successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }
    public function editData($id)
    {
        $getData = NewsPage::where('id', $id)->first();

        $this->edit_id = $getData->id;
        $this->title = $getData->title;
        $this->news = $getData->news;
        $this->category = $getData->category;
        $this->new_banner = $getData->banner;
        $this->type = $getData->type;
        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'title' => 'required',
            'news' => 'required',
            'category' => 'required',
            'new_banner' => 'required',
            'type' => 'required',
        ]);

        $data = NewsPage::where('id', $this->edit_id)->first();

        $data->title = $this->title;

        $data->news =$this->news;
        $data->category = $this->category;
        $data->banner = $this->new_banner;
        $data->type = $this->type;
        if($this->banner != ''){

            $imageName = Carbon::now()->timestamp. '.' . $this->banner->extension();
            $this->banner->storeAs('imgs/slider/news/',$imageName, 's3');
            $data->banner = env('AWS_BUCKET_URL') . 'imgs/slider/news/'.$imageName;

        }

        $data->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>'News updated successfully']);
        $this->resetInputs();
    }
    public function resetInputs()
    {

        $this->banner = '';
        $this->new_banner = '';
        $this->category='';
        $this->news='';
        $this->title='';
        $this->type='';

    }
    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteData()
    {
        $data = NewsPage::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('sliderDeleted');
        $this->resetInputs();

    }

    public function render()
    {
        $categories = Category::where('parent_id', 0)->where('sub_parent_id', 0)->get();
//        $sliders = Slider::orderBy('id', 'DESC')->paginate($this->sortingValue);
        $newsPageVideo=NewsPage::where('type','VIDEO')->latest()->get();
        $newsPageIMG=NewsPage::where('type','IMG')->latest()->get();
        return view('livewire.admin.blog.news-page-component',['newsPageVideo' => $newsPageVideo,'newsPageIMG'=>$newsPageIMG,'categories'=>$categories])->layout('livewire.admin.layouts.base');
    }
}
