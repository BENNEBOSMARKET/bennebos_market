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
        <div class="profile_content_wrapper">
          <div class="profile_content_title_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
            <h3>{{ __('customer.my_rating_reviews') }}</h3>
            <div class="category_product_title d-flex align-items-center g-sm">
              <div class="d-flex align-items-center g-sm">
                <img src="{{ asset('assets/front/images/icon/filter.svg') }}" alt="filter icon" />
                <h5>Sort By</h5>
              </div>
              <div class="selectbox_row">
                <select>
                  <option data-display="All Orders">{{ __('customer.all_orders') }}</option>
                  <option value="1">{{ __('customer.price_high_low') }}</option>
                </select>
              </div>
            </div>
          </div>
          <div class="order_product_item_area review_order_item_area">
            @php
            $sl = $my_reviews->perPage() * $my_reviews->currentPage() - ($my_reviews->perPage() - 1);
            @endphp
            @if ($my_reviews->count() > 0)
            @foreach ($my_reviews as $my_review)
            <div class="order_product_item">
              <div class="order_product_area">
                <div class="order_product_details_area">
                  <a href="#" class="hover_color">
                    <img src="{{ product($my_review->product_id)->thumbnail }}"
                      class="order_product_img" alt="product image" onerror="this.onerror=null;this.src='{{ asset('assets/images/placeholder.png') }}';"/>
                  </a>
                  <div class="order_product_content">
                    <h3>
                      <a href="#">
                        {{ product($my_review->product_id)->name }}
                      </a>
                    </h3>
                      {!! user_avarage_review($my_review->id) !!}
                    <h5>
                      {{ $my_review->comment }}
                    </h5>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            @else
            <tr>
              <td colspan="8" class="text-center">{{ __('customer.you_provide_review_yet') }}</td>
            </tr>
            @endif
          </div>
          {{ $my_reviews->links('pagination-links-table') }}
        </div>
      </div>
    </div>
    <div class="profile_sidebar_overlay" id="sidebarOverlay"></div>
  </section>
</div>