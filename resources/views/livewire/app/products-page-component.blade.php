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
    </style>
    <!-- Page Pagination Section  -->
    <section class="page_pagination_wrapper">
        <div class="my-container">
            <ul class="page_pagination_list d-flex align-items-center flex-wrap-wrap">
                <li>
                    <a href="/">{{ __('auth.home') }}</a>
                    <img src="{{ asset('assets/front/images/icon/right_arrow.svg') }}" alt="right arrow" />
                </li>
                @if ($allCategories != '')
                    <li>
                        Categories
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
                @elseif ($sortByBrand != '')
                    <li>
                        Brands
                        <img src="{{ asset('assets/front/images/icon/right_arrow.svg') }}" alt="right arrow" />
                    </li>
                    <li>
                        <a href="javascript:void(0)">{{ brand($sortByBrand)->name }}</a>
                        <img src="{{ asset('assets/front/images/icon/right_arrow.svg') }}" alt="right arrow" />
                    </li>
                @else
                    <li>
                        All Products
                        <img src="{{ asset('assets/front/images/icon/right_arrow.svg') }}" alt="right arrow" />
                    </li>
                @endif
            </ul>
        </div>
    </section>

    <!-- Category Product Section  -->
    <section class="category_product_page_details_wrapper">
        <div class="my-container">
            <div class="category_product_grid">
                <div class="category_list_area" id="categoryListArea">
                    <div class="mobile_category_list_close_area">
                        <i class="fa-solid fa-xmark" id="mobileCategoryCloseIcon"> </i>
                    </div>

                    <form action="" class="brand_form">

                        <div class="category_list_title skeleton_single_text" wire:ignore>
                            <button type="button" class="d-flex align-items-center justify-content-between">
                                <span>{{ __('auth.category') }}</span>
                            </button>
                        </div>

                        <div class="selectbox_row skeleton_single_text" wire:ignore>
                            <select id="categorySelect" class="niceSelect">
                                <option value="">{{ __('auth.all_categories') }}</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @if (request('slug') == $category->name) selected @endif>
                                        {{ $category->getTranslation('name') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="category_list_title skeleton_single_text" wire:ignore>
                            <button type="button" class="d-flex align-items-center justify-content-between">
                                <span>{{ __('auth.product_brand') }}</span>
                            </button>
                        </div>

                        <div class="selectbox_row skeleton_single_text" wire:ignore>
                            <select id="brandSelect" class="niceSelect">
                                <option value="">{{ __('auth.all_brands') }}</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="category_list_title skeleton_single_text" wire:ignore>
                            <button type="button" class="d-flex align-items-center justify-content-between">
                                <span>{{ __('auth.reviews') }}</span>
                            </button>
                        </div>

                        <div class="selectbox_row star_select_row skeleton_single_text" wire:ignore>
                            <select id="rattingSelect" class="ratting_select">
                                <option value="">{{ __('auth.product_all') }}</option>
                                <option value="5">{{ __('auth.star5') }}</option>
                                <option value="4">{{ __('auth.star4') }}</option>
                                <option value="3">{{ __('auth.star3') }}</option>
                                <option value="2">{{ __('auth.star2') }}</option>
                                <option value="1">{{ __('auth.star1') }}</option>
                            </select>
                            <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" class="star_icon"
                                alt="star icon" />
                        </div>

                        <div class="category_list_title skeleton_single_text" wire:ignore>
                            <button type="button" class="d-flex align-items-center justify-content-between">
                                <span>{{ __('auth.price') }}</span>
                            </button>
                        </div>

                        <div class="selectbox_row skeleton_single_text" wire:ignore>
                            <select id="sortByPriceRange" wire:model='sortByPriceRange' class="niceSelect">
                                <option value="">{{ __('auth.product_all') }}</option>
                                <option value="10,50">₺10-₺50</option>
                                <option value="51,100">₺51-₺100</option>
                                <option value="101,150">₺101-₺150</option>
                                <option value="151,200">₺151-₺200</option>
                                <option value="201,250">₺201-₺250</option>
                                <option value="251,300">₺251-₺300</option>
                                <option value="301,350">₺301-₺350</option>
                                <option value="351,400">₺351-₺400</option>
                                <option value="401,450">₺401-₺450</option>
                                <option value="451,500">₺451-₺500</option>
                                <option value="501,550">₺501-₺550</option>
                                <option value="551,600">₺551-₺600</option>
                                <option value="601,650">₺601-₺650</option>
                                <option value="651,700">₺651-₺700</option>
                                <option value="701,750">₺701-₺750</option>
                                <option value="751,800">₺751-₺800</option>
                                <option value="801,450">₺801-₺850</option>
                                <option value="851,900">₺851-₺900</option>
                                <option value="901,950">₺901-₺950</option>
                                <option value="951,1000">₺951-₺1000</option>
                                <option value="1001,1500">₺1001-₺1500</option>
                                <option value="1551,2000">₺1551-₺2000</option>
                                <option value="2000,10000000"> >₺2000</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="category_product_area">
                    <div class="category_product_title">
                        <div class="d-flex align-items-center justify-content-between g-sm">
                            <h3>
                                @if ($selected_category != '')
                                    {{ category($selected_category)->getTranslation('name') }}
                                @elseif ($sortByBrand != '')
                                    {{ brand($sortByBrand)->name }}
                                @else
                                    {{ __('auth.all_products') }}
                                @endif
                            </h3>
                            <svg width="20" height="14" viewBox="0 0 20 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="mobile_product_list_icon"
                                id="mobileProductCategoryIcon">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M1.5 -0.000976562C0.947715 -0.000976562 0.5 0.446739 0.5 0.999023C0.5 1.55131 0.947715 1.99902 1.5 1.99902H18.5C19.0523 1.99902 19.5 1.55131 19.5 0.999023C19.5 0.446739 19.0523 -0.000976562 18.5 -0.000976562H1.5ZM0.5 6.99902C0.5 6.44674 0.947715 5.99902 1.5 5.99902H18.5C19.0523 5.99902 19.5 6.44674 19.5 6.99902C19.5 7.55131 19.0523 7.99902 18.5 7.99902H1.5C0.947715 7.99902 0.5 7.55131 0.5 6.99902ZM0.5 13C0.5 12.4477 0.947715 12 1.5 12H18.5C19.0523 12 19.5 12.4477 19.5 13C19.5 13.5523 19.0523 14 18.5 14H1.5C0.947715 14 0.5 13.5523 0.5 13Z"
                                    fill="#424C60" />
                            </svg>
                        </div>
                        <div class="d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                            <h4>
                                @if ($sortByCategory != '')
                                    {{ $products->count() }} items found in {{ category($sortByCategory)->getTranslation('name') }}
                                @elseif ($sortByBrand != '')
                                    {{ $products->count() }} items found in {{ brand($sortByBrand)->name }}
                                @endif
                            </h4>
                            <div class="d-flex align-items-center g-sm">
                                <div class="d-flex align-items-center g-sm">
                                    <img src="{{ asset('assets/front/images/icon/filter.svg') }}"
                                        alt="filter icon" />
                                    <h5>{{ __('auth.sort_by') }}</h5>
                                </div>
                                <div class="selectbox_row skeleton_single_text" wire:ignore>
                                    <select id='sortProduct' class="niceSelect">
                                        <option value="">{{ __('auth.filter_products') }}</option>
                                        <option value="low_to_high">{{ __('auth.price_low_to_high') }}</option>
                                        <option value="high_to_low">{{ __('auth.price_high_to_low') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="category_product_inner_grid">
                        @if ($products->count() > 0)
                            @foreach ($products as $key => $product)
                                <div class="product_item">
                                    <a href="{{ route('front.productDetails', ['slug' => $product->slug]) }}"
                                        class="product_img">
                                        @if ($product->thumbnail)
                                            <img src="{{ $product->thumbnail }}"
                                                alt="{{ $product->name }}" />
                                        @else
                                            <img src="{{ asset('assets/images/placeholder.png') }}"
                                                alt="{{ $product->name }}" />
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
                                            <img src="{{ asset('assets/front/images/icon/delivery-truck.svg') }}"
                                                alt="" class="deliver_img" />
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
                            @endforeach
                        @else
                            No Products Found
                        @endif
                    </div>
                    {{ $products->links('front-pagination-links') }}
                </div>
            </div>
        </div>
        <div class="category_list_overlay" id="categoryOverlay"></div>
    </section>
</div>

@push('scripts')
    <script>
        $('document').ready(function() {
            $('#sortProduct').on('change', function() {
                @this.set('sortByPrice', $(this).val());
            });
            $('#orderByMinOrder').on('change', function() {
                @this.set('orderByMinOrder', $(this).val());
            });
            $('#rattingSelect').on('change', function() {
                @this.set('sortByReview', $(this).val());
            });

            $('#sortByPriceRange').on('change', function() {
                @this.set('sortByPriceRange', $(this).val());
            });


            $('#categorySelect').on('change', function() {
                @this.selectCategory($(this).val());
            });

            $('#brandSelect').on('change', function() {
                @this.selectBrand($(this).val());
            });
        });
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
    </script>
@endpush
