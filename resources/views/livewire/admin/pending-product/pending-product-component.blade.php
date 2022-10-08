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

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Products</h4>
                        <button class="card-button btn btn-primary btn-sm" style="margin-left: 5px;"
                            wire:click.prevent="publishAll">{!! loadingStateWithProcess('publishAll', 'Publish All')
                            !!}</button>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12 mb-2 sort_cont">
                                <label class="font-weight-normal" style="">Show</label>
                                <select name="sortuserresults" class="sinput" id="" wire:model="sortingValue"
                                    wire:change='resetPage'>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <label class="font-weight-normal" style="">entries</label>
                            </div>

                            <div class="col-md-6 col-sm-12 mb-2 search_cont">
                                <label class="font-weight-normal mr-2">Search:</label>
                                <input type="search" class="sinput" placeholder="Search" wire:model="searchTerm"
                                    wire:keyup='resetPage' />
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table custom_tbl">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Seller</th>
                                        <th>Category</th>
                                        <th>Info</th>
                                        <th style="text-align: center;">Approved</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($pending_products->count() > 0)
                                    @foreach ($pending_products as $product)
                                    <tr>
                                        <td><img style="height: 50px; width: 50px;" src="{{ $product->thumbnail }}"
                                                alt=""></td>
                                        <td>{{ $product->name }}</td>
                                        <td>
                                            @if ($product->user_id != 0 )
                                            {{ seller($product->user_id)->name }}
                                            @endif
                                        </td>
                                        <td>{{ category($product->category_id)->name }}</td>
                                        <td>
                                            <small><strong>Number of Sale:</strong> 0</small> <br>
                                            <small><strong>Base Price:</strong> {{ $product->unit_price }}</small> <br>
                                            <small><strong>Rating:</strong> 120</small>
                                        </td>
                                        <td style="text-align: center;">
                                            <button class="btn btn-xs btn-success statusPreLoad" wire:click.prevent='publishStatus({{ $product->id }})'>Approve</button>
                                        </td>
                                        <td style="text-align: center;">
                                            <div class="button-items">
                                                <a href="{{ route('front.productDetails', ['slug'=>$product->slug]) }}"
                                                    type="button"
                                                    class="btn btn-outline-secondary btn-icon-circle btn-icon-circle-sm"
                                                    target="_blank"><i class="ti ti-eye"></i></a>
                                                <a wire:click.prevent="deleteConfirmation({{ $product->id }})"
                                                    type="button"
                                                    class="btn btn-outline-danger btn-icon-circle btn-icon-circle-sm"><i
                                                        class="ti ti-trash"></i></a>
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
                        {{ $pending_products->links('pagination-links-table') }}
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

        window.addEventListener('closeModal', event => {
            $('#uploadFromExcel').modal('hide');
        });
</script>
@endpush