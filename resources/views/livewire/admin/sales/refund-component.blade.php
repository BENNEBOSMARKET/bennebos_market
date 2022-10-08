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
                            <li class="breadcrumb-item active">All Refund Request</li>
                        </ol>
                    </div>
                    <h4 class="page-title">All Refund Request</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Refund Request</h4>
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
                            <table class="table table-sm">
                                <thead class="thead-light">
                                <tr>
                                    <th>Order Code:</th>
                                    <th>Num. of Products</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Delivery Status</th>
                                    <th>Payment Status</th>
                                    <th>Refund Status</th>
                                    <th>Seller Approved</th>
                                    <th>Admin Approved</th>
                                    <th>Refund Reason</th>
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
                                                <span class="badge bg-info">
                                                    @if ($order->order_status == 'refund requested')
                                                        Requested
                                                    @else
                                                        {{ ucfirst($order->order_status) }}
                                                    @endif
                                                </span>
                                            </td>

                                            <td>
                                                @if( $order->seller_approved == 1 )
                                                    <span class="badge bg-success">Approved</span>
                                                @else
                                                    <span class="badge bg-warning">Pending</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if( $order->admin_approved == 1 )
                                                    <span class="badge bg-success">Approved</span>
                                                @else
                                                    <span class="badge bg-primary">Pending</span>
                                                @endif
                                            </td>

                                            <td>{{ $order->reason }}</td>

                                            <td style="text-align: center;">
                                                @if( $order->seller_approved != 1 || $order->admin_approved != 1 )
                                                    @if( $order->admin_approved != 1 )
                                                        <a href="{{ route('admin.acceptRefund',['refund_id'=>$order->refund_id])}}" type="button" class="btn btn-outline-success ">Accept</a>
                                                    @else
                                                        <a href="{{ route('admin.rejectRefund',['refund_id'=>$order->refund_id])}}" type="button" class="btn btn-outline-danger ">Reject</a>
                                                    @endif
                                                @endif
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
