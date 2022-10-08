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
                            <li class="breadcrumb-item active">All Orders</li>
                        </ol>
                    </div>
                    <h4 class="page-title">All Orders</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Orders</h4>
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
                                        <th>Delivery Status</th>
                                        <th>Payment Status</th>
                                        <th>Refund Status</th>
                                        <th style="text-align: center;">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sl = $orders->perPage() * $orders->currentPage() - ($orders->perPage() - 1);
                                    @endphp
                                    @if ($orders->count() > 0)
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->code }}</td>
                                                <td>{{ orderProductCount($order->id) }}</td>
                                                <td>{{ getUser($order->user_id)->name }}</td>
                                                <td>{{ $order->grand_total }}</td>
                                                <td>{{ ucfirst($order->delivery_status) }}</td>
                                                <td>
                                                    @if ($order->payment_status == 'unpaid')
                                                        <span class="badge bg-danger">{{ $order->payment_status }}</span>
                                                    @else
                                                        <span class="badge bg-success">{{ $order->payment_status }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">{{ ucfirst($order->order_status) }}</span>
                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="{{ route('admin.orders-details',['id'=>$order->id])}}" type="button" class="btn btn-outline-success btn-icon-circle btn-icon-circle-sm"><i class="ti ti-eye"></i></a>
                                                    <a href="{{ route('order.pdf.download',['id'=>$order->id])}}" class="btn btn-outline-primary btn-icon-circle btn-icon-circle-sm"><i class="fa fa-file-pdf"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center">No data available!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $orders->links('pagination-links-table') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
