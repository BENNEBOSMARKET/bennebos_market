@section('title')
    Tüm Kategoriler
@endsection
<div>
    <style>
        .category_list {
            display: -ms-grid;
            display: grid;
            -ms-grid-columns: minmax(0, 1fr) minmax(0, 1fr);
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            -webkit-box-align: start;
            -ms-flex-align: start;
            align-items: start;
            gap: 1px 50px;
        }
    </style>
    <section class="page_pagination_wrapper">
        <div class="my-container">
            <ul class="page_pagination_list d-flex align-items-center flex-wrap-wrap">
                <li>
                    <a href="/">Home</a>
                    <img src="{{ asset('assets/front/images/icon/right_arrow.svg') }}" alt="right arrow" />
                </li>

                <li>
                    Tüm Kategoriler
                    <img src="{{ asset('assets/front/images/icon/right_arrow.svg') }}" alt="right arrow" />
                </li>
            </ul>
        </div>
    </section>

    <!-- Report Tab Section  -->
    <section class="report_tab_wrapper all_category_tab_wrapper">
        <div class="my-container">
            <div class="repot_slider_title d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                <h4 class="rfq_title">All Category</h4>
            </div>
            <div class="report_tab_slider_area" wire:ignore style="user-select: none;">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="report_tab_button_area">
                                <button type="button" class="tablinks tabActiveButton">
                                    <div class="tab_icon">
                                        <img src="{{ asset('assets/images/placeholder_rounded.png') }}" />
                                    </div>
                                    <div>
                                        <h3>All Category</h3>
                                        {{-- <h4>{{ DB::table('products')->count() }} Itemd</h4> --}}
                                    </div>
                                </button>
                            </div>
                        </div>
                        @foreach ($maincategories as $maincategory)
                            <div class="swiper-slide">
                                <div class="report_tab_button_area">
                                    <button type="button" class="tablinks btn_{{ $maincategory->id }}"
                                        id="mainCategoryTabButton" data-category_id="{{ $maincategory->id }}">
                                        <div class="tab_icon">
                                            <img src="{{ $maincategory->banner }}" alt="{{ $maincategory->name }}"
                                                onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder_rounded.png') }}';" />
                                        </div>
                                        <div>
                                            <h3>{{ $maincategory->getTranslation('name') }}</h3>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="slider_arrow d-flex align-items-center">
                    <div class="slider_prev_arrow slider_single_prev_arrow  report_tab_slider_prev">
                        <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.5 15L1.5 8L8.5 1" stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="slider_next_arrow slider_single_next_arrow  report_tab_slider_next">
                        <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.5 1L8.5 8L1.5 15" stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="report_tab_content_area">
                <div class="category_tab_content_grid">
                    <div class="category_tab_area">
                        <div class="tab_item" id="reportTabSlider1"
                            style="@if ($tabStatus == 0) display: block; @endif">
                            @foreach ($maincategories as $maincategory)
                                <div class="category_tab_inner_area">
                                    <h3 class="cate_tab_title">{{ $maincategory->getTranslation('name') }}</h3>
                                    <div class="category_tab_outer_grid">
                                        @foreach (subCategories($maincategory->id) as $subCategory)
                                            <div class="category_tab_outer_area">
                                                <h4><a
                                                        href="{{ route('front.allProducts', ['slug' => $subCategory->slug]) }}">{{ $subCategory->getTranslation('name') }}</a>
                                                </h4>
                                                <ul class="category_list" style="margin-top: 10px;">
                                                    @foreach (subSubCategories($subCategory->id) as $key => $subSubCategory)
                                                        <li><a
                                                                href="{{ route('front.allProducts', ['slug' => $subSubCategory->slug]) }}">{{ $subSubCategory->getTranslation('name') }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="tab_item" id="reportTabSlider1"
                            style="@if ($tabStatus != 0) display: block; @endif">
                            @if ($selectedCategory != '')
                                <div class="category_tab_inner_area">
                                    <h3 class="cate_tab_title">{{ $selectedCategory->getTranslation('name') }}</h3>
                                    <div class="category_tab_outer_grid">
                                        @foreach (subCategories($selectedCategory->id) as $subCategory)
                                            <div class="category_tab_outer_area">
                                                <h4><a
                                                        href="{{ route('front.allProducts', ['slug' => $subCategory->slug]) }}">{{ $subCategory->getTranslation('name') }}</a>
                                                </h4>
                                                <div class="category_tab_inner_grid">
                                                    <ul class="category_list">
                                                        @foreach (subSubCategories($subCategory->id) as $key => $subSubCategory)
                                                            @if ($key % 2 == 0)
                                                                <li><a
                                                                        href="{{ route('front.allProducts', ['slug' => $subSubCategory->slug]) }}">{{ $subSubCategory->getTranslation('name') }}</a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                    <ul class="category_list">
                                                        @foreach (subSubCategories($subCategory->id) as $key => $subSubCategory)
                                                            @if ($key % 2 != 0)
                                                                <li><a
                                                                        href="{{ route('front.allProducts', ['slug' => $subSubCategory->slug]) }}">{{ $subSubCategory->getTranslation('name') }}</a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section  -->
    <section class="wrapper">
        <div class="my-container"></div>
    </section>
</div>


@push('scripts')
    <script>
        $(".tablinks").each(function(index) {
            $(this).on("click", function() {
                var val = $(this).data('category_id');
                $('.tablinks').removeClass('tabActiveButton');
                $(this).addClass('tabActiveButton');

                @this.selectCategory(val);
            });
        });
    </script>
@endpush
