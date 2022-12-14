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

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Big Deals</h4>
                        {{-- <button class="card-button btn btn-primary btn-sm" style="margin-left: 5px;"  wire:click.prevent="publishAll">{!! loadingStateWithProcess('publishAll', 'Publish All') !!}</button> --}}

                        <a href="{{ route('admin.addBigDeals') }}" class="card-button btn btn-sm btn-primary"><i class="ti ti-plus"></i> Add Big Deals </a>

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
                                    <th>Model No</th>
                                    <th>Quantity</th>
                                    <th>Category</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sl = $bigDeals->perPage() * $bigDeals->currentPage() - ($bigDeals->perPage() - 1);
                                @endphp
                                @if ($bigDeals->count() > 0)
                                    @foreach ($bigDeals as $product)
                                        <tr>
                                            <td>{{ $sl++ }}</td>
                                            <td><img style="height: 50px;" src="{{ $product->product_img }}" alt=""></td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->seller_id }}</td>
                                            <td>{{ $product->model_no }}</td>
                                            <td ><span style="background-color: {{ !is_null($product->product_color_id)?$product->colors->color:'' }};color: {{ !is_null($product->product_color_id)?$product->colors->color:'' }}">{{ $product->quantity}}</span></td>
                                            <td>{{ category($product->category_id)->name }}</td>
                                            <td style="text-align: center;">
                                                <div class="button-items">
                                                    <a href="{{ route('admin.editBigDealsProduct', ['slug' => $product->id]) }}" type="button" class="btn btn-outline-primary btn-icon-circle btn-icon-circle-sm"><i class="ti ti-edit"></i></a>

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
                        {{ $bigDeals->links('pagination-links-table') }}
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
