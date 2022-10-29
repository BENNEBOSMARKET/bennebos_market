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
                            <li class="breadcrumb-item active">  Contact US  </li>
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
                        <h4 class="card-title">All Contact US</h4>
                        @if($Contacts->count() ==0)
                        <button class="card-button btn btn-sm btn-primary" style="padding: 1px 7px;"
                                data-bs-toggle="modal" data-bs-target="#addDataModal"><i class="ti ti-plus"></i> Add
                            Contact </button>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row ">

                            @foreach($Contacts as $Contact)


                                <div class="col text-center">
                                    <div class="card ">



                                        <div class="card-body">
                                            <h3 class=" text-primary"><i class="far fa-envelope"></i> Email: <span class="text-success"> {{$Contact->email}}</span> </h3>
                                            <br>
                                            <h3 class=" text-primary"><i class="fas fa-phone-volume"></i> Phone: <span class="text-success"> {{$Contact->phone}}</span></h3>
                                            <br>
                                            <h3 class=" text-primary"><i class="fas fa-map-marked-alt"></i> Address</h3>
                                            <p class="card-text">
                                               {{$Contact->address}}
                                            </p>
                                        </div>
                                        <div class="card-footer" style="    border-top: solid #f3dcbc;">
                                            <small class="text-muted">{{date_format($Contact->created_at,'Y-M-d')}}</small>
                                            <br>
                                            <a type="button" href="#" class="btn btn-outline-success btn-icon-circle btn-icon-circle-sm"
                                               wire:click.prevent="editData({{ $Contact->id }})"><i class="ti ti-edit"></i></a>
                                            <a wire:click.prevent="deleteConfirmation({{ $Contact->id }})"
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
                    <h5 class="modal-title">Add New Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeData">
                        {{--                 --}}

                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input class="form-control"  type="email" wire:model="email"
                                       placeholder="Title">
                                @error('email')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Phone</label>
                            <div class="col-sm-8">
                                <input class="form-control"  type="number" wire:model="phone"
                                       placeholder="+90 *** *** ****">
                                @error('phone')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" style="height: 100px;" wire:model="address" placeholder="Enter Address"></textarea>


                                @error('address')
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
                    <h5 class="modal-title">Edit Contact </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateData">
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input class="form-control"  type="email" wire:model="email"
                                       placeholder="Title">
                                @error('email')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Phone</label>
                            <div class="col-sm-8">
                                <input class="form-control"  type="number" wire:model="phone"
                                       placeholder="+90 *** *** ****">
                                @error('phone')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" style="height: 100px;" wire:model="address" placeholder="Enter Address"></textarea>


                                @error('address')
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

