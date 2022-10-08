<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Sales</li>
                            <li class="breadcrumb-item">All Quotation</li>
                            <li class="breadcrumb-item active">Quotation Details</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Quotation Details</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-body invoice-head">
                        <div class="row">
                            <div class="col-md-4 align-self-center">
                                <p class="mt-2 mb-0 text-muted">{{ getUser($quotation->user_id)->name }}</p>
                            </div>
                            <div class="col-md-8">

                                <ul class="list-inline mb-0 contact-detail float-end">
                                    <li class="list-inline-item">
                                        <div class="ps-3">
                                            <i class="mdi mdi-map-marker"></i>
                                            <p class="text-muted mb-0">{{ getUser($quotation->user_id)->email }}</p>
                                            <p class="text-muted mb-0">{{ getUser($quotation->user_id)->phone }}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row row-cols-12 d-flex">
                            <div class="col-md-6">
                                <div class="">
                                    <h6 class="mb-0"><b>Product Name :</b>{{ $quotation->name }}</h6>
                                    <h6 class="mb-0"><b>Category :</b>{{ quotationCategory($quotation->category_id)->name }}</h6>
                                    <h6 class="mb-0"><b>Sourcing Type :</b>{{ $quotation->sourcing_type }}</h6>
                                    <h6 class="mb-0"><b>Quantity :</b>{{ $quotation->quantity }}</h6>
                                    <h6 class="mb-0"><b>Max budget :</b>{{ $quotation->max_budget }}</h6>
                                    <h6 class="mb-0"><b>Trade Terms :</b>{{ $quotation->trade_terms }}</h6>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <h6 class="mb-0"><b>Shipping Method :</b>{{ $quotation->shipping_method }}</h6>
                                    <h6 class="mb-0"><b>Payment Method :</b>{{ $quotation->payment_method }}</h6>
                                    <h6 class="mb-0"><b>Lead Time :</b>{{ $quotation->lead_time }}</h6>
                                    <h6 class="mb-0"><b>Details :</b>{{ $quotation->details }}</h6>
                                    <h6 class="mb-0"><b>Attachments :</b><img style="height: 100px; width: 100px;" src="{{ $quotation->image }}" alt=""></h6>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row d-flex justify-content-center">
                           
                            <div class="col-lg-12 col-xl-4">
                                <div class="float-end d-print-none mt-2 mt-md-0">
                                    <a href="{{ route('admin.all-orders') }}" class="btn btn-primary btn-sm">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
