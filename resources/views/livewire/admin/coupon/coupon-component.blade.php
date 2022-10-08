<div>
    <style>
        thead tr {
            background: rgb(219, 219, 219);
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
                            <li class="breadcrumb-item active">Coupon</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Coupon</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tüm Kategoriler</h4>
                        <button class="card-button btn btn-sm btn-primary" style="padding: 1px 7px;"
                            data-bs-toggle="modal" data-bs-target="#addDataModal"><i class="ti ti-plus"></i> Add
                            Coupon</button>
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
                                        <th>Coupon Code</th>
                                        <th>Discount</th>
                                        <th>Discount Type</th>
                                        <th>Date</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $sl = ($coupons->perPage() * $coupons->currentPage())-($coupons->perPage() - 1)
                                    @endphp
                                    @if ($coupons->count() > 0)
                                    @foreach ($coupons as $coupon)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>{{ $coupon->coupon_code }}</td>
                                        <td>{{ $coupon->discount }}</td>
                                        <td>{{ $coupon->discount_type }}</td>
                                        <td>{{ $coupon->date }}</td>
                                        <td style="text-align: center;">
                                            <div class="button-items">
                                                <a type="button" href="#" class="btn btn-sm btn-outline-success"
                                                    wire:click.prevent="editData({{ $coupon->id }})">Edit</a>
                                                <a wire:click.prevent="deleteConfirmation({{ $coupon->id }})"
                                                    type="button" class="btn btn-sm btn-outline-danger">Delete</a>
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
                        {{ $coupons->links('pagination-links-table') }}
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
                    <h5 class="modal-title">Add New Coupon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click='close'></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-md-11">
                            <form wire:submit.prevent="@if($formStatus == 'Update') updateData @else storeData @endif">
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Coupon Code</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" wire:model="coupon_code"
                                            placeholder="Coupon Code">
                                        @error('coupon_code')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-tel-input" class="col-sm-3 col-form-label">Discount Type</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" wire:model="discount_type">
                                            <option value="">-- Select --</option>
                                            <option value="Flat">Flat</option>
                                            <option value="Percentage">Percentage</option>
                                        </select>
                                        @error('discount_type')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-tel-input" class="col-sm-3 col-form-label">Discount</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="number" wire:model="discount"
                                            placeholder="Enter discount" />
                                        @error('discount')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Validity</label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt" style="padding: 7px;"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="validityDate" placeholder="MM/DD/YYYY - MM/DD/YYYY" wire:model="date" autocomplete="off" />
                                        </div>
                                        @error('date')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4 mt-4 row">
                                    <label for="example-number-input" class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-sm btn-primary submitBtn">{!! loadingStateWithText('storeData', 'Submit') !!}</button>
                                        <button type="button" class="btn btn-sm btn-danger"
                                            data-bs-dismiss="modal" wire:click='close'>Cancel</button>
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
    window.addEventListener('showEditModal', event => {
        $('#addDataModal').modal('show');
    });
    window.addEventListener('closeModal', event => {
        $('#addDataModal').modal('hide');
        $('#editDataModal').modal('hide');
    });

    $(document).ready(function () {
        $('#validityDate').daterangepicker({
            autoUpdateInput: false,
            locale: {
                format: 'MM/DD/YYYY'
            }
        });

        $('#validityDate').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            @this.set('date', $(this).val());
        });

        $('#validityDate').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    });
</script>
@endpush
