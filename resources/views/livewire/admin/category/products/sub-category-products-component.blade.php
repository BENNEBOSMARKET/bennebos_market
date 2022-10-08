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
                            <li class="breadcrumb-item active">{{ ucfirst($category->name) }} Products</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{ ucfirst($category->name) }} Products</h4>
                </div>
            </div>
        </div>

        <div class="row justify-content-between mt-3">
            <div class="col-lg-8 col-md-6" style="padding-top: 40px;">
                <a href="javascript:void(0)" class="btn btn-outline-dark active" style="margin-right: 4px;">Products</a>
                <a href="{{ route('admin.subCategoryBrands', ['id'=>$category->id]) }}" class="btn btn-outline-dark">Brands</a>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="row mb-4">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <label class="col-sm-6 col-form-label" for="name">Sort By</label>
                        <select class="form-select" id="exampleFormControlSelect1" wire:model="sort_product">
                            <option value="">All Products</option>
                            <option value="featured">Featured Products</option>
                            <option value="pinned">Pinned Products</option>
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
                                        <th>Product</th>
                                        <th>Featured</th>
                                        <th>Pinned</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sl = $products->perPage() * $products->currentPage() - ($products->perPage() - 1);
                                    @endphp
                                    @if ($products->count() > 0)
                                    @foreach ($products as $product)
                                    <tr>
                                        <td><img style="height: 50px; margin-right: 7px;" src="{{ $product->thumbnail }}" alt=""> {{ Str::limit($product->name, 35, '...') }}</td>

                                        <td style="text-align: center;">
                                            <div class="form-check form-switch form-switch-success"
                                                style="margin-left: 25px;">
                                                <input class="form-check-input featuredCategory" type="checkbox"
                                                    id="customSwitchSuccess" data-product_id="{{ $product->id }}"
                                                    @if($product->category_featured == 1) checked @endif>
                                            </div>
                                        </td>

                                        <td style="text-align: center;">
                                            <div class="form-check form-switch form-switch-success"
                                                style="margin-left: 25px;">
                                                <input class="form-check-input pinnedCategory" type="checkbox"
                                                    id="customSwitchSuccess" data-product_id="{{ $product->id }}"
                                                    @if($product->category_pinned == 1) checked @endif>
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
            $('.featuredCategory').on('click', function(){
                var id = $(this).data('product_id');
                @this.categoryFeatured(id);
            });
            $('.pinnedCategory').on('click', function(){
                var id = $(this).data('product_id');
                @this.categoryPinned(id);
            });
        });
</script>
@endpush