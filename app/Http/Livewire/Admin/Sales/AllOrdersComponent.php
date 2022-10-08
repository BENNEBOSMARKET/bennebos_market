<?php

namespace App\Http\Livewire\Admin\Sales;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class AllOrdersComponent extends Component
{
    use WithPagination;
    public $sortingValue = 10, $searchTerm, $delete_id;
    protected $listeners = ['deleteConfirmed'=>'deleteData'];

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function render()
    {
        $orders = Order::orderBy('id', 'DESC')->paginate($this->sortingValue);
        return view('livewire.admin.sales.all-orders-component', ['orders' => $orders])->layout('livewire.admin.layouts.base');
    }
}
