<?php

namespace App\Http\Livewire\Customer\MyOrder;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RefundOrderComponent extends Component
{
    public $order;
    public $refund_reason;

    public function mount($order)
    {
        $this->order = Order::find($order);
    }

    public function render()
    {
        $order = $this->order;
        return view('livewire.customer.my-order.refund-order-component', compact('order'))->layout('livewire.layouts.base');
    }


    public function submitRefund()
    {
        $details_ids = DB::table('order_details')
            ->where('order_id', $this->order->id)
            ->get()->pluck('id')->toJson();
        $insertData['order_id'] = $this->order->id;
        $insertData['user_id'] = auth()->user()->id;
        $insertData['seller_approved'] = false;
        $insertData['admin_approved'] = false;
        $insertData['refund_amount'] = $this->order->grand_total;
        $insertData['refund_status'] = 'pending';
        $insertData['is_seen'] = false;
        $insertData['created_at'] = now();
        $insertData['updated_at'] = now();
        $insertData['seller_id'] = $this->order->seller_id;
        $insertData['order_details_id'] = $details_ids;

        if ( $this->refund_reason ) {
            $insertData['reason'] = $this->refund_reason;
        }

        try {

            $checkIfRefundExists = DB::table('refunds')->where('order_id', $this->order->id)->exists();

            if ( $checkIfRefundExists ) {
                return redirect()->route('customer.my-orders')->with('error', 'Refund already exists for this order');
            } else {
                DB::beginTransaction();
                DB::table('refunds')->insert($insertData);

                DB::table('orders')->where('id', $this->order->id)->update(['order_status' => 'refund requested']);

                DB::commit();
                return redirect()->route('customer.my-orders')->with('success', 'Refund request sent successfully');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->route('customer.my-orders')->with('error', 'Something went wrong');
        }
    }
}
