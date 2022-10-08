@section('title')
    {{ $shop->name }}
@endsection
<div>
    <!--Sellar Profile Section  -->
    <section class="sellar_profile_wrapper">
        <div class="my-container">
            <div class="cover_img_sellar" style="
              background-image: url(@if($shop->banner) {{ $shop->banner }} @else {{ asset('assets/images/default_cover_shop.png') }} @endif);
            ">
            </div>
            <div class="profile_info_area d-flex justify-content-between flex-wrap-wrap">
                <div class="profile_img_name_area d-flex">
                    <div class="sellar_img_area" wire:ignore>
                        <img src="{{ $shop->logo }}" class="sellar_img"
                            onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder_rounded.png') }}';"
                            alt="sellar img" />
                    </div>
                    <div class="sellar_name_area">
                        <h3>{{ $shop->name }}</h3>
                        <h4 class="d-flex align-items-center g-sm">
                            <img src="{{ asset('assets/front/images/icon/Location.svg') }}" alt="" />
                            <span>{{ $shop->address }}</span>
                        </h4>
                        <h6>{{ $shop_products }} Products</h6>
                    </div>
                </div>
            </div>

            <div class="sellar_profile_tab_wrapper">
                <div class="sellar_tab_button">
                    <button type="button" class="tablinks @if ($tab == 'home') tabActiveButton @endif"
                        wire:click.prevent="changeTab('home')">
                        {{ __('auth.checkout_home') }}
                    </button>
                    <button type="button" class="tablinks @if ($tab == 'products') tabActiveButton @endif"
                        wire:click.prevent="changeTab('products')">
                        {{ __('auth.products') }}
                        <span>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.8327 7.0835L9.99935 12.9168L4.16602 7.0835" stroke="#13192B"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </button>
                    <button type="button" class="tablinks @if ($tab == 'profile') tabActiveButton @endif"
                        wire:click.prevent="changeTab('profile')">
                        {{ __('auth.profile') }}
                        <span>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.8327 7.0835L9.99935 12.9168L4.16602 7.0835" stroke="#13192B"
                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </button>
                </div>
                <div class="tab_content_area">
                    <div class="tab_item" id="categoryTab"
                        style="@if ($tab == 'home') display: block; @endif">
                        <div class="tab_slider_area" wire:ignore>
                            <div
                                class="header_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                <h2 class="page_title">{{ __('auth.recently_added') }}</h2>
                                <div class="sell_all d-flex align-items-center g-sm">
                                    <h4><a href="#">{{ __('auth.see_all') }}</a></h4>
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
                                        @foreach ($shop_recent_products as $product)
                                            <div class="swiper-slide">
                                                <div class="product_item">
                                                    <a href="{{ route('front.productDetails', ['slug' => $product->slug]) }}"
                                                        class="product_img">
                                                        @if ($product->thumbnail)
                                                            <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}" />
                                                        @else
                                                            <img src="{{ asset('assets/images/placeholder.png') }}" alt="{{ $product->name }}" />
                                                        @endif
                                                    </a>
                                                    <button type="button"
                                                        class="best_cart_btn @if (checkIfWishlisted($product->id) > 0) dealsBookarkActive @endif"
                                                        wire:click.prevent="wishlist({{ $product->id }})" id="dealsCartButton">
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
                                                                href="{{ route('front.productDetails', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                                        </h3>
                                                        <div
                                                            class="product_cart_ratting_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                                            <div class="product_ratting_area">
                                                                <img src="{{ asset('assets/front/images/icon/star_single.svg') }}"
                                                                    alt="" />
                                                                {{ product_avg_review($product->id) }}
                                                                <span>({{ product_review($product->id) }} Reviews)  </span>
                                                            </div>
                                                            <div>
                                                                <button type="button "
                                                                    wire:click.prevent="addToCartSingle({{ $product->id }})"
                                                                    class="product_cart_btn">
                                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                                </button>
                                                            </div>
                                                        </div>

                                                        @if ($product->discount > 0)
                                                            <div class="product_price product_price_side">
                                                                <div class="percentage_offer">{{ $product->discount }}%</div>
                                                                <h4>₺{{ discountPrice($product->id) }}</h4>
                                                                <h4 class="discount_price">
                                                                    <del>₺{{ $product->unit_price }}</del>
                                                                </h4>
                                                            </div>
                                                        @else
                                                            <div class="product_price product_price_side">
                                                                <h4>₺{{ $product->unit_price }}</h4>
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

                        <div class="tab_slider_area" wire:ignore>
                            <div
                                class="header_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                <h2 class="page_title">{{ __('auth.recommed_ror_you') }}</h2>
                                <div class="sell_all d-flex align-items-center g-sm">
                                    <h4><a href="#">{{ __('auth.see_all') }}</a></h4>
                                    <!-- Add Arrows -->
                                    <div class="slider_arrow d-flex align-items-center">
                                        <div class="slider_prev_arrow recommed_sellar_slider_prev_arrow">
                                            <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.5 15L1.5 8L8.5 1" stroke="#130F26" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <div class="slider_next_arrow recommed_sellar_slider_next_arrow">
                                            <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.5 1L8.5 8L1.5 15" stroke="#130F26" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="recommend_sellar_product_slider_area">
                                <!-- Swiper -->
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        @foreach ($shop_recomand_products as $product)
                                            <div class="swiper-slide">
                                                <div class="product_item">
                                                    <a href="{{ route('front.productDetails', ['slug' => $product->slug]) }}"
                                                        class="product_img">
                                                        @if ($product->thumbnail)
                                                            <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}" />
                                                        @else
                                                            <img src="{{ asset('assets/images/placeholder.png') }}" alt="{{ $product->name }}" />
                                                        @endif
                                                    </a>
                                                    <button type="button"
                                                        class="best_cart_btn @if (checkIfWishlisted($product->id) > 0) dealsBookarkActive @endif"
                                                        wire:click.prevent="wishlist({{ $product->id }})" id="dealsCartButton">
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
                                                                href="{{ route('front.productDetails', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                                        </h3>
                                                        <div
                                                            class="product_cart_ratting_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                                            <div class="product_ratting_area">
                                                                <img src="{{ asset('assets/front/images/icon/star_single.svg') }}"
                                                                    alt="" />
                                                                {{ product_avg_review($product->id) }}
                                                                <span>({{ product_review($product->id) }} Reviews)</span>
                                                            </div>
                                                            <div>
                                                                <button type="button "
                                                                    wire:click.prevent="addToCartSingle({{ $product->id }})"
                                                                    class="product_cart_btn">
                                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                                </button>
                                                            </div>
                                                        </div>

                                                        @if ($product->discount > 0)
                                                            <div class="product_price product_price_side">
                                                                <div class="percentage_offer">{{ $product->discount }}%</div>
                                                                <h4>₺{{ discountPrice($product->id) }}</h4>
                                                                <h4 class="discount_price">
                                                                    <del>₺{{ $product->unit_price }}</del>
                                                                </h4>
                                                            </div>
                                                        @else
                                                            <div class="product_price product_price_side">
                                                                <h4>₺{{ $product->unit_price }}</h4>
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

                        <div class="tab_slider_area" wire:ignore>
                            <div
                                class="header_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                <h2 class="page_title">{{ __('auth.popular_products') }}</h2>
                                <div class="sell_all d-flex align-items-center g-sm">
                                    <h4><a href="#">{{ __('auth.see_all') }}</a></h4>
                                    <!-- Add Arrows -->
                                    <div class="slider_arrow d-flex align-items-center">
                                        <div class="slider_prev_arrow popular_sellar_slider_prev_arrow">
                                            <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.5 15L1.5 8L8.5 1" stroke="#130F26" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <div class="slider_next_arrow popular_sellar_slider_next_arrow">
                                            <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.5 1L8.5 8L1.5 15" stroke="#130F26" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="popular_sellar_product_slider_area">
                                <!-- Swiper -->
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        @foreach ($shop_popular_products as $product)
                                            <div class="swiper-slide">
                                                <div class="product_item">
                                                    <a href="{{ route('front.productDetails', ['slug' => $product->slug]) }}"
                                                        class="product_img">
                                                        @if ($product->thumbnail)
                                                            <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}" />
                                                        @else
                                                            <img src="{{ asset('assets/images/placeholder.png') }}" alt="{{ $product->name }}" />
                                                        @endif
                                                    </a>
                                                    <button type="button"
                                                        class="best_cart_btn @if (checkIfWishlisted($product->id) > 0) dealsBookarkActive @endif"
                                                        wire:click.prevent="wishlist({{ $product->id }})" id="dealsCartButton">
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
                                                                href="{{ route('front.productDetails', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                                        </h3>
                                                        <div
                                                            class="product_cart_ratting_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                                            <div class="product_ratting_area">
                                                                <img src="{{ asset('assets/front/images/icon/star_single.svg') }}"
                                                                    alt="" />
                                                                {{ product_avg_review($product->id) }}
                                                                <span>({{ product_review($product->id) }} Reviews)</span>
                                                            </div>
                                                            <div>
                                                                <button type="button "
                                                                    wire:click.prevent="addToCartSingle({{ $product->id }})"
                                                                    class="product_cart_btn">
                                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                                </button>
                                                            </div>
                                                        </div>

                                                        @if ($product->discount > 0)
                                                            <div class="product_price product_price_side">
                                                                <div class="percentage_offer">{{ $product->discount }}%</div>
                                                                <h4>₺{{ discountPrice($product->id) }}</h4>
                                                                <h4 class="discount_price">
                                                                    <del>₺{{ $product->unit_price }}</del>
                                                                </h4>
                                                            </div>
                                                        @else
                                                            <div class="product_price product_price_side">
                                                                <h4>₺{{ $product->unit_price }}</h4>
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
                    </div>
                    <div class="tab_item" id="shopTab"
                        style="@if ($tab == 'products') display: block; @endif">
                        <div class="tab_slider_area">
                            <div class="for_your_product_area">
                                @foreach ($shop_all_products as $shop_product)
                                <div class="product_item">
                                    <a href="{{ route('front.productDetails', ['slug' => $shop_product->slug]) }}"
                                        class="product_img">
                                        @if ($shop_product->thumbnail)
                                            <img src="{{ $shop_product->thumbnail }}" alt="{{ $shop_product->name }}" />
                                        @else
                                            <img src="{{ asset('assets/images/placeholder.png') }}" alt="{{ $shop_product->name }}" />
                                        @endif
                                    </a>
                                    <button type="button"
                                        class="best_cart_btn @if (checkIfWishlisted($shop_product->id) > 0) dealsBookarkActive @endif"
                                        wire:click.prevent="wishlist({{ $shop_product->id }})" id="dealsCartButton">
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
                                                href="{{ route('front.productDetails', ['slug' => $shop_product->slug]) }}">{{ $shop_product->name }}</a>
                                        </h3>
                                        <div
                                            class="product_cart_ratting_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                            <div class="product_ratting_area">
                                                <img src="{{ asset('assets/front/images/icon/star_single.svg') }}"
                                                    alt="" />
                                                {{ product_avg_review($shop_product->id) }}
                                                <span>({{ product_review($shop_product->id) }} Reviews)</span>
                                            </div>
                                            <div>
                                                <button type="button "
                                                    wire:click.prevent="addToCartSingle({{ $shop_product->id }})"
                                                    class="product_cart_btn">
                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                </button>
                                            </div>
                                        </div>

                                        @if ($shop_product->discount > 0)
                                            <div class="product_price product_price_side">
                                                <div class="percentage_offer">{{ $shop_product->discount }}%</div>
                                                <h4>₺{{ discountPrice($shop_product->id) }}</h4>
                                                <h4 class="discount_price">
                                                    <del>₺{{ $shop_product->unit_price }}</del>
                                                </h4>
                                            </div>
                                        @else
                                            <div class="product_price product_price_side">
                                                <h4>₺{{ $shop_product->unit_price }}</h4>
                                            </div>
                                        @endif

                                        <p class="bottom_text">
                                            {{-- 96,69 TL'den Başlayan Taksitlerle --}}
                                        </p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            {{ $shop_all_products->links('front-pagination-links') }}
                        </div>
                    </div>
                    <div class="tab_item" id="brandTab"
                        style="@if ($tab == 'profile') display: block; @endif">
                        <div class="tab_slider_area">
                            <div class="sellar_profile_item">
                                <h3 class="sellar_profile_item_title">Overview</h3>
                                <p>
                                    {{ $shop->description }}
                                </p>
                            </div>
                            <div class="sellar_profile_item">
                                <h3 class="sellar_profile_item_title">Photo</h3>
                                <div class="sellar_profile_photo_grid">
                                    @if ($shop->gallery != '')
                                        @foreach (json_decode($shop->gallery) as $gImages)
                                            <img src="{{ $gImages }}" alt="photo" />
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="sellar_profile_item">
                                <h3 class="sellar_profile_item_title">Reviews</h3>
                                <div class="sellar_profile_review_area">
                                    <div class="review_comment_item">
                                        <div class="comment_user_date_area d-flex justify-content-between g-sm">
                                            <div class="comment_user d-flex g-sm">
                                                <img src="{{ asset('assets/front/images/others/review_comment_user.png') }}"
                                                    class="commnent_user_img" alt="user image" />
                                                <div>
                                                    <h5>Kazi Mahbub</h5>
                                                    <img src="{{ asset('assets/front/images/icon/star5.svg') }}"
                                                        class="review_star" alt="star icon" />
                                                </div>
                                            </div>
                                            <h6>24 Mar 2022</h6>
                                        </div>
                                        <p>
                                            I am typically a medium, and the reviews said they
                                            tend to fit small so I ordered large. They are a bit
                                            too big for my liking, but not so much. So if you're a
                                            medium or slightly larger, buy large... If you're on
                                            the smaller side of medium, buy medium.
                                        </p>
                                        <ul class="comment_img_list d-flex align-items-center flex-wrap-wrap g-sm">
                                            <li>
                                                <img src="{{ asset('assets/front/images/product/review_comment_product_img1.png') }}"
                                                    alt="product img" />
                                            </li>
                                            <li>
                                                <img src="{{ asset('assets/front/images/product/review_comment_product_img2.png') }}"
                                                    alt="product img" />
                                            </li>
                                            <li>
                                                <img src="{{ asset('assets/front/images/product/review_comment_product_img3.png') }}"
                                                    alt="product img" />
                                            </li>
                                            <li>
                                                <img src="{{ asset('assets/front/images/product/review_comment_product_img4.png') }}"
                                                    alt="product img" />
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="review_comment_item">
                                        <div class="comment_user_date_area d-flex justify-content-between g-sm">
                                            <div class="comment_user d-flex g-sm">
                                                <img src="{{ asset('assets/front/images/others/review_comment_user.png') }}"
                                                    class="commnent_user_img" alt="user image" />
                                                <div>
                                                    <h5>Kazi Mahbub</h5>
                                                    <img src="{{ asset('assets/front/images/icon/star4.svg') }}"
                                                        class="review_star" alt="star icon" />
                                                </div>
                                            </div>
                                            <h6>24 Mar 2022</h6>
                                        </div>
                                        <p>
                                            I ordered these to wear while I workout and do lawn
                                            work. The Dry Fit (polyester) irritates my skin. These
                                            claim to have moisture wicking technology, but I've
                                            never heard of cool spire.
                                        </p>
                                        <ul class="comment_img_list d-flex align-items-center flex-wrap-wrap g-sm">
                                            <li>
                                                <img src="{{ asset('assets/front/images/product/review_comment_product_img1.png') }}"
                                                    alt="product img" />
                                            </li>
                                            <li>
                                                <img src="{{ asset('assets/front/images/product/review_comment_product_img2.png') }}"
                                                    alt="product img" />
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="review_comment_item">
                                        <div class="comment_user_date_area d-flex justify-content-between g-sm">
                                            <div class="comment_user d-flex g-sm">
                                                <img src="{{ asset('assets/front/images/others/review_comment_user.png') }}"
                                                    class="commnent_user_img" alt="user image" />
                                                <div>
                                                    <h5>Kazi Mahbub</h5>
                                                    <img src="{{ asset('assets/front/images/icon/star3.svg') }}"
                                                        class="review_star" alt="star icon" />
                                                </div>
                                            </div>
                                            <h6>24 Mar 2022</h6>
                                        </div>
                                        <p>
                                            "Men's Crew T-Shirt" with 6" of blouse hanging like a
                                            fool, and an absurd toilet bowl seat of a collar --
                                            purposely disguised (downplayed) in the product
                                            photos.
                                        </p>
                                    </div>
                                    <div class="review_comment_item">
                                        <div class="comment_user_date_area d-flex justify-content-between g-sm">
                                            <div class="comment_user d-flex g-sm">
                                                <img src="{{ asset('assets/front/images/others/review_comment_user.png') }}"
                                                    class="commnent_user_img" alt="user image" />
                                                <div>
                                                    <h5>Kazi Mahbub</h5>
                                                    <img src="{{ asset('assets/front/images/icon/star2.svg') }}"
                                                        class="review_star" alt="star icon" />
                                                </div>
                                            </div>
                                            <h6>24 Mar 2022</h6>
                                        </div>
                                        <p>
                                            Considering the price point, this is precisely the QC
                                            I should've expected from this sorry product --
                                            'proudly' shelved alongside MainStays goods at
                                            WallyWorld. Geez Gildan: I'm done with your company.
                                            These are being sent back.
                                        </p>
                                    </div>
                                    <div class="review_comment_item">
                                        <div class="comment_user_date_area d-flex justify-content-between g-sm">
                                            <div class="comment_user d-flex g-sm">
                                                <img src="{{ asset('assets/front/images/others/review_comment_user.png') }}"
                                                    class="commnent_user_img" alt="user image" />
                                                <div>
                                                    <h5>Kazi Mahbub</h5>
                                                    <img src="{{ asset('assets/front/images/icon/star1.svg') }}"
                                                        class="review_star" alt="star icon" />
                                                </div>
                                            </div>
                                            <h6>24 Mar 2022</h6>
                                        </div>
                                        <p>
                                            I am typically a medium, and the reviews said they
                                            tend to fit small so I ordered large. They are a bit
                                            too big for my liking, but not so much. So if you're a
                                            medium or slightly larger, buy large... If you're on
                                            the smaller side of medium, buy medium.
                                        </p>
                                        <ul class="comment_img_list d-flex align-items-center flex-wrap-wrap g-sm">
                                            <li>
                                                <img src="{{ asset('assets/front/images/product/review_comment_product_img1.png') }}"
                                                    alt="product img" />
                                            </li>
                                            <li>
                                                <img src="{{ asset('assets/front/images/product/review_comment_product_img2.png') }}"
                                                    alt="product img" />
                                            </li>
                                            <li>
                                                <img src="{{ asset('assets/front/images/product/review_comment_product_img3.png') }}"
                                                    alt="product img" />
                                            </li>
                                            <li>
                                                <img src="{{ asset('assets/front/images/product/review_comment_product_img4.png') }}"
                                                    alt="product img" />
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                {{ $shop_all_products->links('front-pagination-links') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
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
    </script>
@endpush