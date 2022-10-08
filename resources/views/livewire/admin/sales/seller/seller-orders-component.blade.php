<div>
    <style>
        thead tr {
            background: rgb(219, 219, 219);
        }

        #customSwitchSuccess {
            font-size: 25px;
        }
        input.sinput {
            width: 275px;
            padding: 10px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Sales</li>
                            <li class="breadcrumb-item active">Seller Orders</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Seller Orders</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Seller Orders</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12 mb-2 sort_cont">
                                <label class="font-weight-normal" style="">Show</label>
                                <select name="sortuserresults" class="sinput" id="" wire:model="sortingValue">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <label class="font-weight-normal" style="">entries</label>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table custom_tbl">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Order Code:</th>
                                        <th>Num. of Products</th>
                                        <th>Customer</th>
                                        <th>Seller</th>
                                        <th>Amount</th>
                                        <th>Payment method</th>
                                        <th>Delivery Status</th>
                                        <th>Payment Status</th>
                                        <th style="text-align: center;">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sl = $sellerOrders->perPage() * $sellerOrders->currentPage() - ($sellerOrders->perPage() - 1);
                                    @endphp
                                    @if ($sellerOrders->count() > 0)
                                        @foreach ($sellerOrders as $sellerOrder)
                                            <tr>
                                                <td>{{ $sellerOrder->code }}</td>
                                                <td>{{ orderProductCount($sellerOrder->id) }}</td>
                                                <td>{{ getUser($sellerOrder->user_id)->name }}</td>
                                                <td>{{ seller($sellerOrder->seller_id)->name }}</td>
                                                <td>{{ $sellerOrder->grand_total }}</td>
                                                <td>
                                                    @if ($sellerOrder->payment_type == 'cod')
                                                        Cash on Delivery
                                                    @else
                                                        
                                                    @endif
                                                </td>
                                                <td>{{ ucfirst($sellerOrder->status) }}</td>

                                                @if ($sellerOrder->payment_status == 'unpaid')
                                                <td><span class="badge bg-danger">{{ $sellerOrder->payment_status }}</span></td>
                                                @else
                                                <td><span class="badge bg-success">{{ $sellerOrder->payment_status }}</span></td>
                                                @endif
                                                <td style="text-align: center;">
                                                    <a href="{{ route('admin.seller-orders-details',['id'=>$sellerOrder->id])}}" type="button" class="btn btn-outline-success btn-icon-circle btn-icon-circle-sm"><i class="ti ti-eye"></i></a>
                                                    <a href="" type="button" class="btn btn-outline-danger btn-icon-circle btn-icon-circle-sm"><i class="ti ti-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9" class="text-center">No data available!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $sellerOrders->links('pagination-links-table') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
