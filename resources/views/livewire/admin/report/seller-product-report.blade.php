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
                            <li class="breadcrumb-item active">Seller Product Report</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Seller Product Report</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row mb-3">
                            <div class="col-sm-8">
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Generate Report By
                                        Date</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt" style="padding: 7px;"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="validityDate"
                                                placeholder="MM/DD/YYYY - MM/DD/YYYY" wire:model="filter_date_range"
                                                autocomplete="off" />
                                        </div>
                                        @error('filter_date_range')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
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
                                    <th>Brand</th>
                                    <th>Info</th>
                                    <th>Publish</th>
                                    <th style="text-align: center;">Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $sl = $sellerReports->perPage() * $sellerReports->currentPage() -
                                ($sellerReports->perPage() - 1);
                                @endphp
                                @if ($sellerReports->count() > 0)
                                @foreach ($sellerReports as $product)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td><img style="height: 50px; width: 50px;"
                                            src={{ $product->thumbnail }}" alt="">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->user_id }}</td>
                                    <td>{{ brand($product->brand_id)->name }}</td>
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
                                    <td>Rating</td>
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
                    {{ $sellerReports->links('pagination-links-table') }}
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
    $(document).ready(function () {
        $('#validityDate').daterangepicker({
            autoUpdateInput: false,
            locale: {
                format: 'MM/DD/YYYY'
            }
        });

        $('#validityDate').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            @this.set('filter_date_range', $(this).val());
        });

        $('#validityDate').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    });
</script>
@endpush