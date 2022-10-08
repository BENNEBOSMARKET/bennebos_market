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
                                            <th>Country Code</th>
                                            <th>Value</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sl = ($countries->perPage() * $countries->currentPage())-($countries->perPage() - 1)
                                        @endphp
                                        @if ($countries->count() > 0)
                                            @foreach ($countries as $country)
                                                <tr>
                                                    <td>{{ $sl++ }}</td>
                                                    <td>{{ $country->country }}</td>
                                                    <td>{{ $country->country_code }}</td>
                                                    <td>{{ $country->value }}</td>
                                                    <td style="text-align: center;">
                                                        <div class="button-items">
                                                            <a href="#" type="button" class="btn btn-outline-secondary btn-icon-circle btn-icon-circle-sm" wire:click.prevent="showData({{ $country->id }})"><i class="ti ti-eye"></i></a>
                                                            <a href="#" type="button" class="btn btn-outline-primary btn-icon-circle btn-icon-circle-sm" wire:click.prevent="editData({{ $country->id }})"><i class="ti ti-edit"></i></a>
                                                            <a href="#" type="button" class="btn btn-outline-danger btn-icon-circle btn-icon-circle-sm" wire:click.prevent="deleteConfirmation({{ $country->id }})"><i class="ti ti-trash"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" style="text-align: center;">No data available!</td>
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
                                    <select class="form-control" type="text" wire:model="country" wire:change="generateSlug">
                                        <option value="">Select country</option>
                                        @foreach ($allCountries as $acountry)
                                            <option value="{{ $acountry->name }}">{{ $acountry->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-tel-input"
                                    class="col-sm-3 col-form-label">Country Code</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" wire:model="country_code" placeholder="Enter country code" />
                                    @error('country_code')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-tel-input"
                                    class="col-sm-3 col-form-label">Value</label>
                                <div class="col-sm-9">
                                    <input class="form-control" step="any" type="number" wire:model="value" placeholder="Enter value" />
                                    @error('value')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="example-tel-input"
                                    class="col-sm-3 col-form-label">SVG Vector Map</label>
                                <div class="col-sm-9">
                                    <input type="file" accept=".svg" class="form-control" wire:model='vector_map' />
                                    @error('vector_map')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror

                                    <div wire:loading="vector_map" wire:target="vector_map" wire:key="vector_map" style="font-size: 12.5px;" class="mr-2"><i class="fa fa-spinner fa-spin mt-3 ml-2"></i> Uploading</div>

                                    @if ($vector_map)
                                        <div class="mt-3"><i class="ti ti-check text-success"></i> File uploaded</div>
                                    @endif
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
                                    <select class="form-control" type="text" wire:model="country" disabled wire:change="generateSlug">
                                        <option value="">Select country</option>
                                        @foreach ($allCountries as $acountry)
                                            <option value="{{ $acountry->name }}">{{ $acountry->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-tel-input"
                                    class="col-sm-3 col-form-label">Country Code</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" wire:model="country_code" placeholder="Enter country code" />
                                    @error('country_code')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-tel-input"
                                    class="col-sm-3 col-form-label">Value</label>
                                <div class="col-sm-9">
                                    <input class="form-control" step="any" type="number" wire:model="value" placeholder="Enter value" />
                                    @error('value')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="example-tel-input"
                                    class="col-sm-3 col-form-label">SVG Vector Map</label>
                                <div class="col-sm-9">
                                    <input type="file" accept=".svg" class="form-control" wire:model='vector_map' />
                                    @error('vector_map')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror

                                    <div wire:loading="vector_map" wire:target="vector_map" wire:key="vector_map" style="font-size: 12.5px;" class="mr-2"><i class="fa fa-spinner fa-spin mt-3 ml-2"></i> Uploading</div>

                                    @if ($vector_map)
                                        <div class="mt-3"><i class="ti ti-check text-success"></i> File uploaded</div>
                                    @endif
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

        <div wire:ignore.self class="modal fade" id="profileModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                @if ($profile != '')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $profile->country }} Trade Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="storeDetails">
                                <div class="mb-2 row text-center">
                                    <div class="col">
                                        <h5><strong>Add New Data</strong></h5>
                                    </div>
                                </div>
                                <div class="mb-4 row justify-content-center">
                                    <div class="col-md-3">
                                        <label for="example-text-input">Country</label>
                                        <select class="form-control" type="text" wire:model="details_country">
                                            <option value="">Select country</option>
                                            @foreach ($allCountries as $acountry)
                                                <option value="{{ $acountry->name }}">{{ $acountry->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('details_country')
                                            <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Value</label>
                                        <input class="form-control" step="any" type="number" wire:model="details_value" placeholder="Enter value" />
                                        @error('details_value')
                                            <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <label for="example-text-input">Data Type</label>
                                        <select class="form-control" type="text" wire:model="details_type">
                                            <option value="">Select data type</option>
                                            <option value="import">Import</option>
                                            <option value="export">Export</option>
                                        </select>
                                        @error('details_type')
                                            <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 pt-4">
                                        <button type="submit" class="btn btn-sm btn-primary">{!! loadingStateWithText('storeDetails', 'Submit') !!}</button>
                                    </div>
                                </div>
                            </form>

                            <div class="dropdown-divider"></div>

                            <div class="row justify-content-center">
                                <div class="col-6">
                                    <div class="text-start">
                                        <h6><strong>Import</strong></h6>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Country</th>
                                                    <th>Trade Value</th>
                                                    <th style="text-align: center;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($profileImportDetails->count() > 0)
                                                    @foreach ($profileImportDetails as $impItem)
                                                        <tr>
                                                            <td>{{ $impItem->country }}</td>
                                                            <td>{{ $impItem->trade_value }}</td>
                                                            <td style="text-align: center;">
                                                                <a href="#" type="button" class="text-danger" wire:click.prevent="deleteImp({{ $impItem->id }})"><i class="ti ti-x"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-start">
                                        <h6><strong>Export</strong></h6>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Country</th>
                                                    <th>Trade Value</th>
                                                    <th style="text-align: center;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($profileExportDetails->count() > 0)
                                                    @foreach ($profileExportDetails as $expItem)
                                                        <tr>
                                                            <td>{{ $expItem->country }}</td>
                                                            <td>{{ $expItem->trade_value }}</td>
                                                            <td style="text-align: center;">
                                                                <a href="#" type="button" class="text-danger" wire:click.prevent="deleteExp({{ $expItem->id }})"><i class="ti ti-x"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @push('scripts')
        <script>
            window.addEventListener('showEditModal', event => {
                $('#editDataModal').modal('show');
            });

            window.addEventListener('showProfile', event => {
                $('#profileModal').modal('show');
            });

            window.addEventListener('show-add-trade-profile-modal', event => {
                $('#tradeProfile').modal('show');
            });
            window.addEventListener('showSvgMap', event => {
                $('#showSVG').modal('show');
            });
            window.addEventListener('closeModal', event => {
                $('#addDataModal').modal('hide');
                $('#editDataModal').modal('hide');
                $('#tradeProfile').modal('hide');
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
