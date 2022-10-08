@section('page_title')
{{ __('seller.shop_profile') }}
@endsection
<div>
    <div class="container-fluid">
        <form wire:submit.prevent='updateShop'>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('seller.shop_information') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <label for="" class="col-sm-2">{{ __('seller.shop_name') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-md" placeholder="Enter products name" wire:model="name" wire:keyup='generateslug' />
                                    @error('name')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="" class="col-sm-2">{{ __('seller.shop_address') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-md" placeholder="Enter address" wire:model="address" />
                                    @error('address')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-2">{{ __('seller.shipping_cost') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-md" placeholder="Enter address" wire:model="shipping_cost" />
                                    @error('shipping_cost')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('seller.social_media_links') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <label for="" class="col-sm-2">{{ __('seller.facebook') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-md" placeholder="Enter facebook url" wire:model="facebook" />
                                    @error('facebook')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-2">{{ __('seller.twitter') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-md" placeholder="Enter twitter url" wire:model="twitter" />
                                    @error('twitter')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-2">{{ __('seller.google') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-md" placeholder="Enter google url" wire:model="google" />
                                    @error('google')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-2">{{ __('seller.youtube') }}</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control-md" placeholder="Enter youtube url" wire:model="youtube" />
                                    @error('youtube')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('seller.shop_description') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <label for="" class="col-sm-2">{{ __('seller.Description_shop') }}</label>
                                <div class="col-sm-9">
                                    <textarea type="text" cols="30" rows="12" class="form-control" placeholder="Enter description" wire:model="description"></textarea>
                                    @error('description')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('seller.shop_media') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <label for="" class="col-sm-2">{{ __('seller.shop_logo') }} <small>{{ __('seller.shop_size1') }}</small></label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control form-control-md" wire:model="logo" />
                                    @error('logo')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                    <div wire:loading="logo" wire:target="logo" wire:key="logo" style="font-size: 12.5px;"
                                        class="mr-2"><i class="fa fa-spinner fa-spin mt-3 ml-2"></i> {{ __('seller.uploading') }}</div>

                                    @if ($logo)
                                        <img src="{{ $logo->temporaryUrl() }}" width="80" class="mt-4 mb-4" />
                                    @elseif ($uploaded_logo)
                                        <img src="{{ $uploaded_logo }}" width="80" class="mt-4 mb-4" />
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-2">{{ __('seller.shop_banner') }} <small>{{ __('seller.shop_size2') }}</small></label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control form-control-md" wire:model="banner" />
                                    @error('banner')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                    <div wire:loading="banner" wire:target="banner" wire:key="banner" style="font-size: 12.5px;"
                                        class="mr-2"><i class="fa fa-spinner fa-spin mt-3 ml-2"></i> {{ __('seller.uploading') }}</div>

                                    @if ($banner)
                                        <img src="{{ $banner->temporaryUrl() }}" style="height: 70px;" class="img-fluid mt-4 mb-4" />
                                    @elseif ($uploaded_banner)
                                        <img src="{{ $uploaded_banner }}" style="height: 70px;" class="img-fluid mt-4 mb-4" />
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="" class="col-sm-2">{{ __('seller.shop_gallery') }} <small>{{ __('seller.shop_size3') }}</small></label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control form-control-md" wire:model="gallery" multiple />
                                    @error('gallery')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                    <div wire:loading="gallery" wire:target="gallery" wire:key="gallery" style="font-size: 12.5px;"
                                        class="mr-2"><i class="fa fa-spinner fa-spin mt-3 ml-2"></i> {{ __('seller.uploading') }}</div>

                                    @if ($gallery)
                                        @foreach ($gallery as $key => $gitem)
                                            <img src="{{ $gitem->temporaryUrl() }}"
                                                alt="upload img" style="height: 70px;" class="img-fluid mt-4 mb-4" />
                                            <a href="" type="button" class="delete_file" wire:click.prevent="removeGallery({{ $key }})">
                                                <i class="ti ti-x text-danger"></i>
                                            </a>
                                        @endforeach
                                    @endif

                                    @if ($uploaded_gallery)
                                        @foreach ($uploaded_gallery as $keyg => $ugitem)
                                            <img src="{{ $ugitem }}" style="height: 70px;" class="img-fluid mt-4 mb-4" />
                                            <a href="" type="button" class="delete_file" wire:click.prevent="deleteGallery({{ $keyg }})">
                                                <i class="ti ti-x text-danger"></i>
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-primary btn-lg pl-4 pr-4">
                        {!! loadingStateWithText('updateShop', 'Update Profile') !!}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
@endpush
