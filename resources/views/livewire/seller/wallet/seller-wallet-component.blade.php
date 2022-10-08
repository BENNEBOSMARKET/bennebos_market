<div>
    <style>
        .ti-wallet{
            font-size: 35px;
        }
        .btn-outline-light{
            background: transparent;
            color: white;
            border-color: #402F53;
        }
        .btn-outline-light:hover{
            background: transparent;
            color: white;
            border: 1px solid #402F53;
        }
    </style>
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <i class="ti ti-wallet"></i>
                                    <div class="media-body align-self-center ms-2">
                                        <h6 class="fw-semibold font-16 d-inline-block m-0">{{ __('seller.wallet_sidebar') }}</h6>
                                        <p class="text-muted mb-0 fw-semibold">{{ __('seller.my_bennebos_wallet') }}</p>
                                    </div>
                                </div>
                                <div class="apexchart-wrapper my-5">

                                </div>
                                <div class="row">
                                    <div class="col mb-2">
                                        <h2 class="font-22 fw-bold mb-0">{{ $wallet->amount }} {{ __('seller.try') }}</h2>
                                        <h6 class="text-muted m-0 fw-semibold">{{ __('seller.current_balance') }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">{{ __('seller.transaction_history') }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive dash-social">
                            <table id="datatable" class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('seller.commission_table_date') }}</th>
                                        <th>{{ __('seller.amount_wallet') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if ($transactions->count() > 0)
                                        @php
                                            $sl = $transactions->perPage() * $transactions->currentPage() - ($transactions->perPage() - 1);
                                        @endphp
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td>{{ $sl++ }}</td>
                                                <td>{{ $transaction->created_at }}</td>
                                                <td>{{ $transaction->seller_earning }}</td>
                                            </tr>
                                        @endforeach

                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">No data available!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $transactions->links('pagination-link-seller') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
