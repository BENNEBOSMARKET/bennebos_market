<div>
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
                                <li class="breadcrumb-item active">Report Map</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Report Map</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">All Countries</h4>
                            <button class="card-button btn btn-sm btn-primary" style="padding: 1px 7px;" data-bs-toggle="modal" data-bs-target="#addDataModal"><i class="ti ti-plus"></i> Add Country</button>
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
                                            <th>Country</th>
                                            <th>Latitude</th>
                                            <th>Longitude</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sl = ($countries->perPage() * $countries->currentPage())-($countries->perPage() - 1)
                                        @endphp
                                        @if ($countries->count() > 0)
                                            @foreach ($countries as $country)
                                                <tr class="{{$country->latitude==null?$country->latitude:'bg-soft-success'}}">
                                                    <td >{{ $sl++ }}</td>
                                                    <td>{{ $country->name }}</td>
                                                    <td>{{ $country->latitude }}</td>
                                                    <td>{{ $country->longitude }}</td>

                                                    <td style="text-align: center;">
                                                        <div class="button-items ">
                                                            <a href="#" type="button" class="btn btn-primary btn-icon-circle btn-icon-circle-sm" wire:click.prevent="editData({{ $country->id }})"><i class="ti ti-edit"></i></a>

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
                            {{ $countries->links('pagination-links-table') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="addDataModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Country</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="storeData">
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Country</label>
                                <div class="col-sm-9">
                                    <select class="form-control" type="text" wire:model="name" wire:change="generateSlug " disabled>
                                        <option value="">Select country</option>
                                        @foreach ($allCountries as $acountry)
                                            <option value="{{ $acountry->id }}">{{ $acountry->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('name')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-tel-input"
                                    class="col-sm-3 col-form-label">Latitude</label>
                                <div class="col-sm-9">
                                    <input class="form-control" step="any" type="number" wire:model="latitude" placeholder="Enter latitude" />
                                    @error('latitude')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-tel-input"
                                    class="col-sm-3 col-form-label">Longitude</label>
                                <div class="col-sm-9">
                                    <input class="form-control" step="any" type="number" wire:model="longitude" placeholder="Enter longitude" />
                                    @error('longitude')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="example-number-input" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-sm btn-primary">{!! loadingStateWithText('storeData', 'Submit') !!}</button>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div wire:ignore.self class="modal fade" id="editDataModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Country</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click.prevent='resetInputs'></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="updateData">
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Country</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" readonly  wire:model="name" wire:change="generateSlug">

                                    @error('name')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-tel-input"
                                    class="col-sm-3 col-form-label">Latitude</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" wire:model="latitude" placeholder="Enter latitude" />
                                    @error('latitude')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-tel-input"
                                    class="col-sm-3 col-form-label">Longitude</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" wire:model="longitude" placeholder="Enter longitude" />
                                    @error('longitude')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="mb-3 row">
                                <label for="example-number-input" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-sm btn-primary">{!! loadingStateWithText('updateData', 'Submit') !!}</button>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal" wire:click.prevent='resetInputs'>Cancel</button>
                                </div>
                            </div>
                        </form>
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
            window.addEventListener('categoryDeleteError', event => {
                Swal.fire(
                    'Error!',
                    'Can not delete this category.<br>Because this category has active posts or subcategory.<br>Please delete them first.',
                    'error'
                )
            });
        </script>
    @endpush
</div>
