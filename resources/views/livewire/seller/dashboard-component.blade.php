@section('page_title')
{{ __('seller.dashboard_top_title') }}
@endsection
<div>
    <div class="container-fluid">
        <div class="top_bar_card_row">
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="sellar_summery_item pt-3">
                                        <img src="{{ asset('assets/seller/images/icon/customer_summery_icon_1.svg') }}"
                                            class="sellar_summery_icon" alt="sellar summery icon" />
                                        <div class="sellar_counter_area" id="counters_1">
                                            <h4>
                                                <span class="counter" data-TargetNum="{{ $totalProduct }}"></span>
                                            </h4>
                                            <h5>{{ __('seller.total_products') }}

                                            </h5>
                                        </div>
                                        <img src="{{ asset('assets/seller/images/shape/customer_summery_shape_3.svg') }}"
                                            class="sellar_shape" alt="sellar shape" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="sellar_summery_item pt-3">
                                        <img src="{{ asset('assets/seller/images/icon/customer_summery_icon_3.svg') }}"
                                            class="sellar_summery_icon" alt="sellar summery icon" />
                                        <div class="sellar_counter_area" id="counters_1">
                                            <h4>
                                                <span class="counter" data-TargetNum="{{ $totalOrders }}"></span>
                                            </h4>
                                            <h5>{{ __('seller.total_order') }}</h5>
                                        </div>
                                        <img src="{{ asset('assets/seller/images/shape/customer_summery_shape_1.svg') }}"
                                            class="sellar_shape" alt="sellar shape" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="sellar_summery_item pt-3">
                                        <img src="{{ asset('assets/seller/images/icon/customer_summery_icon_2.svg') }}"
                                            class="sellar_summery_icon" alt="sellar summery icon" />
                                        <div class="sellar_counter_area" id="counters_1">
                                            <h4>
                                                ₺<span class="counter" data-TargetNum="{{ $totalEarnings }}"></span>
                                            </h4>
                                            <h5>{{ __('seller.total_earnings') }}</h5>
                                        </div>
                                        <img src="{{ asset('assets/seller/images/shape/customer_summery_shape_2.svg') }}"
                                            class="sellar_shape" alt="sellar shape" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="card overflow-hidden">
                                <div class="card-body">
                                    <div class="sellar_summery_item pt-3">
                                        <img src="{{ asset('assets/seller/images/icon/customer_summery_icon_1.svg') }}"
                                            class="sellar_summery_icon" alt="sellar summery icon" />
                                        <div class="sellar_counter_area" id="counters_1">
                                            <h4>
                                                <span class="counter" data-TargetNum="{{ $totalSell }}"></span>
                                            </h4>
                                            <h5>{{ __('seller.total_sell') }}</h5>
                                        </div>
                                        <img src="{{ asset('assets/seller/images/shape/customer_summery_shape_3.svg') }}"
                                            class="sellar_shape" alt="sellar shape" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">{{ __('seller.sales_chart') }}</h4>
                                    </div>
                                    <!--end col-->
                                    <div class="col-auto">
                                        <div class="dropdown">
                                            <a href="#" class="btn btn-sm btn-outline-light dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                               {{ __('seller.this_week') }}<i class="las la-angle-down ms-1"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">{{ __('seller.week') }}</a>
                                                <a class="dropdown-item" href="#">{{ __('seller.month') }}</a>
                                                <a class="dropdown-item" href="#">{{ __('seller.year') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-header-->
                            <div class="card-body">
                                <div class="">
                                    <div class="chart_item">
                                        <canvas id="chartWeek"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-body">
                    <div class="total_ratting_number_area dashboard_card_wrapper">
                        <div class="total_ratting_content text-center pb-3">
                            @if (shop(authSeller()->id)->verification_status == 1)
                            <img src="{{ asset('assets/seller/verified.png') }}" />
                            @else
                            <img src="{{ asset('assets/seller/non_verified.png') }}" />

                            @if (authSeller()->application_status == 1)
                            <br><a href="#" wire:click.prevent='errorMsg' class="btn btn-primary">{{ __('seller.verify_now') }}</a>
                            @else
                            <br><a href="{{ route('seller.shopVerification') }}" class="btn btn-primary">{{ __('seller.verify_now') }}</a>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">{{ __('seller.orders_details') }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <div class="circle_chart_area">
                                <div class="outer_circle_chart" id="outerCircleChart" data-percent="73"></div>
                                <div class="inner_circle_chart" id="innerCircleChart" data-percent="50"></div>
                                <div class="middle_text">
                                    <h4>{{ __('seller.success') }}</h4>
                                    <h3>{{ $totalSell }}</h3>
                                </div>
                                <ul class="order_status_list">
                                    <li class="pending_order">
                                        <h5>{{ __('seller.pending_orders') }} <span>{{ $pendingOrders }}</span></h5>
                                    </li>
                                    <li class="cancel_order">
                                        <h5>{{ __('seller.cancel_orders') }}<span>{{ $cancelledOrders }}</span></h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>