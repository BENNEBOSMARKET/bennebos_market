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
                            <li class="breadcrumb-item active">Product</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Product</h4>
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
                                        <th>Right Slider</th>
                                        <th>Best Selling</th>
                                        <th>New Arrivals</th>
                                        <th>Top-Ranked</th>
                                        <th>Dropshipping</th>
                                        <th>Opportunity</th>
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
                                                <input class="form-check-input rightSlider" type="checkbox"
                                                    id="customSwitchSuccess" data-product_id="{{ $product->id }}"
                                                    @if($product->right_slider == 1) checked @endif>
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div class="form-check form-switch form-switch-success"
                                                style="margin-left: 25px;">
                                                <input class="form-check-input bestSelling" type="checkbox"
                                                    id="customSwitchSuccess" data-product_id="{{ $product->id }}"
                                                    @if($product->best_selling == 1) checked @endif>
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div class="form-check form-switch form-switch-success"
                                                style="margin-left: 25px;">
                                                <input class="form-check-input newArrival" type="checkbox"
                                                    id="customSwitchSuccess" data-product_id="{{ $product->id }}"
                                                    @if($product->new_arrival == 1) checked @endif>
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div class="form-check form-switch form-switch-success"
                                                style="margin-left: 25px;">
                                                <input class="form-check-input topRanked" type="checkbox"
                                                    id="customSwitchSuccess" data-product_id="{{ $product->id }}"
                                                    @if($product->top_ranked == 1) checked @endif>
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div class="form-check form-switch form-switch-success"
                                                style="margin-left: 25px;">
                                                <input class="form-check-input dropShipping" type="checkbox"
                                                    id="customSwitchSuccess" data-product_id="{{ $product->id }}"
                                                    @if($product->dropshipping == 1) checked @endif>
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div class="form-check form-switch form-switch-success"
                                                style="margin-left: 25px;">
                                                <input class="form-check-input trueView" type="checkbox"
                                                    id="customSwitchSuccess" data-product_id="{{ $product->id }}"
                                                    @if($product->true_view == 1) checked @endif>
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
            $('.rightSlider').on('click', function(){
                var id = $(this).data('product_id');
                @this.rightSlider(id);
            });
            
            $('.newArrival').on('click', function(){
                var id = $(this).data('product_id');
                @this.newArrival(id);
            });

            $('.topRanked').on('click', function(){
                var id = $(this).data('product_id');
                @this.topRanked(id);
            });

            $('.personaProtective').on('click', function(){
                var id = $(this).data('product_id');
                @this.personaProtective(id);
            });

            $('.dropShipping').on('click', function(){
                var id = $(this).data('product_id');
                @this.dropShipping(id);
            });


            $('.trueView').on('click', function(){
                var id = $(this).data('product_id');
                @this.trueView(id);
            });

            $('.bestSelling').on('click', function(){
                var id = $(this).data('product_id');
                @this.bestSelling(id);
            });
        });
</script>
@endpush