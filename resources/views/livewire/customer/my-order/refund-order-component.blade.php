@section('title')
{{ __('customer.refund_orders') }}
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
            <div class="">
                <div class="">
                    <div
                        class="">

                        <form wire:submit.prevent="submitRefund" class="form_area">

                            <input type="hidden" wire:model="order_id" value="{{ $order->id }}" >

                            <div class="input_row">
                                <label for="">{{ __('customer.order_code') }}</label>
                                <input type="text" value="{{ $order->code }}" disabled />
                            </div>


                            <div class="input_row">
                                <label for="">{{ __('customer.refund_amount') }}</label>
                                <input type="text" value="{{ $order->grand_total }}" disabled />
                            </div>

                            <div class="input_row">
                                <label for="">{{ __('customer.refund_reason') }}</label>
                                <textarea wire:model="refund_reason" id="" cols="30" rows="10" class="form-control" placeholder="Refund Reason"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('customer.refund') }}</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="profile_sidebar_overlay" id="sidebarOverlay"></div>
    </section>
</div>
