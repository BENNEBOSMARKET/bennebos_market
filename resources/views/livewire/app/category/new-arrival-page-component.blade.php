@section('title')
    New Arrivals
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
                    <a href="#">Home</a>
                    <img src="{{ asset('assets/front/images/icon/right_arrow.svg') }}" alt="right arrow" />
                </li>

                <li>
                    New Arrivals
                    <img src="{{ asset('assets/front/images/icon/right_arrow.svg') }}" alt="right arrow" />
                </li>
            </ul>
        </div>
    </section>

    <!-- Arrivals Product Section  -->
    <section class="new_arrivals_wrapper">
        <div class="my-container">
            <div class="category_product_title">
                <div class="d-flex align-items-center justify-content-between g-sm">
                    <h3>New Arrivals</h3>
                    <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg"
                        class="mobile_product_list_icon" id="mobileProductCategoryIcon">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M1.5 -0.000976562C0.947715 -0.000976562 0.5 0.446739 0.5 0.999023C0.5 1.55131 0.947715 1.99902 1.5 1.99902H18.5C19.0523 1.99902 19.5 1.55131 19.5 0.999023C19.5 0.446739 19.0523 -0.000976562 18.5 -0.000976562H1.5ZM0.5 6.99902C0.5 6.44674 0.947715 5.99902 1.5 5.99902H18.5C19.0523 5.99902 19.5 6.44674 19.5 6.99902C19.5 7.55131 19.0523 7.99902 18.5 7.99902H1.5C0.947715 7.99902 0.5 7.55131 0.5 6.99902ZM0.5 13C0.5 12.4477 0.947715 12 1.5 12H18.5C19.0523 12 19.5 12.4477 19.5 13C19.5 13.5523 19.0523 14 18.5 14H1.5C0.947715 14 0.5 13.5523 0.5 13Z"
                            fill="#424C60" />
                    </svg>
                </div>
                <div class="d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                    <h4>{{ $newproducts->count() }} items arrived this month</h4>
                    <div class="d-flex align-items-center g-sm">
                        <div class="d-flex align-items-center g-sm">
                            <img src="{{ asset('assets/front/images/icon/filter.svg') }}" alt="filter icon" />
                            <h5>Sort By</h5>
                        </div>
                        <div class="selectbox_row" wire:ignore>
                            <select class="niceSelect" id="sortProduct">
                                <option value="">All products</option>
                                <option value="0">Price Low to High</option>
                                <option value="1">Price High to Low</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="new_arrival_tab_area">
                <div class="category_tab_button">
                    <button type="button" wire:click.prevent='selectCategory(0)'
                        class="tablinks @if ($tabStatus == 0) tabActiveButton @endif">
                        Tüm Kategoriler
                    </button>
                    @foreach ($mainCategories as $category)
                        <button type="button" wire:click.prevent='selectCategory({{ $category->id }})'
                            class="tablinks @if ($tabStatus == $category->id) tabActiveButton @endif">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>
            </div>
            <div class="tab_content_area">
                <div class="tab_item" style="display:block;">
                    <div class="new_arrival_grid">
                        @foreach ($newproducts as $discount)
                            <div class="product_item product_item_text">
                                <a href="{{ route('front.productDetails', ['slug' => $discount->slug]) }}" class="product_img hover_color">
                                    <img src="{{ $discount->thumbnail }}" alt="{{ $discount->name }}"
                                        onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholderbg.png') }}';" />
                                </a>
                                <div class="product_content">
                                    <h3>
                                        <a href="{{ route('front.productDetails', ['slug' => $discount->slug]) }}">{{ $discount->name }}</a>
                                    </h3>
                                    <div class="product_ratting_area">
                                        <img src="{{ asset('assets/front/images/icon/star_single.svg') }}" alt="" />
                                        {!! product_avg_review($discount->id) !!}
                                        <span>({{ product_review($discount->id) }} reviews)</span>
                                    </div>

                                    <div class="product_price product_price_side">
                                        <h4>₺{{ discountPrice($discount->id) }}</h4>
                                        <h5 class="discount_price"><del>₺{{ $discount->unit_price }}</del></h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $newproducts->links('front-pagination-links') }}
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
@endpush
