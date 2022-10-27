<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Models\Admin;
use App\Models\Photo;
use App\Models\Seller;
use App\Models\SendMoneyCustomer;
use App\Models\SendMoneySeller;
use App\Models\Slider;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class SendMoneyCustomerComponent extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $sortingValue = 10, $searchTerm;
    public $customer, $money, $description;
    public $edit_id, $delete_id;

    protected $listeners = ['deleteConfirmed'=>'deleteData'];



    public function storeData()
    {
        $this->validate([

            'customer' => 'required',
            'money' => 'required',
        ]);


        $data = new SendMoneyCustomer();



//        $data->banner =  $imageName;
        $data->customer_id = $this->customer;
        $data->money = $this->money;
        $data->description = $this->description;

        $data->save();

        $this->dispatchBrowserEvent('success', ['message'=>' created successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }
    public function resetInputs()
    {
        $this->customer = '';
        $this->money = '';
        $this->description = '';

    }

    public function editData($id)
    {
        $getData = SendMoneyCustomer::where('id', $id)->first();

        $this->edit_id = $getData->id;
        $this->customer = $getData->customer_id;
        $this->money = $getData->money;
        $this->description = $getData->description;

        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'customer' => 'required',
            'money' => 'required',
        ]);

        $data = SendMoneyCustomer::where('id', $this->edit_id)->first();
        $data->customer_id = $this->customer;
        $data->money = $this->money;
        $data->description = $this->description;



        $data->save();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('success', ['message'=>' updated successfully']);
        $this->resetInputs();
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function deleteData()
    {
        $data = SendMoneyCustomer::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('sliderDeleted');
        $this->resetInputs();

    }
    public function render()
    {
        $customers=User::all();
        $customerMoneys = SendMoneycustomer::paginate($this->sortingValue);
        return view('livewire.admin.customer.send-money-customer-component', ['customerMoneys' => $customerMoneys,'customers'=>$customers])->layout('livewire.admin.layouts.base');
    }
}
