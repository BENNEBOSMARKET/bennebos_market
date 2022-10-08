@section('title') Dashboard @endsection
<div>
    <style>
        .view_list_btn i {
            border: 1px solid;
            padding: 5px;
            border-radius: 20px;
            color: green;
            font-size: 15px;
        }
    </style>
    <!-- Profile Account Section  -->
    <section class="profile_account_wrapper sellar_dashboard_wrapper">
        <div class="my-container">
            <div class="profile_title_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                <h3 class="cart_title">{{ __('customer.dashboard') }}</h3>
                <button type="button" id="profileSidebarIcon">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
            <div class="profile_sidebar_grid_area">
                @livewire('customer.inc.sidebar')
                <div class="sellar_dashboard_content_area">
                    <div class="sellar_summery_grid">
                        <div class="sellar_summery_item">
                            <img src="{{ asset('assets/front/images/icon/sellar_summery_icon_1.svg') }}"
                                class="sellar_summery_icon" alt="sellar summery icon" />
                            <div class="sellar_counter_area" id="counters_1">
                                <h4><span class="counter" data-TargetNum="{{ $total_order }}"></span></h4>
                                <h5>{{ __('customer.total_orders') }}</h5>
                            </div>
                            <img src="{{ asset('assets/front/images/shape/sellar_summery_shape_1.svg') }}"
                                class="sellar_shape" alt="sellar shape" />
                        </div>
                        <div class="sellar_summery_item">
                            <img src="{{ asset('assets/front/images/icon/sellar_summery_icon_2.svg') }}"
                                class="sellar_summery_icon" alt="sellar summery icon" />
                            <div class="sellar_counter_area" id="counters_2">
                                <h4>
                                    <span class="counter" data-TargetNum="{{ $total_wiselist }}"></span>
                                </h4>
                                <h5>{{ __('customer.total_wishlist') }}</h5>
                            </div>
                            <img src="{{ asset('assets/front/images/shape/sellar_summery_shape_2.svg') }}"
                                class="sellar_shape" alt="sellar shape" />
                        </div>
                        <div class="sellar_summery_item">
                            <img src="{{ asset('assets/front/images/icon/sellar_summery_icon_3.svg') }}"
                                class="sellar_summery_icon" alt="sellar summery icon" />
                            <div class="sellar_counter_area" id="counters_1">
                                <h4><span class="counter" data-TargetNum="{{$total_earnpoint}}"></span></h4>
                                <h5>{{ __('customer.total_earn_point') }}</h5>
                            </div>
                            <img src="{{ asset('assets/front/images/shape/sellar_summery_shape_3.svg') }}"
                                class="sellar_shape" alt="sellar shape" />
                        </div>
                    </div>
                    <div class="sellar_recently_order_area">
                        <div
                            class="profile_content_title_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                            <h3>{{ __('customer.recent_orders') }}</h3>
                            <div class="sellar_recent_order d-flex align-items-center flex-wrap-wrap g-sm">
                                <a href="{{ route('customer.my-orders') }}" class="sell_all">{{ __('customer.see_all') }}</a>
                            </div>
                        </div>
                        <div class="sellar_recent_grid_wrappper">
                            @foreach ($orderProduct as $order)
                            <div class="sellar_recent_order_grid">
                                <div class="sellar_order_item">
                                    <a href="{{ route('customer.orders-details',['id'=>$order->id])}}">
                                        <h3>{{ $order->code }}</h3>
                                    </a>
                                    <h5>{{ __('customer.order_ID') }}</h5>
                                </div>
                                <div class="sellar_order_item">
                                    <h3>{{ $order->created_at->format("d M, Y") }}</h3>
                                    <h5>{{ __('customer.order_date') }}</h5>
                                </div>
                                <div class="sellar_order_item">
                                    <h3>{{ $order->grand_total }} TL</h3>
                                    <h5>{{ __('customer.amount') }}</h5>
                                </div>
                                <div class="sellar_order_item">
                                    @if ($order->delivery_status == 'pending')
                                    <h3 class="process">{{ __('customer.pending') }}</h3>
                                    @elseif($order->delivery_status == 'deliered')
                                    <h3 class="deliered">{{ __('customer.delivered') }}</h3>
                                    @elseif($order->delivery_status == 'pickedup')
                                    <h3 class="shipped">{{ __('customer.picked_up') }}</h3>
                                    @elseif($order->delivery_status == 'cancel')
                                    <h3 class="cancel">{{ __('customer.cancel') }}</h3>
                                    @endif
                                    <h5>{{ __('customer.order_status') }}</h5>
                                </div>
                                <div class="sellar_order_item">
                                    @if ($order->delivery_status == 'paid')
                                    <h3 class="deliered">{{ __('customer.paid') }}</h3>
                                    @else
                                    <h3 class="cancel">{{ __('customer.unpaid') }}</h3>
                                    @endif
                                    <h5>{{ __('customer.payment_status') }}</h5>
                                </div>

                                <div class="sellar_recent_order d-flex align-items-center flex-wrap-wrap g-sm">
                                    <div class="option_item_area">
                                        <a href="{{ route('customer.orders-details',['id'=>$order->id])}}"
                                            class="view_list_btn"><i class="fa-solid fa-eye"></i></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile_sidebar_overlay" id="sidebarOverlay"></div>
    </section>
</div>
