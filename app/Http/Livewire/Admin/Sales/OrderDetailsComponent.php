<?php

namespace App\Http\Livewire\Admin\Sales;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class OrderDetailsComponent extends Component
{
    public $order_id, $order, $payment_status, $delivery_status;

    public function mount($id)
    {
        $this->order_id = $id;

        $order = Order::where('id', $id)->first();
        $this->order = $order;
        $this->payment_status = $order->payment_status;
        $this->delivery_status = $order->delivery_status;
    }

    public function changePaymentStatus()
    {
        $order = Order::where('id', $this->order_id)->first();
        $order->payment_status = $this->payment_status;
        $order->save();

        if ($this->delivery_status == 'delivered' && $this->payment_status == 'paid') {
            addPoint($order->id, $order->seller_id, $order->user_id);
        }

        $this->dispatchBrowserEvent('success', ['message' => 'Order updated successfully']);
    }

    public function changeDeliveryStatus()
    {
        $order = Order::where('id', $this->order_id)->first();
        $order->delivery_status = $this->delivery_status;
        if ($this->delivery_status == 'delivered') {
            $order->delivery_date = Carbon::now();
        }

        $order->save();
        if ($this->delivery_status == 'delivered' && $this->payment_status == 'paid') {
            addPoint($order->id, $order->seller_id, $order->user_id);
        }

        $mail_data = getUser($order->user_id);
        $mail_order_details = OrderDetails::where('order_id', $this->order_id)->get();
        $order_address = Address::where('id', $order->address_id)->first();

        
        $mail_status = '';
        if ($this->delivery_status == 'confirmed') {
            $mail_status = 'Your Order is Confirmed';
        }
        if ($this->delivery_status == 'pickedup') {
            $mail_status = 'Your Order is Picked Up';
        }
        if ($this->delivery_status == 'shipped') {
            $mail_status = 'Your Order is Shipped';
        }
        if ($this->delivery_status == 'delivered') {
            $mail_status = 'Your Order is Delivered';
        }

        dispatch(function () use ($mail_data, $order, $mail_status, $mail_order_details, $order_address) {
            $mailData['email'] = $mail_data->email;
            $mailData['name'] = $mail_data->name;
            $mailData['delivery_status'] = $mail_status;
            $mailData['code'] = $order->code;
            $mailData['order_address'] = $order_address;
            $mailData['mail_order_details'] = $mail_order_details;

            Mail::send('emails.delevery-status', $mailData, function ($message) use ($mailData) {
                $message->to($mailData['email'])
                    ->subject($mailData['delivery_status']);
            });
        });

        $this->dispatchBrowserEvent('success', ['message' => 'Order updated successfully']);
    }

    public function render()
    {
        $notificationId = request()->query('not');
        if($notificationId){
            DB::table('notifications')->where('id', $notificationId)->update(['seen' => 1]);
        }

        $orderDetails = OrderDetails::where('order_id', $this->order_id)->get();
        return view('livewire.admin.sales.order-details-component', ['orderDetails' => $orderDetails])->layout('livewire.admin.layouts.base');
    }
}
