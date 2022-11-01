<div>
    <style>
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
                            <li class="breadcrumb-item active">Send Money Customer</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Send Money Customer</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Send Money </h4>
                        <button class="card-button btn btn-sm btn-primary" style="padding: 1px 7px;"
                                data-bs-toggle="modal" data-bs-target="#addDataModal"><i class="ti ti-plus"></i> Add
                            Send</button>
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
                                    <th>Customer</th>
                                    <th>Point</th>
                                    <th>Description</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sl = ($customerMoneys->perPage() * $customerMoneys->currentPage())-($customerMoneys->perPage() - 1)
                                @endphp
                                @if ($customerMoneys->count() > 0)
                                    @foreach ($customerMoneys as $customerMoney)
                                        <tr>
                                            <td>{{ $sl++ }}</td>
                                            <td>{{ $customerMoney->customer->name }}</td>
                                            <td>{{ $customerMoney->money }}</td>
                                            <td>
                                                {{$customerMoney->description}}
                                            </td>

                                            <td style="text-align: center;">
                                                <div class="button-items">
                                                    <a type="button" href="#" class="btn btn-outline-success btn-icon-circle btn-icon-circle-sm"
                                                       wire:click.prevent="editData({{ $customerMoney->id }})"><i class="ti ti-edit"></i></a>
                                                    <a wire:click.prevent="deleteConfirmation({{ $customerMoney->id }})"
                                                       type="button" class="btn btn-outline-danger btn-icon-circle btn-icon-circle-sm"><i class="ti ti-trash"></i></a>
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
                        {{ $customerMoneys->links('pagination-links-table') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div wire:poll></div> --}}
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="addDataModal" data-bs-backdrop="static" data-bs-keyboard="false"
         aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Send</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeData">
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Customer</label>
                            <div class="col-sm-8">

                                <div wire:ignore>
                                <select class="form-control" id="SelectCustomer" wire:model="customer">

                                    <option value="">Select Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                                </div>
                                @error('customer')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Point</label>
                            <div class="col-sm-8">
                                <input class="form-control"  type="number" wire:model="money"
                                       placeholder="0 T.L">
                                @error('money')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" style="height: 100px;" wire:model="description" placeholder="Enter Description"></textarea>


                                @error('description')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="example-number-input" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-8">
                                <button type="submit" class="btn btn-sm btn-primary">{!! loadingStateWithText('storeData', 'Submit') !!}</button>
                                <button type="button" class="btn btn-sm btn-danger"
                                        data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="editDataModal" data-bs-backdrop="static" data-bs-keyboard="false"
         aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Send</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateData">

                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Customer</label>
                            <div class="col-sm-8">
                                <div wire:ignore>
                                <select class="form-control" id="customerSelect"  wire:model="customer">
                                    <option value="">Select Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                                </div>
                                @error('customer')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Point</label>
                            <div class="col-sm-8">
                                <input class="form-control"  type="number" wire:model="money"
                                       placeholder="0 T.L">
                                @error('money')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" style="height: 100px;" wire:model="description" placeholder="Enter Description"></textarea>


                                @error('description')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-number-input" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-8">
                                <button type="submit" class="btn btn-sm btn-primary">{!! loadingStateWithText('updateData', 'Submit') !!}</button>
                                <button type="button" class="btn btn-sm btn-danger"
                                        data-bs-dismiss="modal">Cancel</button>
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

        var countrySelector = new Selectr('#SelectCustomer', {
            placeholder: 'Select Customer',
        });
        countrySelector.on('selectr.change', function(option) {
            var id = $('#SelectCustomer').val();
        @this.set('customer', id);
        });

    </script>
@endpush
