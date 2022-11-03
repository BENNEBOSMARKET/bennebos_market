<?php

namespace App\Http\Livewire\Admin\Country;

use App\Models\Country;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class  CountryComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm;

    public $parent_id = 0, $sub_parent_id = 0, $name, $phonecode, $flag, $banner, $uploadedBanner, $latitude, $longitude, $mega_banner, $uploadedMegaBanner;

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
            'phonecode' => 'required',
            'banner' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'name' => 'required',
            'phonecode' => 'required',
            'banner' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $data = new Country();
        $data->name = $this->name;
        $data->phonecode = $this->phonecode;
        $data->latitude = $this->latitude;
        $data->longitude = $this->longitude;

        $imageName = Carbon::now()->timestamp . '.' . $this->banner->extension();
        $this->banner->storeAs('imgs/country', $imageName, 's3');
        $data->flag = env('AWS_BUCKET_URL',"https://bennebos.s3.amazonaws.com/") . 'imgs/category/' . $imageName;

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
        $this->phonecode = '';
        $this->falg = '';
    }


    public function editData($id)
    {
        $getData = Country::where('id', $id)->first();

        $this->edit_id = $getData->id;
        $this->name = $getData->name;
        $this->phonecode = $getData->phonecode;
        $this->uploadedBanner= $getData->flag;
        $this->latitude = $getData->latitude;
        $this->longitude = $getData->longitude;
        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'name' => 'required',
            'phonecode' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $data = Country::where('id', $this->edit_id)->first();
        $data->name = $this->name;
        $data->phonecode = $this->phonecode;
        $data->latitude = $this->latitude;
        $data->longitude = $this->longitude;

        if ($this->banner != '') {
            $imageName = Carbon::now()->timestamp . '.' . $this->banner->extension();
            $this->banner->storeAs('imgs/category', $imageName, 's3');
            $data->flag = env('AWS_BUCKET_URL',"https://bennebos.s3.amazonaws.com/") . 'imgs/category/' . $imageName;
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

            $data = Country::find($this->delete_id);
            $data->delete();

            $this->dispatchBrowserEvent('categoryDeleted');
            $this->resetInputs();
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
        $countries = Country::where('name', 'LIKE', '%' . $this->searchTerm . '%')
                            ->orWhere('latitude', 'LIKE', '%' . $this->searchTerm . '%')
                            ->orWhere('longitude', 'LIKE', '%' . $this->searchTerm . '%')
                            ->orWhere('sortname', 'LIKE', '%' . $this->searchTerm . '%')
                            ->orderBy('name', 'ASC')->paginate($this->sortingValue);
        return view('livewire.admin.country.country-component', ['countries' => $countries])->layout('livewire.admin.layouts.base');
    }


}
