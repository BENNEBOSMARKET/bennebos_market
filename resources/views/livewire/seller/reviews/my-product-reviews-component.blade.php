@section('page_title')
{{ __('seller.product_reviews') }}
@endsection
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
    </style>
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">{{ __('seller.my_product_reviews') }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive dash-social">
                            <table id="datatable" class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('seller.product_reviews_product') }}</th>
                                        <th>{{ __('seller.product_reviews_user') }}</th>
                                        <th>{{ __('seller.product_reviews_ratting') }}</th>
                                        <th>{{ __('seller.product_reviews_review') }}</th>
                                        <th>{{ __('seller.product_reviews_image') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($reviews->count() > 0)
                                        @php
                                            $sl = $reviews->perPage() * $reviews->currentPage() - ($reviews->perPage() - 1);
                                        @endphp
                                        @foreach ($reviews as $review)
                                            <tr>
                                                <td>{{ $sl++ }}</td>
                                                <td>{{ product($review->product_id)->name }}</td>
                                                <td>{{ user($review->user_id)->name }}</td>
                                                <td>{!! product_star_review($review->rating) !!}</td>
                                                <td>{{ $review->comment }}</td>
                                                <td>
                                                    @foreach (json_decode($review->image) as $img)
                                                        <img src="{{ $img }}" style="height: 70px;" class="img-fluid" alt="">
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">{{ __('seller.commission_table_none_text') }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $reviews->links('pagination-link-seller') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
