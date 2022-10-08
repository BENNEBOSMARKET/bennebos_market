@section('title')
    {{ __('quotation.qutotations') }}
@endsection
<div>
    <!-- Quotation Info Section  -->
    <section class="quotation_details_wrapper" style="background-image: url(assets/front/images/others/quotatoin_bg.png)">
        <div class="my-container">
            <div class="qutotation_title text-center">
                <h3>{{ __('quotation.title') }}</h3>
                <h4>{{ __('quotation.sub_title') }}</h4>
                <a href="{{ route('rfq-submission') }}" class="submit_quotation_btn">{{ __('quotation.submit_button') }}
                    <span>
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.44531 2.88862L7.55642 5.99973L4.44531 9.11084" stroke="#74C247"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                </a>
            </div>
            <div class="qutotation_counter_area" style="text-align: center;">
                <div class="qutotation_counter_item">
                    <h2 id="counters_2">
                        <span class="counter" data-TargetNum="{{ $quationcategories->count() }}"></span>
                    </h2>
                    <h5>{{ __('quotation.total_categories') }}</h5>
                </div>
                <div class="qutotation_counter_item">
                    <h2 id="counters_3">
                        <span class="counter" data-TargetNum="{{ $total_quotation }}"></span> +
                    </h2>
                    <h5>{{ __('quotation.total_quotation') }}</h5>
                </div>
                <div class="qutotation_counter_item">
                    <h2 id="counters_4">
                        <span class="counter" data-TargetNum="{{ $total_quotes }}"></span> +
                    </h2>
                    <h5>{{ __('quotation.total_quotes') }}</h5>
                </div>
            </div>
        </div>
    </section>
    <!-- RFQ Guid Section  -->
    <section class="rfq_guid_wrapper default_repot_gap">
        <div class="my-container">
            <h4 class="rfq_title">{{ __('quotation.quotations_user_guide') }}</h4>
            <div class="rfq_guid_grid">
                <div class="rfq_guid_item">
                    <div class="rfq_img">
                        <img src="{{ 'assets/front/images/icon/rfq_icon1.svg' }}" alt="" />
                    </div>

                    <div class="rfq_content">
                        <h4>01 {{ __('quotation.submit_button') }}</h4>
                        <p>
                            {{ __('quotation.user_guide_description') }}
                        </p>
                    </div>
                </div>
                <div class="rfq_guid_item">
                    <div class="rfq_img">
                        <img src="{{ 'assets/front/images/icon/rfq_icon2.svg' }}" alt="" />
                    </div>
                    <div class="rfq_content">
                        <h4>02 {{ __('quotation.analyze_quatations') }}</h4>
                        <p>
                            {{ __('quotation.user_guide_description') }}
                        </p>
                    </div>
                </div>
                <div class="rfq_guid_item">
                    <div class="rfq_img">
                        <img src="{{ 'assets/front/images/icon/rfq_icon3.svg' }}" alt="" />
                    </div>
                    <div class="rfq_content">
                        <h4>03 {{ __('quotation.communicate_real_time') }}</h4>
                        <p>
                            {{ __('quotation.user_guide_description') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="report_slider_wrapper default_repot_gap">
        <div class="my-container">
            <div class="repot_slider_title d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                <h3 class="rfq_title">{{ __('quotation.successful_collaborations') }}</h3>
            </div>
            <div class="repot_slider_area" wire:ignore>
                <!-- Swiper -->
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @foreach ($quationsliders as $quationslider)
                            <div class="swiper-slide">
                                <div class="report_slider_item">
                                    <div class="repot_slider_img">
                                        <a href="#">
                                            <img src="{{ $quationslider->image }}"
                                                onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholderbg.png') }}';"
                                                alt="" />
                                        </a>
                                    </div>
                                    <div class="repot_slider_content">
                                        <a href="{{ route('quotations.details', ['slug' => $quationslider->slug]) }}">
                                            <h3>{{ $quationslider->name }}</h3>
                                        </a>
                                        <div class="slider_status_area d-flex align-items-center flex-wrap-wrap">
                                            <img src="{{ 'assets/front/images/icon/star_single.svg' }}"
                                                class="star_img" alt="" />
                                            <span>{{ $quationslider->quantity }}
                                                {{ $quationslider->piece }}</span>
                                            <img src="{{ 'assets/front/images/icon/repot_slider_flag.png' }}"
                                                class="repot_flag" alt="" />
                                            <span>Turkey</span>
                                        </div>
                                        <div
                                            class="slider_more_text_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                            <h4>{{ __('quotation.qutation_amount') }}</h4>
                                            <h4>1 Contact(s) Established</h4>
                                        </div>
                                        <div
                                            class="report_slider_btn_area d-flex align-items-center flex-wrap-wrap g-sm">
                                            @if (isQuoted($quationslider->id))
                                                <a href="javascript:void(0)"
                                                    class="report_slidet_btn repot_green_btn"><i class="fa fa-check"
                                                        style="margin-right: 5px;"></i> Quoted</a>
                                            @else
                                                <a href="#"
                                                    wire:click.prevent="quoteNow({{ $quationslider->id }})"
                                                    class="report_slidet_btn repot_green_btn">{{ __('quotation.quote_now') }}</a>
                                            @endif
                                            <a href="{{ route('rfq-submission') }}"
                                                class="report_slidet_btn">{{ __('quotation.try_REQ') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="slider_arrow d-flex align-items-center">
                    <div class="slider_prev_arrow slider_single_prev_arrow  report_slider_prev">
                        <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.5 15L1.5 8L8.5 1" stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="slider_next_arrow slider_single_next_arrow  report_slider_next">
                        <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.5 1L8.5 8L1.5 15" stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Report Tab Section  -->
    <section class="report_tab_wrapper default_repot_gap">
        <div class="my-container">
            <div class="rfq_header_area">
                <h3 class="rfq_title">{{ __('quotation.most_recent_RFQ') }}</h3>
                <p>
                    {{ __('quotation.user_guide_description') }}
                </p>
            </div>
            <div class="repot_slider_title d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                <h3 class="tab_title">{{ __('quotation.categories') }}</h3>
            </div>
            <div class="report_tab_slider_area" wire:ignore>
                <!-- Swiper -->
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="report_tab_button_area">
                                <button type="button" class="tablinks tabActiveButton">
                                    <div class="tab_icon">
                                        <svg width="24" height="27" viewBox="0 0 24 27" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M0.815474 4.13818C0 5.6316 0 7.61293 0 11.5756V15.7264C0 15.8115 0 15.854 0.000388219 15.89C0.0395173 19.5156 2.9691 22.4452 6.59472 22.4843C6.63069 22.4847 6.67322 22.4847 6.75827 22.4847L6.77344 22.4847C7.13077 22.4867 7.47237 22.632 7.72159 22.8881L7.73212 22.899L8.1574 23.3409C9.96278 25.2166 10.8655 26.1544 12 26.1544C13.1345 26.1544 14.0372 25.2166 15.8426 23.3409L16.2679 22.899L16.2784 22.8881C16.5276 22.632 16.8692 22.4867 17.2266 22.4847L17.2417 22.4847C17.3268 22.4847 17.3693 22.4847 17.4053 22.4843C21.0309 22.4452 23.9605 19.5156 23.9996 15.89C24 15.854 24 15.8115 24 15.7264V11.5756C24 7.61294 24 5.6316 23.1845 4.13818C22.572 3.01648 21.65 2.09447 20.5283 1.48198C19.0349 0.666504 17.0536 0.666504 13.0909 0.666504H10.9091C6.94643 0.666504 4.9651 0.666504 3.47167 1.48198C2.34997 2.09447 1.42797 3.01648 0.815474 4.13818ZM13.0671 6.76379C14.1829 6.05601 15.9848 5.38672 17.541 6.97365C21.235 10.7407 14.9001 17.9998 12 17.9998C9.09992 17.9998 2.76501 10.7407 6.45902 6.97365C8.01514 5.38674 9.81709 6.05602 10.9329 6.76379C11.5633 7.16371 12.4367 7.16371 13.0671 6.76379Z"
                                                fill="#13192B" />
                                        </svg>
                                    </div>
                                    <h3>{{ __('quotation.recommended_for_you') }}</h3>
                                </button>
                            </div>
                        </div>
                        @foreach ($quationcategories as $quationcategory)
                            <div class="swiper-slide">
                                <div class="report_tab_button_area">
                                    <button type="button" class="tablinks btn_{{ $quationcategory->id }}"
                                        id="mainCategoryTabButton" data-category_id="{{ $quationcategory->id }}">
                                        <div class="tab_icon">
                                            <img src="{{ $quationcategory->icon_image }}"
                                                alt="">
                                        </div>
                                        <h3>{{ $quationcategory->name }}</h3>
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
                    <div class="slider_next_arrow slider_single_next_arrow report_tab_slider_next">
                        <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.5 1L8.5 8L1.5 15" stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="report_tab_content_area">

                <div class="tab_item" id="reportTabSlider1"
                    style="@if ($tabStatus == 0) display: block; @endif">
                    <div class="report_tab_slider_grid ">
                        @foreach ($recomandedquations as $recomandedquation)
                            <div class="report_slider_item">
                                <div class="repot_slider_img">
                                    <a href="{{ route('quotations.details', ['slug' => $recomandedquation->slug]) }}">
                                        <img src="{{ asset('assets/images/placeholderbg.png') }}" />
                                    </a>
                                </div>
                                <div class="repot_slider_content">
                                    <a href="{{ route('quotations.details', ['slug' => $recomandedquation->slug]) }}">
                                        <h3>{{ $recomandedquation->name }}</h3>
                                    </a>
                                    <div class="slider_status_area d-flex align-items-center flex-wrap-wrap">
                                        <span><b>{{ __('quotation.sourcing_type') }}:</b></span>
                                        <span>{{ $recomandedquation->sourcing_type }}</span>
                                        <span><b>{{ __('quotation.destination') }}:</b></span>
                                        <img src="{{ 'assets/front/images/icon/repot_slider_flag.png' }}"
                                            class="repot_flag" alt="" />
                                        <span>Turkey</span>
                                    </div>
                                    <div
                                        class="slider_more_text_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                        <h4 class="d-flex align-items-center g-sm">
                                            <img src="{{ 'assets/front/images/icon/star_single.svg' }}"
                                                class="star_img" alt="" />
                                            <span>{{ __('quotation.qutation_amount') }}</span>
                                        </h4>
                                        <h4>{{ $recomandedquation->created_at->diffForHumans() }}</h4>
                                    </div>
                                    <div class="report_slider_btn_area d-flex align-items-center flex-wrap-wrap g-sm">
                                        @if (isQuoted($recomandedquation->id))
                                            <a href="javascript:void(0)" class="report_slidet_btn repot_green_btn"><i
                                                    class="fa fa-check" style="margin-right: 5px;"></i> Quoted</a>
                                        @else
                                            <a href="#"
                                                wire:click.prevent="quoteNow({{ $recomandedquation->id }})"
                                                class="report_slidet_btn repot_green_btn">Quote Now</a>
                                        @endif

                                        <a href="{{ route('rfq-submission') }}" class="report_slidet_btn">Try
                                            REQ</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $recomandedquations->links('front-pagination-links') }}
                </div>
                <div class="tab_item" id="reportTabSlider1"
                    style="@if ($tabStatus != 0) display: block; @endif">
                    <div class="report_tab_slider_grid ">
                        @if ($categoryquations != null)
                            @foreach ($categoryquations as $categoryquation)
                                <div class="report_slider_item">
                                    <div class="repot_slider_img">
                                        <img src="#"
                                            onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholderbg.png') }}';"
                                            alt="" />
                                    </div>
                                    <div class="repot_slider_content">
                                        <a
                                            href="{{ route('quotations.details', ['slug' => $categoryquation->slug]) }}">
                                            <h3>{{ $categoryquation->name }}</h3>
                                        </a>
                                        <div class="slider_status_area d-flex align-items-center flex-wrap-wrap">
                                            <span><b>{{ __('quotation.sourcing_type') }}:</b></span>
                                            <span>{{ $categoryquation->sourcing_type }}</span>
                                            <span><b>{{ __('quotation.destination') }}:</b></span>
                                            <img src="{{ 'assets/front/images/icon/repot_slider_flag.png' }}"
                                                class="repot_flag" alt="" />
                                            <span>Turkey</span>
                                        </div>
                                        <div
                                            class="slider_more_text_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                            <h4 class="d-flex align-items-center g-sm">
                                                <img src="{{ 'assets/front/images/icon/star_single.svg' }}"
                                                    class="star_img" alt="" />
                                                <span>{{ __('quotation.qutation_amount') }}</span>
                                            </h4>
                                            <h4>{{ $categoryquation->created_at->diffForHumans() }}</h4>
                                        </div>
                                        <div
                                            class="report_slider_btn_area d-flex align-items-center flex-wrap-wrap g-sm">
                                            <a href="#"
                                                wire:click.prevent="quoteNow({{ $categoryquation->id }})"
                                                class="report_slidet_btn repot_green_btn">Quote Now</a>
                                            <a href="#" class="report_slidet_btn">Try REQ</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    @if ($categoryquations != null)
                        {{ $categoryquations->links('front-pagination-links') }}
                    @endif
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
