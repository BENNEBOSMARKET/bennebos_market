<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Brand</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Brand</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Brands</h4>
                        <button class="card-button btn btn-sm btn-primary" style="padding: 1px 7px;"
                            data-bs-toggle="modal" data-bs-target="#addDataModal"><i class="ti ti-plus"></i> Add
                            Brand</button>
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
                                        <th>Logo</th>
                                        <th>Brand Name</th>
                                        <th>Category</th>
                                        <th>Created Date</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sl = $brands->perPage() * $brands->currentPage() - ($brands->perPage() - 1);
                                    @endphp
                                    @if ($brands->count() > 0)
                                        @foreach ($brands as $brand)
                                            <tr>
                                                <td>{{ $sl++ }}</td>
                                                <td><img style="height: 40px; width: 40px;" src="{{ $brand->logo }}"
                                                        alt=""></td>
                                                <td>{{ $brand->name }}</td>
                                                <td>
                                                    @if ($brand->category_id)
                                                        @foreach (json_decode($brand->category_id) as $category)
                                                            @if (category($category))
                                                                <div class="badge bg-success pb-2"
                                                                    style="font-size: 13.5px;">

                                                                    {{ category($category)->name }}

                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </td>
                                                <td>{{ $brand->created_at }}</td>
                                                <td style="text-align: center;">
                                                    <div class="button-items">
                                                        <a type="button" href="#"
                                                            class="btn btn-outline-success btn-icon-circle btn-icon-circle-sm"
                                                            wire:click.prevent="editData({{ $brand->id }})"><i
                                                                class="ti ti-edit"></i></a>
                                                        <a wire:click.prevent="deleteConfirmation({{ $brand->id }})"
                                                            type="button"
                                                            class="btn btn-outline-danger btn-icon-circle btn-icon-circle-sm"><i
                                                                class="ti ti-trash"></i></a>
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
                        {{ $brands->links('pagination-links-table') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New Brand Modal -->
    <div wire:ignore.self class="modal fade" id="addDataModal" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-zoom">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-md-11">
                            <form wire:submit.prevent="storeData">
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" wire:model="name"
                                            wire:keyup="generateSlug" placeholder="Enter name">
                                        @error('name')
                                            <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Slug</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" wire:model="slug"
                                            placeholder="Enter slug">
                                        @error('slug')
                                            <span class="text-danger"
                                                style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="BrandCategory">Category *</label>
                                    <div class="col-sm-9">
                                        <div wire:ignore>
                                            <select class="form-control" id="BrandCategory" wire:model="category_id"
                                                multiple>
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('category')
                                            <span class="text-danger"
                                                style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-number-input" class="col-sm-3 col-form-label">Meta
                                        Title</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" style="height: 100px;" wire:model="meta_title" placeholder="Enter meta title"></textarea>
                                        @error('meta_title')
                                            <span class="text-danger"
                                                style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-number-input" class="col-sm-3 col-form-label">Meta
                                        Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" style="height: 100px;" wire:model="meta_description"
                                            placeholder="Enter meta description"></textarea>
                                        @error('meta_description')
                                            <span class="text-danger"
                                                style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-number-input" class="col-sm-3 col-form-label">Logo</label>
                                    <div class="col-sm-9">
                                        <input class="form-control mb-2" type="file" wire:model="logo">
                                        @error('logo')
                                            <span class="text-danger"
                                                style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror

                                        <div wire:loading="logo" wire:target="logo" wire:key="logo"
                                            style="font-size: 12.5px;" class="mr-2"><span
                                                class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span> Uploading</div>

                                        @if ($logo)
                                            <img src="{{ $logo->temporaryUrl() }}" width="80"
                                                class="mt-2 mb-2" />
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-number-input" class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit"
                                            class="btn btn-sm btn-primary">{!! loadingState('storeData', 'Submit') !!}</button>
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
    </div>

    <!-- Edit New Brand Modal -->
    <div wire:ignore.self class="modal fade" id="editDataModal" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-zoom">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="resetInputs"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-md-11">
                            <form wire:submit.prevent="updateData">
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" wire:model="name"
                                            wire:keyup="generateSlug" placeholder="Enter name">
                                        @error('name')
                                            <span class="text-danger"
                                                style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 col-form-label">Slug</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" wire:model="slug"
                                            placeholder="Enter slug">
                                        @error('slug')
                                            <span class="text-danger"
                                                style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="EditBrandCategory">Category *</label>
                                    <div class="col-sm-9">
                                        <div wire:ignore>
                                            <select class="form-control" id="EditBrandCategory"
                                                wire:model="category_id" multiple>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('category_id')
                                            <span class="text-danger"
                                                style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror

                                        @if ($selected_category)
                                            @foreach (json_decode($selected_category) as $category)
                                                @if (category($category))
                                                    <div class="badge bg-success pb-2 mt-2" style="font-size: 14px;">
                                                        {{ category($category)->name }}
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-number-input" class="col-sm-3 col-form-label">Meta
                                        Title</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" style="height: 100px;" wire:model="meta_title" placeholder="Enter meta title"></textarea>
                                        @error('meta_title')
                                            <span class="text-danger"
                                                style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-number-input" class="col-sm-3 col-form-label">Meta
                                        Description</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" style="height: 100px;" wire:model="meta_description"
                                            placeholder="Enter meta description"></textarea>
                                        @error('meta_description')
                                            <span class="text-danger"
                                                style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-number-input" class="col-sm-3 col-form-label">Logo</label>
                                    <div class="col-sm-9">
                                        <input class="form-control mb-2" type="file" wire:model="logo">
                                        @error('logo')
                                            <span class="text-danger"
                                                style="font-size: 12.5px;">{{ $message }}</span>
                                        @enderror

                                        <div wire:loading="logo" wire:target="logo" wire:key="logo"
                                            style="font-size: 12.5px;" class="mr-2"><span
                                                class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span> Uploading</div>

                                        @if ($logo)
                                            <img src="{{ $logo->temporaryUrl() }}" width="80"
                                                class="mt-2 mb-2" />
                                        @elseif($uploadedLogo != '')
                                            <img src="{{ $uploadedLogo }}" width="120" class="mt-2 mb-2" />
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-number-input" class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                                            wire:click="resetInputs">Cancel</button>
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
            $('#editDataModal').modal('show');
        });
        window.addEventListener('closeModal', event => {
            $('#addDataModal').modal('hide');
            $('#editDataModal').modal('hide');
        });

        // selector store
        var sizeSelector = new Selectr('#BrandCategory', {
            multiple: true,
            placeholder: 'Select Category'
        });
        sizeSelector.on('selectr.change', function(option) {
            var category_id = $('#BrandCategory').val();
            @this.set('category_id', category_id);
        });

        // selector edit
        var sizeSelector = new Selectr('#EditBrandCategory', {
            multiple: true,
            placeholder: 'Select Category'
        });
        sizeSelector.on('selectr.change', function(option) {
            var category_id = $('#EditBrandCategory').val();
            @this.set('category_id', category_id);
        });

        //Success Delete
        window.addEventListener('brandDeleted', event => {
            Swal.fire(
                'Deleted!',
                'Brand has been deleted successfully.',
                'success'
            )
        });
    </script>
@endpush
