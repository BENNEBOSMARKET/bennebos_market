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
                            <li class="breadcrumb-item active">Company Information</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Company Information</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Company Information</h4>

                        <button class="card-button btn btn-sm btn-primary" style="padding: 1px 7px;"
                            data-bs-toggle="modal" data-bs-target="#addDataModal"><i class="ti ti-plus"></i> Add Company
                            Information</button>

                        <button class="card-button btn btn-sm btn-primary" style="padding: 1px 7px; margin-right: 5px;"
                            data-bs-toggle="modal" data-bs-target="#uploadFromExcel"><i class="ti ti-plus"></i> Import
                            File</button>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12 mb-2 sort_cont">
                                <label class="font-weight-normal" style="">Show</label>
                                <select name="sortuserresults" class="sinput" id="" wire:model="sortingValue" wire:change='resetPagination'>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                <label class="font-weight-normal" style="">entries</label>
                            </div>

                            <div class="col-md-6 col-sm-12 mb-2 search_cont">
                                <label class="font-weight-normal mr-2">Search:</label>
                                <input type="search" class="sinput" placeholder="Search" wire:model="searchTerm" wire:keyup='resetPagination' />
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table custom_tbl">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Logo</th>
                                        <th>Company</th>
                                        <th>Category</th>
                                        <th>Country</th>
                                        <th>Address</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $sl = ($companyinfos->perPage() *
                                    $companyinfos->currentPage())-($companyinfos->perPage() - 1)
                                    @endphp
                                    @if ($companyinfos->count() > 0)
                                    @foreach ($companyinfos as $companyinfo)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td>
                                            @if ($companyinfo->logo)
                                                <img style="height: 40px; width: 40px;" src="{{ $companyinfo->logo }}" alt="">
                                            @else
                                                <img style="height: 40px; width: 40px;" src="{{ asset('assets/images/company_info_logo.png') }}" alt="">
                                            @endif
                                        </td>
                                        <td>{{ $companyinfo->company_name }}</td>
                                        <td>{{ $companyinfo->category }}</td>
                                        <td>{{ companyCountry($companyinfo->country_id)->name }}</td>
                                        <td>{{ $companyinfo->address }}</td>
                                        <td style="text-align: center;">
                                            <div class="button-items">
                                                <a type="button" href="#" class="btn btn-sm btn-outline-success btn-icon-circle btn-icon-circle-sm"
                                                    wire:click.prevent="editData({{ $companyinfo->id }})"><i class="ti ti-edit"></i></a>
                                                <a wire:click.prevent="deleteConfirmation({{ $companyinfo->id }})"
                                                    type="button" class="btn btn-sm btn-outline-danger btn-icon-circle btn-icon-circle-sm"><i class="ti ti-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="7" style="text-align: center;">No data available!</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $companyinfos->links('pagination-links-table') }}
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
                    <h5 class="modal-title">Add New Company</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click='close'></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-md-11">
                            <form wire:submit.prevent="@if($formStatus == 'Update') updateData @else storeData @endif">
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Company Name</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" wire:model="company_name"
                                            placeholder="Company Name">
                                        @error('company_name')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Company
                                        Category</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" wire:model="category"
                                            placeholder="Company Category">
                                        @error('category')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Company Sub
                                        Category</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" wire:model="sub_category"
                                            placeholder="Company Sub Category">
                                        @error('sub_category')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Year
                                        Established</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="number" wire:model="established"
                                            placeholder="Year Established">
                                        @error('established')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Proprietor</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" wire:model="proprietor"
                                            placeholder="Proprietor">
                                        @error('proprietor')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Telephone</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" wire:model="telephone"
                                            placeholder="Telephone">
                                        @error('telephone')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Fax</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" wire:model="fax" placeholder="Fax">
                                        @error('fax')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Mobile</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" wire:model="mobile"
                                            placeholder="Mobile">
                                        @error('mobile')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="email" wire:model="email" placeholder="Email">
                                        @error('email')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Website</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" wire:model="website"
                                            placeholder="Website">
                                        @error('website')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Zip Code</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" wire:model="zip_code"
                                            placeholder="Zip Code">
                                        @error('zip_code')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" wire:model="address"
                                            placeholder="Address">
                                        @error('address')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-tel-input" class="col-sm-3 col-form-label">Country</label>
                                    <div class="col-sm-9">
                                        <div wire:ignore>
                                            <select class="form-control" id="countrySelect" wire:model="country_id">
                                                <option value="">-- Select Country --</option>
                                                @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('country_id')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-tel-input" class="col-sm-3 col-form-label">State</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" wire:model="state_id">
                                            <option value="">-- Select State --</option>
                                            @foreach ($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('state_id')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Facebook</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" wire:model="facebook"
                                            placeholder="Facebook">
                                        @error('facebook')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Twitter</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" wire:model="twitter"
                                            placeholder="Twitter">
                                        @error('twitter')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Instragram</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" wire:model="instragram"
                                            placeholder="Instragram">
                                        @error('instragram')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Linkedin</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" wire:model="linkedin"
                                            placeholder="Linkedin">
                                        @error('linkedin')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="description">Company Details</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" class="form-control" id="description"
                                            placeholder="Enter Company Details" wire:model="description"></textarea>
                                        @error('description')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-number-input" class="col-sm-3 col-form-label">Logo</label>
                                    <div class="col-sm-9">
                                        <input class="form-control mb-2" type="file" wire:model="logo">
                                        @error('logo')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror

                                        <div wire:loading="logo" wire:target="logo" wire:key="logo"
                                            style="font-size: 12.5px;" class="mr-2"><i
                                                class="fa fa-spinner fa-spin mt-3 ml-2"></i> Uploading</div>

                                        @if ($logo)
                                        <img src="{{ $logo->temporaryUrl() }}" width="80" class="mt-2 mb-2" />
                                        @elseif($uploadedLogo != '')
                                        <img src="{{ $uploadedLogo }}" width="120"
                                            class="mt-2 mb-2" />
                                        @endif

                                    </div>
                                </div>
                                <div class="mb-4 mt-4 row">
                                    <label for="example-number-input" class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-sm btn-primary submitBtn">{!!
                                            loadingStateWithText('storeData', 'Submit') !!}</button>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                                            wire:click='close'>Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="uploadFromExcel" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Info via Excel/Csv</h5>
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

                <div class="modal-footer">
                    <small class="text-muted">Last uploaded file: </small><small class="text-danger">{{ Session::get('last_uploaded_info_csv') }}</small>
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
        $('#uploadFromExcel').modal('hide');
    });

    var countrySelector = new Selectr('#countrySelect', {
        placeholder: 'Select country',
    });
    countrySelector.on('selectr.change', function(option) {
        var id = $('#countrySelect').val();
        @this.set('country_id', id);
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