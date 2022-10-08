<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Seller Order Details</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Seller Order Details</h4>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-body invoice-head">
                        <div class="row">
                            <div class="col-md-4 align-self-center">
                                <img src="{{ asset('assets/front/images/header/logo.svg') }}" alt="logo-small"
                                    class="logo-sm me-1" height="24">
                                <p class="mt-2 mb-0 text-muted">Seller order details</p>
                            </div>
                            <div class="col-md-8">

                                <ul class="list-inline mb-0 contact-detail float-end">
                                    <li class="list-inline-item">
                                        <div class="ps-3">
                                            <i class="mdi mdi-web"></i>
                                            <p class="text-muted mb-0">www.bennebosmarket.com</p>
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
                                    <h6 class="mb-0"><b>Order Date : </b>{{ $order->created_at }}</h6>
                                    <h6><b>Order ID : </b># {{ $order->code }}</h6>
                                </div>
                            </div>
                            <div class="col-md-3 d-print-flex">
                                <div class="">
                                    <address class="font-13">
                                        <strong class="font-14">Customer Info:</strong><br>
                                        {{ getUser($order->user_id)->name }}<br>
                                        {{ getUser($order->user_id)->email }}<br>
                                        @if (getUser($order->user_id)->phone != '')
                                            {{ getUser($order->user_id)->phone }} <br>
                                        @endif
                                        {{ getUser($order->user_id)->phone }}
                                        {{ getAddress($order->address_id)->address }},
                                        {{ getAddress($order->address_id)->state }},
                                        {{ getAddress($order->address_id)->country }}.
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
                                                <th>Product Details</th>
                                                <th>QTY</th>
                                                <th>PRICE</th>
                                                <th>TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sellerOrderDetails as $item)
                                                <tr>
                                                    <td>
                                                        <img style="height: 50px; width: 50px;"
                                                            src="{{ product($item->product_id)->thumbnail }}">
                                                    </td>
                                                    <td>
                                                        <h5 class="mt-0 mb-1 font-14">
                                                            {{ product($item->product_id)->name }}</h5>
                                                    </td>
                                                    <td>{{ $item->quantity }}</td>

                                                    <td>₺{{ $item->price }}</td>
                                                    <td>₺{{ $item->total }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="3" class="border-0"></td>
                                                <td class="border-0 font-14 text-dark"><b>Coupon</b></td>
                                                <td class="border-0 font-14 text-dark">
                                                    <b>₺{{ $order->coupon_discount }}</b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="border-0"></td>
                                                <td class="border-0 font-14 text-dark"><b>Discount</b></td>
                                                <td class="border-0 font-14 text-dark">
                                                    <b>₺{{ $order->discount }}</b></td>
                                            </tr>
                                            <tr>
                                                <th colspan="3" class="border-0"></th>
                                                <td class="border-0 font-14 text-dark"><b>Sub Total</b></td>
                                                <td class="border-0 font-14 text-dark"><b>₺{{ $order->grand_total }}</b>
                                                </td>
                                            </tr>
                                            <tr class="bg-black text-white">
                                                <th colspan="3" class="border-0"></th>
                                                <td class="border-0 font-14"><b>Total</b></td>
                                                <td class="border-0 font-14"><b>₺{{ $order->grand_total }}</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
