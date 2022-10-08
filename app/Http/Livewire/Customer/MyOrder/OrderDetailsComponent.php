<?php

namespace App\Http\Livewire\Customer\MyOrder;

use App\Models\BusinessSetting;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Review;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\OrderDetails;
use App\Models\Refund;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class OrderDetailsComponent extends Component
{
    use WithFileUploads;
    public $order_id, $order, $payment_status, $delivery_status, $rating = 1, $comment, $images = [];
    public $refund_reason, $refund_time;

    public function mount($id)
    {
        $this->order_id = $id;
    }

    public $product_id;
    public function showReviewModal($id)
    {
        $this->product_id = $id;
        $this->dispatchBrowserEvent('showReviewModal');
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'rating' => 'required',
            'comment' => 'required',
            'refund_reason' => 'required',
        ]);
    }

    public function storeReview()
    {
        $this->validate([
            'rating' => 'required',
            'comment' => 'required',
        ]);

        $review = new Review();
        $review->product_id = $this->product_id;
        $review->user_id = user()->id;
        $review->rating = $this->rating;
        $review->comment = $this->comment;

        if ($this->images) {
            $imgArray = [];
            foreach ($this->images as $key => $galImg) {
                $imageName = Carbon::now()->timestamp . Str::random(10) . '.' . $this->images[$key]->extension();
                $this->images[$key]->storeAs('reviews', $imageName);
                $imgArray[] = url('/') . '/uploads/reviews/' . $imageName;
            }

            $review->image = json_encode($imgArray);
        }

        $review->save();

        $this->dispatchBrowserEvent('ratingAdded');
        $this->dispatchBrowserEvent('closeModal');

        $this->close();
    }

    public $order_details_id;
    public function showRefundModal($id)
    {
        $this->order_details_id = $id;

        $getData = Refund::where('order_id', $this->order_id)->where('order_details_id', $id)->where('user_id', user()->id)->get();

        if($getData->count() > 0){
            $this->dispatchBrowserEvent('error', ['message' => 'Already requested']);
        }
        else{
            $this->dispatchBrowserEvent('showRefundModal');
        }

        
    }

    public function submitRefund()
    {
        $this->validate([
            'refund_reason' => 'required',
        ]);

        $order_detail = OrderDetails::where('id', $this->order_details_id)->first();
        $refund = new Refund();
        $refund->user_id = user()->id;
        $refund->order_id = $order_detail->order_id;
        $refund->order_details_id = $order_detail->id;
        $refund->seller_id = $order_detail->seller_id;
        $refund->seller_approved = 0;
        $refund->reason = $this->refund_reason;
        $refund->admin_approved = 0;
        $refund->refund_amount = $order_detail->total;
        $refund->refund_status = 0;
        if ($refund->save()) {
            $order = Order::find($this->order_id);
            $order->order_status = 'refund requested';
            $order->save();

            $this->dispatchBrowserEvent('success', ['message' => 'Refund request sent successfully']);
            $this->dispatchBrowserEvent('closeModal');
        } else {
            $this->dispatchBrowserEvent('error', ['message' => 'Something went wrong']);
        }
    }

    public function close()
    {
        $this->comment = '';
        $this->rating = '1';
        $this->product_id = '';
        $this->refund_product_id = '';
        $this->refund_reason = '';
    }

    public function render()
    {
        $order = Order::where('id', $this->order_id)->first();
        $this->order = $order;
        $this->payment_status = $order->payment_status;
        $this->delivery_status = $order->delivery_status;
        $this->refund_time = BusinessSetting::where('id', 1)->first()->refund_time;

        $orderDetails = OrderDetails::where('order_id', $this->order_id)->get();
        return view('livewire.customer.my-order.order-details-component', ['orderDetails' => $orderDetails])->layout('livewire.layouts.base');
    }
}
