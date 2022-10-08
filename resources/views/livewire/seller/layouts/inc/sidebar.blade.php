<div>
    <div class="left-sidebar">
        <!-- LOGO -->
        <div class="brand">
            <a href="{{ route('admin.home') }}" class="logo">
                <img src="{{ asset('assets/admin/images/logo.png') }}" alt="logo-large" class="logo-lg logo-light"
                    style="height: 44px; width: 190px;">
            </a>
        </div>
        <div class="text-center pt-3 pb-3" style="border-right: 1px solid #4C2C63;">
            <a href="{{ route('shop.seller', ['slug'=>$shop->slug]) }}" target="_blank">
                @if ($shop->logo != '')
                    <img src="{{ $shop->logo }}" alt="user" class="rounded-circle thumb-lg">
                @else
                    <img src="{{ asset('assets/images/placeholder_rounded.png') }}" alt="user" class="rounded-circle thumb-lg">
                @endif
                <h5 class="font-16 mt-2 fw-bold">{{ $shop->name }} </h5>
            </a>
        </div>
        <div class="menu-content h-100" data-simplebar>
            <div class="menu-body navbar-vertical">
                <div class="collapse navbar-collapse tab-content" id="sidebarCollapse">
                    <ul class="navbar-nav tab-pane active" id="Main" role="tabpanel">
                        <li class="nav-item {{ request()->is('seller/dashboard') ? 'menuitem-active' : '' }}">
                            <a class="nav-link {{ request()->is('seller/dashboard') ? 'active' : '' }}"
                                href="{{ route('seller.home') }}"><i class="ti ti-layout-grid menu-icon"></i><span
                                    style="padding-top: 4px;">{{ __('seller.dashboard_sidebar') }}</span></a>
                        </li>

                        <li
                            class="nav-item {{ request()->is('seller/add-new-product') || request()->is('seller/add-new-product/*') ? 'menuitem-active' : '' }}">
                            <a class="nav-link {{ request()->is('seller/add-new-product') || request()->is('seller/add-new-product/*') ? 'active' : '' }}"
                                href="{{ route('seller.addProduct') }}"><i class="ti ti-upload menu-icon"></i><span
                                    style="padding-top: 4px;">{{ __('seller.add_new_product_sidebar') }}</span></a>
                        </li>

                        <li
                            class="nav-item {{ request()->is('seller/products') || request()->is('seller/products/*') ? 'menuitem-active' : '' }}">
                            <a class="nav-link {{ request()->is('seller/products') || request()->is('seller/products/*') ? 'active' : '' }}"
                                href="{{ route('seller.allProducts') }}"><i class="ti ti-list menu-icon"></i><span
                                    style="padding-top: 4px;">{{ __('seller.my_products') }}</span></a>
                        </li>

                        <li
                            class="nav-item  {{ request()->is('seller/orders') || request()->is('seller/orders/*') ? 'menuitem-active' : '' }}">
                            <a class="nav-link {{ request()->is('seller/orders') || request()->is('seller/orders/*') ? 'active' : '' }}"
                                href="{{ route('seller.all-orders') }}"><i
                                    class="ti ti-shopping-cart menu-icon"></i><span
                                    style="padding-top: 4px;">{{ __('seller.orders_sidebar') }}</span></a>
                        </li>

                        <li class="nav-item  {{ request()->is('seller/refund') || request()->is('seller/refund/*') ? 'menuitem-active' : '' }}">
                            <a class="nav-link {{ request()->is('seller/refund') || request()->is('seller/refund/*') ? 'active' : '' }}" href="{{ url('seller/refund') }}"><i class="ti ti-shopping-cart menu-icon"></i><span style="padding-top: 4px;">Refunds</span></a>
                        </li>

                        <li
                            class="nav-item {{ request()->is('seller/wish-list') || request()->is('seller/wish-list/*') ? 'menuitem-active' : '' }}">
                            <a class="nav-link {{ request()->is('seller/wish-list') || request()->is('seller/wish-list/*') ? 'active' : '' }}"
                                href="{{ route('seller.wish-list') }}"><i class="ti ti-heart menu-icon"></i><span
                                    style="padding-top: 4px;">{{ __('seller.wishlisted_products') }}</span></a>
                        </li>

                        <li
                            class="nav-item {{ request()->is('seller/wallet') || request()->is('seller/wallet/*') ? 'menuitem-active' : '' }}">
                            <a class="nav-link {{ request()->is('seller/wallet') || request()->is('seller/wallet/*') ? 'active' : '' }}"
                                href="{{ route('seller.myWallet') }}"><i class="ti ti-wallet menu-icon"></i><span
                                    style="padding-top: 4px;">{{ __('seller.wallet_sidebar') }}</span></a>
                        </li>

                        <li
                            class="nav-item {{ request()->is('seller/shop-profile') || request()->is('seller/shop-profile/*') ? 'menuitem-active' : '' }}">
                            <a class="nav-link {{ request()->is('seller/shop-profile') || request()->is('seller/shop-profile/*') ? 'active' : '' }}"
                                href="{{ route('seller.shopProfile') }}"><i
                                    class="ti ti-building-store menu-icon"></i><span style="padding-top: 4px;">{{ __('seller.shop_profile') }}</span></a>
                        </li>

                        <li
                            class="nav-item {{ request()->is('seller/money-withdraw') || request()->is('seller/money-withdraw/*') ? 'menuitem-active' : '' }}">
                            <a class="nav-link {{ request()->is('seller/money-withdraw') || request()->is('seller/money-withdraw/*') ? 'active' : '' }}"
                                href="{{ route('seller.money.withdraw') }}"><i
                                    class="ti ti-building-bank menu-icon"></i><span
                                    style="padding-top: 4px;">{{ __('seller.withdraw_sidebar') }}</span></a>
                        </li>

                        <li
                            class="nav-item {{ request()->is('seller/commission-history') || request()->is('seller/commission-history/*') ? 'menuitem-active' : '' }}">
                            <a class="nav-link {{ request()->is('seller/commission-history') || request()->is('seller/commission-history/*') ? 'active' : '' }}"
                                href="{{ route('seller.commissionHistory') }}"><i
                                    class="ti ti-history menu-icon"></i><span style="padding-top: 4px;">{{ __('seller.commission_history_sidebar') }}</span></a>
                        </li>

                        <li
                            class="nav-item {{ request()->is('seller/product-reviews') || request()->is('seller/product-reviews/*') ? 'menuitem-active' : '' }}">
                            <a class="nav-link {{ request()->is('seller/product-reviews') || request()->is('seller/product-reviews/*') ? 'active' : '' }}"
                                href="{{ route('seller.productReviews') }}"><i class="ti ti-star menu-icon"></i><span
                                    style="padding-top: 4px;">{{ __('seller.product_reviews_sidebar') }}</span></a>
                        </li>

                        <li class="nav-item {{ request()->is('seller/refund-requests') || request()->is('seller/refund-requests/*') ? 'menuitem-active' : '' }}">
                            <a class="nav-link {{ request()->is('seller/refund-requests') || request()->is('seller/refund-requests/*') ? 'active' : '' }}" href="{{ route('seller.refundRequests') }}"><i class="ti ti-receipt-refund menu-icon"></i><span
                                    style="padding-top: 4px;">{{ __('seller.returns_cancel_sidebar') }}</span></a>
                        </li>
                        <li
                            class="nav-item {{ request()->is('seller/kargo-company') || request()->is('seller/kargo-company/*') ? 'menuitem-active' : '' }}">
                            <a class="nav-link {{ request()->is('seller/kargo-company') || request()->is('seller/kargo-company/*') ? 'active' : '' }}"
                                href="{{ route('seller.kargo.company') }}"><i class="ti ti-star menu-icon"></i><span
                                    style="padding-top: 4px;">{{ __('seller.kargo_company_sidebar') }}</span></a>
                        </li>

                        <li class="nav-item {{ request()->is('seller/password-settings') || request()->is('seller/password-settings/*') ? 'menuitem-active' : '' }}">
                            <a class="nav-link {{ request()->is('seller/password-settings') || request()->is('seller/password-settings/*') ? 'active' : '' }}" href="{{ route('seller.password-settings') }}"><i class="ti ti-settings menu-icon"></i><span style="padding-top: 4px;">Settings</span></a>

                        <li
                            class="nav-item {{ request()->is('seller/support-ticket') || request()->is('seller/support-ticket/*') ? 'menuitem-active' : '' }}">
                            <a class="nav-link {{ request()->is('seller/support-ticket') || request()->is('seller/support-ticket/*') ? 'active' : '' }}"
                                href="{{ route('seller.support.ticket') }}"><i class="ti ti-history menu-icon"></i><span
                                    style="padding-top: 4px;">{{ __('seller.support_ticket') }}</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
