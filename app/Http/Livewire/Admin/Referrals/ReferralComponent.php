<?php

namespace App\Http\Livewire\Admin\Referrals;

use App\Models\Referral;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class ReferralComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm;

    public $name, $referral_code, $sellers_count;

    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed' => 'deleteData'];

    public function mount()
    {
    }


    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|string',
            'referral_code' => 'required|unique:referrals,referral_code,' . $this->edit_id . '',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'name' => 'required|string',
            'referral_code' => 'required|unique:referrals,referral_code',
        ]);

        $data = new Referral();
        $data->name = $this->name;
        $data->referral_code = $this->referral_code;
        $data->save();

        $this->dispatchBrowserEvent('success', ['message' => 'referral created successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->edit_id = '';
        $this->delete_id = '';
        $this->name = '';
        $this->referral_code = '';
        $this->sellers_count = '';
    }


    public function editData($id)
    {
        $getData = Referral::where('id', $id)->first();

        $this->edit_id = $getData->id;
        $this->name = $getData->name;
        $this->referral_code = $getData->referral_code;

        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'name' => 'required|string',
            'referral_code' => 'required|unique:referrals,referral_code,' . $this->edit_id . '',
        ]);

        $data = Referral::where('id', $this->edit_id)->first();
        $data->name = $this->name;
        $data->referral_code = $this->referral_code;
        $data->save();

        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message' => 'Referral updated successfully']);

        $this->resetInputs();
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteData()
    {

        $data = Referral::find($this->delete_id);
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
        $referrals = Referral::where('name', 'like', '%' . $this->searchTerm . '%')->paginate($this->sortingValue);
        return view('livewire.admin.referrals.referrals-component', ['referrals' => $referrals])->layout('livewire.admin.layouts.base');
    }
}
