@section('title')
{{ __('auth.cart') }}
@endsection
<div>
    <style>
        .validation-error {
            color: red;
            font-size: 11.5px;
        }

        .remove-coupon {
            color: red;
            font-weight: bold;
        }
    </style>
    <!-- Cart Item Section  -->
    <section class="cart_item_wrapper">
        <div class="my-container">
            <h3 class="cart_title">{{ __('auth.shopping_cart') }}</h3>
            <div class="cart_item_grid">
                <div class="cart_item_area">
                    @if ($cartItems->count() > 0)
                        <div class="cart_title_inner">
                            <div
                                class="custom_checkbox_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                <label class="checkbox_wrapper">{{ __('auth.select_all') }}
                                    <input type="checkbox" id="" wire:model='selectAll' wire:click='selectAll' />
                                    <span class="checkmark"></span>
                                </label>
                                <div class="select_delete">
                                    <button type="button" wire:click.prevent='deleteAll'>
                                        <svg width="19" height="20" viewBox="0 0 19 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16.3248 7.46826C16.3248 7.46826 15.7818 14.2033 15.4668 17.0403C15.3168 18.3953 14.4798 19.1893 13.1088 19.2143C10.4998 19.2613 7.88779 19.2643 5.27979 19.2093C3.96079 19.1823 3.13779 18.3783 2.99079 17.0473C2.67379 14.1853 2.13379 7.46826 2.13379 7.46826"
                                                stroke="#EB5757" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M17.708 4.23975H0.75" stroke="#EB5757" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M14.4406 4.23973C13.6556 4.23973 12.9796 3.68473 12.8256 2.91573L12.5826 1.69973C12.4326 1.13873 11.9246 0.750732 11.3456 0.750732H7.11258C6.53358 0.750732 6.02558 1.13873 5.87558 1.69973L5.63258 2.91573C5.47858 3.68473 4.80258 4.23973 4.01758 4.23973"
                                                stroke="#EB5757" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                        <span>{{ __('auth.delete') }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="cart_product_area">
                            <div class="shop_product_group">
                                @foreach ($cartGroups as $cartGroup)
                                    @if ($cartGroup->owner_id == 0)
                                        <div class="shop_name_area">
                                            <a href="javascript:void(0)" class="shop_name">
                                                <img src="{{ asset('assets/images/company_info_logo.png') }}" alt="" />
                                                <span>{{ __('auth.in_house_product') }}</span>
                                            </a>
                                        </div>
                                    @else
                                        <div class="shop_name_area">
                                            <a href="{{ route('shop.seller', ['slug'=>shop($cartGroup->owner_id)->slug]) }}" class="shop_name">
                                                <img src="{{ shop($cartGroup->owner_id)->logo }}" alt="" />
                                                <span>{{ shop($cartGroup->owner_id)->name }}</span></a>
                                        </div>
                                    @endif

                                    @foreach (cartItems($cartGroup->owner_id) as $cartItm)
                                        <div class="cart_product_item">
                                            <div class="cart_img_area">
                                                <div class="custom_checkbox_area">
                                                    <label class="checkbox_wrapper">
                                                        <input type="checkbox" id="cartInputChecked" wire:click='selectSingleItem' wire:model="SelectedCartItems" value="{{ $cartItm->id }}" />
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="cart_product_img">
                                                    <a href="{{ route('front.productDetails', ['slug'=>product($cartItm->product_id)->slug]) }}">
                                                        <img src="{{ product($cartItm->product_id)->thumbnail }}" alt="{{ product($cartItm->product_id)->name }}" />
                                                    </a>
                                                </div>
                                                <ul class="cart_product_list">
                                                    <li class="cart_product_name">
                                                        <a
                                                            href="{{ route('front.productDetails', ['slug'=>product($cartItm->product_id)->slug]) }}">{{ product($cartItm->product_id)->name }}</a>
                                                    </li>
                                                    <li class="cart_seller_name">

                                                        @if (product($cartItm->product_id)->brand_id != '')
                                                        {{ __('auth.brand') }} {{ brand(product($cartItm->product_id)->brand_id)->name }} <br/>
                                                        @endif

                                                        @if ($cartItm->product_color)
                                                            @if($cartItm->product_color->code)
                                                            {{ __('auth.color') }} <span style="color: {{$cartItm->product_color->code}}">⬤</span><br/>
                                                            @else
                                                            {{ __('auth.color') }} <span>{{$cartItm->product_color->name}}</span><br/>
                                                            @endif
                                                        @endif

                                                        @if ($cartItm->size != '')
                                                        {{ __('auth.size') }} {{ $cartItm->product_size ? $cartItm->product_size->size : $cartItm->size }}<br/>
                                                        @endif

                                                    </li>
                                                    <li class="car_product_price">₺{{ $cartItm->price }}</li>
                                                </ul>
                                            </div>
                                            <div class="cart_delete_increase">
                                                <button type="button" class="delete_icon"
                                                    wire:click.prevent='deleteItem({{ $cartItm->id }})'>
                                                    <svg width="19" height="20" viewBox="0 0 19 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M16.3248 7.46777C16.3248 7.46777 15.7818 14.2028 15.4668 17.0398C15.3168 18.3948 14.4798 19.1888 13.1088 19.2138C10.4998 19.2608 7.88779 19.2638 5.27979 19.2088C3.96079 19.1818 3.13779 18.3778 2.99079 17.0468C2.67379 14.1848 2.13379 7.46777 2.13379 7.46777"
                                                            stroke="#EB5757" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path d="M17.708 4.23926H0.75" stroke="#EB5757" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path
                                                            d="M14.4406 4.23949C13.6556 4.23949 12.9796 3.68449 12.8256 2.91549L12.5826 1.69949C12.4326 1.13849 11.9246 0.750488 11.3456 0.750488H7.11258C6.53358 0.750488 6.02558 1.13849 5.87558 1.69949L5.63258 2.91549C5.47858 3.68449 4.80258 4.23949 4.01758 4.23949"
                                                            stroke="#EB5757" stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </button>

                                                <ul class="quantity_list d-flex align-items-center flex-wrap-wrap g-sm">
                                                    <ul class="quantity_list d-column align-items-center flex-wrap-wrap g-sm">
                                                        <li class="" id="minusButton"
                                                            style="margin-bottom: 3px"
                                                            wire:click.prevent="decrease({{ $cartItm->id }})">
                                                            <svg width="16" height="2" viewBox="0 0 16 2" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M1.33301 0.375C0.98783 0.375 0.708008 0.654822 0.708008 1C0.708008 1.34518 0.98783 1.625 1.33301 1.625H14.6663C15.0115 1.625 15.2913 1.34518 15.2913 1C15.2913 0.654822 15.0115 0.375 14.6663 0.375H1.33301Z"
                                                                    fill="#424C60" />
                                                            </svg>
                                                        </li>
                                                        <li class="inc_decr_input_list" style="margin-bottom: 3px">
                                                            <input type="number" class="qty_number" value="{{ $cartItm->quantity }}"
                                                                readonly />
                                                        </li>
                                                        <li class="inc_decr_active" id="plusButton"
                                                            style="margin-bottom: 3px"
                                                            wire:click.prevent="increase({{ $cartItm->id }})">
                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M8.62467 1.33301C8.62467 0.98783 8.34485 0.708008 7.99967 0.708008C7.6545 0.708008 7.37467 0.98783 7.37467 1.33301L7.37467 7.37467H1.33301C0.98783 7.37467 0.708008 7.6545 0.708008 7.99967C0.708008 8.34485 0.98783 8.62467 1.33301 8.62467H7.37467V14.6663C7.37467 15.0115 7.6545 15.2913 7.99967 15.2913C8.34485 15.2913 8.62467 15.0115 8.62467 14.6663V8.62467H14.6663C15.0115 8.62467 15.2913 8.34485 15.2913 7.99967C15.2913 7.6545 15.0115 7.37467 14.6663 7.37467H8.62467L8.62467 1.33301Z"
                                                                    fill="black" />
                                                            </svg>
                                                        </li>
                                                    </ul>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach


                            </div>
                        </div>
                    @else
                        <div style="text-align: center; margin-top: 20%;">
                            <h5>   {{ __('auth.no_items_in_cart') }}</h5>
                        </div>
                    @endif

                </div>
                <div class="cart_details_area">
                    <div class="total_summery_area">
                        <h3>{{ __('auth.total_summary') }}</h3>
                        <ul class="order_summer_list">
                            <li>
                                <h4>{{ __('auth.subtotal') }} ({{ $totalItem }} Items)</h4>
                                <h5>₺{{ round($subtotal, 2) }}</h5>
                            </li>
                            <li>
                                <h4>{{ __('auth.discount') }}</h4>
                                <h5>₺{{ round($totalDiscount, 2) }}</h5>
                            </li>
                            <li>
                                <h4>{{ __('auth.shipping_fee') }}</h4>
                                <h5>₺{{ round($shippingfee, 2) }}</h5>
                            </li>
                            @if (session('coupon'))
                                <li>
                                    <h4>{{ __('auth.coupon_discount') }} <a href="#" class="remove-coupon" title="remove"
                                            wire:click.prevent='removeCoupon'>×</a></h4>
                                    <h5>${{ round($couponDiscount, 2) }}</h5>
                                </li>
                            @endif

                            <li>
                                <h4><b>{{ __('auth.total') }}</b></h4>
                                <h5><b>₺{{ round($grandTotal, 2) }}</b></h5>
                            </li>
                        </ul>

                        @if (!session('coupon'))
                            <form class="coupon_form" wire:submit.prevent='applyCoupon'>
                                <div class="input_row">
                                    <input type="text" placeholder="Enter Coupon Code" wire:model="coupon" />
                                    @error('coupon')
                                        <span class="validation-error">{{ $message }}</span>
                                    @enderror
                                    <button type="submit">{{ __('auth.apply') }}</button>
                                </div>
                            </form>
                        @endif

                        @if ($cartItems->count() > 0)
                            <a href="#" class="process_btn" wire:click.prevent='proceedToCheckout'>{{ __('auth.proceed_to_payment') }}</a>
                        @else
                            <a href="{{ route('home.index') }}" class="process_btn">{{ __('auth.shop_now') }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')

@endpush
