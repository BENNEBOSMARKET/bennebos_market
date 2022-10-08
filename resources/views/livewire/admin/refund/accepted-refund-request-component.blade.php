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
                            <li class="breadcrumb-item active">Accepted Refund Request</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Accepted Refund Request</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Accepted Refund Request</h4>
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
                                    <th>Delivery Status</th>
                                    <th>Payment Status</th>
                                    <th>Amount</th>
                                    <th>Refund Status</th>
                                    <th>Seller Approved</th>
                                    <th>Admin Approved</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sl = $refunds->perPage() * $refunds->currentPage() - ($refunds->perPage() - 1);
                                @endphp
                                @if ($refunds->count() > 0)
                                    @foreach ($refunds as $refund)
                                        <tr>
                                            <td>{{ order($refund->order_id)->code }}</td>
                                            <td>{{ orderProductCount($refund->id) }}</td>
                                            <td>{{ getUser($refund->user_id)->name }}</td>
                                            <td>{{ order($refund->order_id)->delivery_status }}</td>
                                            <td>
                                                {{ order($refund->order_id)->payment_status }}
                                            </td>
                                            <td>{{ $refund->refund_amount }}</td>
                                            <td>
                                                <span class="badge bg-info">
                                                    @if ($refund->refund_status == 0)
                                                        Non-Paid
                                                    @else
                                                        Paid
                                                    @endif
                                                </span>
                                            </td>

                                            <td>
                                                @if( $refund->seller_approved == 1 )
                                                    <span class="badge bg-success">Approved</span>
                                                @else
                                                    <span class="badge bg-warning">Pending</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if( $refund->admin_approved == 1 )
                                                    <span class="badge bg-success">Approved</span>
                                                @else
                                                    <span class="badge bg-primary">Pending</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10" class="text-center">No data available!</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $refunds->links('pagination-links-table') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        window.addEventListener('showReasonModal', event => {
            $('#viewReason').modal('show');
        });
        
        window.addEventListener('closeModal', event => {
            $('#addColorModal').modal('hide');
        });
    </script>
@endpush