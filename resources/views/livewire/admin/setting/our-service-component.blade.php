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
                            <li class="breadcrumb-item active">Our Service  </li>
                        </ol>
                    </div>
                    <h4 class="page-title"></h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Our Service </h4>
                        <button class="card-button btn btn-sm btn-primary" style="padding: 1px 7px;"
                                data-bs-toggle="modal" data-bs-target="#addDataModal"><i class="ti ti-plus"></i> Add
                            New Service</button>
                    </div>
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-md-3 g-4">

                            @foreach($services as $service)


                                <div class="col-xl-2">
                                    <div class="card">



                                        <div class="card-body">
                                            <h5 class="card-title text-success"> {{$service->title}}</h5>
                                            <br>
                                            <p class="card-text">
                                                <IMG src="{{$service->banner}}" width="50"> {{$service->description}}
                                            </p>
                                        </div>
                                        <div class="card-footer" style="    border-top: solid #f3dcbc;">
                                            <small class="text-muted">{{date_format($service->created_at,'Y-M-d')}}</small>
                                            <br>
                                            <a type="button" href="#" class="btn btn-outline-success btn-icon-circle btn-icon-circle-sm"
                                               wire:click.prevent="editData({{ $service->id }})"><i class="ti ti-edit"></i></a>
                                            <a wire:click.prevent="deleteConfirmation({{ $service->id }})"
                                               type="button" class="btn btn-outline-danger btn-icon-circle btn-icon-circle-sm"><i class="ti ti-trash"></i></a>
                                        </div>
                                    </div>


                                </div>



                            @endforeach

                        </div>
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
                    <h5 class="modal-title">Add New service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeData">
                        {{--                 --}}

                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-8">
                                <input   class="form-control" wire:model="title">
                                @error('title')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-8">
                                <input   class="form-control" wire:model="description">
                                @error('description')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-number-input" class="col-sm-3 col-form-label">Slider Image <br> <small>(990 x 400)</small></label>
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
                    <h5 class="modal-title">Edit service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateData">
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-8">
                                <input   class="form-control" wire:model="title">
                                @error('title')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-8">
                                <input   class="form-control" wire:model="description">
                                @error('description')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-number-input" class="col-sm-3 col-form-label"> Iamge <br> <small>(895 x 382)</small></label>
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
                                    <img src="{{ asset('uploads/slider') }}/{{ $new_banner }}" width="120"
                                         class="mt-2 mb-2" />
                                @endif
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
        window.addEventListener('sliderDeleted', event => {
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
    </script>
@endpush

