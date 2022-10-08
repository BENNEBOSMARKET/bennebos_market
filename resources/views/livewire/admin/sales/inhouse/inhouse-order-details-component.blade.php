<div>
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#">Order</a></li>
                            <li class="breadcrumb-item active">Inhouse Order Details</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Inhouse Order Details</h4>
                </div>
                <!--end page-title-box-->
            </div>
            <!--end col-->
        </div>
        <!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-body invoice-head">
                        <div class="row">
                            <div class="col-md-4 align-self-center">
                                <img src="{{ asset('assets/front/images/header/logo.svg') }}" alt="logo-small"
                                    class="logo-sm me-1" height="24">
                                <p class="mt-2 mb-0 text-muted">Thank you for shoping with us!</p>
                            </div>
                            <!--end col-->
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
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end card-body-->
                    <div class="card-body">
                        <div class="row row-cols-3 d-flex justify-content-md-between">
                            <div class="col-md-3 d-print-flex">
                                <div class="">
                                    <h6 class="mb-0"><b>Order Date :</b>{{ $order->created_at }}</h6>
                                    <h6><b>Order ID :</b> # {{ $order->code }}</h6>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-3 d-print-flex">
                                <div class="">
                                    <address class="font-13">
                                        <strong class="font-14">Customer Info:</strong><br>
                                        {{ getUser($order->user_id)->name }}<br>
                                        {{ getUser($order->user_id)->email }}<br>
                                        <abbr title="Phone">P:</abbr> {{ getUser($order->user_id)->phone }} <br>
                                        {{ getAddress($order->address_id)->address }},
                                        {{ getAddress($order->address_id)->state }},
                                        {{ getAddress($order->address_id)->country }}.
                                    </address>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->

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
                                            <!--end tr-->
                                        </thead>
                                        <tbody>
                                            @foreach ($inhouseOrderDetails as $item)
                                            <tr>
                                                <td>
                                                    <img style="height: 50px; width: 50px;"
                                                        src="{{ product($item->product_id)->thumbnail }}">
                                                </td>
                                                <td>
                                                    <h5 class="mt-0 mb-1 font-14">{{ product($item->product_id)->name }}</h5>
                                                </td>
                                                <td>{{ $item->quantity }}</td>

                                                <td>₺{{ $item->price }}</td>
                                                <td>₺{{ $item->total }}</td>
                                            </tr>
                                            @endforeach
                                            <!--end tr-->
                                            <tr>
                                                <td colspan="3" class="border-0"></td>
                                                <td class="border-0 font-14 text-dark"><b>Coupon</b></td>
                                                <td class="border-0 font-14 text-dark"><b>₺{{ $order->coupon_discount }}</b></td>
                                            </tr>
                                            <!--end tr-->
                                            <tr>
                                                <td colspan="3" class="border-0"></td>
                                                <td class="border-0 font-14 text-dark"><b>Discount</b></td>
                                                <td class="border-0 font-14 text-dark"><b>₺{{ $order->discount }}</b></td>
                                            </tr>
                                            <!--end tr-->
                                            <tr>
                                                <th colspan="3" class="border-0"></th>
                                                <td class="border-0 font-14 text-dark"><b>Sub Total</b></td>
                                                <td class="border-0 font-14 text-dark"><b>₺{{ $order->grand_total }}</b></td>
                                            </tr>
                                            <!--end tr-->
                                            <tr class="bg-black text-white">
                                                <th colspan="3" class="border-0"></th>
                                                <td class="border-0 font-14"><b>Total</b></td>
                                                <td class="border-0 font-14"><b>₺{{ $order->grand_total }}</b></td>
                                            </tr>
                                            <!--end tr-->
                                        </tbody>
                                    </table>
                                    <!--end table-->
                                </div>
                                <!--end /div-->
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->

                        <div class="row">
                            <div class="col-lg-7">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label class="col-sm-6 col-form-label" for="name">Payment Status</label>
                                        <select class="form-select" id="exampleFormControlSelect1">
                                            <option>Paid</option>
                                            <option>Unpaid</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-sm-6 col-form-label" for="name">Delivery Status</label>
                                        <select class="form-select" id="exampleFormControlSelect1">
                                            <option>Pending</option>
                                            <option>Confirmed</option>
                                            <option>Picked Up</option>
                                            <option>On The Way</option>
                                            <option>Delivered</option>
                                            <option>Cancel</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-5 align-self-center">
                                <div class="float-none float-md-end" style="width: 30%;">
                                    <small>Account Manager</small>
                                    <img src="assets/images/signature.png" alt="" class="mt-2 mb-1" height="20">
                                    <p class="border-top">Signature</p>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                        <hr>
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-12 col-xl-4 ms-auto align-self-center">
                                <div class="text-center"><small class="font-12">Thank you very much for doing business
                                        with us.</small></div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-12 col-xl-4">
                                <div class="float-end d-print-none mt-2 mt-md-0">
                                    <a href="javascript:window.print()" class="btn btn-info btn-sm">Print</a>
                                    <a href="#" class="btn btn-primary btn-sm">Save</a>
                                    <a href="#" class="btn btn-danger btn-sm">Cancel</a>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div><!-- container -->
</div>
