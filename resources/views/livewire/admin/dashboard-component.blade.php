@if(auth()->user()->role != "sub-admin" )
    <div>
        <div class="container-fluid">

            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="float-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Bennebosmarket</a>
                                </li>
                                <!--end nav-item-->
                                <li class="breadcrumb-item"><a href="#">Ecommerce</a>
                                </li>
                                <!--end nav-item-->
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                    <!--end page-title-box-->
                </div>
                <!--end col-->
            </div>
            <!-- end page title end breadcrumb -->
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col align-self-center">
                                    <a href="{{url('admin/commission-history')}}" class="media">
                                        <img src="{{ asset('assets/admin/images/logos/money-beg.png') }}" alt=""
                                             class="align-self-center" height="40">
                                        <div class="media-body align-self-center ms-3">
                                            <h6 class="m-0 font-24 fw-bold">Tl {{$adminCommission}}</h6>
                                            <p class="text-muted mb-0">Total Revenue</p>
                                        </div>
                                        <!--end media body-->
                                    </a>
                                    <!--end media-->
                                </div>
                                <!--end col-->
                                <div class="col-auto align-self-center">
                                    <div class="">
                                        <div id="Revenu_Status_bar" class="apex-charts mb-n4"></div>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <a href="{{url('admin/commission-history')}}" class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col text-center">
                                            <span class="h5  fw-bold">TL {{$adminCommissionToday}}</span>
                                            <h6 class="text-uppercase text-muted mt-2 m-0 font-11">Today's Revenue</h6>
                                        </div>
                                        <!--end col-->
                                    </div> <!-- end row -->
                                </div>
                                <!--end card-body-->
                            </a>
                            <!--end card-body-->
                        </div>
                        <!--end col-->
                        <div class="col-12 col-lg-6">
                            <a  href="{{url('admin/sales/all-orders')}}" class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col text-center">
                                            <span class="h5  fw-bold">{{$orderToday}}</span>
                                            <h6 class="text-uppercase text-muted mt-2 m-0 font-11">Today's New Order</h6>
                                        </div>
                                        <!--end col-->
                                    </div> <!-- end row -->
                                </div>
                                <!--end card-body-->
                            </a>
                            <!--end card-body-->
                        </div>
                        <div class="col-12 col-lg-6">
                            <a href="{{url('admin/sales/all-orders')}}" class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col text-center">
                                            <span class="h5  fw-bold">{{$order}}</span>
                                            <h6 class="text-uppercase text-muted mt-2 m-0 font-11">All Orders</h6>
                                        </div>
                                        <!--end col-->
                                    </div> <!-- end row -->
                                </div>
                                <!--end card-body-->
                            </a>
                            <!--end card-body-->
                        </div>
                        <!--end col-->
                        <div class="col-12 col-lg-6">
                            <a href="{{url('admin/sales/inhouse-orders')}}" class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col text-center">
                                            <span class="h5  fw-bold">{{$inhouseOrderDetails}}</span>
                                            <h6 class="text-uppercase text-muted mt-2 m-0 font-11">In house Order Details</h6>
                                        </div>
                                        <!--end col-->
                                    </div> <!-- end row -->
                                </div>
                                <!--end card-body-->
                            </a>
                            <!--end card-body-->
                        </div>
                        <!--end col-->
                        <div class="col-12 col-lg-6">
                            <a href="{{url('admin/seller/all-seller')}}" class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col text-center">
                                            <span class="h5  fw-bold">{{$sellerToday}}</span>
                                            <h6 class="text-uppercase text-muted mt-2 m-0 font-11">Today's New Seller</h6>
                                        </div>
                                        <!--end col-->
                                    </div> <!-- end row -->
                                </div>
                                <!--end card-body-->
                            </a>
                            <!--end card-->
                        </div>
                        <div class="col-12 col-lg-6">
                            <a href="{{url('admin/seller/all-seller')}}" class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col text-center">
                                            <span class="h5  fw-bold">{{$seller}}</span>
                                            <h6 class="text-uppercase text-muted mt-2 m-0 font-11">All Sellers</h6>
                                        </div>
                                        <!--end col-->
                                    </div> <!-- end row -->
                                </div>
                                <!--end card-body-->
                            </a>
                            <!--end card-->
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div><!-- end col-->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">Revenu Status</h4>
                                </div>
                                <!--end col-->
                                <div class="col-auto">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-sm btn-outline-light dropdown-toggle"
                                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            This Month<i class="las la-angle-down ms-1"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Today</a>
                                            <a class="dropdown-item" href="#">Last Week</a>
                                            <a class="dropdown-item" href="#">Last Month</a>
                                            <a class="dropdown-item" href="#">This Year</a>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <div class="">
                                <canvas id="canvas" height="183" width="600"></canvas>
                            </div>
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div><!-- end col-->
            </div>
            <!--end row-->
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-2 col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{ $product->thumbnail }}" alt=""
                                     class="img-fluid px-2 px-lg-5">
                                <hr class="hr-dashed">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="#" class="font-15 fw-bold text-primary">{!! Str::limit($product->name, 10,) !!}</a>
                                        <p class="text-muted mb-0 fw-semibold font-13">{{ category($product->category_id)->name }}</p>
                                    </div>
                                    <div class="align-self-center">
                                        <p class="fw-bold font-22 m-0">₺{{ $product->unit_price }}</p>
                                    </div>
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                @endforeach
            </div>
            <!--end row-->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">Earnings Reports</h4>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th class="border-top-0">Date</th>
                                        <th class="border-top-0">Seller</th>
                                        <th class="border-top-0">Admin commission</th>
                                        <th class="border-top-0">Seller Earning</th>
                                        <th class="border-top-0">-</th>
                                    </tr>
                                    <!--end tr-->
                                    </thead>
                                    <tbody>
                                    @foreach($Commissions as $Commission)
                                    <tr>
                                        <td>{{date_format($Commission->created_at ,'M-d')}}</td>
                                        <td>{{$Commission->name}}</td>

                                        <td class="text-success">Tl {{$Commission->admin_commission}}</td>
                                        <td class="text-primary">Tl {{$Commission->seller_earning}}</td>
                                        <td class="text-danger">Tl {{$Commission->seller_earning - $Commission->admin_commission }}</td>
                                    </tr>
                                    @endforeach
                                    <!--end tr-->

                                    <!--end tr-->
                                    </tbody>
                                </table>
                                <!--end table-->
                            </div>
                            <!--end /div-->
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">Most Populer Products</h4>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-header-->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="thead-light">
                                    <tr>
                                        <th class="border-top-0">Product</th>
                                        <th class="border-top-0">Price</th>
                                        <th class="border-top-0">Unit</th>
                                        <th class="border-top-0">Status</th>

                                    </tr>
                                    <!--end tr-->
                                    </thead>
                                    <tbody>
                                    @foreach($productsTopRanked as $productTopRanked)
                                    <tr>

                                        <td>
                                            <div class="media">
                                                <img src="{{ $productsTopRanked->thumbnail  }}"
                                                     height="30" class="me-3 align-self-center rounded" alt="...">
                                                <div class="media-body align-self-center">
                                                    <h6 class="m-0">{{$productsTopRanked->name}}</h6>
                                                    <a href="#" class="font-12 text-primary">ID: {{$productsTopRanked->barcode}}</a>
                                                </div>
                                                <!--end media body-->
                                            </div>
                                        </td>

                                        <td>Tl {{$productsTopRanked->unit_price}} </td>
                                        <td> {{$productsTopRanked->unit}} </td>
                                        <td><span class="badge badge-soft-warning px-2">{{$productsTopRanked->status}}</span></td>

                                    </tr>
                                    @endforeach
                                    <!--end tr-->

                                    </tbody>
                                </table>
                                <!--end table-->
                            </div>
                            <!--end /div-->
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->

        </div><!-- container -->

        <!--Start Rightbar-->
        <!--Start Rightbar/offcanvas-->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="Appearance" aria-labelledby="AppearanceLabel">
            <div class="offcanvas-header border-bottom">
                <h5 class="m-0 font-14" id="AppearanceLabel">Appearance</h5>
                <button type="button" class="btn-close text-reset p-0 m-0 align-self-center" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <h6>Account Settings</h6>
                <div class="p-2 text-start mt-3">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="settings-switch1">
                        <label class="form-check-label" for="settings-switch1">Auto updates</label>
                    </div>
                    <!--end form-switch-->
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="settings-switch2" checked>
                        <label class="form-check-label" for="settings-switch2">Location Permission</label>
                    </div>
                    <!--end form-switch-->
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="settings-switch3">
                        <label class="form-check-label" for="settings-switch3">Show offline Contacts</label>
                    </div>
                    <!--end form-switch-->
                </div>
                <!--end /div-->
                <h6>General Settings</h6>
                <div class="p-2 text-start mt-3">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="settings-switch4">
                        <label class="form-check-label" for="settings-switch4">Show me Online</label>
                    </div>
                    <!--end form-switch-->
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="settings-switch5" checked>
                        <label class="form-check-label" for="settings-switch5">Status visible to all</label>
                    </div>
                    <!--end form-switch-->
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="settings-switch6">
                        <label class="form-check-label" for="settings-switch6">Notifications Popup</label>
                    </div>
                    <!--end form-switch-->
                </div>
                <!--end /div-->
            </div>
            <!--end offcanvas-body-->
        </div>
        <!--end Rightbar/offcanvas-->
        <!--end Rightbar-->
    </div>
@endif
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>

    <script>
        var year = ['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20'];
        var user = ['200','150','500','450','120','350','440','520','80','250','410','120','190','250','150','360','170','380','500','400'];
        var barChartData = {
            labels: year,
            datasets: [{
                label: 'Income',
                backgroundColor: "pink",
                data: user
            }]
        };

        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: '#c1c1c1',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Revinue'
                    }
                }
            });
        };
    </script>
@endpush
