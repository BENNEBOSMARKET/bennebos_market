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
                        {{-- <button class="card-button btn btn-primary btn-sm" style="margin-left: 5px;"  wire:click.prevent="publishAll">{!! loadingStateWithProcess('publishAll', 'Publish All') !!}</button> --}}

                        <a href="{{ route('admin.addProduct') }}" class="card-button btn btn-sm btn-primary"><i class="ti ti-plus"></i> Add Product</a>

                        <button class="card-button btn btn-sm btn-primary" style="margin-right: 5px;" data-bs-toggle="modal" data-bs-target="#uploadFromExcel"><i class="ti ti-plus"></i> Import File</button>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12 mb-2 sort_cont">
                                <label class="font-weight-normal" style="">Show</label>
                                <select name="sortuserresults" class="sinput" id="" wire:model="sortingValue" wire:change='resetPage'>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <label class="font-weight-normal" style="">entries</label>
                            </div>

                            <div class="col-md-6 col-sm-12 mb-2 search_cont">
                                <label class="font-weight-normal mr-2">Search:</label>
                                <input type="search" class="sinput" placeholder="Search" wire:model="searchTerm" wire:keyup='resetPage' />
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
                                        <th>Category</th>
                                        <th>Info</th>
                                        <th style="text-align: center;">Publish</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sl = $products->perPage() * $products->currentPage() - ($products->perPage() - 1);
                                    @endphp
                                    @if ($products->count() > 0)
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $sl++ }}</td>
                                                <td><img style="height: 50px;" src="{{ $product->thumbnail }}" alt=""></td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->user_id }}</td>
                                                <td>{{ category($product->category_id)->name }}</td>
                                                <td>
                                                    <small><strong>Number of Sale:</strong> {{ totalSale($product->id) }}</small> <br>
                                                    <small><strong>Base Price:</strong> {{ $product->unit_price }}</small> <br>
                                                    <small><strong>Rating:</strong> {{ product_review($product->id) }}</small>
                                                </td>
                                                <td style="text-align: center;">
                                                    <div class="form-check form-switch form-switch-success" style="margin-left: 25px;">
                                                        <input class="form-check-input" type="checkbox" id="customSwitchSuccess" wire:change='publishStatus({{ $product->id }})' @if($product->status == 1) checked @endif>
                                                    </div>
                                                </td>
                                                <td style="text-align: center;">
                                                    <div class="button-items">
                                                        <a href="{{ route('front.productDetails', ['slug'=>$product->slug]) }}" type="button" class="btn btn-outline-secondary btn-icon-circle btn-icon-circle-sm" target="_blank"><i class="ti ti-eye"></i></a>

                                                        <a href="{{ route('admin.editProduct', ['slug' => $product->slug]) }}" type="button" class="btn btn-outline-primary btn-icon-circle btn-icon-circle-sm"><i class="ti ti-edit"></i></a>
                                                        
                                                        <a wire:click.prevent="deleteConfirmation({{ $product->id }})" type="button" class="btn btn-outline-danger btn-icon-circle btn-icon-circle-sm"><i class="ti ti-trash"></i></a>
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

    <div wire:ignore.self class="modal fade" id="uploadFromExcel" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-zoom">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Product via Excel/Csv</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click='close'></button>
                </div>
                <div class="modal-body pt-4 pb-4">
                    <div class="row justify-content-center">
                        <div class="col-md-11">
                            <form wire:submit.prevent="uploadExcel">
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Upload File</label>
                                    <div class="col-sm-9">
                                        <input class="form-control mb-3" type="file" wire:model="excel" >
                                        @error('excel')
                                            <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                        <div wire:loading="excel" wire:target="excel" wire:key="excel" style="font-size: 12.5px;" class="mr-2"><i class="fa fa-spinner fa-spin mt-3 ml-2"></i> Loading</div>
                                        @if ($excel)
                                            <i class="fa fa-check text-success"></i> Loaded
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="mb-4 mt-4 row">
                                    <label for="example-number-input" class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-sm btn-primary submitBtn">{!!
                                            loadingStateWithProcess('uploadExcel', 'Submit') !!}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
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

        $(document).ready(function(){
            $('.publishStatus').on('click', function(){
                var id = $(this).data('product_id');
                @this.publishStatus(id);
            });
        });
    </script>
@endpush
