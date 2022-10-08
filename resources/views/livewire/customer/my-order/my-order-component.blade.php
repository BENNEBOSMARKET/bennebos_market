@section('title')
{{ __('customer.sort_by') }}
@endsection
<div>
    <style>
        .view_list_btn i {
            border: 1px solid;
            padding: 5px;
            border-radius: 20px;
            color: green;
            font-size: 15px;
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
                    <div
                        class="profile_content_title_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                        <h3>{{ __('customer.my_orders') }}</h3>
                        <div class="category_product_title d-flex align-items-center g-sm">
                            <div class="d-flex align-items-center g-sm">
                                <img src="{{ asset('assets/front/images/icon/filter.svg') }}" alt="filter icon" />
                                <h5>{{ __('customer.sort_by') }}</h5>
                            </div>
                            <div class="selectbox_row" wire:ignore>
                                <select class="niceSelect" id="sortBy">
                                    <option value="">{{ __('customer.all_orders') }}</option>
                                    <option value="1">{{ __('customer.price_high_low') }}</option>
                                    <option value="2">{{ __('customer.price_low_high') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="profile_sub_content_area">
                        <div class="order_details_product_table">
                            <table>
                                <tr>
                                    <td style="text-align: left;">
                                        <h3>{{ __('customer.order_code') }}</h3>
                                    </td>
                                    <td>
                                        <h3>{{ __('customer.num_products') }}</h3>
                                    </td>
                                    <td>
                                        <h3>{{ __('customer.amount') }}</h3>
                                    </td>
                                    <td>
                                        <h3>{{ __('customer.delivery_status') }}</h3>
                                    </td>
                                    <td>
                                        <h3>{{ __('customer.payment_status') }}</h3>
                                    </td>
                                    <td>
                                        <h3>{{ __('customer.view') }}</h3>
                                    </td>
                                </tr>
                                @foreach ($orders as $order)
                                <tr class="table_row">
                                    <td style="text-align: left;">
                                        <h5>{{ $order->code }}</h5>
                                    </td>
                                    <td>
                                        <h5>{{ orderProductCount($order->id) }}</h5>
                                    </td>
                                    <td>
                                        <h5>₺ {{ $order->grand_total }}</h5>
                                    </td>
                                    <td>
                                        <h5>{{ ucfirst($order->delivery_status) }}</h5>
                                    </td>
                                    <td>
                                        @if ($order->payment_status == 'unpaid')
                                        <h5 style="color: #ff0000;">{{ __('customer.unpaid') }}</h5>
                                        @else
                                        <h5 class="proccess">{{ __('customer.paid') }}</h5>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('customer.orders-details',['id'=>$order->id])}}"
                                            class="view_list_btn"><i class="fa-solid fa-eye"></i></a>

                                        <a href="{{ route('order.pdf.download',['id'=>$order->id])}}"
                                           class="view_list_btn"><i class="fa-file-pdf fa"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile_sidebar_overlay" id="sidebarOverlay"></div>
    </section>
</div>

@push('scripts')
    <script>
        $(document).ready(function(){
            $('#sortBy').on('change', function(){
                @this.set('sort_order', $(this).val());
            });
        });
    </script>
@endpush
