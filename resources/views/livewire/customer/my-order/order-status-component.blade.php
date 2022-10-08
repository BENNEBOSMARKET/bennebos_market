@section('title')
{{ __('customer.track_order') }}
@endsection
<div>
    <section class="profile_account_wrapper">
        <div class="my-container">
            <div class="profile_title_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                <h3 class="cart_title">{{ __('customer.dashboard') }}</h3>
                <button type="button" id="profileSidebarIcon">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
            <div class="profile_sidebar_grid_area">
                @livewire('customer.inc.sidebar')
                <div class="profile_content_wrapper">
                    <div class="d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                        <div>
                            <h3>{{ __('customer.track_order') }}</h3>
                            <small>{{ __('customer.order_code') }}: #{{ $orderCode }}</small>
                        </div>

                        <div>
                            <span style="color: grey; font-weight: normal;">{{ __('customer.amount') }}: </span> ${{ $order->grand_total }}
                        </div>
                    </div>
                    <div class="order_status_area" style="margin-top: 70px;">
                        <ul class="order_step_list" id="orderStepList">
                            <li @if($order->delivery_status == 'pending' || $order->delivery_status == 'confirmed' || $order->delivery_status == 'pickedup' || $order->delivery_status == 'shipped' || $order->delivery_status == 'delivered') class="active_step" @endif>{{ __('customer.pending') }}</li>
                            <li @if($order->delivery_status == 'confirmed' || $order->delivery_status == 'pickedup' || $order->delivery_status == 'shipped' || $order->delivery_status == 'delivered') class="active_step" @endif>{{ __('customer.processing') }}</li>
                            <li @if($order->delivery_status == 'shipped' || $order->delivery_status == 'delivered') class="active_step" @endif>{{ __('customer.shipped') }}</li>
                            <li @if($order->delivery_status == 'delivered') class="active_step" @endif>{{ __('customer.delivered') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile_sidebar_overlay" id="sidebarOverlay"></div>
    </section>
</div>
