<div>
    <style>
        thead tr {
            background: rgb(219, 219, 219);
        }

        input.sinput {
            width: 275px;
            padding: 10px;
        }

        #customSwitchSuccess {
            font-size: 20px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Job List</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Job List</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Job List</h4>
                        <button class="card-button btn btn-sm btn-primary" style="padding: 1px 7px;"
                            data-bs-toggle="modal" data-bs-target="#addDataModal"><i class="ti ti-plus"></i> Post New
                            Job</button>
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
                                        <th>Subject</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($careers->count() > 0)
                                    @foreach ($careers as $career)
                                    <tr>
                                        <td>{{ $career->subject }}</td>
                                        <td>{{ $career->type }}</td>
                                        <td>
                                            <div class="form-check form-switch form-switch-success"
                                                style="margin-left: 25px;">
                                                <input class="form-check-input publishStatus" type="checkbox"
                                                    id="customSwitchSuccess" data-career_id="{{ $career->id }}"
                                                    @if($career->status == 1) checked @endif>
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <div class="button-items">
                                                {{-- <a type="button" href="#" class="btn btn-sm btn-outline-success"
                                                    wire:click.prevent="editData({{ $career->id }})">Edit</a> --}}
                                                <a wire:click.prevent="deleteConfirmation({{ $career->id }})"
                                                    type="button" class="btn btn-sm btn-outline-danger">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="6" style="text-align: center;">No job available!</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $careers->links('pagination-links-table') }}
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
                    <h5 class="modal-title">Post New Job</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeData">
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Subject</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" wire:model="subject" wire:keyup="generateSlug"
                                    placeholder="Enter Job Title">
                                @error('subject')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Type</label>
                            <div class="col-sm-8">
                                <select wire:model="type" class="form-control">
                                    <option selected value="">Select Job Type</option>
                                    <option value="Full Time">Full Time</option>
                                    <option value="Part Time">Part Time</option>
                                    <option value="Remote">Remote</option>
                                </select>
                                @error('type')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-number-input" class="col-sm-3 col-form-label">Job
                                Description</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" style="height: 100px;" wire:model="description"
                                    placeholder="Enter meta description"></textarea>
                                @error('description')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-number-input" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-8">
                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
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
                    <h5 class="modal-title">Edit Job</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click='close'></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateData">
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" wire:model="name" wire:keyup="generateSlug"
                                    readonly placeholder="Enter name">
                                @error('name')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="example-tel-input" class="col-sm-3 col-form-label">Commision
                                Rate</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="number" wire:model="commision_rate"
                                    placeholder="Enter rate" />
                                @error('commision_rate')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-number-input" class="col-sm-3 col-form-label">Meta
                                Title</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" style="height: 100px;" wire:model="meta_title"
                                    placeholder="Enter meta title"></textarea>
                                @error('meta_title')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-number-input" class="col-sm-3 col-form-label">Meta
                                Description</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" style="height: 100px;" wire:model="meta_description"
                                    placeholder="Enter meta description"></textarea>
                                @error('meta_description')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-number-input" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-8">
                                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
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

            //Success Delete
    window.addEventListener('CareerDeleted', event => {
            Swal.fire(
                'Deleted!',
                'Job has been deleted successfully.',
                'success'
            )
        });

    $(document).ready(function(){
        $('.publishStatus').on('click', function(){
            var id = $(this).data('career_id');
            @this.publishStatus(id);
        });
    });

</script>
@endpush