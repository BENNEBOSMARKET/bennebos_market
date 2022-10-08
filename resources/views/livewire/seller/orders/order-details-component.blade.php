@section('page_title')
{{ __('seller.orders_details_top_title') }}
@endsection

<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="row justify-content-end">
                    <div class="col-lg-4 col-md-10">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="col-sm-6 col-form-label text-white" for="name">{{ __('seller.payment_status') }}</label>
                                <select class="form-select" id="exampleFormControlSelect1" wire:model="payment_status" wire:change='changePaymentStatus' @if($delivery_status == 'cancelled' || $payment_status == 'paid') disabled @endif>
                                    <option value="unpaid">{{ __('seller.unpaid') }}</option>
                                    <option value="paid">{{ __('seller.paid') }}</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="col-sm-6 col-form-label text-white" for="name">{{ __('seller.delivery_status') }}</label>
                                <select class="form-select" id="exampleFormControlSelect1" wire:model="delivery_status"  wire:change='changeDeliveryStatus' @if($delivery_status == 'delivered' || $delivery_status == 'cancelled') disabled @endif>
                                    <option value="pending">{{ __('seller.pending') }}</option>
                                    <option value="confirmed">{{ __('seller.confirmed') }}</option>
                                    <option value="pickedup">{{ __('seller.picked_up') }}</option>
                                    <option value="shipped">{{ __('seller.shipped') }}</option>
                                    <option value="delivered">{{ __('seller.delivered') }}</option>
                                    <option value="cancelled">{{ __('seller.cancelled') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body invoice-head">
                        <div class="row">
                            <div class="col-md-4 align-self-center">
                                <img src="{{ asset('assets/front/images/header/logo.svg') }}" alt="logo-small"
                                    class="logo-sm me-1" height="24">
                                <p class="mt-2 mb-0 text-muted">{{ __('seller.orders_details_top_title') }}</p>
                            </div>
                            <div class="col-md-8">

                                <ul class="list-inline mb-0 contact-detail float-end">
                                    <li class="list-inline-item">
                                        <div class="ps-3">
                                            <i class="mdi mdi-web"></i>
                                            <p class="text-muted mb-0">{{ __('seller.bennebos_link') }}</p>
                                            <p class="text-muted mb-0">{{ __('seller.bennebos_link') }}</p>
                                        </div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="ps-3">
                                            <i class="mdi mdi-phone"></i>
                                            <p class="text-muted mb-0">{{ __('seller.bennebos_number') }}</p>
                                            <p class="text-muted mb-0">{{ __('seller.bennebos_number') }}</p>
                                        </div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="ps-3">
                                            <i class="mdi mdi-map-marker"></i>
                                            <p class="text-muted mb-0">{{ __('seller.bennebos_address1') }}</p>
                                            <p class="text-muted mb-0">{{ __('seller.bennebos_address2') }}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row row-cols-3 d-flex justify-content-md-between">
                            <div class="col-md-3 d-print-flex">
                                <div class="">
                                    <h6 class="mb-0"><b>{{ __('seller.order_date') }}</b>{{ $order->created_at }}</h6>
                                    <h6><b>{{ __('seller.order_id') }}</b> # {{ $order->code }}</h6>
                                </div>
                            </div>
                            <div class="col-md-3 d-print-flex">
                                <div class="">
                                    <address class="font-13">
                                        <strong class="font-14">{{ __('seller.customer_info') }}</strong><br>
                                        {{ __('seller.name') }} {{ getUser($order->user_id)->name }}<br>
                                        {{ __('seller.email') }} {{ getUser($order->user_id)->email }}<br>
                                        @if (getUser($order->user_id)->phone)
                                        {{ __('seller.phone') }} {{ getUser($order->user_id)->phone }} <br>
                                        @endif
                                        {{ __('seller.address') }} {{ getAddress($order->address_id)->address }}<br>
                                    </address>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive project-invoice">
                                    <table class="table table-bordered mb-0">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>{{ __('seller.order_details_image') }}</th>
                                                <th>{{ __('seller.order_details_name') }}</th>
                                                <th>{{ __('seller.order_details_color') }}</th>
                                                <th>{{ __('seller.order_details_size') }}</th>
                                                <th>{{ __('seller.order_details_delivery') }}</th>
                                                <th>{{ __('seller.order_details_qty') }}</th>
                                                <th>{{ __('seller.order_details_price') }}</th>
                                                <th>{{ __('seller.order_details_total') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderItems as $orderDetail)
                                                <tr>
                                                    <td>
                                                        <img style="height: 50px; width: 50px;"
                                                            src="{{ product($orderDetail->product_id)->thumbnail }}">
                                                    </td>
                                                    <td>
                                                        <h5 class="mt-0 mb-1 font-14">{{ product($orderDetail->product_id)->name }}</h5>
                                                    </td>
                                                    <td>
                                                        @if ($orderDetail->color != '')
                                                            {{ $orderDetail->color }}
                                                        @else
                                                        {{ __('seller.product_table_no_color') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($orderDetail->size != '')
                                                            {{ $orderDetail->size }}
                                                        @else
                                                        {{ __('seller.order_details_no_size') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (order($orderDetail->order_id)->payment_type == 'cod')
                                                        {{ __('seller.cash_on_delivery') }}
                                                        @else
                                                        @endif
                                                    </td>
                                                    <td>{{ $orderDetail->quantity }}</td>
                                                    <td>₺{{ $orderDetail->price }}</td>
                                                    <td>₺{{ $orderDetail->price * $orderDetail->quantity }}</td>
                                                </tr>
                                            @endforeach

                                            <tr>
                                                <th colspan="6" class="border-0"></th>
                                                <td class="border-0 font-14 text-white"><b>  {{ __('seller.sub_total') }}</b></td>
                                                <td class="border-0 font-14 text-white"><b>₺{{ $orderItems->sum('total') }}</b></td>
                                            </tr>

                                            <tr>
                                                <td colspan="6" class="border-0"></td>
                                                <td class="border-0 font-14 text-white"><b>  {{ __('seller.coupon') }}</b></td>
                                                <td class="border-0 font-14 text-white"><b>₺{{ order($orderDetail->order_id)->coupon_discount }}</b></td>
                                            </tr>

                                            <tr>
                                                <td colspan="6" class="border-0"></td>
                                                <td class="border-0 font-14 text-white"><b>  {{ __('seller.discount') }}</b></td>
                                                <td class="border-0 font-14 text-white"><b>₺{{ order($orderDetail->order_id)->discount }}</b></td>
                                            </tr>

                                            <tr class="bg-black text-white">
                                                <th colspan="6" class="border-0"></th>
                                                <td class="border-0 font-14"><b>  {{ __('seller.order_details_table_total') }}</b></td>
                                                <td class="border-0 font-14"><b>₺{{ order($orderDetail->order_id)->grand_total }}</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center mt-4 mb-4">
                            <div class="col-lg-12 col-xl-4 ms-auto align-self-center">
                                <div class="text-center"><small class="font-12">  {{ __('seller.order_thanks') }}</small></div>
                            </div>

                            <div class="col-lg-12 col-xl-4">
                                <div class="float-end d-print-none mt-2 mt-md-0">
                                    <a href="javascript:window.print()" class="btn btn-info btn-sm">  {{ __('seller.print') }}</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


</div>


@push('scripts')
    <script>
        //SWL
        window.addEventListener('show_delivery_confirmation', event => {
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Confirm'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deliveryConfirmed')
                }
            })
        });

        //Success Delete
        window.addEventListener('confirmed_message', event => {
            Swal.fire(
                'Confirmed!',
                'Delivery confirmed successfully.',
                'success'
            )
        });

        //Cancel
        window.addEventListener('show_delivery_cancel_confirmation', event => {
            Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to cancel this order? You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('cancelConfirmed')
                }
            })
        });

        //Success Delete
        window.addEventListener('cancelled_message', event => {
            Swal.fire(
                'Cancelled!',
                'Order cancelled successfully.',
                'error'
            )
        });
    </script>
@endpush