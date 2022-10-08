@section('title')
{{ __('auth.checkout') }}
@endsection
<div>
    <style>
        .validation-error {
            font-size: 12.5px;
            color: red;
        }

        .shipping_address_wrapper .shipping_save_address_item::before {
            display: none
        }

        .customSelect{
            height: 44px;
            border: 1.5px solid #e8e9ec;
            width: 100%;
            background: #f7f7f7;
            border-radius: 5px;
            padding-left: 16px;
            font-size: 16px;
            color: #13192b;
            padding-right: 16px;
        }
    </style>
    <!-- Cart Item Section  -->
    <section class="cart_item_wrapper shipping_address_wrapper">
        <div class="my-container">
            <h3 class="cart_title">{{ __('auth.shipping_address') }}</h3>
            <div class="cart_item_grid">
                <div class="shipping_address_area">
                    <div class="shipping_address_inner_area">
                        <button type="button" class="add_shipping_button" id="modalClickButton1">
                            {{ __('auth.add_new_address') }}
                        </button>

                        <div class="shipping_save_address_rea">
                            <h5>{{ __('auth.shipping_address') }}</h5>
                            @if ($addresses->count() > 0)
                                @foreach ($addresses as $address)
                                    <div class="shipping_save_address_item">
                                        <label class="custom_radio_button_area">
                                            <input type="radio" value="{{ $address->id }}" wire:model="address_id" />
                                            <span class="checkmark"></span>
                                        </label>
                                        <div
                                            class="shipping_save_address_title d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                            <h3>{{ $address->first_name }} {{ $address->last_name }}</h3>


                                            <ul class="edit_delete_list d-flex align-items-center flex-wrap-wrap">
                                                <li>
                                                    <button type="button" id=""
                                                        wire:click.prevent='editData({{ $address->id }})'>
                                                        <img src="{{ asset('assets/front/images/icon/Edit-Square.svg') }}"
                                                            alt="edit icon" />
                                                        <span>{{ __('auth.edit') }}</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="delete_button"
                                                        wire:click.prevent="deleteAddress({{ $address->id }})">
                                                        <img src="{{ asset('assets/front/images/icon/Delete.svg') }}"
                                                            alt="delete icon" />

                                                        <span>{{ __('auth.delete') }}</span>
                                                    </button>
                                                </li>
                                            </ul>

                                        </div>
                                        <ul class="save_info_list">
                                            <li>
                                                {{ __('auth.checkout_home') }}{{ $address->address }}.
                                            </li>
                                            <li>{{ __('auth.checkout_moble') }} {{ $address->phone }}</li>
                                        </ul>
                                    </div>
                                @endforeach
                            @else
                            @endif
                            @error('address_id')
                                <span class="validation-error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="payment_method_area">
                        <h5>{{ __('auth.payment_method') }}</h5>
                        <form action="" class="form_area">
                            <div class="payment_method_option_area" id="paymentMethodArea">
                                @error('payment_method')
                                    <span class="validation-error">{{ $message }}</span>
                                @enderror
                                <div class="checkbox_payment_form_area">
                                    <label class="custom_radio_button_area">
                                        <img src="{{ asset('assets/front/images/icon/payment_option_img_1.svg') }}"
                                            alt="payment icon" />
                                        <span class="radio_text">{{ __('auth.cash_on_delivery') }}</span>
                                        <input type="radio" checked='checked' name="radio" wire:click="selectDeliveryType('cod')" />
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                
                                <div class="checkbox_payment_form_area @if($payment_method == 'visa') payment_option_active @endif">
                                    <label class="custom_radio_button_area">
                                        <img src="{{ asset('assets/front/images/icon/payment_option_img_2.svg') }}"
                                            alt="payment icon" />
                                        <span class="radio_text">{{ __('auth.visa_card') }}</span>
                                        <input type="radio" name="radio" wire:click="selectDeliveryType('visa')" />
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="checkbox_payment_form_area @if($payment_method == 'master_card') payment_option_active @endif"">
                                    <label class="custom_radio_button_area">
                                        <img src="{{ asset('assets/front/images/icon/payment_option_img_3.svg') }}"
                                            alt="payment icon" />
                                        <span class="radio_text">{{ __('auth.master_card') }}</span>
                                        <input type="radio" name="radio" wire:click="selectDeliveryType('master_card')" />
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Modal Adress -->
                <div wire:ignore.self class="modal_wrapper" id="modalID1">
                    <div class="modal_dialog">
                        <div
                            class="modal_header d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                            <h3>
                                @if ($formStatus == 1)
                                {{ __('auth.edit_address') }}
                                @else
                                {{ __('auth.checkout_new_address') }}
                                @endif
                            </h3>
                            <button type="button" id="modalClose1" wire:click='close'>
                                <img src="{{ asset('assets/front/images/icon/close_icon.svg') }}" alt="close icon" />
                            </button>
                        </div>
                        <div class="modal_body">
                            <form
                                wire:submit.prevent='@if ($formStatus == 1) updateAddress @else storeAddress @endif'
                                class="form_area">
                                <div class="modal_form_item_grid">
                                    <div class="input_row">
                                        <label for="">{{ __('auth.first_name') }}</label>
                                        <input type="text" placeholder="{{ __('auth.first_name') }}" wire:model='first_name' />
                                        @error('first_name')
                                            <span class="validation-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="input_row">
                                        <label for="">{{ __('auth.last_name') }}</label>
                                        <input type="text" placeholder="{{ __('auth.last_name') }}" wire:model='last_name' />
                                        @error('last_name')
                                            <span class="validation-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="modal_form_item_grid">
                                    <div class="input_row">
                                        <label for="">{{ __('auth.phone_number') }}</label>
                                        <input type="text" placeholder="{{ __('auth.placeholer_phone_number') }}" id=""
                                            wire:model='phone' />
                                        @error('phone')
                                            <span class="validation-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="input_row">
                                        <label for="">{{ __('auth.email') }}</label>
                                        <input type="email" placeholder="{{ __('auth.email_placeholder') }}" wire:model='email' />
                                        @error('email')
                                            <span class="validation-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="modal_form_item_grid">
                                    <div class="input_row">
                                        <label for="">{{ __('auth.country') }} </label>
                                        <select class="customSelect" wire:model='country'>
                                            <option value="">{{ __('auth.select_country') }}</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="input_row">
                                        <label for="state_id">{{ __('auth.state') }} </label>
                                        <select class="customSelect" wire:model="state">
                                            <option value="">{{ __('auth.select_state') }}</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('state')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="input_row">
                                    <label for="">{{ __('auth.address') }}</label>
                                    <input type="text" placeholder="{{ __('auth.placeholder_write_address') }}"
                                        wire:model='address' />
                                    @error('address')
                                        <span class="validation-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="sign_up_button">
                                    <button type="submit">{{ __('auth.save_address') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div wire:ignore class="modal_overlay" id="modalOverlay1"></div>

                <div class="cart_details_area">
                    <div class="total_summery_area">
                        <h3>{{ __('auth.total_summary') }}</h3>
                        <ul class="order_summer_list">
                            <li>
                                <h4>{{ __('auth.subtotal') }} ({{ Session::get('checkout')['totalItem'] }} Items)</h4>
                                <h5>₺{{ round(Session::get('checkout')['subtotal'], 2) }}</h5>
                            </li>
                            <li>
                                <h4>{{ __('auth.discount') }}</h4>
                                <h5>₺{{ round(Session::get('checkout')['totalDiscount'], 2) }}</h5>
                            </li>
                            <li>
                                <h4>{{ __('auth.shipping_fee') }}</h4>
                                <h5>₺{{ $shippingfee }}</h5>
                            </li>
                            @if (session('coupon'))
                                <li>
                                    <h4>{{ __('auth.coupon_discount') }}</h4>
                                    <h5>${{ round(Session::get('checkout')['coupon_discount'], 2) }}</h5>
                                </li>
                            @endif

                            <li>
                                <h4><b>{{ __('auth.total') }}</b></h4>
                                <h5><b>₺{{ round(Session::get('checkout')['grand_total'], 2) }}</b></h5>
                            </li>

                        </ul>

                        @if ($myPoint > 0)
                            <div class="cart_title_inner">
                                <div class="custom_checkbox_area d-flex justify-content-between flex-wrap-wrap g-sm">
                                    <label class="checkbox_wrapper" style="cursor: default;><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Exchange {{ $use_point }} Point = <b>{{ $point_amount }}</b>₺
                                        <input type="checkbox" wire:model='use_my_points' wire:change='usePoints' value="1" wire:loading.attr='disabled' />
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        @endif
                        
                        <div class="cart_title_inner">
                            <div class="custom_checkbox_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                <label class="checkbox_wrapper" style="cursor: default;">{{ __('auth.i_have_read') }} <a
                                        style="color: black; text-decoration: underline;"
                                        href="{{ route('terms-conditon') }}">{{ __('auth.terms_conditions') }}</a> {{ __('auth.and') }} <a
                                        style="color: black; text-decoration: underline;"
                                        href="{{ route('privacy-policy') }}">{{ __('auth.privacy_policy') }}</a>
                                    <input type="checkbox" id="" wire:model='accept_terms'
                                        value="1" />
                                    <span class="checkmark"></span>
                                </label>
                                @error('accept_terms')
                                    <span class="validation-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <a href="#" class="process_btn"
                            wire:click.prevent='confirmCheckout'>{!! loadingStateWithProcess('confirmCheckout', 'Place Order') !!}</a>
                    </div>
                </div>
            </div>


           <div id="iyzipay-checkout-form" style="width: 600px!important;" class="popup"></div>

        </div>
    </section>
</div>


@push('scripts')
    <script>
        $(document).ready(function() {
            $('#niceSelectAddress').on('change', function() {
                var val = $(this).val();
                @this.set('country', val);
            });
        });
    </script>

    <script>
        window.addEventListener('showEditModal', event => {
            modalShow("modalID1", "modalOverlay1");
        });

        window.addEventListener('closeModal', event => {
            modalHide("modalID1", "modalOverlay1");
        });

        window.addEventListener('showPaymentModal', event => {
            $('#iyzipay-checkout-form').html(event.detail);
        });

        window.addEventListener('paymentFailed', event => {
            alert('Payment failed, Please Try again later!')
        });

    </script>
@endpush
