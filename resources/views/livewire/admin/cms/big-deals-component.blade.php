<div>
    <style>
        thead tr {
            background: rgb(219, 219, 219);
        }

        #customSwitchSuccess {
            font-size: 20px;
        }
        input.sinput {
            width: 275px;
            padding: 10px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Big Deals</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Big Deals</h4>
                </div>
            </div>
        </div>

        <div class="row justify-content-end mt-3">
            <div class="col-lg-4 col-md-10">
                <div class="row mb-4">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <label class="col-sm-6 col-form-label" for="name">Sort By Category</label>
                        <select class="form-select" id="exampleFormControlSelect1" wire:model="sort_category">
                            <option value="">Select category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12 mb-2 sort_cont">
                                <label class="font-weight-normal" style="">Show</label>
                                <select name="sortuserresults" class="sinput" id="" wire:model="sortingValue">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <label class="font-weight-normal" style="">entries</label>
                            </div>

                            <div class="col-md-6 col-sm-12 mb-2 search_cont">
                                <label class="font-weight-normal mr-2">Search:</label>
                                <input type="search" class="sinput" placeholder="Search" wire:model="searchTerm" />
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table custom_tbl">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Best Big Deal</th>
                                        <th>New Arrival</th>
                                        <th>More Viewed</th>
                                        <th>Deal of Season</th>
                                        <th>Big Needs</th>
                                        <th>Big Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sl = $products->perPage() * $products->currentPage() - ($products->perPage() - 1);
                                    @endphp
                                    @if ($products->count() > 0)
                                    @foreach ($products as $product)
                                    <tr>
                                        <td><img style="height: 50px; width: 50px;" src="{{ $product->thumbnail }}"
                                                alt=""></td>
                                        <td>{{ Str::limit($product->name, 35, '...') }}</td>

                                        <td style="text-align: center;">
                                            <div class="form-check form-switch form-switch-success"
                                                style="margin-left: 25px;">
                                                <input class="form-check-input best_big_deal" type="checkbox"
                                                    id="customSwitchSuccess" data-product_id="{{ $product->id }}"
                                                    @if($product->best_big_deal == 1) checked @endif>
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div class="form-check form-switch form-switch-success"
                                                style="margin-left: 25px;">
                                                <input class="form-check-input big_deal_new_arrival" type="checkbox"
                                                    id="customSwitchSuccess" data-product_id="{{ $product->id }}"
                                                    @if($product->big_deal_new_arrival == 1) checked @endif>
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div class="form-check form-switch form-switch-success"
                                                style="margin-left: 25px;">
                                                <input class="form-check-input big_deal_most_viewed" type="checkbox"
                                                    id="customSwitchSuccess" data-product_id="{{ $product->id }}"
                                                    @if($product->big_deal_most_viewed == 1) checked @endif>
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div class="form-check form-switch form-switch-success"
                                                style="margin-left: 25px;">
                                                <input class="form-check-input deal_of_season" type="checkbox"
                                                    id="customSwitchSuccess" data-product_id="{{ $product->id }}"
                                                    @if($product->deal_of_season == 1) checked @endif>
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div class="form-check form-switch form-switch-success"
                                                style="margin-left: 25px;">
                                                <input class="form-check-input big_needs" type="checkbox"
                                                    id="customSwitchSuccess" data-product_id="{{ $product->id }}"
                                                    @if($product->big_needs == 1) checked @endif>
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div class="form-check form-switch form-switch-success"
                                                style="margin-left: 25px;">
                                                <input class="form-check-input big_quantity" type="checkbox"
                                                    id="customSwitchSuccess" data-product_id="{{ $product->id }}"
                                                    @if($product->big_quantity == 1) checked @endif>
                                            </div>
                                        </td>

                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="8" class="text-center">No data available!</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $products->links('pagination-links-table') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
        $(document).ready(function(){
            $('.best_big_deal').on('click', function(){
                var id = $(this).data('product_id');
                @this.bestBigDeal(id);
            });
            
            $('.big_deal_new_arrival').on('click', function(){
                var id = $(this).data('product_id');
                @this.newArrival(id);
            });

            $('.big_deal_most_viewed').on('click', function(){
                var id = $(this).data('product_id');
                @this.mostViewed(id);
            });

            $('.deal_of_season').on('click', function(){
                var id = $(this).data('product_id');
                @this.dealOfSesion(id);
            });

            $('.big_needs').on('click', function(){
                var id = $(this).data('product_id');
                @this.bigNeeds(id);
            });

            $('.big_quantity').on('click', function(){
                var id = $(this).data('product_id');
                @this.bigQuantity(id);
            });
        });
</script>
@endpush