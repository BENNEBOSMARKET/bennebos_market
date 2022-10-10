@section('title')
    {{ $product->name }}
@endsection
<div>
    <style>
        .product_details_img {
            height: 400px;
        }

        .active_stars {
            font-size: 16px;
            color: #F2994A;
        }

        .inactive_stars {
            font-size: 16px;
            color: #CDD0D5;
        }

        .validation-error {
            font-size: 12.5px;
            color: red;
        }
    </style>
    <!-- Product details Topbar friz Section  -->
    <section class="product_topbar_wrapper" id="productTopbar" wire:ignore.self>
        <div class="my-container">
            <div class="topbar_product_flex">
                <div class="topbar_product d-flex align-items-start g-sm">
                    <div>
                        <img src="{{ $product->thumbnail }}" alt="product image" class="top_product_img" />
                    </div>
                    <div class="top_product_content">
                        <h3>
                            {{ $product->name }}
                        </h3>
                        <h4>
                            @if ($product->brand_id != '')
                                {{ brand($product->brand_id)->name }}
                            @else
                            @endif
                        </h4>
                        <h5>₺{{ $product->unit_price }}</h5>
                    </div>
                </div>
                <ul class="topbra_product_list d-flex align-items-center justify-content-end flex-wrap-wrap g-sm">
                    <li>
                        <form wire:submit.prevent='addToCart'>
                            <div class="product_details_button">
                                <button type="submit" class="tobar_bar_btn">{!! processing('addToCart', 'Add To Cart',) !!}</button>
                            </div>
                        </form>
                    </li>
                    <li style="width: 40px; height: 40px;" class="top_product_book">
                        <button type="button" wire:click.prevent='wishlist({{ $product->id }})'>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20.3115 4.46071C17.9773 2.08032 15.2743 3.08425 13.6007 4.14593C12.655 4.74582 11.345 4.74582 10.3993 4.14593C8.72564 3.08427 6.02272 2.08035 3.68853 4.46072C-1.85249 10.1114 7.64988 21 12 21C16.3502 21 25.8525 10.1114 20.3115 4.46071Z"
                                    fill="@if (checkIfWishlisted($product->id) > 0) red @else gray @endif" />
                            </svg>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Page Pagination Section  -->
    <section class="page_pagination_wrapper">
        <div class="my-container">
            <ul class="page_pagination_list d-flex align-items-center flex-wrap-wrap">
                <li>
                    <a href="/">{{ __('auth.home') }}</a>
                    <img src="{{ asset('assets/front/images/icon/right_arrow.svg') }}" alt="right arrow" />
                </li>
                <li>
                    <a href="{{ route('front.allCategories') }}">{{ __('auth.categories') }}</a>
                    <img src="{{ asset('assets/front/images/icon/right_arrow.svg') }}" alt="right arrow" />
                </li>
                @if ($maincategory != null)
                    <li>
                        <a
                            href="{{ route('front.category.products', ['slug' => $maincategory->slug]) }}">{{ $maincategory->getTranslation('name') }}</a>
                        <img src="{{ asset('assets/front/images/icon/right_arrow.svg') }}" alt="right arrow" />
                    </li>
                @endif
                @if ($sub_category != null)
                    <li>
                        <a
                            href="{{ route('front.category.products', ['slug' => $sub_category->slug]) }}">{{ $sub_category->getTranslation('name') }}</a>
                        <img src="{{ asset('assets/front/images/icon/right_arrow.svg') }}" alt="right arrow" />
                    </li>
                @endif
                @if ($sub_sub_category != null)
                    <li>
                        <a
                            href="{{ route('front.category.products', ['slug' => $sub_sub_category->slug]) }}">{{ $sub_sub_category->getTranslation('name') }}</a>
                        <img src="{{ asset('assets/front/images/icon/right_arrow.svg') }}" alt="right arrow" />
                    </li>
                @endif

            </ul>
        </div>
    </section>
    <!-- Product Details Section  -->
    <section class="product_details_wrapper">
        <div class="my-container">
            <div class="product_details_grid_area">
                <div class="product_details_content_area">
                    <div class="product_gallery_slider_area" style="user-select: none;" wire:ignore>
                        <!-- Swiper -->
                        <div class="swiper gallery-top">
                            <div class="swiper-wrapper swiper_top">
                                @forelse(json_decode($gallery) as $key => $gimage)
                                    <div class="swiper-slide">
                                        <div class="product_details_img">
                                            <img src="{{ $gimage }}" alt="{{ $product->name }}" />
                                        </div>
                                    </div>
                                @empty
                                    <div class="swiper-slide">
                                        <div class="product_details_img">
                                            <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}" />
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="swiper gallery-thumbs">
                            <div class="swiper-wrapper swiper_bottom">
                                @forelse(json_decode($gallery) as $key => $gimage)
                                    <div class="swiper-slide">
                                        <div class="product_thumb">
                                            <img src="{{ $gimage }}" alt="{{ $product->name }}" />
                                        </div>
                                    </div>
                                @empty
                                    <div class="swiper-slide">
                                        <div class="product_thumb">
                                            <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}" />
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <!-- Add Arrows -->
                        <div class="slider_arrow d-flex align-items-center">
                            <div class="slider_prev_arrow product_gallery_prev_arrow">
                                <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.5 15L1.5 8L8.5 1" stroke="#130F26" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="slider_next_arrow product_gallery_next_arrow">
                                <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.5 1L8.5 8L1.5 15" stroke="#130F26" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="product_details_content">
                        <h3 class="product_title">
                            @if ($color_title != '')
                                {{ $color_title }}
                            @else
                                {{ $product->name }}
                            @endif
                        </h3>
                        <div
                            class="product_star_bookmark_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                            <div class="star_count_area d-flex align-items-center">
                                <span class="start_number">
                                    {!! avarage_review($product->id) !!}
                                    <span>({{ product_review($product->id) }} Reviews)</span>
                                </span>
                            </div>
                            <ul class="bookmart_list d-flex align-items-center flex-wrap-wrap">
                                <li>
                                    <button type="button" id="modalClickButton1">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M14.9529 15.2302C15.4043 15.2315 15.8469 15.356 16.2329 15.5902H16.2229C17.3864 16.2842 17.7816 17.7812 17.1121 18.9591C16.4427 20.137 14.9543 20.5634 13.7626 19.9188C12.571 19.2742 12.1134 17.7951 12.7329 16.5902L9.80286 13.6002C9.59129 13.729 9.36227 13.8267 9.12286 13.8902C8.9235 13.9414 8.71868 13.9683 8.51286 13.9702C7.24414 13.9767 6.17177 13.0317 6.01849 11.7723C5.86521 10.5128 6.67963 9.33829 7.91286 9.04023C8.10923 8.99233 8.31074 8.96882 8.51286 8.97023C9.02893 8.97063 9.53213 9.13137 9.95286 9.43023L12.7329 6.65023C12.3187 5.87635 12.3444 4.94119 12.8005 4.19127C13.2567 3.44135 14.0752 2.98839 14.9529 3.00023C15.4035 2.99795 15.8461 3.11899 16.2329 3.35023C17.0188 3.78252 17.5145 4.60129 17.5331 5.49812C17.5517 6.39495 17.0905 7.23358 16.3231 7.69812C15.5557 8.16265 14.5988 8.18252 13.8129 7.75023L10.8729 10.6902C10.9055 10.7613 10.9323 10.8348 10.9529 10.9102C11.0857 11.4485 11.0328 12.0158 10.8029 12.5202L13.8029 15.5202C14.1581 15.3345 14.5521 15.2352 14.9529 15.2302ZM14.9529 4.50023C14.6018 4.49818 14.2754 4.68037 14.0929 4.98023C13.9565 5.20882 13.9169 5.48235 13.9829 5.74023C14.0406 5.99771 14.2039 6.21907 14.4329 6.35023C14.5862 6.44532 14.7624 6.49716 14.9429 6.50023C15.2959 6.50016 15.6228 6.31393 15.8029 6.01023C16.0862 5.53786 15.9342 4.92532 15.4629 4.64023C15.3098 4.54571 15.1328 4.49712 14.9529 4.50023ZM8.51286 12.4702C8.04216 12.4839 7.62568 12.1674 7.51286 11.7102C7.4499 11.451 7.4931 11.1774 7.63286 10.9502C7.76926 10.726 7.98835 10.5644 8.24286 10.5002H8.48286C8.95356 10.4865 9.37004 10.803 9.48286 11.2602C9.54604 11.515 9.50653 11.7843 9.37286 12.0102L9.31286 12.0802C9.1802 12.27 8.98581 12.4078 8.76286 12.4702H8.51286ZM14.9429 18.6802C15.2939 18.6823 15.6203 18.5001 15.8029 18.2002C16.0534 17.7392 15.905 17.1629 15.4629 16.8802C15.3095 16.7851 15.1333 16.7333 14.9529 16.7302C14.5998 16.7303 14.2729 16.9165 14.0929 17.2202C13.8095 17.6926 13.9616 18.3051 14.4329 18.5902C14.5911 18.6674 14.7678 18.6986 14.9429 18.6802Z"
                                                fill="#424C60" />
                                        </svg>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" wire:click.prevent='wishlist({{ $product->id }})'>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M20.3115 4.46071C17.9773 2.08032 15.2743 3.08425 13.6007 4.14593C12.655 4.74582 11.345 4.74582 10.3993 4.14593C8.72564 3.08427 6.02272 2.08035 3.68853 4.46072C-1.85249 10.1114 7.64988 21 12 21C16.3502 21 25.8525 10.1114 20.3115 4.46071Z"
                                                fill="@if (checkIfWishlisted($product->id) > 0) red @else gray @endif" />
                                        </svg>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="product_details_info_area">
                            <div class="product_details_item">
                                <h4>{{ __('auth.brand') }}</h4>
                                <h5>
                                    @if ($product->brand_id != '')
                                        {{ brand($product->brand_id)->name }}
                                    @else
                                        {{ __('auth.no_nrand') }}
                                    @endif
                                </h5>
                            </div>

                            <div class="product_details_item">
                                <h4>Price:</h4>
                                <h3>
                                    ₺@if ($color_price != '')
                                        {{ $color_price }}
                                    @else
                                        {{ $product->unit_price }}
                                    @endif
                                    <span>/Pieces</span>
                                    <span>{{ $product->min_qty }} {{ $product->unit }}
                                        ({{ __('auth.min_order') }})</span>
                                </h3>
                            </div>

                            @if (count($commonColors))
                                <div class="product_details_item">
                                    <h4>Color:</h4>
                                    <ul class="color_product_list d-flex align-items-center flex-wrap-wrap g-sm"
                                        id="colorProductList">
                                        @foreach ($commonColors as $key => $coloritem)
                                            <li class="@if ($color == $coloritem->id) color_product_selected @endif"
                                                title="{{ $coloritem->name }}"
                                                wire:click='selectColor("{{ $coloritem->id }}", {{ $key }})'>
                                                <img src="{{ $coloritem->image }}" alt="product img" />
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (count($commonSizes))
                                <div class="product_details_item">
                                    <h4>Size:</h4>
                                    <div class="request_size_area product_details_inner_grid">
                                        <ul class="product_size_list d-flex align-items-center flex-wrap-wrap g-sm"
                                            id="">
                                            @foreach ($commonSizes as $sizeitem)
                                                <li class="@if ($size == $sizeitem->id) product_size_selected @endif"
                                                    wire:click='selectSize("{{ $sizeitem->id }}")'>
                                                    {{ $sizeitem->size }}
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div
                                            class="request_product_area d-flex align-items-center justify-content-center flex-wrap-wrap">
                                            <h4>Size Not found :</h4>
                                            <button type="button" class="request_btn" id="modalClickButton3">
                                                <span>Request</span>
                                                <img src="{{ asset('assets/front/images/others/product_user_icon.png') }}"
                                                    alt="" />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="product_details_item">
                                <h4>{{ __('auth.qty') }} </h4>
                                <ul class="quantity_list d-flex align-items-center flex-wrap-wrap g-sm">
                                    <li class="" id="" wire:click.prevent='decrease'>
                                        <svg width="16" height="2" viewBox="0 0 16 2" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1.33301 0.375C0.98783 0.375 0.708008 0.654822 0.708008 1C0.708008 1.34518 0.98783 1.625 1.33301 1.625H14.6663C15.0115 1.625 15.2913 1.34518 15.2913 1C15.2913 0.654822 15.0115 0.375 14.6663 0.375H1.33301Z"
                                                fill="#424C60" />
                                        </svg>
                                    </li>
                                    <li class="inc_decr_input_list">
                                        <input type="number" class="qty_number" wire:model="quantity" />
                                    </li>
                                    <li class="inc_decr_active" wire:click.prevent='increase'>
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.62467 1.33301C8.62467 0.98783 8.34485 0.708008 7.99967 0.708008C7.6545 0.708008 7.37467 0.98783 7.37467 1.33301L7.37467 7.37467H1.33301C0.98783 7.37467 0.708008 7.6545 0.708008 7.99967C0.708008 8.34485 0.98783 8.62467 1.33301 8.62467H7.37467V14.6663C7.37467 15.0115 7.6545 15.2913 7.99967 15.2913C8.34485 15.2913 8.62467 15.0115 8.62467 14.6663V8.62467H14.6663C15.0115 8.62467 15.2913 8.34485 15.2913 7.99967C15.2913 7.6545 15.0115 7.37467 14.6663 7.37467H8.62467L8.62467 1.33301Z"
                                                fill="black" />
                                        </svg>
                                    </li>
                                </ul>
                            </div>
                            <div class="product_details_item">
                                <h4>{{ __('auth.shipping') }}</h4>
                                <ul class="product_tag_list d-flex align-items-center flex-wrap-wrap">
                                    <li>{{ __('auth.support_express') }}</li>
                                    <li>{{ __('auth.sea_freight') }}</li>
                                    <li>{{ __('auth.air_freight') }}</li>
                                    <li>{{ __('auth.air_freight') }}</li>

                                </ul>
                            </div>
                        </div>
                        <form wire:submit.prevent='addToCart'>
                            <div class="product_details_button">
                                <button type="submit" class="product_btn">{!! processing('addToCart', 'Add To Cart') !!}</button>
                                <a href="#" wire:click.prevent="proceedToCheckout"
                                    class="product_btn">{!! processing('proceedToCheckout', 'Buy Now') !!}</a>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="product_details_seller_area">
                    <div class="seller_info_item">
                        <div
                            class="seller_info_title d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                            <h3>{{ __('auth.delivery') }}</h3>
                        </div>
                        <div class="info_para d-flex g-sm">
                            <img src="{{ asset('assets/front/images/icon/Location.svg') }}" alt="location" />
                            <p>
                                {{ __('auth.gokhansok_urkey') }}
                                <img src="{{ asset('assets/front/images/icon/turkey_flag.png') }}"
                                    alt="turkey flag" />
                            </p>
                        </div>
                    </div>
                    <div class="seller_info_item">
                        <div
                            class="seller_info_title d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                            <h3> {{ __('auth.protection') }}</h3>
                        </div>
                        <div class="info_para d-flex g-sm">
                            <img src="{{ asset('assets/front/images/icon/return_icon.svg') }}" alt="returns image" />
                            <p> {{ __('auth.refund_policy') }}</p>
                        </div>
                        <div class="info_para d-flex g-sm">
                            <img src="{{ asset('assets/front/images/icon/guarantee_icon.svg') }}"
                                alt="guarantee image" />
                            <p> {{ __('auth.guarantee_product') }}</p>
                        </div>

                        @if ($product->refundable != 0)
                            <div class="info_para d-flex g-sm">
                                <img src="{{ asset('assets/front/images/icon/refundable.svg') }}"
                                    alt="guarantee image" />
                                <p> {{ __('auth.refundable') }}</p>
                            </div>
                        @else
                            <div class="info_para d-flex g-sm">
                                <img src="{{ asset('assets/front/images/icon/not_refundable.svg') }}"
                                    alt="guarantee image" />
                                <p> {{ __('auth.not_refundable') }}</p>
                            </div>
                        @endif
                    </div>
                    @if ($product->user_id == 0)
                        <div class="seller_info_item">
                            <div class="info_para copmany_info d-flex g-sm">
                                <div class="company_profile d-flex g-sm">
                                    <img src="{{ asset('assets/images/placeholder_rounded.png') }}"
                                        alt="profile image" />
                                    <div>
                                        <h3> {{ __('auth.inhouse_product') }}</h3>
                                        <p> {{ __('auth.turkey') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="seller_info_item">
                            <div
                                class="seller_info_title d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                <h3> {{ __('auth.sold_by') }}</h3>
                                <a href="{{ route('shop.seller', ['slug' => shop($product->user_id)->slug]) }}"
                                    class="see_profile"> {{ __('auth.see_profile') }}</a>
                            </div>
                            <div class="info_para copmany_info d-flex g-sm">
                                <div class="company_profile d-flex g-sm">
                                    <img src="{{ shop($product->user_id)->logo }}" class="sellar_img"
                                        alt="" />
                                    <div>
                                        <h3><a
                                                href="{{ route('shop.seller', ['slug' => shop($product->user_id)->slug]) }}">{{ shop($product->user_id)->name }}</a>
                                        </h3>
                                        <p> {{ __('auth.turkey') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="seller_info_item">
                        <div
                            class="seller_info_title d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                            <h3>{{ __('auth.response_time') }}</h3>
                        </div>
                        <div class="info_para d-flex g-sm">
                            <p>{{ __('auth.hours_1') }}</p>
                        </div>
                    </div>
                    <div class="seller_info_item">
                        <div
                            class="seller_info_title d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                            <h3>{{ __('auth.transactions') }}</h3>
                        </div>
                        <div class="info_para d-flex g-sm">
                            <p>70,000+</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Product Section  -->
    <section class="popular_prodcut_wrapper default_section_gap" wire:ignore>
        <div class="my-container">
            <div class="header_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                <h2 class="page_title">{{ __('auth.popular_products') }}</h2>
                <div class="sell_all d-flex align-items-center g-sm">
                    <h4><a href="{{ route('top-products') }}">{{ __('auth.see_all') }}</a></h4>
                    <!-- Add Arrows -->
                    <div class="slider_arrow d-flex align-items-center">
                        <div class="slider_prev_arrow popular_slider_prev_arrow">
                            <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.5 15L1.5 8L8.5 1" stroke="#130F26" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="slider_next_arrow popular_slider_next_arrow">
                            <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.5 1L8.5 8L1.5 15" stroke="#130F26" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="popular_product_slider_area">
                <!-- Swiper -->
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @foreach ($popularProducts as $popularProduct)
                            <div class="swiper-slide">
                                <div class="product_item">
                                    <a href="{{ route('front.productDetails', ['slug' => $popularProduct->slug]) }}"
                                        class="product_img">
                                        <img src="{{ asset('assets/images/placeholder.png') }}"
                                            data-original="{{ $popularProduct->thumbnail }}"
                                            onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder.png') }}';"
                                            alt="{{ $popularProduct->name }}" />
                                    </a>
                                    <button type="button"
                                        class="best_cart_btn @if (checkIfWishlisted($popularProduct->id) > 0) dealsBookarkActive @endif"
                                        wire:click.prevent="wishlist({{ $popularProduct->id }})"
                                        id="dealsCartButton">
                                        <svg width="22" height="20" viewBox="0 0 22 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M19.3115 2.46071C16.9773 0.0803204 14.2743 1.08425 12.6007 2.14593C11.655 2.74582 10.345 2.74582 9.39929 2.14593C7.72564 1.08427 5.02272 0.0803466 2.68853 2.46072C-2.85249 8.11136 6.64988 19 11 19C15.3502 19 24.8525 8.11136 19.3115 2.46071Z"
                                                stroke="#424C60" stroke-width="1.5" stroke-linecap="round"></path>
                                        </svg>
                                    </button>
                                    <div class="product_content">
                                        <div class="deliver_icon d-flex align-items-center g-sm">
                                            <img src="{{ asset('assets/front/images/icon/delivery-truck.svg') }}"
                                                alt="" class="deliver_img" />
                                            <h4 class="delivery_text">
                                                {{ __('auth.fast_delivery_text') }}
                                            </h4>
                                        </div>
                                        <h3>
                                            <a
                                                href="{{ route('front.productDetails', ['slug' => $popularProduct->slug]) }}">{{ $popularProduct->name }}</a>
                                        </h3>
                                        <div
                                            class="product_cart_ratting_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                            <div class="product_ratting_area">
                                                <img src="{{ asset('assets/front/images/icon/star_single.svg') }}"
                                                    alt="" />
                                                {{ product_avg_review($popularProduct->id) }}
                                                <span>({{ product_review($popularProduct->id) }} Reviews)</span>
                                            </div>
                                            <div>
                                                <button type="button "
                                                    wire:click.prevent="addToCartSingle({{ $popularProduct->id }})"
                                                    class="product_cart_btn">
                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                </button>
                                            </div>
                                        </div>

                                        @if ($popularProduct->discount > 0)
                                            <div class="product_price product_price_side">
                                                <div class="percentage_offer">{{ $popularProduct->discount }}%</div>
                                                <h4>₺{{ discountPrice($popularProduct->id) }}</h4>
                                                <h4 class="discount_price">
                                                    <del>₺{{ $popularProduct->unit_price }}</del>
                                                </h4>
                                            </div>
                                        @else
                                            <div class="product_price product_price_side">
                                                <h4>₺{{ $popularProduct->unit_price }}</h4>
                                            </div>
                                        @endif

                                        <p class="bottom_text">
                                            {{-- 96,69 TL'den Başlayan Taksitlerle --}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Similar product   -->
    <section class="your_product_wrapper default_section_gap">
        <div class="my-container">
            <div class="header_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                <h2 class="page_title">{{ __('auth.similar_products') }}</h2>
            </div>
            <div class="for_your_product_area product_dispaly_bg">
                @foreach ($similarProducts as $similarProduct)
                    <div class="product_item">
                        <a href="{{ route('front.productDetails', ['slug' => $similarProduct->slug]) }}"
                            class="product_img">
                            <img src="{{ asset('assets/images/placeholder.png') }}"
                                data-original="{{ $similarProduct->thumbnail }}"
                                onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder.png') }}';"
                                alt="{{ $similarProduct->name }}" />
                        </a>
                        <button type="button"
                            class="best_cart_btn @if (checkIfWishlisted($similarProduct->id) > 0) dealsBookarkActive @endif"
                            wire:click.prevent="wishlist({{ $similarProduct->id }})" id="dealsCartButton">
                            <svg width="22" height="20" viewBox="0 0 22 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M19.3115 2.46071C16.9773 0.0803204 14.2743 1.08425 12.6007 2.14593C11.655 2.74582 10.345 2.74582 9.39929 2.14593C7.72564 1.08427 5.02272 0.0803466 2.68853 2.46072C-2.85249 8.11136 6.64988 19 11 19C15.3502 19 24.8525 8.11136 19.3115 2.46071Z"
                                    stroke="#424C60" stroke-width="1.5" stroke-linecap="round"></path>
                            </svg>
                        </button>
                        <div class="product_content">
                            <div class="deliver_icon d-flex align-items-center g-sm">
                                <img src="{{ asset('assets/front/images/icon/delivery-truck.svg') }}" alt=""
                                    class="deliver_img" />
                                <h4 class="delivery_text">
                                    {{ __('auth.fast_delivery_text') }}
                                </h4>
                            </div>
                            <h3>
                                <a
                                    href="{{ route('front.productDetails', ['slug' => $similarProduct->slug]) }}">{{ $similarProduct->name }}</a>
                            </h3>
                            <div
                                class="product_cart_ratting_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                <div class="product_ratting_area">
                                    <img src="{{ asset('assets/front/images/icon/star_single.svg') }}"
                                        alt="" />
                                    {{ product_avg_review($similarProduct->id) }}
                                    <span>({{ product_review($similarProduct->id) }} Reviews)</span>
                                </div>
                                <div>
                                    <button type="button "
                                        wire:click.prevent="addToCartSingle({{ $similarProduct->id }})"
                                        class="product_cart_btn">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                    </button>
                                </div>
                            </div>

                            @if ($similarProduct->discount > 0)
                                <div class="product_price product_price_side">
                                    <div class="percentage_offer">{{ $similarProduct->discount }}%</div>
                                    <h4>₺{{ discountPrice($similarProduct->id) }}</h4>
                                    <h4 class="discount_price">
                                        <del>₺{{ $similarProduct->unit_price }}</del>
                                    </h4>
                                </div>
                            @else
                                <div class="product_price product_price_side">
                                    <h4>₺{{ $similarProduct->unit_price }}</h4>
                                </div>
                            @endif

                            <p class="bottom_text">
                                {{-- 96,69 TL'den Başlayan Taksitlerle --}}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ShareThis social share -->
    <div class="modal_wrapper share_modal" id="modalID1">
        <div class="modal_dialog">
            <div class="modal_header d-flex align-items-start justify-content-between  g-sm">
                <h3>{{ __('auth.share_this_product') }}</h3>
                <button type="button" id="modalClose1">
                    <img src="{{ asset('assets/front/images/icon/close_icon.svg') }}" alt="close icon" />
                </button>
            </div>
            <div class="modal_body">
                <ul class="footer_social_list d-flex align-items-center justify-content-center flex-wrap-wrap">
                    <!-- ShareThis BEGIN -->
                    <div class="sharethis-inline-share-buttons"></div>
                    <!-- ShareThis END -->
                </ul>
            </div>
        </div>
    </div>
    <div class="modal_overlay" id="modalOverlay1"></div>

    <!-- ShareThis social share -->
    <div wire:ignore.self class="modal_wrapper share_modal" id="modalID3" style="max-width: 550px;">
        <div class="modal_dialog">
            <div class="modal_header d-flex align-items-start justify-content-between g-sm">
                <h3>Request New Size</h3>
                <button type="button" id="modalClose3">
                    <img src="{{ asset('assets/front/images/icon/close_icon.svg') }}" alt="close icon" />
                </button>
            </div>
            <div class="modal_body">
                <form wire:submit.prevent='requestNewSize' class="form_area">
                    <div class="input_row">
                        <label for="">Product</label>
                        <input type="text" value="{{ $product->name }}" readonly />
                        @error('first_name')
                            <span class="validation-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input_row">
                        <label for="">Required Size</label>
                        <input type="text" placeholder="eg. M,L,XL" wire:model='request_size' />
                        @error('request_size')
                            <span class="validation-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input_row">
                        <label for="">message</label>
                        <textarea type="text" placeholder="Enter your message" wire:model='request_message' rows="7"></textarea>
                        @error('request_message')
                            <span class="validation-error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="sign_up_button">
                        <button type="submit">{!! processing('requestNewSize', 'Submit Request') !!}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal_overlay" id="modalOverlay3"></div>
    <!-- Product Review Section  -->
    <section class="product_review_wrapper">
        <div class="my-container">
            <div class="product_review_grid">
                <div class="product_review_area">
                    <div class="category_tab_button">
                        <button type="button" class="tablinks" wire:click.prevent="changeTab('details')">
                            {{ __('auth.products_details') }}
                        </button>
                        <button type="button" class="tablinks" wire:click.prevent="changeTab('reviews')">
                            {{ __('auth.buyer_reviews') }}
                        </button>
                    </div>
                    <div class="tab_content_area">
                        <div class="tab_item" id="categoryTab"
                            style="@if ($tab == 'details') display: block; @endif margin-top: 25px;">
                            {!! $product->description !!}
                        </div>
                        <div class="tab_item" id="shopTab"
                            style="@if ($tab == 'reviews') display: block; @endif">
                            <div class="product_details_item">
                                <h3>{{ __('auth.customer_reviws') }}</h3>
                                <div class="total_star_averag_bar_area">
                                    <div class="total_star_average_item d-flex align-items-center flex-wrap-wrap g-sm">
                                        <img src="{{ asset('assets/front/images/icon/star5.svg') }}"
                                            alt="star" />
                                        <div class="total_star_bar_area d-flex g-sm">
                                            <div>
                                                <div class="bg_bar"></div>
                                                <div class="review_bar" style="width: 75%"></div>
                                            </div>
                                            <h6>85%</h6>
                                        </div>
                                    </div>
                                    <div class="total_star_average_item d-flex align-items-center flex-wrap-wrap g-sm">
                                        <img src="{{ asset('assets/front/images/icon/star4.svg') }}"
                                            alt="star" />
                                        <div class="total_star_bar_area d-flex g-sm">
                                            <div>
                                                <div class="bg_bar"></div>
                                                <div class="review_bar" style="width: 15%"></div>
                                            </div>
                                            <h6>10%</h6>
                                        </div>
                                    </div>
                                    <div class="total_star_average_item d-flex align-items-center flex-wrap-wrap g-sm">
                                        <img src="{{ asset('assets/front/images/icon/star3.svg') }}"
                                            alt="star" />
                                        <div class="total_star_bar_area d-flex g-sm">
                                            <div>
                                                <div class="bg_bar"></div>
                                                <div class="review_bar" style="width: 8%"></div>
                                            </div>

                                            <h6>3%</h6>
                                        </div>
                                    </div>
                                    <div class="total_star_average_item d-flex align-items-center flex-wrap-wrap g-sm">
                                        <img src="{{ asset('assets/front/images/icon/star2.svg') }}"
                                            alt="star" />
                                        <div class="total_star_bar_area d-flex g-sm">
                                            <div>
                                                <div class="bg_bar"></div>
                                                <div class="review_bar" style="width: 5%"></div>
                                            </div>

                                            <h6>2%</h6>
                                        </div>
                                    </div>
                                    <div class="total_star_average_item d-flex align-items-center flex-wrap-wrap g-sm">
                                        <img src="{{ asset('assets/front/images/icon/star1.svg') }}"
                                            alt="star" />
                                        <div class="total_star_bar_area d-flex g-sm">
                                            <div>
                                                <div class="bg_bar"></div>
                                                <div class="review_bar" style="width: 0%"></div>
                                            </div>

                                            <h6>0%</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="review_comment_text_area">
                                    <div
                                        class="review_filter_title d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                        <h4>{{ __('auth.product_reviews') }}</h4>
                                        <div>
                                            <button type="button" class="filter_button">
                                                <img src="{{ asset('assets/front/images/icon/filter.svg') }}"
                                                    alt="filter icon" />
                                                <span>{{ __('auth.filter') }}</span>
                                                <span>{{ __('auth.all_star') }}</span>
                                            </button>
                                        </div>
                                    </div>
                                    @if ($product_reviews->count() > 0)
                                        @foreach ($product_reviews as $reviews)
                                            <div class="review_comment_item">
                                                <div
                                                    class="comment_user_date_area d-flex justify-content-between g-sm">
                                                    <div class="comment_user d-flex g-sm">
                                                        @if (getUser($reviews->user_id)->image != '')
                                                            <img src="{{ getUser($reviews->user_id)->image }}"
                                                                class="commnent_user_img" alt="user image" />
                                                        @else
                                                            <img src="{{ asset('assets/images/avatar-place.png') }}"
                                                                class="commnent_user_img" alt="user image" />
                                                        @endif

                                                        <div>
                                                            <h5>{{ getUser($reviews->user_id)->name }}</h5>
                                                            {!! single_avarage_review($reviews->user_id, $reviews->product_id) !!}
                                                        </div>
                                                    </div>
                                                    <h6>{{ $reviews->created_at }}</h6>
                                                </div>
                                                <p>
                                                    {{ $reviews->comment }}
                                                </p>
                                            </div>
                                        @endforeach
                                    @else
                                        {{ __('auth.no_reviews_available') }}
                                    @endif
                                </div>
                                {{ $product_reviews->links('front-pagination-links') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="review_product_item_area">
                    <h3 class="review_title">{{ __('auth.suplier_products') }}</h3>
                    <div class="review_product_grid_area">
                        @foreach ($supplierPoducts as $supplierPoduct)
                            <div class="product_item">
                                <a href="{{ route('front.productDetails', ['slug' => $supplierPoduct->slug]) }}"
                                    class="product_img">
                                    <img src="{{ asset('assets/images/placeholder.png') }}"
                                        data-original="{{ $supplierPoduct->thumbnail }}"
                                        onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder.png') }}';"
                                        alt="{{ $supplierPoduct->name }}" />
                                </a>
                                <button type="button"
                                    class="best_cart_btn @if (checkIfWishlisted($supplierPoduct->id) > 0) dealsBookarkActive @endif"
                                    wire:click.prevent="wishlist({{ $supplierPoduct->id }})" id="dealsCartButton">
                                    <svg width="22" height="20" viewBox="0 0 22 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M19.3115 2.46071C16.9773 0.0803204 14.2743 1.08425 12.6007 2.14593C11.655 2.74582 10.345 2.74582 9.39929 2.14593C7.72564 1.08427 5.02272 0.0803466 2.68853 2.46072C-2.85249 8.11136 6.64988 19 11 19C15.3502 19 24.8525 8.11136 19.3115 2.46071Z"
                                            stroke="#424C60" stroke-width="1.5" stroke-linecap="round"></path>
                                    </svg>
                                </button>
                                <div class="product_content">
                                    <div class="deliver_icon d-flex align-items-center g-sm">
                                        <img src="{{ asset('assets/front/images/icon/delivery-truck.svg') }}"
                                            alt="" class="deliver_img" />
                                        <h4 class="delivery_text">
                                            {{ __('auth.fast_delivery_text') }}
                                        </h4>
                                    </div>
                                    <h3>
                                        <a
                                            href="{{ route('front.productDetails', ['slug' => $supplierPoduct->slug]) }}">{{ $supplierPoduct->name }}</a>
                                    </h3>
                                    <div
                                        class="product_cart_ratting_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                        <div class="product_ratting_area">
                                            <img src="{{ asset('assets/front/images/icon/star_single.svg') }}"
                                                alt="" />
                                            {{ product_avg_review($supplierPoduct->id) }}
                                            <span>({{ product_review($supplierPoduct->id) }} Reviews)</span>
                                        </div>
                                        <div>
                                            <button type="button "
                                                wire:click.prevent="addToCartSingle({{ $supplierPoduct->id }})"
                                                class="product_cart_btn">
                                                <i class="fa-solid fa-cart-shopping"></i>
                                            </button>
                                        </div>
                                    </div>

                                    @if ($supplierPoduct->discount > 0)
                                        <div class="product_price product_price_side">
                                            <div class="percentage_offer">{{ $supplierPoduct->discount }}%</div>
                                            <h4>₺{{ discountPrice($supplierPoduct->id) }}</h4>
                                            <h4 class="discount_price">
                                                <del>₺{{ $supplierPoduct->unit_price }}</del>
                                            </h4>
                                        </div>
                                    @else
                                        <div class="product_price product_price_side">
                                            <h4>₺{{ $supplierPoduct->unit_price }}</h4>
                                        </div>
                                    @endif

                                    <p class="bottom_text">
                                        {{-- 96,69 TL'den Başlayan Taksitlerle --}}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@push('scripts')
    <script>
        window.addEventListener('changeGalleryImages', function(event) {
            if (event.detail) {
                let images = $('.product_gallery_slider_area').find('img');
                let thumbImages = $('.swiper-slide .product_thumb').find('img');
                let gallery = JSON.parse(event.detail);
                let url = '';

                for (let i = 0; i < gallery.length; i++) {
                    url = gallery[i];
                    images[i].src = url;
                    thumbImages[i].src = url;
                }
            }
        })
    </script>

    <script>
        window.addEventListener('success', event => {
            if (event.detail && event.detail.message) {
                toastr.success(event.detail.message);
            }
        });
        window.addEventListener('warning', event => {
            if (event.detail && event.detail.message) {
                toastr.warning(event.detail.message);
            }
        });
        window.addEventListener('error', event => {
            if (event.detail && event.detail.message) {
                toastr.error(event.detail.message);
            }
        });
    </script>

    <script>
        //Modal
        let modalClickButton3 = document.querySelector("#modalClickButton3");
        let modalID3 = document.querySelector("#modalID3");
        let modalClose3 = document.querySelector("#modalClose3");


        if (modalClickButton3) {
            modalClickButton3.addEventListener("click", () => {
                modalShow("modalID3", "modalOverlay3");
            });
        }
        if (modalClose3) {
            modalClose3.addEventListener("click", () => {
                modalHide("modalID3", "modalOverlay3");
            });
        }

        window.addEventListener('closeModal', event => {
            modalHide("modalID3", "modalOverlay3");
        });
    </script>
@endpush
