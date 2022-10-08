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

      </div>
      <div class="profile_sidebar_overlay" id="sidebarOverlay"></div>
    </div>
  </section>
</div>
