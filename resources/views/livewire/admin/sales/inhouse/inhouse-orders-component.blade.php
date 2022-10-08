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
                            <li class="breadcrumb-item active">Inhouse Orders</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Inhouse Orders</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Inhouse Orders</h4>
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
                                        <th>Amount</th>
                                        <th>Payment method</th>
                                        <th>Delivery Status</th>
                                        <th>Payment Status</th>
                                        <th style="text-align: center;">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sl = $inhouseOrders->perPage() * $inhouseOrders->currentPage() - ($inhouseOrders->perPage() - 1);
                                    @endphp
                                    @if ($inhouseOrders->count() > 0)
                                        @foreach ($inhouseOrders as $inhouseOrder)
                                            <tr>
                                                <td>{{ $inhouseOrder->code }}</td>
                                                <td>{{ orderProductCount($inhouseOrder->id) }}</td>
                                                <td>{{ getUser($inhouseOrder->user_id)->name }}</td>
                                                <td>{{ $inhouseOrder->grand_total }}</td>
                                                <td>
                                                    @if ($inhouseOrder->payment_type == 'cod')
                                                        Cash on Delivery
                                                    @else
                                                        Pay
                                                    @endif
                                                </td>
                                                <td>{{ $inhouseOrder->delivery_status }}</td>
                                                <td>
                                                    @if ($inhouseOrder->payment_status == 'unpaid')
                                                        <span class="badge bg-danger">{{ $inhouseOrder->payment_status }}</span>
                                                    @else
                                                        <span class="badge bg-success">{{ $inhouseOrder->payment_status }}</span>
                                                    @endif
                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="{{ route('admin.inhouse-orders-details',['id'=>$inhouseOrder->id])}}" type="button" class="btn btn-outline-success btn-icon-circle btn-icon-circle-sm"><i class="ti ti-eye"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center">No data available!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $inhouseOrders->links('pagination-links-table') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
