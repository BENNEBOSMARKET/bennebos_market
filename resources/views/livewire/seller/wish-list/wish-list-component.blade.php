@section('page_title')
    Wish List
@endsection
<div>
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row mb-3">
                            <div class="col-md-12 d-flex justify-content-between">
                                <h4>{{ __('seller.wishlisted_products') }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom_tbl">
                                <thead>
                                    <tr>
                                        <th>{{ __('seller.order_details_image') }}</th>
                                        <th>{{ __('seller.order_details_name') }}</th>
                                        <th>{{ __('seller.categiry') }}</th>
                                        <th>{{ __('seller.order_details_price') }}</th>
                                        <th>{{ __('seller.wishlist_quantity') }}</th>
                                        <th>{{ __('seller.wishlist_count') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($wishlistProducts->count() > 0)
                                        @foreach ($wishlistProducts as $wishlist)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('front.productDetails', ['slug' => $wishlist->slug]) }}" target="_blank"><img src="{{ $wishlist->thumbnail }}"  class="rounded" height="50" width="50" /></a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('front.productDetails', ['slug' => $wishlist->slug]) }}" target="_blank">{{ Str::limit($wishlist->name, 35) }}</a>
                                                </td>
                                                <td>{{ category($wishlist->category_id)->name }}</td>
                                                <td>${{ $wishlist->unit_price }}</td>
                                                <td>{{ $wishlist->quantity }}</td>
                                                <td>{{ wishList($wishlist->id) }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center">{{ __('seller.commission_table_none_text') }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $wishlistProducts->links('pagination-link-seller') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
