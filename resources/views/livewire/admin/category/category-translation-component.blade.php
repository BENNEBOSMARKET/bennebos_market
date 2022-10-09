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
                            <li class="breadcrumb-item active">Category</li>
                            <li class="breadcrumb-item active">Category Translation</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Translation of <b>{{ $category->name }}</b></h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Translations</h4>
                        <button class="card-button btn btn-sm btn-primary" style="padding: 1px 7px;" data-bs-toggle="modal" data-bs-target="#addDataModal"><i class="ti ti-plus"></i> Add Translation</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom_tbl">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Category Name</th>
                                        <th>Language</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($translations->count() > 0)
                                        @foreach ($translations as $key => $translation)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $translation->name }}</td>
                                                <td>
                                                    @if ($translation->lang == 'ar')
                                                        Arabic
                                                    @elseif ($translation->lang == 'en')
                                                        English
                                                    @elseif ($translation->lang == 'fr')
                                                        French
                                                    @elseif ($translation->lang == 'tur')
                                                        Turkish
                                                    @endif
                                                </td>
                                                <td style="text-align: center;">
                                                    <div class="button-items">
                                                        <a type="button" href="#" class="btn btn-outline-primary btn-icon-circle btn-icon-circle-sm" wire:click.prevent="editData({{ $translation->id }})"><i class="ti ti-edit"></i></a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="addDataModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-zoom">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Translation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeData">
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" wire:model="name" placeholder="Enter name">
                                @error('name')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Language</label>
                            <div class="col-sm-8">
                                <select  class="form-control" wire:model="language">
                                    <option value="">Select Language</option>
                                    <option value="ar">Arabic</option>
                                    <option value="en">English</option>
                                    <option value="fr">French</option>
                                    <option value="tur">Turkish</option>
                                </select>
                                @error('language')
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
        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-zoom">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Language</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateData">
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" wire:model="name" placeholder="Enter name">
                                @error('name')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Language</label>
                            <div class="col-sm-8">
                                <select  class="form-control" wire:model="language">
                                    <option value="">Select Language</option>
                                    <option value="ar">Arabic</option>
                                    <option value="en">English</option>
                                    <option value="fr">French</option>
                                    <option value="tur">Turkish</option>
                                </select>
                                @error('language')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="example-number-input" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-sm btn-primary">{!! loadingStateWithText('updateData', 'Submit') !!}</button>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Cancel</button>
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
@endpush
