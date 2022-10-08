<div>
  <section class="profile_account_wrapper">
    <div class="my-container">
      <div class="profile_title_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
        <h3 class="cart_title">{{ __('customer.dashboard') }}</h3>
        <button type="button" id="profileSidebarIcon">
          <i class="fa-solid fa-bars"></i>
        </button>
      </div>
      <div class="profile_sidebar_grid_area">
        @livewire('customer.inc.sidebar')
        <section class="rfq_details_wrapper">
          <div class="my-container">
            <div class="rfq_qustion_wrapper">
              <div class="rfq_details_left_area">
                <div class="rfq_card_area">
                  <div class="page_pagination_wrapper">
                    <ul
                      class="page_pagination_list d-flex align-items-center flex-wrap-wrap"
                    >
                      <li>
                        <a href="#">Home</a>
                        <img
                          src="{{ asset('assets/front/images/icon/right_arrow.svg') }}"
                          alt="right arrow"
                        />
                      </li>
  
                      <li>
                        Report
                        <img
                          src="{{ asset('assets/front/images/icon/right_arrow.svg') }}"
                          alt="right arrow"
                        />
                      </li>
                      <li>
                        Company Details
                        <img
                          src="assets/images/icon/right_arrow.svg"
                          alt="right arrow"
                        />
                      </li>
                    </ul>
                  </div>
                  <div class="rfq_profile_content_area">
                    <h3>{{ $quotation_details->name }}</h3>
                    <ul class="profile_info_list">
                      <li>Max budget : <b>{{ $quotation_details->max_budget }}</b> {{ $quotation_details->curency }}
                      </li>
                      <li>Quantity Required : <b>{{ $quotation_details->quantity }}</b> {{ $quotation_details->piece }}
                      </li>
                      <li>
                        Destination :
                        <span><img src="assets/images/icon/rfq_bd_flag.png" alt="" /></span>
                        {{ $quotation_details->country }}
                      </li>
                      <li>Date Posted : {{ $quotation_details->created_at }}</li>
                    </ul>
                    <div class="user_profile_area">
                      <img src="{{ getUser($quotation_details->user_id)->avatar }}"
                          onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholderbg.png') }}';"
                          alt="use img" class="user_img" />
                        <div>
                          <h4><a href="#" target="_blank">{{ getUser($quotation_details->user_id)->name }}</a></h4>
                          <h5>
                            <img src="{{ asset('assets/front/images/icon/rfq_check.png') }}" alt="" />
                            <span>Email confirmed</span>
                          </h5>
                        </div>
                    </div>
                    <div class="profile_bottom_area">
                      <div
                        class="profile_bottm_list_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm"
                      >
                        <ul class="profile_bottom_list">
                          <li>Open Time Left : <span>{{ $quotation_details->created_at }}</span></li>
                        </ul>
                        <ul
                          class="profile_bottom_list profile_bottom_list_right_area d-flex align-items-center flex-wrap-wrap"
                        >
                          <li>Sourcing Type : <span>{{ $quotation_details->sourcing_type }}</span></li>
                        </ul>
                      </div>
                    </div>
                  </div>
  
                  <div class="rfq_record_card_area">
                    <h2>Quotes Record ({{ $total_quotes }})</h2>
                    <div class="quotes_table_area">
                      <table>
                        @foreach ($quote_of_this as $quote)
                              <tr>
                                <td>
                                  <div class="quote_user_aera">
                                    <div class="quote_user">
                                      <img src="{{ shop($quote->seller_id)->logo }}" alt="quote user" />
                                    </div>
                                    <div class="quote_user_content">
                                      <h4>{{ seller($quote->seller_id)->name }}</h4>
                                      <h5>{{ shop($quote->seller_id)->name }}</h5>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <div class="quote_user_info_area">
                                    <ul>
                                      <li>
                                        <h6>Phone Number</h6>
                                        <a>: {{ seller($quote->seller_id)->phone }}</a>
                                      </li>
                                      <li>
                                        <h6>Email Address</h6>
                                        <a>: {{ seller($quote->seller_id)->email }}</a>
                                      </li>
                                    </ul>
                                  </div>
                                </td>
                                <td>
                                  <div class="quote_user_info_area">
                                    <ul>
                                      <li>
                                        <h6>Time</h6>
                                        <h6>: {{ seller($quote->seller_id)->created_at }}</h6>
                                      </li>
                                      <li>
                                        <h6>Location</h6>
                                        <a>: {{ shop($quote->seller_id)->address }}</a>
                                      </li>
                                    </ul>
                                  </div>
                                </td>
                              </tr>
                              @endforeach
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
</div>