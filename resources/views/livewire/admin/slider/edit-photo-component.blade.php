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
                            <li class="breadcrumb-item active"> Mega Menu  </li>
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
                        <h4 class="card-title">All Potos</h4>
                        <button class="card-button btn btn-sm btn-primary" style="padding: 1px 7px;"
                                data-bs-toggle="modal" data-bs-target="#addDataModal"><i class="ti ti-plus"></i> Add
                            Photo</button>
                    </div>
                    <div class="card-body">
                        <div class="row ">

                                @foreach($photos as $photo)
                                <div class="col-xl-3">
                                    <a  href="#" class="img-container text-center"
                                       wire:click.prevent="editData({{ $photo->id ,$photo->banner}})">

                                    <img
                                        src="{{ $photo->banner }}"
                                        class=" img-thumbnail"
                                        alt="Palm Springs Road"  width="304" height="236"
                                            >
                                            <h4 >{{$photo->category}}</h4>


                                    </a>
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
                    <h5 class="modal-title">Add New Photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeData">
{{--                 --}}
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-8">
                                <select class="form-control" wire:model="category">
                                    <option value="">Select category</option>
                                    <?php $suc=0 ?>
                                    @foreach($photos as $ph)
                                        @if($ph->category == 'الرئيسية')
                                                <?php $suc=1 ?>
                                        @endif
                                    @endforeach
                                    @if($suc == 0)
                                    <option value="الرئيسية">الرئيسية</option>
                                    @endif

                                    <?php $suc=0 ?>
                                    @foreach($photos as $ph)
                                        @if($ph->category == 'الرئيسية الثانية')
                                                <?php $suc=1 ?>
                                        @endif
                                    @endforeach
                                    @if($suc == 0)
                                        <option value="الرئيسية الثانية">الرئيسية الثانية</option>
                                    @endif

                                @foreach ($categories as $category)


                                        @foreach ($categories as $category)
                                                <?php $suc=0 ?>
                                            @foreach($photos as $ph)
                                                @if($ph->category == $category->name)
                                                        <?php $suc=1 ?>
                                                @endif
                                            @endforeach
                                            @if($suc == 0)
                                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                                            @endif
                                @endforeach
                                    @endforeach
                                    <?php $suc=0 ?>
                                    @foreach($photos as $ph)
                                        @if($ph->category == 'الصورة الفسيفسائية')
                                                <?php $suc=1 ?>
                                        @endif
                                    @endforeach
                                    @if($suc == 0)
                                    <option value="الصورة الفسيفسائية">الصورة الفسيفسائية</option>
                                    @endif

                                </select>
                                @error('category')
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
                    <h5 class="modal-title">Edit Photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateData">
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-sm-3 col-form-label">Category</label>
                            <div class="col-sm-8">
                                <input readonly required class="form-control" wire:model="category">
                                @error('category')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="example-number-input" class="col-sm-3 col-form-label">Slider Iamge <br> <small>(895 x 382)</small></label>
                            <div class="col-sm-8">
                                <input class="form-control mb-2" type="file" wire:model="new_banner">
                                @error('banner')
                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                                <div wire:loading="banner" wire:target="banner" wire:key="banner"
                                     style="font-size: 12.5px;" class="mr-2"><i
                                        class="fa fa-spinner fa-spin mt-3 ml-2"></i> Uploading</div>
                                @if ($banner)
                                    <img src="{{ $banner->temporaryUrl() }}" width="80" class="mt-2 mb-2" />
                                @elseif($new_banner != '')
                                    <img src="{{ asset('uploads/imageUpload/') }}/{{ $new_banner }}" width="120"
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

