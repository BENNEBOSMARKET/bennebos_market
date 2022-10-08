<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Website Setup</li>
                            <li class="breadcrumb-item active">Website Footer</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Website Footer</h4>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5><strong>Footer Setting</strong></h5>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent='updateHeader'>
                            <div class="mb-3 row">
                                <label for="example-number-input" class="col-sm-3 col-form-label">Footer Logo</label>
                                <div class="col-sm-9">
                                    <input class="form-control mb-2" type="file" wire:model="logo">
                                    @error('logo')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                        <br>
                                    @enderror
                                    <div wire:loading="logo" wire:target="logo" wire:key="logo" style="font-size: 12.5px;" class="mr-2"><i class="fa fa-spinner fa-spin mt-3 ml-2"></i> Uploading</div>

                                    @if ($logo)
                                        <img src="{{ $logo->temporaryUrl() }}" class="mt-2 mb-2" width="206" />
                                    @elseif($uploadedLogo != '')
                                        <img src="{{ asset('uploads/logo') }}/{{ $uploadedLogo }}" class="mt-2 mb-2" width="206" />
                                    @endif
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="mb-3 row">
                                <label for="example-number-input" class="col-sm-3 col-form-label">Facebook Url</label>
                                <div class="col-sm-9">
                                    <input class="form-control mb-2" type="text" wire:model="facebook_url" placeholder="Enter url">
                                    @error('facebook_url')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-number-input" class="col-sm-3 col-form-label">Twitter Url</label>
                                <div class="col-sm-9">
                                    <input class="form-control mb-2" type="text" wire:model="twitter_url" placeholder="Enter url">
                                    @error('twitter_url')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-number-input" class="col-sm-3 col-form-label">WhatsApp Url</label>
                                <div class="col-sm-9">
                                    <input class="form-control mb-2" type="text" wire:model="whatsapp_url" placeholder="Enter url">
                                    @error('whatsapp_url')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="example-number-input" class="col-sm-3 col-form-label">linkedin Url</label>
                                <div class="col-sm-9">
                                    <input class="form-control mb-2" type="text" wire:model="linkedin_url" placeholder="Enter url">
                                    @error('linkedin_url')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row mt-4">
                                <div class="col-md-12" style="text-align: right;">
                                    <button class="btn btn-primary" style="width: 100px;">{!! loadingStateWithText('updateHeader', 'Update') !!}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
