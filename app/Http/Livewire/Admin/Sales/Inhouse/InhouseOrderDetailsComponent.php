<?php

namespace App\Http\Livewire\Admin\Sales\Inhouse;

use App\Models\Order;
use App\Models\OrderDetails;
use Livewire\Component;

class InhouseOrderDetailsComponent extends Component
{
    public $inhouse_order_id, $subOrder, $order;

    public function mount($id){
        $this->order = Order::where('id', $id)->first();
        $this->inhouse_order_id = $id;
    }

    public function render()
    {
        $inhouseOrderDetails = OrderDetails::where('order_id', $this->inhouse_order_id)->get();

        return view('livewire.admin.sales.inhouse.inhouse-order-details-component', ['inhouseOrderDetails' => $inhouseOrderDetails])->layout('livewire.admin.layouts.base');
    }
}
