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
                            <table class="table custom_tbl">
                                <thead>
                                    <tr>
                                        <th>{{ __('seller.order_id') }}</th>
                                        <th>{{ __('seller.total_product') }}</th>
                                        <th>{{ __('seller.customer_name') }}</th>
                                        <th>{{ __('seller.amount') }}</th>
                                        <th>{{ __('seller.payment_method') }}</th>
                                        <th>{{ __('seller.payment_status') }}</th>
                                        <th>{{ __('seller.delivery_status') }}</th>
                                        <th style="text-align: center;">{{ __('seller.action_order') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sl = $orders->perPage() * $orders->currentPage() - ($orders->perPage() - 1);
                                    @endphp
                                    @if ($orders->count() > 0)
                                        @foreach ($orders as $order)
                                            <tr class="table_row">
                                                <td>
                                                    {{ $order->code }}
                                                </td>
                                                <td>
                                                    {{ orderProductCount($order->id) }}
                                                </td>
                                                <td>
                                                    {{ getUser($order->user_id)->name }}
                                                </td>
                                                <td>
                                                    {{ $order->grand_total }}
                                                </td>
                                                <td>
                                                    @if ($order->payment_type == 'cod')
                                                    {{ __('seller.cash_on_delivery') }}
                                                    @else
                                                    {{ __('seller.error') }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($order->payment_status == 'unpaid')
                                                        <div class="badge bg-danger">{{ __('seller.unpaid') }}</div>
                                                    @else
                                                    <div class="badge bg-success">{{ __('seller.paid') }}</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ ucfirst($order->delivery_status) }}
                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="{{ route('seller.orderDetails',['id'=>$order->id]) }}" type="button" title="view" class="btn btn-secondary btn-icon-circle btn-icon-circle-sm" target="_blank"><i class="ti ti-eye"></i></a>
                                                    <a href="{{ route('order.pdf.download',['id'=>$order->id]) }}" title="PDF" class="btn btn-primary btn-icon-circle btn-icon-circle-sm" target="_blank"><i class="fa fa-file-pdf"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="table_row">
                                            <td colspan="8" style="text-align: center; font-size: 12.5px;">{{ __('seller.no_order_found') }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $orders->links('pagination-link-seller') }}
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
