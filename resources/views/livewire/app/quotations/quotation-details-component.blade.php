@section('title')
{{ $quotation->name }}
@endsection
<div>
    <!-- RFQ Details Section  -->
    <section class="rfq_details_wrapper">
        <div class="my-container">
            <div class="rfq_details_grid">
                <div class="rfq_details_left_area">
                    <div class="rfq_card_area">
                        <div class="page_pagination_wrapper">
                            <ul class="page_pagination_list d-flex align-items-center flex-wrap-wrap">
                                <li>
                                    <a href="/">{{ __('auth.company_home') }}</a>
                                    <img src="{{ asset('assets/front/images/icon/right_arrow.svg') }}"
                                        alt="right arrow" />
                                </li>

                                <li>
                                    <a href="{{ route('quotations') }}">Quotations</a>
                                    <img src="{{ asset('assets/front/images/icon/right_arrow.svg') }}"
                                        alt="right arrow" />
                                </li>
                                <li>
                                    {{ $quotation->name }}
                                    <img src="{{ asset('assets/front/images/icon/right_arrow.svg') }}"
                                        alt="right arrow" />
                                </li>
                            </ul>
                        </div>
                        <div class="rfq_profile_content_area">
                            <h3>{{ $quotation->name }}</h3>
                            <ul class="profile_info_list">
                                <li>{{ __('quotation.max_budget') }} : <b>{{ $quotation->max_budget }}</b> {{
                                    $quotation->curency }}</li>
                                <li>{{ __('quotation.quantity_required') }} : <b>{{ $quotation->quantity }}</b>/{{
                                    $quotation->piece }}
                                </li>
                                <li>
                                    {{ __('quotation.destination') }} : {{ $quotation->country }}
                                </li>
                                <li>{{ __('quotation.date_posted') }} : {{ $quotation->created_at }}</li>
                            </ul>
                            <div class="user_profile_area">
                                <img src="{{ asset('assets/front/images/others/user_img_3.png') }}" alt="use img"
                                    class="user_img" />
                                <div>
                                    <h4><a href="#" target="_blank">{{ getUser($quotation->user_id)->name }}</a></h4>
                                    <h5>
                                        <img src="{{ asset('assets/front/images/icon/rfq_check.png') }}" alt="" />
                                        <span>{{ __('quotation.email_confirmed') }}</span>
                                    </h5>
                                </div>
                            </div>
                            <div class="profile_bottom_area">
                                <div
                                    class="profile_bottm_list_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                    <ul class="profile_bottom_list">
                                        <li>{{ __('quotation.open_time_left') }} :
                                            <span>{{ $quotation->created_at->diffForHumans() }}</span>
                                        </li>
                                    </ul>
                                    <ul
                                        class="profile_bottom_list profile_bottom_list_right_area d-flex align-items-center flex-wrap-wrap">
                                        <li class="quote_btn_area">
                                            @if (isQuoted($quotation->id))
                                                <a href="javascript:void(0)" class="quote_btn"><i class="fa fa-check" style="margin-right: 5px;"></i> Quoted</a>
                                            @else
                                                <a href="#" wire:click.prevent="quoteNow({{ $quotation->id }})"
                                                class="quote_btn">{{ __('quotation.quote_now') }}</a>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rfq_card_area">
                        <div class="rfq_tab_area">
                            <div class="category_tab_button">
                                <div>
                                    <button type="button" class="tablinks" id="defaultOpen2"
                                        onclick="openTab(event, 'rfqInfoTab')">
                                        {{ __('quotation.RFQ_information') }}
                                    </button>
                                </div>
                                <div>
                                    <button type="button" class="tablinks" onclick="openTab(event, 'rfqRecordTab')">
                                        {{ __('quotation.quotes_record') }}
                                    </button>
                                </div>
                            </div>
                            <div class="tab_content_area">
                                <div class="tab_item" id="rfqInfoTab">
                                    <div class="product_info_area">
                                        <h2>{{ __('quotation.product_basic_information') }}</h2>
                                        <div class="product_info_grid">
                                            <h4>{{ __('quotation.product_name') }}</h4>
                                            <h4>
                                                <span class="clone">:</span>{{ $quotation->name }}
                                            </h4>
                                        </div>
                                        <div class="product_info_grid">
                                            <h4>{{ __('quotation.category') }}</h4>
                                            <h4><span class="clone">:</span>{{
                                                quotationCategory($quotation->category_id)->name }}
                                            </h4>
                                        </div>
                                        <div class="product_info_grid">
                                            <h4>{{ __('quotation.sourcing_type') }}</h4>
                                            <h4><span class="clone">:</span>{{ $quotation->sourcing_type }}</h4>
                                        </div>
                                        <div class="product_info_grid">
                                            <h4>{{ __('quotation.quantity') }}</h4>
                                            <h4><span class="clone">:</span>{{ $quotation->quantity }} /
                                                {{ $quotation->piece }}</h4>
                                        </div>
                                        <div class="product_info_grid">
                                            <h4>{{ __('quotation.max_budget') }}</h4>
                                            <h4><span class="clone">:</span>{{ $quotation->max_budget }}</h4>
                                        </div>
                                        <div class="product_info_grid">
                                            <h4>{{ __('quotation.trade_terms') }}</h4>
                                            <h4><span class="clone">:</span> {{ $quotation->trade_terms }}</h4>
                                        </div>
                                        <div class="product_info_grid">
                                            <h4>{{ __('quotation.details') }}</h4>
                                            <h4 class="message_area">
                                                <span class="clone">:</span>
                                                <div>
                                                    <p class="message_intro"></p>
                                                    <p>
                                                        {{ $quotation->details }}
                                                    </p>
                                                </div>
                                            </h4>
                                        </div>
                                        @if($quotation->image != '')
                                        <div class="product_info_grid">
                                            <h4>Attachments</h4>
                                            <h4 class="message_area">
                                                <span class="clone">:</span>
                                                <div class="rfq_attachment_area d-flex align-items-start flex-wrap-wrap">
                                                    <div class="rfq_img_area">
                                                        <img src="{{ $quotation->image }}" alt="" />
                                                    </div>
                                                </div>
                                            </h4>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab_item" id="rfqRecordTab">
                                    <div class="product_info_area">
                                        <h3>{{ __('quotation.no_quotation_record') }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rfq_card_area">
                        <div class="product_info_area">
                            <h2>{{ __('quotation.shipment_and_payment') }}</h2>
                            <div class="product_info_grid">
                                <h4>{{ __('quotation.destination') }}</h4>
                                <h6><span class="clone">:</span>{{ $quotation->country }}</h6>
                            </div>
                            <div class="product_info_grid">
                                <h4>{{ __('quotation.payment_term') }}</h4>
                                <h6><span class="clone">:</span>{{ $quotation->payment_method }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="rfq_card_area">
                        <div class="rfq_record_card_area">
                            <h2>{{ __('quotation.quotes_record') }}</h2>
                            <div class="record_empty_area d-flex align-items-center justify-content-center g-sm">
                                <img src="assets/images/icon/record_empty.svg" alt="" />
                                <h5>{{ __('quotation.no_quotation_record') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rfq_details_right_area">
                    <div class="rfq_card_area">
                        <h3 class="right_first_title">{{ __('quotation.recommend_RFQs') }}</h3>
                    </div>
                    <div class="rfq_card_area">
                        @foreach ($recomandedrfqs as $recomandedrfq)
                        <div class="rfq_right_info_item">
                            <h3 class="right_first_title">{{ $recomandedrfq->name }}</h3>
                            <div class="rfq_right_inner_item d-flex align-items-center flex-wrap-wrap">
                                <h4>{{ __('quotation.quantity_required') }} : </h4>
                                <h5><span>{{ $recomandedrfq->quantity }}</span> /{{ $recomandedrfq->piece }}
                                </h5>
                            </div>
                            <div>
                                <div class="rfq_right_inner_item d-flex align-items-center flex-wrap-wrap">
                                    <h4>{{ __('quotation.date_posted') }} </h4>
                                    <h6>: {{ $recomandedrfq->country }}</h6>
                                </div>
                                <p class="date_text">{{ $recomandedrfq->created_at->diffForHumans() }}</p>
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