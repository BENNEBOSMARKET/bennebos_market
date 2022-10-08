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
                                    <th>Delivery Status</th>
                                    <th>Payment Status</th>
                                    <th>Amount</th>
                                    <th>Refund Status</th>
                                    <th>Seller Approved</th>
                                    <th>Admin Approved</th>
                                    <th style="text-align: center;">Options</th>
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

                                            <td style="text-align: center;">
                                                <a href="" wire:click.prevent="acceptRefund({{ $refund->id }})" type="button" class="btn btn-outline-primary btn-icon-circle btn-icon-circle-sm" title="Refund now"><i class="ti ti-check"></i></a>
                                                
                                                <a wire:click.prevent="rejectConfirmation({{ $refund->id }})" type="button" class="btn btn-outline-danger btn-icon-circle btn-icon-circle-sm" title="Reject"><i class="ti ti-ban"></i></a>

                                                <a href="" wire:click.prevent='viewReason({{ $refund->id }})' type="button" class="btn btn-outline-secondary btn-icon-circle btn-icon-circle-sm" title="View reason"><i class="ti ti-eye"></i></a>
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

    <div wire:ignore.self class="modal fade" id="viewReason" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Refund Reason</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p style="color: black;">
                        {{ $refund_reason }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="rejectModel" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reject Reason</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='rejectRefund'>
                        <div class="row mb-3">
                            <label for="" class="col-sm-3">Order Code</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" wire:model="order_code" readonly />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="" class="col-sm-3">Reason</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="5" wire:model='reject_reason'></textarea>
                                @error('reject_reason')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <label for="" class="col-sm-3"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
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
        window.addEventListener('showRejectModel', event => {
            $('#rejectModel').modal('show');
        });
        
        window.addEventListener('closeModal', event => {
            $('#addColorModal').modal('hide');
            $('#rejectModel').modal('hide');
        });
    </script>
@endpush