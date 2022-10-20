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
                            <li class="breadcrumb-item active">Right Grid Banner</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Right Grid Banner</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Right Grid Banner</h4>
                        <button class="card-button btn btn-sm btn-primary" style="padding: 1px 7px;"
                            data-bs-toggle="modal" data-bs-target="#addDataModal"><i class="ti ti-plus"></i> Add
                            Right Grid Banner</button>
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
                                        <th>Banner</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $sl = ($gridBanners->perPage() * $gridBanners->currentPage())-($gridBanners->perPage() - 1)
                                    @endphp
                                    @if ($gridBanners->count() > 0)
                                    @foreach ($gridBanners as $gridBanner)
                                    <tr>
                                        <td>{{ $sl++ }}</td>
                                        <td><img style="height: 50px; width: 150px;"
                                                src="{{ $gridBanner->banner }}" alt=""></td>
                                        <td style="text-align: center;">
                                            <div class="button-items">
                                                <a type="button" href="#" class="btn btn-sm btn-outline-success"
                                                    wire:click.prevent="editData({{ $gridBanner->id }})">Edit</a>
                                                <a wire:click.prevent="deleteConfirmation({{ $gridBanner->id }})"
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
                        {{ $gridBanners->links('pagination-links-table') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div wire:poll></div> --}}
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="addDataModal" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Grid Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeData">
                        <div class="mb-3 row">
                            <label for="example-number-input" class="col-sm-3 col-form-label">Banner Image (600*360)</label>
                            <div class="col-sm-8">
                                <input class="form-control mb-2" type="file" wire:model="banner">
                                @error('banner')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                                <div wire:loading="banner" wire:target="banner" wire:key="banner"
                                    style="font-size: 12.5px;" class="mr-2"><i
                                        class="fa fa-spinner fa-spin mt-3 ml-2"></i> Uploading</div>
                                @if ($banner)
                                <img src="{{ $banner->temporaryUrl() }}" width="80" class="mt-2 mb-2" />
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-number-input" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-8">
                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
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
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Grid Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateData">
                        <div class="mb-3 row">
                            <label for="example-number-input" class="col-sm-3 col-form-label">Slider Image(600 * 360)</label>
                            <div class="col-sm-8">
                                <input class="form-control mb-2" type="file" wire:model="banner">
                                @error('banner')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                                <div wire:loading="banner" wire:target="banner" wire:key="banner"
                                    style="font-size: 12.5px;" class="mr-2"><i
                                        class="fa fa-spinner fa-spin mt-3 ml-2"></i> Uploading</div>
                                @if ($banner)
                                    <img src="{{ $banner->temporaryUrl() }}" width="80" class="mt-2 mb-2" />
                                @elseif($new_banner != '')
                                    <img src="{{ $new_banner }}" width="120"
                                        class="mt-2 mb-2" />
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-number-input" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-8">
                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
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
    window.addEventListener('middleBannerDeleted', event => {
            Swal.fire(
                'Deleted!',
                'Banner has been deleted successfully.',
                'success'
            )
        });
</script>
@endpush
