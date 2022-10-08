<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Sales</li>
                            <li class="breadcrumb-item">All Orders</li>
                            <li class="breadcrumb-item active">Order Details</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Order Details</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="row justify-content-end mt-3">
                    <div class="col-lg-4 col-md-10">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="col-sm-6 col-form-label" for="name">Payment Status</label>
                                <select class="form-select" id="exampleFormControlSelect1" wire:model="payment_status" wire:change='changePaymentStatus'>
                                    <option value="unpaid">Unpaid</option>
                                    <option value="paid">Paid</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="col-sm-6 col-form-label" for="name">Delivery Status</label>
                                <select class="form-select" id="exampleFormControlSelect1" wire:model="delivery_status"  wire:change='changeDeliveryStatus'>
                                    <option value="pending">Pending</option>
                                    <option value="confirmed">Confirmed</option>
                                    <option value="pickedup">Picked Up</option>
                                    <option value="shipped">Shipped</option>
                                    <option value="delivered">Delivered</option>
                                    <option value="cancelled">Cancel</option>
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
                                <p class="mt-2 mb-0 text-muted">Order details</p>
                            </div>
                            <div class="col-md-8">

                                <ul class="list-inline mb-0 contact-detail float-end">
                                    <li class="list-inline-item">
                                        <div class="ps-3">
                                            <i class="mdi mdi-web"></i>
                                            <p class="text-muted mb-0">www.bennebosmarket.com</p>
                                            <p class="text-muted mb-0">www.bennebosmarket.com</p>
                                        </div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="ps-3">
                                            <i class="mdi mdi-phone"></i>
                                            <p class="text-muted mb-0">+123 123456789</p>
                                            <p class="text-muted mb-0">+123 123456789</p>
                                        </div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="ps-3">
                                            <i class="mdi mdi-map-marker"></i>
                                            <p class="text-muted mb-0">2821 Kensington Road,</p>
                                            <p class="text-muted mb-0">Avondale Estates, GA 30002 USA.</p>
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
                                    <h6 class="mb-0"><b>Order Date :</b>{{ $order->created_at }}</h6>
                                    <h6><b>Order ID :</b> # {{ $order->code }}</h6>
                                </div>
                            </div>
                            <div class="col-md-3 d-print-flex">
                                <div class="">
                                    <address class="font-13">
                                        <strong class="font-14">Customer Info:</strong><br>
                                        {{ getUser($order->user_id)->name }}<br>
                                        {{ getUser($order->user_id)->email }}<br>
                                        {{ getUser($order->user_id)->phone }} <br>
                                        {{ getAddress($order->address_id)->address }}<br>
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
                                                <th>Image</th>
                                                <th>Product Name</th>
                                                <th>Seller</th>
                                                <th>DELIVERY TYPE</th>
                                                <th>QTY</th>
                                                <th>PRICE</th>
                                                <th>TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderDetails as $orderDetail)
                                                <tr>
                                                    <td>
                                                        <img style="height: 50px; width: 50px;"
                                                            src="{{ product($orderDetail->product_id)->thumbnail }}">
                                                    </td>
                                                    <td>
                                                        <h5 class="mt-0 mb-1 font-14">{{ product($orderDetail->product_id)->name }}</h5>
                                                    </td>
                                                    <td>
                                                        <h5 class="mt-0 mb-1 font-14">{{ seller($order->seller_id)->name }}</h5>
                                                    </td>
                                                    <td>
                                                        @if (order($orderDetail->order_id)->payment_type == 'cod')
                                                            Cash on Delivery
                                                        @else
                                                        @endif
                                                    </td>
                                                    <td>{{ $orderDetail->quantity }}</td>
                                                    <td>₺{{ $orderDetail->price }}</td>
                                                    <td>₺{{ $orderDetail->price * $orderDetail->quantity }}</td>
                                                </tr>
                                            @endforeach

                                            <tr>
                                                <th colspan="4" class="border-0"></th>
                                                <td class="border-0 font-14 text-dark"><b>Sub Total</b></td>
                                                <td class="border-0 font-14 text-dark"><b>₺{{ $orderDetails->sum('total') }}</b></td>
                                            </tr>

                                            <tr>
                                                <td colspan="4" class="border-0"></td>
                                                <td class="border-0 font-14 text-dark"><b>Coupon</b></td>
                                                <td class="border-0 font-14 text-dark"><b>₺{{ order($orderDetail->order_id)->coupon_discount }}</b></td>
                                            </tr>

                                            <tr>
                                                <td colspan="4" class="border-0"></td>
                                                <td class="border-0 font-14 text-dark"><b>Discount</b></td>
                                                <td class="border-0 font-14 text-dark"><b>₺{{ order($orderDetail->order_id)->discount }}</b></td>
                                            </tr>

                                            <tr class="bg-black text-white">
                                                <th colspan="5" class="border-0"></th>
                                                <td class="border-0 font-14"><b>Total</b></td>
                                                <td class="border-0 font-14"><b>₺{{ order($orderDetail->order_id)->grand_total }}</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4
                        ">
                            <div class="col-12 text-end">
                                <div class="float-none float-md-end" style="width: 30%;">
                                    <small>Account Manager</small>
                                    <img src="assets/images/signature.png" alt="" class="mt-2 mb-1" height="20">
                                    <p class="border-top">Signature</p>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-12 col-xl-4 ms-auto align-self-center">
                                <div class="text-center"><small class="font-12">Thank you very much for doing business
                                        with us.</small></div>
                            </div>

                            <div class="col-lg-12 col-xl-4">
                                <div class="float-end d-print-none mt-2 mt-md-0">
                                    <a href="javascript:window.print()" class="btn btn-info btn-sm">Print</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
