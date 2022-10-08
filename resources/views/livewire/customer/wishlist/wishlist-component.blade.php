@section('title'){{ __('customer.my_wishlist') }} @endsection
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
                <div class="profile_content_wrapper">
                    <div
                        class="profile_content_title_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                        <h3>{{ __('customer.my_wishlist') }}</h3>
                        <div class="category_product_title d-flex align-items-center g-sm">
                            <div class="d-flex align-items-center g-sm">
                                <img src="{{ asset('assets/front/images/icon/filter.svg') }}" alt="filter icon" />
                                <h5>{{ __('customer.sort_by') }}</h5>
                            </div>
                            <div class="selectbox_row" wire:ignore>
                                <select id="sortProduct">
                                    <option value="">-- {{ __('customer.default') }} --</option>
                                    <option value="low_to_high">{{ __('customer.price_low_high') }}</option>
                                    <option value="high_to_low">{{ __('customer.price_high_low') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="order_product_item_area">
                        {{-- Wishlist Items --}}
                        @foreach ($wishlists as $wishlist)
                            <div class="order_product_item order_wishlist_product_item">
                                <div class="order_product_area">
                                    <div class="order_product_details_area">
                                        <a target="_blank" href="{{ route('front.productDetails', ['slug'=>product($wishlist->product_id)->slug]) }}" class="hover_color">
                                            <img src="{{ product($wishlist->product_id)->thumbnail }}"
                                                class="order_product_img" alt="{{ product($wishlist->product_id)->name }}" />
                                        </a>
                                        <div class="order_product_content">
                                            <h3>
                                                <a target="_blannk" href="{{ route('front.productDetails', ['slug'=>product($wishlist->product_id)->slug]) }}">
                                                    {{ product($wishlist->product_id)->name }}
                                                </a>
                                            </h3>
                                            <h5>{{ brand(product($wishlist->product_id)->brand_id)->name }}</h5>
                                            <h4>₺{{ product($wishlist->product_id)->unit_price }}</h4>
                                        </div>
                                    </div>
                                    <div class="order_date_area">
                                        <button type="button" class="delete_button" wire:click.prevent='deleteFromWishList({{ $wishlist->id }})'>
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19.3248 9.46777C19.3248 9.46777 18.7818 16.2028 18.4668 19.0398C18.3168 20.3948 17.4798 21.1888 16.1088 21.2138C13.4998 21.2608 10.8878 21.2638 8.27979 21.2088C6.96079 21.1818 6.13779 20.3778 5.99079 19.0468C5.67379 16.1848 5.13379 9.46777 5.13379 9.46777"
                                                    stroke="#EB5757" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                                <path d="M20.708 6.23926H3.75" stroke="#EB5757" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M17.4406 6.23949C16.6556 6.23949 15.9796 5.68449 15.8256 4.91549L15.5826 3.69949C15.4326 3.13849 14.9246 2.75049 14.3456 2.75049H10.1126C9.53358 2.75049 9.02558 3.13849 8.87558 3.69949L8.63258 4.91549C8.47858 5.68449 7.80258 6.23949 7.01758 6.23949"
                                                    stroke="#EB5757" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    {{ $wishlists->links('front-pagination-links') }}
                </div>
            </div>
        </div>
        <div class="profile_sidebar_overlay" id="sidebarOverlay"></div>
    </section>
</div>


@push('scripts')
    <script>
        $('document').ready(function(){
            $('#sortProduct').on('change', function(){
                @this.set('sortByPrice', $(this).val());
            });
        })
    </script>
@endpush
