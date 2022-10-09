@section('title')
    {{ __('auth.bennebos_market') }}
@endsection
<div>
    <style>
        .active_stars {
            font-size: 12px;
            color: #F2994A;
        }

        .inactive_stars {
            font-size: 12px;
            color: #CDD0D5;
        }

        .fetures_product_wrapper .prodcut_inner_area li img {
            border-radius: 15px;
            width: 100%;
            height: 75px;
            object-fit: cover;
        }
    </style>
    {{-- Deals of the day --}}
    <section class="popular_prodcut_wrapper default_section_gap" wire:ignore>
        @if ($deals_of_day->count() > 0)
            <div class="my-container" style="margin-bottom: 25px;">
                <div class="header_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                    <h2 class="page_title">{{ __('auth.deals_of_the_day') }}</h2>
                    <div class="sell_all d-flex align-items-center g-sm">
                        <h4><a href="/">{{ __('auth.see_more') }}</a></h4>
                        <!-- Add Arrows -->
                        <div class="slider_arrow d-flex align-items-center">
                            <div class="slider_prev_arrow deals_of_day_slider_prev_arrow">
                                <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.5 15L1.5 8L8.5 1" stroke="#130F26" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <div class="slider_next_arrow deals_of_day_slider_next_arrow">
                                <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.5 1L8.5 8L1.5 15" stroke="#130F26" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="deals_day_product_slider_area">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            @foreach ($deals_of_day as $deal)
                                @php $shop = shop($deal->user_id); @endphp
                                <div class="swiper-slide">
                                    <div class="product_item">
                                        <a href="{{ route('front.productDetails', ['slug' => $deal->slug]) }}"
                                            class="product_img hover_color">
                                            <img src="{{ $deal->thumbnail }}" alt="{{ $deal->name }}" />
                                        </a>
                                        <div class="product_content">
                                            <h3>
                                                <a
                                                    href="{{ route('front.productDetails', ['slug' => $deal->slug]) }}">{{ $deal->name }}</a>
                                            </h3>
                                            @if ($deal->discount > 0)
                                                <div class="product_price product_price_side">
                                                    <div class="percentage_offer">{{ $deal->discount }}%</div>
                                                    <h4>₺{{ calculateDiscount($deal->unit_price, $deal->discount) }}
                                                    </h4>
                                                    <h4 class="discount_price">
                                                        <del>₺{{ $deal->unit_price }}</del>
                                                    </h4>
                                                </div>
                                            @else
                                                <div class="product_price product_price_side">
                                                    <h4>₺{{ $deal->unit_price }}</h4>
                                                </div>
                                            @endif
                                            <div class="product_review_img_area d-flex align-items-center">
                                                {!! avgReview($deal->total_reviews, $deal->total_ratings) !!}
                                                <span>({{ $deal->total_reviews }}
                                                    Reviews)</span>
                                            </div>
                                            <div class="product_company_name_area">
                                                <div
                                                    class="company_brand_area d-flex align-items-center flex-wrap-wrap g-sm">
                                                    <img src="{{ asset('assets/images/placeholderbg.png') }}"
                                                        data-original="{{ $deal->shop_logo }}"
                                                        alt="{{ $deal->shop_name }}" />
                                                    <h4>{{ $deal->shop_name }}</h4>
                                                </div>
                                                <div class="product_progress_bar_area">
                                                    <div class="product_progress_inner_bar">
                                                        <div class="prodcut_progress_outer_bar" style="width: 50%;">
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="product_stoke_text d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                                        <h5>100 In Stock</h5>
                                                        <h6>Sold 50</h6>
                                                    </div>
                                                    <div class="offer_end_time_area">
                                                        <h3>{{ __('auth.offers_ends_on') }}</h3>
                                                        <div class="offer_number_item">
                                                            <div class="countdown event_countdown1"
                                                                data-Date="{{ Carbon\Carbon::parse($deal->date_to)->format('Y/m/d H:i:s') }}">
                                                                <div class="running d-block">
                                                                    <timer class="timer">
                                                                        <div class="time_text_area">
                                                                            <span class="days"></span>
                                                                            <h4>Day</h4>
                                                                        </div>
                                                                        <div class="time_text_area">
                                                                            <span class="hours"></span>
                                                                            <h4>Hour</h4>
                                                                        </div>
                                                                        <div class="time_text_area">
                                                                            <span class="minutes"></span>
                                                                            <h4>Minute</h4>
                                                                        </div>
                                                                        <div class="time_text_area">
                                                                            <span class="seconds"></span>
                                                                            <h4>Second</h4>
                                                                        </div>
                                                                    </timer>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>
    <!-- Best Selling -->
    <section class="best_selling_wrapper" wire:ignore>
        <div class="my-container">
            <div class="header_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                <h2 class="page_title">{{ __('auth.best_sellings_products') }}</h2>
                <div class="sell_all d-flex align-items-center g-sm">
                    <h4><a
                            href="{{ route('best-selling-products', ['slug' => 'all']) }}">{{ __('auth.see_more') }}</a>
                    </h4>

                </div>
            </div>
            <div class="best_selling_slider_area">
                <!-- Swiper -->
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @foreach ($best_selling as $bestSelling)
                            <div class="swiper-slide">
                                <div class="product_item">
                                    <a href="{{ route('front.productDetails', ['slug' => $bestSelling->slug]) }}"
                                        class="product_img">
                                        @if ($bestSelling->thumbnail)
                                            <img src="{{ $bestSelling->thumbnail }}" alt="{{ $bestSelling->name }}" />
                                        @else
                                            <img src="{{ asset('assets/images/placeholder.png') }}"
                                                alt="{{ $bestSelling->name }}" />
                                        @endif
                                    </a>
                                    <button type="button"
                                        class="best_cart_btn @if (checkIfWishlisted($bestSelling->id) > 0) dealsBookarkActive @endif"
                                        wire:click.prevent="wishlist({{ $bestSelling->id }})" id="dealsCartButton">
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
                                                href="{{ route('front.productDetails', ['slug' => $bestSelling->slug]) }}">{{ $bestSelling->name }}</a>
                                        </h3>
                                        <div
                                            class="product_cart_ratting_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                            <div class="product_ratting_area">
                                                <img src="{{ asset('assets/front/images/icon/star_single.svg') }}"
                                                    alt="" />
                                                {!! product_avg_review($bestSelling->id) !!}
                                                <span>({{ product_review($bestSelling->id) }} Reviews)</span>
                                            </div>
                                            <div>
                                                <button type="button "
                                                    wire:click.prevent="addToCartSingle({{ $bestSelling->id }})"
                                                    class="product_cart_btn">
                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @if ($bestSelling->discount > 0)
                                            <div class="product_price product_price_side">
                                                <div class="percentage_offer">{{ $bestSelling->discount }}%</div>
                                                <h4>₺{{ calculateDiscount($bestSelling->unit_price, $bestSelling->discount) }}
                                                </h4>
                                                <h4 class="discount_price">
                                                    <del>₺{{ $bestSelling->unit_price }}</del>
                                                </h4>
                                            </div>
                                        @else
                                            <div class="product_price product_price_side">
                                                <h4>₺{{ $bestSelling->unit_price }}</h4>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="desktop_slider_btn">
                    <div class="slider_arrow d-flex align-items-center">
                        <div class="slider_prev_arrow best_slider_prev_arrow">
                            <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.5 15L1.5 8L8.5 1" stroke="#130F26" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="slider_next_arrow best_slider_next_arrow">
                            <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.5 1L8.5 8L1.5 15" stroke="#130F26" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- BBanner -->
    <section class="bennebos_banner_wrapper">
        <div class="my-container">
            <div class="top_banner_area text-center">
                <a href="#">
                    <img src="{{ asset('assets/front/images/home/product_banner_img_1.jpeg') }}" />
                </a>
            </div>
        </div>
    </section>
    <!-- Category  Cards  -->
    <section class="category_product_wrapper" wire:ignore>
        <div class="my-container">
            <div class="category_product_grid">
                <div class="category_card">
                    <h3>{{ __('auth.new_rivals') }}</h3>
                    <div class="features_slider_area" id="newArrivalSlider">
                        <!-- Swiper -->
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @foreach ($new_arrivals as $new_arrival)
                                    <div class="swiper-slide">
                                        <div class="product_item product_item2">
                                            <a href="{{ route('front.productDetails', ['slug' => $new_arrival->slug]) }}"
                                                class="product_img">
                                                <img src="{{ $new_arrival->thumbnail }}"
                                                    onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholderbg.png') }}';" />
                                            </a>
                                            <div class="product_content">
                                                <h3>
                                                    <a
                                                        href="{{ route('front.productDetails', ['slug' => $new_arrival->slug]) }}">
                                                        {{ $new_arrival->name }}</a>
                                                </h3>
                                                <div
                                                    class="product_price product_price_side d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                                    @if ($new_arrival->discount > 0)
                                                        <div class="price_area d-flex align-items-center">
                                                            <h4>₺{{ calculateDiscount($new_arrival->unit_price, $new_arrival->discount) }}
                                                            </h4>
                                                            <h4 class="discount_price">
                                                                <del>₺{{ $new_arrival->unit_price }}</del>
                                                            </h4>
                                                        </div>
                                                    @else
                                                        <div class="product_price product_price_side">
                                                            <h4>₺{{ $new_arrival->unit_price }}</h4>
                                                        </div>
                                                    @endif
                                                    <div class="category_ion">
                                                        <img
                                                            src="{{ asset('assets/front/images/icon/category_product_icon_1.png') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next slider_single_next_arrow new_arrival_next_arrow"></div>
                        <div class="swiper-button-prev slider_single_prev_arrow new_arrival_prev_arrow"></div>
                    </div>
                    <div class="text-center">
                        <a href="/" class="view_all_btn">View All</a>
                    </div>
                </div>
                <div class="category_card">
                    <h3>{{ __('auth.top_ranked_products') }}</h3>
                    <div class="features_slider_area" id="topRankingSlider">
                        <!-- Swiper -->
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @foreach ($top_products as $top_product)
                                    <div class="swiper-slide">
                                        <div class="product_item product_item2">
                                            <a href="{{ route('front.productDetails', ['slug' => $top_product->slug]) }}"
                                                class="product_img">
                                                <img src="{{ $top_product->thumbnail }}"
                                                    onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholderbg.png') }}';" />
                                            </a>
                                            <div class="product_content">
                                                <h3>
                                                    <a
                                                        href="{{ route('front.productDetails', ['slug' => $top_product->slug]) }}">
                                                        {{ $top_product->name }}</a>
                                                </h3>
                                                <div
                                                    class="product_price product_price_side d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                                    @if ($top_product->discount > 0)
                                                        <div class="price_area d-flex align-items-center">
                                                            <h4>₺{{ calculateDiscount($top_product->unit_price, $top_product->discount) }}
                                                            </h4>
                                                            <h4 class="discount_price">
                                                                <del>₺{{ $top_product->unit_price }}</del>
                                                            </h4>
                                                        </div>
                                                    @else
                                                        <div class="product_price product_price_side">
                                                            <h4>₺{{ $top_product->unit_price }}</h4>
                                                        </div>
                                                    @endif

                                                    <div class="category_ion">
                                                        <img
                                                            src="{{ asset('assets/front/images/icon/category_product_icon_2.png') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next slider_single_next_arrow top_ranking_next_arrow"></div>
                        <div class="swiper-button-prev slider_single_prev_arrow top_ranking_prev_arrow"></div>
                    </div>
                    <div class="text-center">
                        <a href="/" class="view_all_btn">View All</a>
                    </div>
                </div>
                <div class="category_card">
                    <h3>{{ __('auth.dropshipping') }}</h3>
                    <div class="features_slider_area" id="protectiveSlider">
                        <!-- Swiper -->
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @foreach ($dropshippings as $dropshipping)
                                    <div class="swiper-slide">
                                        <div class="product_item product_item2">
                                            <a href="{{ route('front.productDetails', ['slug' => $dropshipping->slug]) }}"
                                                class="product_img">
                                                <img src="{{ $dropshipping->thumbnail }}"
                                                    onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholderbg.png') }}';" />
                                            </a>
                                            <div class="product_content">
                                                <h3>
                                                    <a
                                                        href="{{ route('front.productDetails', ['slug' => $dropshipping->slug]) }}">
                                                        {{ $dropshipping->name }}</a>
                                                </h3>
                                                <div
                                                    class="product_price product_price_side d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                                    @if ($dropshipping->discount > 0)
                                                        <div class="price_area d-flex align-items-center">
                                                            <h4>₺{{ calculateDiscount($dropshipping->unit_price, $dropshipping->discount) }}
                                                            </h4>
                                                            <h4 class="discount_price">
                                                                <del>₺{{ $dropshipping->unit_price }}</del>
                                                            </h4>
                                                        </div>
                                                    @else
                                                        <div class="product_price product_price_side">
                                                            <h4>₺{{ $dropshipping->unit_price }}</h4>
                                                        </div>
                                                    @endif
                                                    <div class="category_ion">
                                                        <img
                                                            src="{{ asset('assets/front/images/icon/category_product_icon_3.png') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next slider_single_next_arrow protective_next_arrow"></div>
                        <div class="swiper-button-prev slider_single_prev_arrow protective_prev_arrow"></div>
                    </div>
                </div>
                <div class="category_card">
                    <h3>Opportunity Products</h3>
                    <div class="features_slider_area" id="dropshippingSlider">
                        <!-- Swiper -->
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                @foreach ($opportunities as $opportunity)
                                    <div class="swiper-slide">
                                        <div class="product_item product_item2">
                                            <a href="{{ route('front.productDetails', ['slug' => $opportunity->slug]) }}"
                                                class="product_img">
                                                <img src="{{ $opportunity->thumbnail }}"
                                                    onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholderbg.png') }}';" />
                                            </a>
                                            <div class="product_content">
                                                <h3>
                                                    <a
                                                        href="{{ route('front.productDetails', ['slug' => $opportunity->slug]) }}">
                                                        {{ $opportunity->name }}</a>
                                                </h3>
                                                <div
                                                    class="product_price product_price_side d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                                    @if ($opportunity->discount > 0)
                                                        <div class="price_area d-flex align-items-center">
                                                            <h4>₺{{ calculateDiscount($opportunity->unit_price, $opportunity->discount) }}
                                                            </h4>
                                                            <h4 class="discount_price">
                                                                <del>₺{{ $opportunity->unit_price }}</del>
                                                            </h4>
                                                        </div>
                                                    @else
                                                        <div class="product_price product_price_side">
                                                            <h4>₺{{ $opportunity->unit_price }}</h4>
                                                        </div>
                                                    @endif
                                                    <div class="category_ion">
                                                        <img
                                                            src="{{ asset('assets/front/images/icon/category_product_icon_4.png') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next slider_single_next_arrow dropshipping_next_arrow"></div>
                        <div class="swiper-button-prev slider_single_prev_arrow dropshipping_prev_arrow"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Big Deals Section  -->
    <section class="big_deals_wrapper default_section_gap">
        <div class="my-container">
            <h3 class="page_title">Big Deals</h3>
        </div>
        <div class="big_deals_inner_wrapper">
            <div class="my-container">
                <div class="big_deals_slider_grid">
                    <div class="best_big_text_deal_area tablinks3">
                        <span> Best Big Deals</span>
                    </div>
                    <div class="slider_btn_tab_wrapper">
                        <div class="big_deals_slider_btn">
                            <!-- Swiper -->
                            <div class="swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <button type="button" class="tablinks3 tabActiveButton" id="defaultOpen3"
                                            onclick="openTab3(event, 'bigTabSlider1')">
                                            {{ __('auth.best_big_deals') }}
                                        </button>
                                    </div>
                                    <div class="swiper-slide">
                                        <button type="button" class="tablinks3"
                                            onclick="openTab3(event, 'bigTabSlider2')">
                                            {{ __('auth.new_rivals') }}
                                        </button>
                                    </div>
                                    <div class="swiper-slide">
                                        <button type="button" class="tablinks3"
                                            onclick="openTab3(event, 'bigTabSlider3')">
                                            {{ __('auth.most_viewed') }}
                                        </button>
                                    </div>
                                    <div class="swiper-slide">
                                        <button type="button" class="tablinks3"
                                            onclick="openTab3(event, 'bigTabSlider4')">
                                            {{ __('auth.deal_of_the_season') }}
                                        </button>
                                    </div>
                                    <div class="swiper-slide">
                                        <button type="button" class="tablinks3"
                                            onclick="openTab3(event, 'bigTabSlider5')">
                                            {{ __('auth.big_needs') }}
                                        </button>
                                    </div>
                                    <div class="swiper-slide">
                                        <button type="button" class="tablinks3"
                                            onclick="openTab3(event, 'bigTabSlider6')">
                                            {{ __('auth.big_quantity') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="big_deals_slider_area" wire:ignore>
                            <div class="tab_item3" id="bigTabSlider1">
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        @foreach ($bd_best_deals as $bestDeal)
                                            <div class="swiper-slide">
                                                <div class="product_item product_item2">
                                                    <a href="{{ route('front.productDetails', ['slug' => $bestDeal->slug]) }}"
                                                        class="product_img hover_color">
                                                        <img src="{{ $bestDeal->thumbnail }}"
                                                            onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholderbg.png') }}';" />
                                                        <div class="offer_text">{{ __('auth.bennebos_offer') }}</div>
                                                    </a>
                                                    <div class="product_content">
                                                        <h3>
                                                            <a
                                                                href="{{ route('front.productDetails', ['slug' => $bestDeal->slug]) }}">{{ $bestDeal->name }}</a>
                                                        </h3>
                                                        <div
                                                            class="product_cart_ratting_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                                            <div class="product_ratting_area">
                                                                <img src="{{ asset('assets/front/images/icon/star_single.svg') }}"
                                                                    alt="" />
                                                                {!! product_avg_review($bestDeal->id) !!}
                                                                <span>({{ product_review($bestDeal->id) }}
                                                                    Reviews)</span>
                                                            </div>
                                                        </div>

                                                        @if ($bestDeal->discount > 0)
                                                            <div class="product_price product_price_side">
                                                                <h4>₺{{ calculateDiscount($bestDeal->unit_price, $bestDeal->discount) }}
                                                                </h4>
                                                                <h4 class="discount_price">
                                                                    <del>₺{{ $bestDeal->unit_price }}</del>
                                                                </h4>
                                                            </div>
                                                        @else
                                                            <div class="product_price product_price_side">
                                                                <h4>₺{{ $bestDeal->unit_price }}</h4>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab_item3" id="bigTabSlider2">
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        @foreach ($bd_new_arrivals as $bdNewArrival)
                                            <div class="swiper-slide">
                                                <div class="product_item product_item2">
                                                    <a href="{{ route('front.productDetails', ['slug' => $bdNewArrival->slug]) }}"
                                                        class="product_img hover_color">
                                                        <img src="{{ $bdNewArrival->thumbnail }}"
                                                            onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholderbg.png') }}';" />
                                                        <div class="offer_text">{{ __('auth.bennebos_offer') }}</div>
                                                    </a>
                                                    <div class="product_content">
                                                        <h3>
                                                            <a
                                                                href="{{ route('front.productDetails', ['slug' => $bdNewArrival->slug]) }}">{{ $bdNewArrival->name }}</a>
                                                        </h3>
                                                        <div
                                                            class="product_cart_ratting_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                                            <div class="product_ratting_area">
                                                                <img src="{{ asset('assets/front/images/icon/star_single.svg') }}"
                                                                    alt="" />
                                                                {!! product_avg_review($bdNewArrival->id) !!}
                                                                <span>({{ product_review($bdNewArrival->id) }}
                                                                    Reviews)</span>
                                                            </div>
                                                        </div>
                                                        @if ($bdNewArrival->discount > 0)
                                                            <div class="product_price product_price_side">
                                                                <h4>₺{{ calculateDiscount($bdNewArrival->unit_price, $bdNewArrival->discount) }}
                                                                </h4>
                                                                <h4 class="discount_price">
                                                                    <del>₺{{ $bdNewArrival->unit_price }}</del>
                                                                </h4>
                                                            </div>
                                                        @else
                                                            <div class="product_price product_price_side">
                                                                <h4>₺{{ $bdNewArrival->unit_price }}</h4>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab_item3" id="bigTabSlider3">
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        @foreach ($bd_most_viewed as $bdMostViewed)
                                            <div class="swiper-slide">
                                                <div class="product_item product_item2">
                                                    <a href="{{ route('front.productDetails', ['slug' => $bdMostViewed->slug]) }}"
                                                        class="product_img hover_color">
                                                        <img src="{{ $bdMostViewed->thumbnail }}"
                                                            onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholderbg.png') }}';" />
                                                        <div class="offer_text">{{ __('auth.bennebos_offer') }}</div>
                                                    </a>
                                                    <div class="product_content">
                                                        <h3>
                                                            <a
                                                                href="{{ route('front.productDetails', ['slug' => $bdMostViewed->slug]) }}">{{ $bdMostViewed->name }}</a>
                                                        </h3>
                                                        <div
                                                            class="product_cart_ratting_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                                            <div class="product_ratting_area">
                                                                <img src="{{ asset('assets/front/images/icon/star_single.svg') }}"
                                                                    alt="" />
                                                                {!! product_avg_review($bdMostViewed->id) !!}
                                                                <span>({{ product_review($bdMostViewed->id) }}
                                                                    Reviews)</span>
                                                            </div>
                                                        </div>

                                                        @if ($bdMostViewed->discount > 0)
                                                            <div class="product_price product_price_side">
                                                                <h4>₺{{ calculateDiscount($bdMostViewed->unit_price, $bdMostViewed->discount) }}
                                                                </h4>
                                                                <h4 class="discount_price">
                                                                    <del>₺{{ $bdMostViewed->unit_price }}</del>
                                                                </h4>
                                                            </div>
                                                        @else
                                                            <div class="product_price product_price_side">
                                                                <h4>₺{{ $bdMostViewed->unit_price }}</h4>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab_item3" id="bigTabSlider4">
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        @foreach ($bd_deal_of_seasons as $bdDealOfSeason)
                                            <div class="swiper-slide">
                                                <div class="product_item product_item2">
                                                    <a href="{{ route('front.productDetails', ['slug' => $bdDealOfSeason->slug]) }}"
                                                        class="product_img hover_color">
                                                        <img src="{{ $bdDealOfSeason->thumbnail }}"
                                                            onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholderbg.png') }}';" />
                                                        <div class="offer_text">{{ __('auth.bennebos_offer') }}</div>
                                                    </a>
                                                    <div class="product_content">
                                                        <h3>
                                                            <a
                                                                href="{{ route('front.productDetails', ['slug' => $bdDealOfSeason->slug]) }}">{{ $bdDealOfSeason->name }}</a>
                                                        </h3>
                                                        <div
                                                            class="product_cart_ratting_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                                            <div class="product_ratting_area">
                                                                <img src="{{ asset('assets/front/images/icon/star_single.svg') }}"
                                                                    alt="" />
                                                                {!! product_avg_review($bdDealOfSeason->id) !!}
                                                                <span>({{ product_review($bdDealOfSeason->id) }}
                                                                    Reviews)</span>
                                                            </div>
                                                        </div>

                                                        @if ($bdDealOfSeason->discount > 0)
                                                            <div class="product_price product_price_side">
                                                                <h4>₺{{ calculateDiscount($bdDealOfSeason->unit_price, $bdDealOfSeason->discount) }}
                                                                </h4>
                                                                <h4 class="discount_price">
                                                                    <del>₺{{ $bdDealOfSeason->unit_price }}</del>
                                                                </h4>
                                                            </div>
                                                        @else
                                                            <div class="product_price product_price_side">
                                                                <h4>₺{{ $bdDealOfSeason->unit_price }}</h4>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab_item3" id="bigTabSlider5">
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        @foreach ($bd_big_needs as $bdBigNeeds)
                                            <div class="swiper-slide">
                                                <div class="product_item product_item2">
                                                    <a href="{{ route('front.productDetails', ['slug' => $bdBigNeeds->slug]) }}"
                                                        class="product_img hover_color">
                                                        <img src="{{ $bdBigNeeds->thumbnail }}"
                                                            onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholderbg.png') }}';" />
                                                        <div class="offer_text">{{ __('auth.bennebos_offer') }}</div>
                                                    </a>
                                                    <div class="product_content">
                                                        <h3>
                                                            <a
                                                                href="{{ route('front.productDetails', ['slug' => $bdBigNeeds->slug]) }}">{{ $bdBigNeeds->name }}</a>
                                                        </h3>
                                                        <div
                                                            class="product_cart_ratting_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                                            <div class="product_ratting_area">
                                                                <img src="{{ asset('assets/front/images/icon/star_single.svg') }}"
                                                                    alt="" />
                                                                {!! product_avg_review($bdBigNeeds->id) !!}
                                                                <span>({{ product_review($bdBigNeeds->id) }}
                                                                    Reviews)</span>
                                                            </div>
                                                        </div>
                                                        @if ($bdBigNeeds->discount > 0)
                                                            <div class="product_price product_price_side">
                                                                <h4>₺{{ calculateDiscount($bdBigNeeds->unit_price, $bdBigNeeds->discount) }}
                                                                </h4>
                                                                <h4 class="discount_price">
                                                                    <del>₺{{ $bdBigNeeds->unit_price }}</del>
                                                                </h4>
                                                            </div>
                                                        @else
                                                            <div class="product_price product_price_side">
                                                                <h4>₺{{ $bdBigNeeds->unit_price }}</h4>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab_item3" id="bigTabSlider6">
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        @foreach ($bd_big_quantity as $bdBigQuantity)
                                            <div class="swiper-slide">
                                                <div class="product_item product_item2">
                                                    <a href="{{ route('front.productDetails', ['slug' => $bdBigQuantity->slug]) }}"
                                                        class="product_img hover_color">
                                                        <img src="{{ $bdBigQuantity->thumbnail }}"
                                                            onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholderbg.png') }}';" />
                                                        <div class="offer_text">{{ __('auth.bennebos_offer') }}</div>
                                                    </a>
                                                    <div class="product_content">
                                                        <h3>
                                                            <a
                                                                href="{{ route('front.productDetails', ['slug' => $bdBigQuantity->slug]) }}">{{ $bdBigQuantity->name }}</a>
                                                        </h3>
                                                        <div
                                                            class="product_cart_ratting_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                                            <div class="product_ratting_area">
                                                                <img src="{{ asset('assets/front/images/icon/star_single.svg') }}"
                                                                    alt="" />
                                                                {!! product_avg_review($bdBigQuantity->id) !!}
                                                                <span>({{ product_review($bdBigQuantity->id) }}
                                                                    Reviews)</span>
                                                            </div>
                                                        </div>
                                                        @if ($bdBigQuantity->discount > 0)
                                                            <div class="product_price product_price_side">
                                                                <h4>₺{{ calculateDiscount($bdBigQuantity->unit_price, $bdBigQuantity->discount) }}
                                                                </h4>
                                                                <h4 class="discount_price">
                                                                    <del>₺{{ $bdBigQuantity->unit_price }}</del>
                                                                </h4>
                                                            </div>
                                                        @else
                                                            <div class="product_price product_price_side">
                                                                <h4>₺{{ $bdBigQuantity->unit_price }}</h4>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section  -->
    <section class="bennebos_banner_wrapper">
        <div class="my-container">
            <div class="top_banner_area text-center">
                <a href="#">
                    <img src="{{ asset('assets/front/images/home/product_banner_img_3.png') }}"
                        alt="product_banner_img" />
                </a>
            </div>
        </div>
    </section>
    <!-- Category  Section  -->
    <section class="category_product_wrapper" wire:ignore>
        <div class="my-container">
            @foreach ($subCategorytopFive as $key => $sctItem)
                <div class="category_left_area">
                    <div class="header_title_bar_area">
                        <h3>{{ $sctItem->getTranslation('name') }}</h3>
                    </div>
                    <div class="category_left_grid">
                        <div class="categroy_left_img_area divide_line_two">
                            <a href="{{ route('front.category.products', ['slug' => $sctItem->slug]) }}">
                                <img src="{{ asset('assets/images/placeholder.png') }}"
                                    data-original="{{ $sctItem->featured_image }}"
                                    onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder.png') }}';"
                                    class="category_img category-image" />
                            </a>
                            <div class="divide_line_grid_area">
                                <div class="divide_line_grid">
                                    @foreach (subCategoryFeaturedProducts($sctItem->id) as $pinnedProduct)
                                        <div class="divide_product_item">
                                            <a
                                                href="{{ route('front.productDetails', ['slug' => $pinnedProduct->slug]) }}">
                                                <img src="{{ asset('assets/images/placeholder.png') }}"
                                                    data-original="{{ $pinnedProduct->thumbnail }}"
                                                    onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder.png') }}';" />
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="divide_line_third"></div>
                            </div>
                        </div>
                        <div>
                            <div
                                class="@if ($key == '0') customer-electronics @elseif($key == '1') apparel @elseif($key == '2') vehicles @elseif($key == '3') vehicles1 @elseif($key == '4') vehicles2 @endif position-relative">
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        @foreach (subCategoryProducts($sctItem->id) as $subCatProduct)
                                            <div class="swiper-slide">
                                                <div class="product_item">
                                                    <a href="{{ route('front.productDetails', ['slug' => $subCatProduct->slug]) }}" class="product_img hover_color">
                                                        <img src="{{ asset('assets/images/placeholder.png') }}"
                                                        data-original="{{ $subCatProduct->thumbnail }}"
                                                        onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder.png') }}';" />
                                                        {{-- <div class="offer_text">Bennebos Offer</div> --}}
                                                    </a>
                                                    <button type="button" class="best_cart_btn add_to_cart_catitem @if (checkIfWishlisted($subCatProduct->id) > 0) dealsBookarkActive @endif"
                                                        id="dealsCartButton" data-id="{{ $subCatProduct->id }}">
                                                        <svg width="22" height="20" viewBox="0 0 22 20"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M19.3115 2.46071C16.9773 0.0803204 14.2743 1.08425 12.6007 2.14593C11.655 2.74582 10.345 2.74582 9.39929 2.14593C7.72564 1.08427 5.02272 0.0803466 2.68853 2.46072C-2.85249 8.11136 6.64988 19 11 19C15.3502 19 24.8525 8.11136 19.3115 2.46071Z"
                                                                stroke="#424C60" stroke-width="1.5"
                                                                stroke-linecap="round"></path>
                                                        </svg>
                                                    </button>
                                                    <div class="product_content">
                                                        <h3>
                                                            <a href="{{ route('front.productDetails', ['slug' => $subCatProduct->slug]) }}">{{ $subCatProduct->name }}</a>
                                                        </h3>
                                                        <div
                                                            class="product_cart_ratting_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                                            <div class="product_ratting_area">
                                                                <img src="{{ asset('assets/front/images/icon/star_single.svg') }}"
                                                                    alt="" />
                                                                {!! product_avg_review($subCatProduct->id) !!}
                                                                <span>({{ product_review($subCatProduct->id) }} Reviews)</span>
                                                            </div>
                                                        </div>
                                                        @if ($subCatProduct->discount > 0)
                                                            <div class="product_price product_price_side">
                                                                <div class="percentage_offer">{{ $subCatProduct->discount }}%</div>
                                                                <h4>₺{{ calculateDiscount($subCatProduct->unit_price, $subCatProduct->discount) }}
                                                                </h4>
                                                                <h4 class="discount_price">
                                                                    <del>₺{{ $subCatProduct->unit_price }}</del>
                                                                </h4>
                                                            </div>
                                                        @else
                                                            <div class="product_price product_price_side">
                                                                <h4>₺{{ $subCatProduct->unit_price }}</h4>
                                                            </div>
                                                            <br>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div
                                    class="@if ($key == '0') customer-electronics-swiper-button-next @elseif($key == '1') apparel-swiper-button-next @elseif($key == '2') vehicles-swiper-button-next  @elseif($key == '3') vehicles1-swiper-button-next  @elseif($key == '4') vehicles2-swiper-button-next @endif swiper-button-next slider_single_next_arrow">
                                </div>
                                <div
                                    class="@if ($key == '0') customer-electronics-swiper-button-prev @elseif($key == '1') apparel-swiper-button-prev @elseif($key == '2') vehicles-swiper-button-prev  @elseif($key == '3') vehicles1-swiper-button-prev  @elseif($key == '4') vehicles2-swiper-button-prev @endif swiper-button-prev slider_single_prev_arrow">
                                </div>
                            </div>
                            <div class="category_bottom_slider_area">
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        @foreach (subCategoryFeaturedBrands($sctItem->id) as $scBrand)
                                            <div class="swiper-slide">
                                                <a
                                                    href="{{ route('front.brand.products', ['slug' => $scBrand->slug]) }}">
                                                    <img src="{{ $scBrand->logo }}" alt="{{ $scBrand->name }}" />
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>


    <!-- Fetures Product Section  -->
    @if ($middle_banner != null)
        <section class="banner_features_wrapper default_section_gap" wire:ignore>
            <div class="my-container">
                <div class="banner_product_item">
                    <div class="banner_product_img">
                        <a href="{{ route('discount-products') }}">
                            <img data-original="{{ $middle_banner->banner }}" />
                        </a>
                    </div>
                    <h4>
                        <a href="{{ route('discount-products') }}">
                            <span>{{ $middle_banner->title }}</span>
                            <span>Start shopping
                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.0156 5.79512L18.1359 13.9083L10.0156 22.0215" stroke="white"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </a>
                    </h4>
                </div>
            </div>
        </section>
    @endif

    <!-- Banner Product Section  -->
    @if ($subCategoryF9->count() > 0)
        <section class="banner_product_wrapper default_section_gap" wire:ignore>
            <div class="my-container">
                <div class="banner_product_grid">
                    @foreach ($subCategoryF9 as $f9Item)
                        <div class="banner_product_item">
                            <div class="banner_product_img">
                                <a href="{{ route('front.category.products', ['slug' => $f9Item->slug]) }}">
                                    <img src="{{ asset('assets/images/placeholderbg.png') }}"
                                        data-original="{{ $f9Item->banner }}"
                                        onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholderbg.png') }}';"
                                        alt="" />
                                </a>
                            </div>
                            <h4>
                                <a href="{{ route('front.category.products', ['slug' => $f9Item->slug]) }}">
                                    <span>{{ $f9Item->getTranslation('name') }}</span> </a>
                            </h4>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Fetures Product Section  -->
    @if ($bottom_banner != null)
        <section class="banner_features_wrapper default_section_gap" wire:ignore>
            <div class="my-container">
                <div class="banner_product_item">
                    <div class="banner_product_img">
                        <a href="{{ route('discount-products') }}">
                            <img data-original="{{ $bottom_banner->banner }}"
                                onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholderbg.png') }}';" />
                        </a>
                    </div>
                    <h4>
                        <a href="{{ route('discount-products') }}">
                            <span>{{ $bottom_banner->title }}</span>
                            <span>Start shopping
                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.0156 5.79512L18.1359 13.9083L10.0156 22.0215" stroke="white"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </a>
                    </h4>
                </div>
            </div>
        </section>
    @endif

    @if ($subCategoryT_all->count() > 0)
        <section class="banner_product_wrapper default_section_gap">
            <div class="my-container">
                <div class="banner_product_grid">
                    @foreach ($subCategoryT_all as $key => $tAllItem)
                        <div class="banner_product_item">
                            @if ($key <= 8)
                                <div class="banner_product_img" wire:ignore>
                                    <a href="{{ route('front.category.products', ['slug' => $tAllItem->slug]) }}">
                                        <img src="{{ asset('assets/images/placeholderbg.png') }}"
                                            data-original="{{ $tAllItem->banner }}"
                                            onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholderbg.png') }}';"
                                            alt="" />
                                    </a>
                                </div>
                            @else
                                <div class="banner_product_img">
                                    <a href="{{ route('front.category.products', ['slug' => $tAllItem->slug]) }}">
                                        <img src="{{ $tAllItem->banner }}" />
                                    </a>
                                </div>
                            @endif
                            <h4>
                                <a href="{{ route('front.category.products', ['slug' => $tAllItem->slug]) }}">
                                    <span>{{ $tAllItem->getTranslation('name') }}</span> </a>
                            </h4>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <div class="text-center" style="margin-top: 50px;">
        <span wire:loading wire:key='loadMore' wire:target='loadMore'>
            <p style=""><i class="fa fa-spinner fa-spin"></i> Loading</p>
        </span>
    </div>
    <!-- Partners Section  -->
    <section class="partner_wrapper default_section_gap" wire:ignore>
        <div class="my-container">
            <div class="partner_slider_area">
                <!-- Swiper -->
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @foreach ($partners as $partner)
                            <div class="swiper-slide">
                                <div class="partner_logo">
                                    <img src="{{ $partner->logo }}" alt="partner_logo_img" />
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination partner_pagination"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer Privacy Section  -->
    <section class="footer_privacy_wrapper default_section_gap">
        <div class="my-container">
            <div class="footer_privacy_grid">
                <div class="footer_privacy_item">
                    <div class="privacy_icon">
                        <img src="{{ asset('assets/front/images/icon/footer_privacy_icon_1.svg') }}"
                            alt="footer privacy icon" />
                    </div>
                    <div>
                        <h4>Fast & Free Shipping</h4>
                        <h5>All orders over $99</h5>
                    </div>
                </div>
                <div class="footer_privacy_item">
                    <div class="privacy_icon">
                        <img src="{{ asset('assets/front/images/icon/footer_privacy_icon_2.svg') }}"
                            alt="footer privacy icon" />
                    </div>
                    <div>
                        <h4>100% Money Guarantee</h4>
                        <h5>30 Days money return</h5>
                    </div>
                </div>
                <div class="footer_privacy_item">
                    <div class="privacy_icon">
                        <img src="{{ asset('assets/front/images/icon/footer_privacy_icon_3.svg') }}"
                            alt="footer privacy icon" />
                    </div>
                    <div>
                        <h4>Support 24/7</h4>
                        <h5>Hotline : <a href="tel:+">(+123) 123 456 788</a></h5>
                    </div>
                </div>
                <div class="footer_privacy_item">
                    <div class="privacy_icon">
                        <img src="{{ asset('assets/front/images/icon/footer_privacy_icon_4.svg') }}"
                            alt="footer privacy icon" />
                    </div>
                    <div>
                        <h4>Safa Payment</h4>
                        <h5>Protect online payment</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Newsletter Section  -->
    <section class="newsletter_wrapper default_section_gap">
        <div class="my-container">
            <div class="newsletter_grid_area">
                <div class="newsletter_grid">
                    <div class="newsletter_form_area">
                        <div class="newletter_content_area">
                            <h3>{{ __('auth.subscribe_newsletter') }}</h3>
                            <h6>Get every new offer and product update immediately</h6>
                        </div>

                        <form id="newsletterForm">
                            <div class="input_row">
                                <input type="email" id='newsletterEmail'
                                    placeholder="{{ __('auth.subscribe_email') }}" />
                            </div>
                            <button type="submit"
                                class="submitNewsletter">{{ __('auth.subscribe_button') }}</button>
                        </form>
                        <p style="font-size: 12px; color: red;" id="error_message"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#newsletterForm').on('submit', function(event) {
                event.preventDefault();
                $('.submitNewsletter').html('<i class="fa fa-spinner fa-spin"></i> ' + $(
                    '.submitNewsletter').html());
                var value = $('#newsletterEmail').val();
                var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

                if (value != '') {
                    if (value.match(validRegex)) {
                        $('#error_message').html('');

                        @this.subscribe(value);

                    } else {
                        $('.submitNewsletter').html('{{ __('auth.subscribe_button') }}');
                        $('#error_message').html('Enter a valid email address');
                    }
                } else {
                    $('.submitNewsletter').html('{{ __('auth.subscribe_button') }}');
                    $('#error_message').html('Enter a valid email address');
                }
            });
        });
        window.addEventListener('resetInput', event => {
            $('#newsletterEmail').val('');
        });
    </script>
    <script>
        if ($(".mercado-countdown").length > 0) {
            $(".mercado-countdown").each(function(index, el) {
                var _this = $(this),
                    _expire = _this.data('expire');
                _this.countdown(_expire, function(event) {
                    $(this).html(event.strftime(
                        '<div class="col-xs-6 col-sm-3 animated rotateIn" id="days"><div class="wrapper"><span class="time">%D</span><span class="label">Days</span></div></div> <div class="col-xs-6 col-sm-3 animated rotateIn" id="days"><div class="wrapper"><span class="time">%H</span><span class="label">Hours</span></div></div> <div class="col-xs-6 col-sm-3 animated rotateIn" id="days"><div class="wrapper"><span class="time">%M</span><span class="label">Minutes</span></div></div> <div class="col-xs-6 col-sm-3 animated rotateIn" id="days"><div class="wrapper"><span class="time">%S</span><span class="label">Seconds</span></div></div>'
                    ));
                });
            });
        }
    </script>
    <script>
        window.addEventListener('success', event => {
            toastr.success(event.detail.message);
        });
        window.addEventListener('warning', event => {
            toastr.warning(event.detail.message);
        });
        window.addEventListener('error', event => {
            toastr.error(event.detail.message);
        });

        $('.add_to_cart_catitem').on('click', function(){
            var id = $(this).data('id');
            @this.wishlist(id);
        });
    </script>
    <script>
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                @this.loadMore();
            }
        });
    </script>
@endpush
