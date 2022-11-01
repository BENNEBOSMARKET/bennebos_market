<?php

namespace App\Http\Livewire\Admin\Coupon;

use App\Models\Coupon;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class CouponComponent extends Component
{
    use WithPagination;

    public $sortingValue = 10, $searchTerm;

    public $product, $start, $coupon_type, $coupon_code, $date, $discount, $discount_type;

    public $edit_id, $delete_id, $formStatus;

    protected $listeners = ['deleteConfirmed'=>'deleteData'];

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'coupon_code' => 'required',
            'date' => 'required',
            'discount' => 'required',
            'discount_type' => 'required',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'coupon_code' => 'required',
            'date' => 'required',
            'discount' => 'required',
            'discount_type' => 'required',
        ]);

        $data = new Coupon();
        $data->coupon_type = $this->coupon_type;
        $data->coupon_code = $this->coupon_code;
        $data->date = $this->date;
        $data->discount = $this->discount;
        $data->discount_type = $this->discount_type;
        $data->save();

        $this->dispatchBrowserEvent('success', ['message'=>'Coupon created successfully']);
        $this->dispatchBrowserEvent('closeModal');
        $this->resetInputs();
    }

    public function resetInputs()
    {
        $this->coupon_type = '';
        $this->coupon_code = '';
        $this->date = '';
        $this->discount = '';
        $this->formStatus = '';
    }

    public function editData($id)
    {
        $getData = Coupon::where('id', $id)->first();

        $this->edit_id = $getData->id;
        $this->coupon_type = $getData->coupon_type;
        $this->coupon_code = $getData->coupon_code;
        $this->date = $getData->date;
        $this->discount = $getData->discount;
        $this->discount_type = $getData->discount_type;
        $this->formStatus = 'Update';

        $this->dispatchBrowserEvent('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'coupon_code' => 'required',
            'date' => 'required',
            'discount' => 'required',
            'discount_type' => 'required',
        ]);

        $data = Coupon::where('id', $this->edit_id)->first();
        $data->coupon_type = $this->coupon_type;
        $data->coupon_code = $this->coupon_code;
        $data->date = $this->date;
        $data->discount = $this->discount;
        $data->discount_type = $this->discount_type;

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
        $data = Coupon::find($this->delete_id);
        $data->delete();

        $this->dispatchBrowserEvent('categoryDeleted');
        $this->resetInputs();

    }

    public function close()
    {
        $this->resetInputs();
    }

    public function render()
    {
        $coupons = Coupon::where('coupon_code', 'like', '%'.$this->searchTerm.'%')
            ->orWhere('discount', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('discount_type', 'LIKE', '%' . $this->searchTerm . '%')
            ->orWhere('date', 'LIKE', '%' . $this->searchTerm . '%')->paginate($this->sortingValue);
        return view('livewire.admin.coupon.coupon-component', ['coupons' => $coupons])->layout('livewire.admin.layouts.base');
    }
}
