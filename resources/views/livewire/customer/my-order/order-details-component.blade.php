@section('title')
    Order Details
@endsection
<div>
    <style>
        [type="file"] {
            /* Style the color of the message that says 'No file chosen' */
            color: #878787;
        }
        [type="file"]::-webkit-file-upload-button {
            background: #ffffff;
            border: 2px solid #9e9e9e;
            border-radius: 4px;
            color: rgb(0, 0, 0);
            cursor: pointer;
            font-size: 10px;
            outline: none;
            padding: 17px 15px;
        }
    </style>
    <section class="profile_account_wrapper">
        <div class="my-container">
            <div class="profile_title_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                <h3 class="cart_title">{{ __('customer.dashboard') }}</h3>
                <button type="button" id="profileSidebarIcon">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
            <div class="profile_sidebar_grid_area">
                @livewire('customer.inc.sidebar')
                <div>
                    <div class="profile_content_wrapper">
                        <div
                            class="profile_content_title_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                            <h3 style="float: left;">{{ __('customer.order_summary') }}</h3>
                            <a href="{{ route('customer.orders-track', ['order_code'=>$order->code]) }}" class="" style="float: right;">Track Order</a>
                        </div>
                        <div class="order_details_info_area">
                            <div class="order_details_item_grid">
                                <div class="order_item_content">
                                    <h4>{{ __('customer.order_ID') }}:</h4>
                                    <h5>{{ $order->code }}</h5>
                                </div>
                                <div class="order_item_content">
                                    <h4>{{ __('customer.order_date') }}:</h4>
                                    <h5>{{ $order->created_at }}</h5>
                                </div>
                            </div>
                            <div class="order_details_item_grid">
                                <div class="order_item_content">
                                    <h4>{{ __('customer.customer') }}:</h4>
                                    <h5>{{ getUser($order->user_id)->name }}</h5>
                                </div>
                                <div class="order_item_content">
                                    <h4>{{ __('customer.email') }}:</h4>
                                    <h5>
                                        <a href="mailto:{{ getUser($order->user_id)->email }}">{{
                                            getUser($order->user_id)->email }}</a>
                                    </h5>
                                </div>
                            </div>
                            <div class="order_details_item_grid">
                                <div class="order_item_content">
                                    <h4>{{ __('customer.payment_method') }}:</h4>
                                    <h5>
                                        @if ($order->payment_type == 'cod')
                                        {{ __('customer.cash_on_delivery') }}
                                        @else

                                        @endif
                                    </h5>
                                </div>
                                @if (getAddress($order->address_id)->phone != '')
                                    <div class="order_item_content">
                                        <h4>{{ __('customer.mobile') }}:</h4>
                                        <h5>{{ getAddress($order->address_id)->phone }}</h5>
                                    </div>
                                @endif
                                @if (getAddress($order->address_id)->phone != '')
                                    <div class="order_item_content">
                                        <h4>Seller:</h4>
                                        <h5>{{ seller($order->seller_id)->name }}</h5>
                                    </div>
                                @endif

                                <div class="order_item_content">
                                    <h4>{{ __('customer.shipping_address') }}:</h4>
                                    <h5>
                                        {{ getAddress($order->address_id)->address }},
                                        {{ getAddress($order->address_id)->state }},
                                        {{ getAddress($order->address_id)->country }}.
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order_details_product_price_grid">
                        <div class="profile_sub_content_area">
                            <div class="order_title">
                                <h2>{{ __('customer.order_detials') }}</h2>
                            </div>
                            <div class="order_details_product_table">
                                <table>
                                    <tr>
                                        <td style="text-align: left;">
                                            <h3>{{ __('customer.product') }}</h3>
                                        </td>
                                        <td>
                                            <h3>{{ __('customer.quantity') }}</h3>
                                        </td>
                                        <td>
                                            <h3>{{ __('customer.price') }}</h3>
                                        </td>
                                        <td>
                                            <h3>Review</h3>
                                        </td>
                                        <td>
                                            <h3>Refund</h3>
                                        </td>
                                    </tr>
                                    @foreach ($orderDetails as $orderDetail)
                                        <tr class="table_row">
                                            <td>
                                                <a href="{{ route('front.productDetails', ['slug'=>product($orderDetail->product_id)->slug]) }}" style="display: flex;">
                                                    <img style="height: 50px;"
                                                    src="{{ product($orderDetail->product_id)->thumbnail }}">
                                                    <span style="padding: 15px 10px;">
                                                        {{ Str::limit(product($orderDetail->product_id)->name, 30, '...') }}
                                                    </span>
                                                </a>
                                            </td>
                                            <td>
                                                <h5>{{ $orderDetail->quantity }}</h5>
                                            </td>
                                            <td>
                                                <h5>₺{{ $orderDetail->price }}</h5>
                                            </td>
                                            <td> 
                                                @if (order($orderDetail->order_id)->delivery_status == 'delivered')
                                                    @if (isReviewed($orderDetail->product_id) == 1)
                                                        <span style="font-size: 14px; color: green; cursor: pointer;"><i class="fa fa-check"></i> Reviewed</span>
                                                    @else
                                                        <button type="button" class="btnPreLoadR" wire:click.prevent="showReviewModal({{ $orderDetail->product_id }})" style="font-size: 14px; color: green; cursor: pointer;"><i class="fa fa-plus"></i> Review</button>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                @if (product($orderDetail->product_id)->refundable == 1 && Carbon\Carbon::parse(order($orderDetail->order_id)->delivery_date)->addDays($refund_time) > Carbon\Carbon::now())
                                                    @if (order($orderDetail->order_id)->delivery_status == 'delivered' && order($orderDetail->order_id)->payment_status == 'paid')
                                                        @if( $order->order_status == 'refund requested' )
                                                            <small>Requested</small>
                                                        @elseif( $order->order_status == 'accepted' )
                                                            <small>Accepted</small>
                                                        @elseif( $order->order_status == 'rejected' )
                                                            <small style="color: red;">Rejected</small>
                                                        @else
                                                            <button type="button" wire:click.prevent="showRefundModal({{ $orderDetail->id }})" style="font-size: 14px; color: green; cursor: pointer;"><i class="fa fa-sync-alt"></i></button>
                                                        @endif
                                                    @endif
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="profile_sub_content_area">
                            <div class="order_title">
                                <h2>{{ __('customer.order_amount') }}</h2>
                            </div>
                            <div class="order_details_ammout_area">
                                <ul>
                                    <li>
                                        <h3>{{ __('customer.subtotal') }}</h3>
                                        <h4>₺{{ $orderDetails->sum('total') }}</h4>
                                    </li>
                                    <li>
                                        <h3>{{ __('customer.discount') }}</h3>
                                        <h4>₺{{ order($orderDetail->order_id)->discount }}</h4>
                                    </li>
                                    <li>
                                        <h3>{{ __('customer.coupon') }}</h3>
                                        <h4>₺{{ order($orderDetail->order_id)->coupon_discount }}</h4>
                                    </li>

                                    @if (order($orderDetail->order_id)->points_used > 0)
                                        <li>
                                            <h3>Used Points</h3>
                                            <h4>{{ order($orderDetail->order_id)->points_used }}</h4>
                                        </li>
                                    @endif
                                </ul>
                                <div class="order_summery_divider"></div>
                                <div class="total_ammout_area d-flex align-items-center justify-content-between g-sm">
                                    <h3>{{ __('customer.total') }}</h3>
                                    <h4>₺{{ order($orderDetail->order_id)->grand_total }}</h4>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Adress -->
                        <div wire:ignore.self class="modal_wrapper" id="modalID1">
                            <div class="modal_dialog">
                                <div class="modal_header d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                    <h3 style="font-size: 17px;">Write your Review</h3>
                                    <button type="button" id="modalClose1" wire:click='close'>
                                        <i class="fa fa-times" style="font-size: 25px;"></i>
                                    </button>
                                </div>
                                <div class="modal_body">
                                    <form wire:submit.prevent='storeReview' class="form_area">
                                        @if ($product_id != '')
                                            <div class="input_row">
                                                <label for="" style="font-size: 14px;">Add Review for: {{ product($product_id)->name }}</label>
                                            </div>
                                        @endif
                                        <div class="input_row">
                                            <label for="" style="font-size: 13px;">Your Rating</label>
                                        </div>
                                        <div class="starability-basic">
                                            <input type="radio" id="rate5" name="rating" wire:model='rating' value="1" />
                                            <label for="rate5" title="Terrible">1 stars</label>

                                            <input type="radio" id="rate4" name="rating" wire:model='rating' value="2" />
                                            <label for="rate4" title="Not good">2 stars</label>

                                            <input type="radio" id="rate3" name="rating" wire:model='rating' value="3" />
                                            <label for="rate3" title="Average">3 stars</label>

                                            <input type="radio" id="rate2" name="rating" wire:model='rating' value="4" />
                                            <label for="rate2" title="Very good">4 stars</label>

                                            <input type="radio" id="rate1" name="rating" wire:model='rating' value="5" />
                                            <label for="rate1" title="Amazing">5 star</label>
                                        </div>
                                        <br>
                                        <div class="input_row">
                                            <label for="" style="font-size: 13px;">Comment</label>
                                            <textarea name="" id="" rows="7" wire:model='comment' placeholder="Enter your review"></textarea>
                                            @error('comment')
                                                <p style="color: red; font-size: 13px;">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <label for="" style="font-size: 13px;">Images</label>
                                        <input type="file" wire:model='images' multiple />
                                        <br>
                                        <br>
                                        <div wire:loading="images" wire:target="images" wire:key="images" style="font-size: 12.5px;" class="mr-2"><i class="fa fa-spinner fa-spin"></i> Uploading</div>
                                        @if ($images)
                                            @foreach ($images as $item)
                                                <img src="{{ $item->temporaryUrl() }}" style="height: 50px; margin-right: 5px;" alt="">
                                            @endforeach
                                        @endif

                                        <div class="sign_up_button" style="text-align: right;">
                                            <button type="submit" class="btnPreLoad" style="width: 45%;">Submit Review</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div wire:ignore class="modal_overlay" id="modalOverlay1"></div>


                        <!-- Refund Modal -->
                        <div wire:ignore.self class="modal_wrapper" id="modalID2">
                            <div class="modal_dialog">
                                <div class="modal_header d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                    <h3 style="font-size: 17px;">Write your Review</h3>
                                    <button type="button" id="modalClose2" wire:click='close'>
                                        <i class="fa fa-times" style="font-size: 25px;"></i>
                                    </button>
                                </div>
                                <div class="modal_body">
                                    <form wire:submit.prevent='submitRefund' class="form_area">
                                        <div class="input_row">
                                            <label for="">Order Code</label>
                                            <input type="text" value="{{ $order->code }}" disabled />
                                        </div>
            
            
                                        <div class="input_row">
                                            <label for="">Refund Amount</label>
                                            <input type="text" value="{{ $order->grand_total }}" disabled />
                                        </div>
            
                                        <div class="input_row">
                                            <label for="">Refund Reason</label>
                                            <textarea wire:model="refund_reason" id="" cols="30" rows="10" class="form-control" placeholder="Refund Reason"></textarea>
                                            @error('refund_reason')
                                                <p style="color: red; font-size: 13px;">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="sign_up_button" style="text-align: right;">
                                            <button type="submit" class="btnPreLoad" style="width: 45%;">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div wire:ignore class="modal_overlay" id="modalOverlay2"></div>

                    </div>
                </div>
            </div>
        </div>
        <div class="profile_sidebar_overlay" id="sidebarOverlay"></div>
    </section>
</div>

@push('scripts')
    <script>
        window.addEventListener('showReviewModal', event => {
            modalShow("modalID1", "modalOverlay1");
        });
        window.addEventListener('showRefundModal', event => {
            modalShow("modalID2", "modalOverlay2");
        });

        window.addEventListener('closeModal', event => {
            modalHide("modalID1", "modalOverlay1");
            modalHide("modalID2", "modalOverlay2");
        });

        window.addEventListener('ratingAdded', event => {
            Swal.fire(
                'Success!',
                'Your Review Added Successfully',
                'success'
            )
        });
    </script>
    <script>
        window.addEventListener('success', event => {
            toastr.success(event.detail.message);
        });
        window.addEventListener('warning', event => {
            toastr.warning(event.detail.message);
        });
        window.addEventListener('error', event => {
            toastr.error(event.detail.message);
        });
    </script>
@endpush
