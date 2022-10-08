<?php

namespace App\Http\Livewire\Admin\Sales\Seller;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class SellerOrdersComponent extends Component
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
        $sellerOrders = Order::orderBy('id', 'DESC')->where('seller_id', '!=', 0)->paginate($this->sortingValue);
        return view('livewire.admin.sales.seller.seller-orders-component', ['sellerOrders' => $sellerOrders ])->layout('livewire.admin.layouts.base');
    }
}
