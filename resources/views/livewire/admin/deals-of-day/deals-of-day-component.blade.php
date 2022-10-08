<div>
    <style>
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
                            <li class="breadcrumb-item active">Deals Of The Day Products</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Deals Of The Day Products</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Deals Of The Day Products</h4>
                        <button class="card-button btn btn-sm btn-primary" style="padding: 1px 7px;"
                            data-bs-toggle="modal" data-bs-target="#addDataModal"><i class="ti ti-plus"></i> Add
                            New</button>
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
                                        <th>Product Name</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $sl = ($dealsofDay->perPage() * $dealsofDay->currentPage())-($dealsofDay->perPage() - 1)
                                    @endphp
                                    @if ($dealsofDay->count() > 0)
                                    @foreach ($dealsofDay as $deals)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td><img style="height: 50px; width: 50px;" src={{ $deals->thumbnail }}" alt=""></td>
                                        <td>{{ $deals->name }}</td>
                                        <td>{{ dealOfDayProduct($deals->id)->date_from }} to {{ dealOfDayProduct($deals->id)->date_to }}</td>
                                        <td>
                                            <div class="form-check form-switch form-switch-success"
                                                style="margin-left: 25px;">
                                                <input class="form-check-input publishStatus" type="checkbox"
                                                    id="customSwitchSuccess" data-slider_id="{{ dealOfDayProduct($deals->id)->id }}"
                                                    @if(dealOfDayProduct($deals->id)->status == 1) checked @endif>
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div class="button-items">
                                                <a wire:click.prevent="deleteConfirmation({{ dealOfDayProduct($deals->id)->id }})" type="button" class="btn btn-outline-danger btn-icon-circle btn-icon-circle-sm"><i class="ti ti-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" style="text-align: center;">No data available!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $dealsofDay->links('pagination-links-table') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="addDataModal" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Deals of the Day</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click.prevent='resetInputs'></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeData">
                        
                        <div class="mb-3 row">
                            <label for="example-tel-input" class="col-sm-3 col-form-label">Product</label>
                            <div class="col-sm-8">
                                <div wire:ignore>
                                    <select class="form-control" id="productSelect" wire:model="product_id">
                                        <option value="">Select Product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('product_id')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Date Started</label>
                            <div class="col-sm-8">
                                <input class="form-control" wire:model="date_from" type="datetime-local" id="example-datetime-local-input">
                                @error('date_from')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Date End</label>
                            <div class="col-sm-8">
                                <input class="form-control" wire:model="date_to" type="datetime-local" id="example-datetime-local-input">
                                @error('date_to')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-number-input" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-8">
                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                <button type="button" class="btn btn-sm btn-danger"
                                    data-bs-dismiss="modal" wire:click.prevent='resetInputs'>Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    window.addEventListener('showEditModal', event => {
        $('#editDataModal').modal('show');
    });
    window.addEventListener('closeModal', event => {
        $('#addDataModal').modal('hide');
        $('#editDataModal').modal('hide');
    });
</script>
<script>
    //Success Delete
    window.addEventListener('DealsDeleted', event => {
            Swal.fire(
                'Deleted!',
                'Slider has been deleted successfully.',
                'success'
            )
        });
    $(document).ready(function(){
        $('.publishStatus').on('click', function(){
            var id = $(this).data('slider_id');
            
            @this.publishStatus(id);
        });
    });

    var countrySelector = new Selectr('#productSelect', {
        placeholder: 'Select product',
    });
    countrySelector.on('selectr.change', function(option) {
        var id = $('#productSelect').val();
        @this.set('product_id', id);
    });

    var countrySelector2 = new Selectr('#productSelect2', {
        placeholder: 'Select product',
    });
    countrySelector2.on('selectr.change', function(option) {
        var id = $('#productSelect2').val();
        @this.set('product_id', id);
    });
</script>
@endpush
