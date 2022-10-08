<?php

namespace App\Http\Livewire\Admin\Sales\Inhouse;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class InhouseOrdersComponent extends Component
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
        $inhouseOrders = Order::orderBy('id', 'DESC')->where('seller_id', 0)->paginate($this->sortingValue);

        return view('livewire.admin.sales.inhouse.inhouse-orders-component', ['inhouseOrders' => $inhouseOrders])->layout('livewire.admin.layouts.base');
    }
}
