@section('title')
    Best Selling Products
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
    <!-- Page Pagination Section  -->
    <section class="page_pagination_wrapper">
        <div class="my-container">
            <ul class="page_pagination_list d-flex align-items-center flex-wrap-wrap">
                <li>
                    <a href="/">Home</a>
                    <img src="{{ asset('assets/front/images/icon/right_arrow.svg') }}" alt="right arrow" />
                </li>

                <li>
                    <a href="{{ route('best-selling-products', ['slug'=>'all']) }}">Best Selling Products</a>
                    <img src="{{ asset('assets/front/images/icon/right_arrow.svg') }}" alt="right arrow" />
                </li>

                @if ($slug != 'all')
                    <li>
                        <a href="{{ route('front.category.products', ['slug'=>$category->slug]) }}">{{ $category->name }}</a>
                        <img src="{{ asset('assets/front/images/icon/right_arrow.svg') }}" alt="right arrow" />
                    </li>
                @endif
            </ul>
        </div>
    </section>

    <!-- Arrivals Product Section  -->
    <section class="new_arrivals_wrapper">
        <div class="my-container">
            <div class="category_product_title">
                <div class="d-flex align-items-center justify-content-between g-sm">
                    <h3>Best Selling Products</h3>
                    <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="mobile_product_list_icon" id="mobileProductCategoryIcon">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M1.5 -0.000976562C0.947715 -0.000976562 0.5 0.446739 0.5 0.999023C0.5 1.55131 0.947715 1.99902 1.5 1.99902H18.5C19.0523 1.99902 19.5 1.55131 19.5 0.999023C19.5 0.446739 19.0523 -0.000976562 18.5 -0.000976562H1.5ZM0.5 6.99902C0.5 6.44674 0.947715 5.99902 1.5 5.99902H18.5C19.0523 5.99902 19.5 6.44674 19.5 6.99902C19.5 7.55131 19.0523 7.99902 18.5 7.99902H1.5C0.947715 7.99902 0.5 7.55131 0.5 6.99902ZM0.5 13C0.5 12.4477 0.947715 12 1.5 12H18.5C19.0523 12 19.5 12.4477 19.5 13C19.5 13.5523 19.0523 14 18.5 14H1.5C0.947715 14 0.5 13.5523 0.5 13Z"
                            fill="#424C60" />
                    </svg>
                </div>
                <div class="d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                    <h4>{{ $total }} items found in Best Selling Products</h4>
                    <div class="d-flex align-items-center g-sm">
                        <div class="d-flex align-items-center g-sm">
                            <img src="{{ asset('assets/front/images/icon/filter.svg') }}" alt="filter icon" />
                            <h5>Sort By</h5>
                        </div>
                        <div class="selectbox_row" wire:ignore>
                            <select class="niceSelect" id="sortProduct">
                                <option value="">Default</option>
                                <option value="1">Price Low to High</option>
                                <option value="2">Price High to Low</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab_content_area" style="margin-top: 25px;">
                <div class="tab_item" style="display:block;">
                    <div class="new_arrival_grid">
                        @foreach ($bestSellingProducts as $bestSellingProduct)
                        <div class="product_item">
                            <a href="{{ route('front.productDetails', ['slug' => $bestSellingProduct->slug]) }}"
                                class="product_img">
                                @if ($bestSellingProduct->thumbnail)
                                    <img src="{{ $bestSellingProduct->thumbnail }}" />
                                @else
                                    <img src="{{ asset('assets/images/placeholder.png') }}" />
                                @endif
                                
                            </a>
                            <button type="button"
                                class="best_cart_btn @if (checkIfWishlisted($bestSellingProduct->id) > 0) dealsBookarkActive @endif"
                                wire:click.prevent="wishlist({{ $bestSellingProduct->id }})" id="dealsCartButton">
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
                                        Fast Delivery : Ships in 2 days
                                    </h4>
                                </div>
                                <h3>
                                    <a
                                        href="{{ route('front.productDetails', ['slug' => $bestSellingProduct->slug]) }}">{{ $bestSellingProduct->name }}</a>
                                </h3>
                                <div
                                    class="product_cart_ratting_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                    <div class="product_ratting_area">
                                        <img src="{{ asset('assets/front/images/icon/star_single.svg') }}"
                                            alt="" />
                                        {{ product_avg_review($bestSellingProduct->id) }}
                                        <span>({{ product_review($bestSellingProduct->id) }} Reviews)</span>
                                    </div>
                                    <div>
                                        <button type="button "
                                            wire:click.prevent="addToCartSingle({{ $bestSellingProduct->id }})"
                                            class="product_cart_btn">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </button>
                                    </div>
                                </div>
    
                                @if ($bestSellingProduct->discount > 0)
                                    <div class="product_price product_price_side">
                                        <div class="percentage_offer">{{ $bestSellingProduct->discount }}%</div>
                                        <h4>₺{{ discountPrice($bestSellingProduct->id) }}</h4>
                                        <h4 class="discount_price">
                                            <del>₺{{ $bestSellingProduct->unit_price }}</del>
                                        </h4>
                                    </div>
                                @else
                                    <div class="product_price product_price_side">
                                        <h4>₺{{ $bestSellingProduct->unit_price }}</h4>
                                    </div>
                                @endif
    
                                <p class="bottom_text">
                                    {{-- 96,69 TL'den Başlayan Taksitlerle --}}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{ $bestSellingProducts->links('front-pagination-links') }}
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
    <script>
        $(document).ready(function(){
            $('#sortProduct').on('change', function(){
                @this.set('sortType', $(this).val());
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