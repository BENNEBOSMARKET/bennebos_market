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
                            <li class="breadcrumb-item active">Inhouse Product Report</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Inhouse Product Report</h4>
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
                                    <th>Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $sl = $inhouseReports->perPage() * $inhouseReports->currentPage() -
                                ($inhouseReports->perPage() - 1);
                                @endphp
                                @if ($inhouseReports->count() > 0)
                                @foreach ($inhouseReports as $product)
                                <tr>
                                    <td>{{ $sl++ }}</td>
                                    <td><img style="height: 50px; width: 50px;"
                                            src="{{ $product->thumbnail }}" alt="">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>Admin</td>
                                    <td>
                                        @if ($product->brand_id != '')
                                           {{ brand($product->brand_id)->name }}</td>
                                        @else
                                            <small class="text-muted">No Brand</small>
                                        @endif
                                    <td>
                                        <small><strong>Number of Sale:</strong> 0</small> <br>
                                        <small><strong>Base Price:</strong> 320</small> <br>
                                    </td>
                                    <td>{{ product_review($product->id) }}</td>
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
                    {{ $inhouseReports->links('pagination-links-table') }}
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