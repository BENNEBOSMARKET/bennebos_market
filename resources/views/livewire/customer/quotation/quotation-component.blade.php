<div>
  <section class="profile_account_wrapper">
    <div class="my-container">
      <div class="profile_title_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
        <h3 class="cart_title">Dashboard</h3>
        <button type="button" id="profileSidebarIcon">
          <i class="fa-solid fa-bars"></i>
        </button>
      </div>
      <div class="profile_sidebar_grid_area">
        @livewire('customer.inc.sidebar')
        <div class="profile_content_wrapper">
          <div
            class="profile_content_title_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm"
          >
            <h3>My Quotations <span>({{ $total_quotations }} Quote)</span></h3>
            <div
              class="category_product_title d-flex align-items-center g-sm"
            >
              <div class="d-flex align-items-center g-sm">
                <img
                  src="{{ asset('assets/front/images/icon/filter.svg') }}"
                  alt="filter icon"
                />
                <h5>Sort By</h5>
              </div>
              <div class="selectbox_row">
                <select class="niceSelect">
                  <option data-display="All Orders">All Orders</option>
                  <option value="1">Price High to Low</option>
                </select>
              </div>
            </div>
          </div>
          <div class="order_product_item_area">
            @foreach ($quotations as $quotation)
            <div class="order_product_item">
              <div class="order_product_area">
                <div class="order_product_details_area">
                  <a href="#" class="hover_color">
                    <img
                      src="{{ $quotation->image }}" onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholderbg.png') }}';"
                      class="order_product_img"
                      alt="product image"
                    />
                  </a>
                  <div
                    class="order_product_content d-flex align-items-start justify-content-between g-sm"
                  >
                    <div>
                      <h3>
                        <a href="{{ route('quotationsdetails',['id'=>$quotation->id]) }}">{{ $quotation->name }}</a>
                      </h3>
                      <ul class="quotation_list">
                        <li>
                          Sourcing Type: <span>{{ $quotation->sourcing_type }}</span>
                        </li>
                        <li>
                          Destination:
                          <span>
                            <img
                              src="assets/images/icon/turkey_flag.png"
                              alt=""
                            />
                            {{ $quotation->country }}
                          </span>
                        </li>
                      </ul>
                      <ul class="quotation_list">
                        <li>
                          Quantity:
                          <span>{{ $quotation->quantity }} {{ $quotation->piece }}</span>
                        </li>
                        <li>
                          Max Budget:
                          <span>{{ $quotation->max_budget }} {{ $quotation->curency }}</span>
                        </li>
                        <li class="time_list">{{ $quotation->created_at->diffForHumans() }}</li>
                      </ul>
                    </div>
                    <div class="show_icon">
                      <a href="">
                        <img src="assets/images/icon/Show.svg" alt="" />
                      </a>
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
    <div class="profile_sidebar_overlay" id="sidebarOverlay"></div>
  </section>
</div>