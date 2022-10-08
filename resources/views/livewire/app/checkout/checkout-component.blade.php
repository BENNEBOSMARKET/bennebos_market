@section('title') Checkout @endsection
<div>
    <style>
        .validation-error{
            font-size: 12.5px;
            color: red;
        }
        .shipping_address_wrapper .shipping_save_address_item::before {
            display: none
        }
    </style>
    <!-- Cart Item Section  -->
    <section class="cart_item_wrapper shipping_address_wrapper">
        <div class="my-container">
            <h3 class="cart_title">Shipping Address</h3>
            <div class="cart_item_grid">
                <div class="shipping_address_area">
                    <div class="shipping_address_inner_area">
                        <button type="button" class="add_shipping_button" id="modalClickButton1">
                            + Add New Address
                        </button>

                        <div class="shipping_save_address_rea">
                            <h5>Shipping Address</h5>
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
                                                    <button type="button" id="" wire:click.prevent='editData({{ $address->id }})'>
                                                        <img src="{{ asset('assets/front/images/icon/Edit-Square.svg') }}" alt="edit icon" />
                                                        <span>Edit</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="delete_button" wire:click.prevent="deleteAddress({{ $address->id }})">
                                                        <img src="{{ asset('assets/front/images/icon/Delete.svg') }}" alt="delete icon" />

                                                        <span>Delete</span>
                                                    </button>
                                                </li>
                                            </ul>

                                        </div>
                                        <ul class="save_info_list">
                                            <li>
                                                Home: {{ $address->address }}.
                                            </li>
                                            <li>Mobile: {{ $address->phone }}</li>
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
                        <h5>Payment Method</h5>
                        <div class="payment_method_option_area">
                            @error('delivery_type')
                                <span class="validation-error">{{ $message }}</span>
                            @enderror
                            <label class="custom_radio_button_area">
                                <img src="{{ asset('assets/front/images/icon/payment_option_img_1.svg') }}" alt="payment icon" />
                                <span class="radio_text">Cash on Delivery</span>
                                <input type="radio" name="radio" wire:click="selectDeliveryType('cod')" />
                                <span class="checkmark"></span>
                            </label>
                            <label class="custom_radio_button_area">
                                <img src="{{ asset('assets/front/images/icon/payment_option_img_2.svg') }}" alt="payment icon" />
                                <span class="radio_text">Visa Card</span>
                                <input type="radio" name="deliveryType" wire:click="selectDeliveryType('visa')" disabled  />
                                <span class="checkmark"></span>
                            </label>
                            <label class="custom_radio_button_area">
                                <img src="{{ asset('assets/front/images/icon/payment_option_img_3.svg') }}" alt="payment icon" />
                                <span class="radio_text">Master Card</span>
                                <input type="radio" name="deliveryType" wire:click="selectDeliveryType('master_card')" disabled  />
                                <span class="checkmark"></span>
                            </label>
                            <label class="custom_radio_button_area">
                                <img src="{{ asset('assets/front/images/icon/payment_option_img_4.svg') }}" alt="payment icon" />
                                <span class="radio_text">Bank Transfer</span>
                                <input type="radio" name="deliveryType" wire:click="selectDeliveryType('bank')" disabled  />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <!-- Modal Adress -->
                <div wire:ignore.self class="modal_wrapper" id="modalID1">
                    <div class="modal_dialog">
                        <div class="modal_header d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                            <h3>@if ($formStatus == 1) Edit Address @else Add New Address @endif</h3>
                            <button type="button" id="modalClose1" wire:click='close'>
                                <img src="{{ asset('assets/front/images/icon/close_icon.svg') }}" alt="close icon" />
                            </button>
                        </div>
                        <div class="modal_body">
                            <form wire:submit.prevent='@if ($formStatus == 1) updateAddress @else storeAddress @endif' class="form_area">
                                <div class="modal_form_item_grid">
                                    <div class="input_row">
                                        <label for="">First Name</label>
                                        <input type="text" placeholder="First Name" wire:model='first_name' />
                                        @error('first_name')
                                            <span class="validation-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="input_row">
                                        <label for="">Last Name</label>
                                        <input type="text" placeholder="Last Name" wire:model='last_name' />
                                        @error('last_name')
                                            <span class="validation-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="modal_form_item_grid">
                                    <div class="input_row">
                                        <label for="">Phone Number</label>
                                        <input type="text" placeholder="17552364" id="" wire:model='phone' />
                                        @error('phone')
                                            <span class="validation-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="input_row">
                                        <label for="">Email</label>
                                        <input type="email" placeholder="Enter your email" wire:model='email' />
                                        @error('email')
                                            <span class="validation-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="modal_form_item_grid">
                                    <div class="input_row">
                                        <label for="">Country</label>
                                        <div wire:ignore>
                                            <select id="niceSelectAddress" class="niceSelect" wire:model='country'
                                            wire:change='selectCountry'>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->name }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('country')
                                            <span class="validation-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="input_row">
                                        <label for="">State</label>
                                        <input type="text" placeholder="Enter state" wire:model='state' />
                                        @error('state')
                                            <span class="validation-error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="input_row">
                                    <label for="">Address</label>
                                    <input type="text" placeholder="Write here your full address" wire:model='address' />
                                    @error('address')
                                        <span class="validation-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="sign_up_button">
                                    <button type="submit">Save Address</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div wire:ignore class="modal_overlay" id="modalOverlay1"></div>

                <div class="cart_details_area">
                    <div class="total_summery_area">
                        <h3>Total Summary</h3>
                        <ul class="order_summer_list">
                            <li>
                                <h4>Subtotal ({{ Session::get('checkout')['totalItem'] }} Items)</h4>
                                <h5>${{ Session::get('checkout')['subtotal'] }}</h5>
                            </li>
                            <li>
                                <h4>Discount</h4>
                                <h5>${{ Session::get('checkout')['totalDiscount'] }}</h5>
                            </li>
                            <li>
                                <h4>Shipping Fee</h4>
                                <h5>${{ $shippingfee }}</h5>
                            </li>
                            @if (session('coupon'))
                                <li>
                                    <h4>Coupon Discount</h4>
                                    <h5>${{ Session::get('checkout')['coupon_discount'] }}</h5>
                                </li>
                            @endif

                            <li>
                                <h4><b>Total</b></h4>
                                <h5><b>${{ Session::get('checkout')['grand_total'] }}</b></h5>
                            </li>
                        </ul>
                        <a href="#" class="process_btn" wire:click.prevent='confirmCheckout'>{!! loadingStateWithProcess('confirmCheckout', 'Place Order') !!}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@push('scripts')
    <script>
        $(document).ready(function(){
            $('#niceSelectAddress').on('change', function(){
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
    </script>
@endpush
