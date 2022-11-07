<?php

namespace App\Http\Livewire\Admin\Administrator;

use App\Models\Admin;
use App\Models\Referral;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class SubAdminComponent extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm;

    public $name, $email, $password, $password_confirmation, $referral_code;

    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed' => 'deleteData'];

    public function mount()
    {
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|confirmed|min:6',
            'referral_code' => 'required'
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'referral_code' => 'required'
        ]);

        $data = new Admin();
        $data->name = $this->name;
        $data->email = $this->email;
        $data->referral_code = $this->referral_code;
        $data->password = Hash::make($this->password);
        $data->role = "sub-admin";
        $data->save();

        $this->dispatchBrowserEvent('success', ['message' => 'Sub-Admin created successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->edit_id = '';
        $this->delete_id = '';
        $this->name = '';
        $this->email = '';
        $this->referral_code = '';
        $this->password = '';
        $this->password_confirmation = '';
    }


    public function editData($id)
    {
        $getData = Admin::where('id', $id)->first();

        $this->edit_id = $getData->id;
        $this->name = $getData->name;
        $this->email = $getData->email;
        $this->referral_code = $getData->referral_code;
        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,'.$this->edit_id,
            'password' => 'nullable|confirmed|min:6',
            'referral_code' => 'required'
        ]);

        $data = Admin::where('id', $this->edit_id)->first();
        $data->name = $this->name;
        $data->email = $this->email;
        $data->referral_code = $this->referral_code;
        if(request()->has("password")) $data->password = Hash::make($this->password);
        $data->role = "sub-admin";

        $data->save();

        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message' => 'Sub-Admin updated successfully']);

        $this->resetInputs();
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteData()
    {

        $data = Admin::find($this->delete_id);
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
        $admins = Admin::where('role', 'sub-admin')->where(function($query){
            $query->orWhere('name', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('email', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('phone', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('created_at', 'LIKE', '%' . $this->searchTerm . '%');
        })->paginate($this->sortingValue);       
        $referralCodes = Referral::all(); 
        return view('livewire.admin.administrator.sub-admin-component', ['admins' => $admins, 'referralCodes' => $referralCodes])->layout('livewire.admin.layouts.base');
    }
}
