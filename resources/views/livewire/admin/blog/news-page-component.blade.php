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
                            <li class="breadcrumb-item active">News </li>
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
                        <h4 class="card-title">All News</h4>
                        <button class="card-button btn btn-sm btn-primary" style="padding: 1px 7px;"
                                data-bs-toggle="modal" data-bs-target="#addDataModal"><i class="ti ti-plus"></i> Add
                            News</button>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            @foreach($newsPageIMG as $n)

                                <div class="col-sm-2">
                                    <div class="card {{$n->type == 'IMG'? 'bg-info':' bg-warning' }}" >




                                        <div class="bg-image hover-overlay ripple text-center" data-mdb-ripple-color="light">

                                            <img src="{{$n->banner}}" class="img-fluid mt-4" height="240" style="width: 100% "/>
                                            <a href="#!">
                                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                            </a>


                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title text-dark " style="font-size: xx-large;">{{$n->title}}               </h4>
                                            <br>
                                            <h4 class="card-title text-purple mt-2 " style="font-size: x-large;"> {{$n->category}}</h4>
                                            <br>
                                            <p class="card-text mt-2 text-white">{{$n->news}}.</p>
                                            <p class="card-text mt-2">{{date_format($n->created_at,'Y/M/D')}}.</p>
                                            <div class="button-items">
                                                <a type="button" href="#" class="btn btn-outline-success btn-icon-circle btn-icon-circle-sm"
                                                   wire:click.prevent="editData({{ $n->id }})"><i class="ti ti-edit"></i></a>
                                                <a wire:click.prevent="deleteConfirmation({{ $n->id }})"
                                                   type="button" class="btn btn-outline-danger btn-icon-circle btn-icon-circle-sm"><i class="ti ti-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            @endforeach
                        </div>
                        <div class="row ">


                            @foreach($newsPageVideo as $n)

                                <div class="col-sm-2">
                                    <div class="card {{$n->type == 'IMG'? 'bg-info':' bg-warning' }}" >




                                        <div class="bg-image hover-overlay ripple text-center" data-mdb-ripple-color="light">

                                                <video  height="240" controls  style="    width: 100%">
                                                    <source src="{{$n->banner}}" type="video/mp4">
                                                </video>


                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title text-dark " style="font-size: xx-large;">{{$n->title}}               </h4>
                                            <br>
                                            <h4 class="card-title text-purple mt-2 " style="font-size: x-large;"> {{$n->category}}</h4>
                                            <br>
                                            <p class="card-text mt-2 text-white">{{$n->news}}.</p>
                                            <p class="card-text mt-2">{{date_format($n->created_at,'Y/M/D')}}.</p>
                                            <div class="button-items">
                                                <a type="button" href="#" class="btn btn-outline-success btn-icon-circle btn-icon-circle-sm"
                                                   wire:click.prevent="editData({{ $n->id }})"><i class="ti ti-edit"></i></a>
                                                <a wire:click.prevent="deleteConfirmation({{ $n->id }})"
                                                   type="button" class="btn btn-outline-danger btn-icon-circle btn-icon-circle-sm"><i class="ti ti-trash"></i></a>
                                            </div>
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
                    <h5 class="modal-title">Add New </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeData">
                        {{--                 --}}



                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-8">
                                <input  required class="form-control" wire:model="title">
                                @error('title')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">News</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" style="height: 100px;" wire:model="news" placeholder="Enter News"></textarea>


                                @error('news')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-8">
                                <select class="form-control" wire:model="category">
                                    <option value="">Select category</option>

                                    @foreach ($categories as $category)

                                            <option value="{{ $category->name }}">{{ $category->name }}</option>

                                    @endforeach



                                </select>
                                @error('category')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Type</label>
                            <div class="col-sm-8">
                                <select class="form-control" wire:model="type">
                                    <option value="">Select category</option>

                                  <option value="IMG">IMG</option>
                                    <option value="VIDEO">VIDEO</option>


                                </select>
                                @error('type')
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
                    <h5 class="modal-title">Edit News</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateData">
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-8">
                                <input  required class="form-control" wire:model="title">
                                @error('title')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">News</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" style="height: 100px;" wire:model="news" placeholder="Enter News"></textarea>


                                @error('news')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Type</label>
                            <div class="col-sm-8">
                                <input class="form-control" readonly required  wire:model="type" placeholder="Enter News">


                                @error('news')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-8">
                                <select class="form-control" wire:model="category">
                                    <option value="">Select category</option>

                                    @foreach ($categories as $category)

                                        <option value="{{ $category->name }}">{{ $category->name }}</option>

                                    @endforeach



                                </select>
                                @error('category')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="example-number-input" class="col-sm-3 col-form-label">Slider Iamge <br> <small>(895 x 382)</small></label>
                            <div class="col-sm-8">
                                <input class="form-control mb-2" type="file" wire:model="banner">
                                @error('banner')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror

                                <div wire:loading="banner" wire:target="banner" wire:key="banner" style="font-size: 12.5px;" class="mr-2"><i class="fa fa-spinner fa-spin mt-3 ml-2"></i> Uploading</div>

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

