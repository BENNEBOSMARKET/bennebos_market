<div>
    <style>
        .ti-wallet {
            font-size: 35px;
        }

        .btn-outline-light {
            background: transparent;
            color: white;
            border-color: #402F53;
        }

        .btn-outline-light:hover {
            background: transparent;
            color: white;
            border: 1px solid #402F53;
        }
    </style>
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">{{ __('seller.commission_history') }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive dash-social">
                            <table id="datatable" class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>{{ __('seller.commission_table_number ') }}</th>
                                        <th>{{ __('seller.commission_table_order ') }}</th>
                                        <th>{{ __('seller.commission_table_admin ') }}</th>
                                        <th>{{ __('seller.commission_table_seller ') }}</th>
                                        <th>{{ __('seller.commission_table_date') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($commissions->count() > 0)
                                    @php
                                    $sl = $commissions->perPage() * $commissions->currentPage() -
                                    ($commissions->perPage() - 1);
                                    @endphp
                                    @foreach ($commissions as $commission)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>{{ order($commission->order_id)->code }}</td>
                                        <td>{{ $commission->admin_commission }}</td>
                                        <td>{{ $commission->seller_earning }}</td>
                                        <td>{{ $commission->created_at }}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" class="text-center">{{ __('seller.commission_table_none_text ') }} </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $commissions->links('pagination-link-seller') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>