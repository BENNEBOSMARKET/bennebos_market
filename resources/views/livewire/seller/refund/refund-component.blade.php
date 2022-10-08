@section('page_title')
{{ __('seller.orders_top_title') }}
@endsection
<div>
    <div class="container-fluid">

        <div class="row mt-4">
            <div class="col-md-12 d-flex justify-content-between">
                <h4>{{ __('seller.all_orders') }}</h4>

                <div class="d-flex cstm_sort">
                    <span class="d-flex filter-text"><i class="ti ti-filter"></i> {{ __('seller.sort_by_order') }}</span>
                    <select class="sort_select">
                        <option value="">{{ __('seller.all_products_order') }}</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>							
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Order Code</th>
                                        <th>Product	Amount</th>
                                        <th>Status</th>
                                        <th>Reason</th>
                                        <th>Approval</th>
                                        <th>Reject</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requests as $request)
                                        <tr>							
                                            <th>{{ $request->id }}</th>
                                            <th>{{ $request->created_at }}</th>
                                            <th>{{ order($request->order_id)->code }}</th>
                                            <th>{{ $request->refund_amount }}</th>
                                            <th>{{ $request->refund_status }}</th>
                                            <th>{{ $request->reason }}</th>
                                            <th>
                                                @if ($request->seller_approved == 0)
                                                    <a href="" title="Approve" wire:click.prevent='approveRefund({{ $request->id }})' class="btn btn-outline-primary btn-icon-circle btn-icon-circle-sm"><i class="ti ti-check"></i></a>
                                                @elseif($request->seller_approved == 1)
                                                    <a href="" title="Approved" class="btn btn-primary btn-icon-circle btn-icon-circle-sm active"><i class="ti ti-check"></i></a>
                                                @else

                                                @endif
                                            </th>
                                            <th>
                                                @if ($request->seller_approved == 0)
                                                    <a href="" title="Approve" wire:click.prevent='rejectRefund({{ $request->id }})' class="btn btn-outline-danger btn-icon-circle btn-icon-circle-sm"><i class="ti ti-ban"></i></a>
                                                @elseif($request->seller_approved == 1)
                                                @else
                                                    <a href="" title="Rejected" class="btn btn-danger btn-icon-circle btn-icon-circle-sm active"><i class="ti ti-ban"></i></a>
                                                @endif
                                                
                                            </th>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        $(document).ready(function(){
            $('#sortStatus').on('change', function(){
                var val = $(this).val();
                @this.set('sortStatus', val);
            })
        })
    </script>
@endpush
