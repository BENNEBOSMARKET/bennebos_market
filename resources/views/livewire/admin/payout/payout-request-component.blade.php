<div>
    <style>
        thead tr {
            background: rgb(219, 219, 219);
        }

        #customSwitchSuccess {
            font-size: 25px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Seller Withdraw Request</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Seller Withdraw Request</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Seller Withdraw Request</h4>
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

                            <div class="col-md-6 col-sm-12 mb-2 search_cont">
                                <label class="font-weight-normal mr-2">Search:</label>
                                <input type="search" class="sinput" placeholder="Search" wire:model="searchTerm" />
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table custom_tbl">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Seller</th>
                                        <th>Total Amount to Pay</th>
                                        <th>Requested Amount</th>
                                        <th>Status</th>
                                        <th>message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $sl = $paymentsRequest->perPage() * $paymentsRequest->currentPage() -
                                    ($paymentsRequest->perPage() - 1);
                                    @endphp
                                    @if ($paymentsRequest->count() > 0)
                                    @foreach ($paymentsRequest as $payment)
                                    <tr>
                                        <td>{{ $payment->created_at }}</td>
                                        <td>{{ seller($payment->seller_id)->name }}</td>
                                        <td>{{ sellerWallet($payment->seller_id)->amount }}</td>
                                        <td>{{ $payment->amount }}</td>
                                        <td>{{ $payment->status }}</td>
                                        <td>{{ $payment->message }}</td>
                                        <td style="text-align: center;">
                                            <div class="form-check form-switch form-switch-success" style="margin-left: 25px;">
                                                <input class="form-check-input publishStatus" type="checkbox" id="customSwitchSuccess" data-payment_id="{{ $payment->id }}" @if($payment->status == 1) checked @endif>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="8">No data available!</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $paymentsRequest->links('pagination-links-table') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function(){
            $('.publishStatus').on('click', function(){
                var id = $(this).data('payment_id');
                @this.publishStatus(id);
            });
        });
    </script>
@endpush