<div>
    <style>
        thead tr {
            background: rgb(219, 219, 219);
        }

        #customSwitchSuccess {
            font-size: 25px;
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
                            <li class="breadcrumb-item active">Product Wishlist Report</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Product Wishlist Report</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row mb-3">
                            <div class="col-sm-8">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="product">Prodcut Wishlist Report</label>
                                    <div class="col-sm-9">
                                        <div wire:ignore>
                                            <select class="form-control" id="product" wire:model="product_wishlist_filter">
                                                <option value="">Select Prodcut</option>
                                                @foreach ($products as $product)
                                                <option value="{{ $product->id }}">
                                                    {{ $product->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Added By</th>
                                    <th>Info</th>
                                    <th>Publish</th>
                                    <th style="text-align: center;">Wish List</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $sl = $products->perPage() * $products->currentPage() -
                                ($products->perPage() - 1);
                                @endphp
                                @if ($products->count() > 0)
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td><img style="height: 50px; width: 50px;"
                                            src="{{ $product->thumbnail }}" alt="">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->user_id }}</td>
                                    <td>
                                        <small><strong>Number of Sale:</strong> 0</small> <br>
                                        <small><strong>Base Price:</strong> 320</small> <br>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch form-switch-success"
                                            style="margin-left: 25px;">
                                            <input class="form-check-input publishStatus" type="checkbox"
                                                id="customSwitchSuccess" data-product_id="{{ $product->id }}"
                                                @if($product->status == 1) checked @endif>
                                        </div>
                                    </td>
                                    <td>{{ wishList($product->id) }}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="8">No data available!</td>
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
    //Success Delete
        window.addEventListener('productDeleted', event => {
            Swal.fire(
                'Deleted!',
                'Product has been deleted successfully.',
                'success'
            )
        });

        $(document).ready(function(){
            $('.publishStatus').on('click', function(){
                var id = $(this).data('product_id');
                @this.publishStatus(id);
            });
        });
</script>
<script>
    $(document).ready(function() {
            $('#product').select2({
                dropdownAutoWidth: true,
            });
        });
        
    $(document).ready(function () {
       
        $('#product').on('change', function() {
            @this.set('product_wishlist_filter', $(this).val());
        });
    });
</script>
@endpush