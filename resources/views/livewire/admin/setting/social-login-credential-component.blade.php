<div>
    <style>
        thead tr {
            background: rgb(219, 219, 219);
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Setting</li>
                            <li class="breadcrumb-item active">Social Login Setting</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Social Login Setting</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Google Login Credential</h4>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="storeGoogleSecret">
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Google Client ID</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" wire:model="client_id" placeholder="Enter client id">
                                    @error('client_id')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Google Client Secret</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" wire:model="client_secret" placeholder="Enter client secret">
                                    @error('client_secret')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Google Redirect Url</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" wire:model='redirect_url' readonly>
                                </div>
                            </div>
    
                            <div class="mb-3 row">
                                <label for="example-number-input" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-sm btn-primary">{!! loadingStateWithText('storeGoogleSecret', 'Submit') !!}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Facebook Login Credential</h4>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="storeFacebookSecret">
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Facebook Client ID</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" wire:model="facebook_client_id" placeholder="Enter client id">
                                    @error('facebook_client_id')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Facebook Client Secret</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" wire:model="facebook_client_secret" placeholder="Enter client secret">
                                    @error('facebook_client_secret')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Facebook Redirect Url</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" wire:model='facebook_redirect_url' readonly>
                                </div>
                            </div>
    
                            <div class="mb-3 row">
                                <label for="example-number-input" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-sm btn-primary">{!! loadingStateWithText('storeFacebookSecret', 'Submit') !!}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Twitter Login Credential</h4>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="storeTwitterSecret">
                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Twitter Client ID</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" wire:model="twitter_client_id" placeholder="Enter client id">
                                    @error('twitter_client_id')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Twitter Client Secret</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" wire:model="twitter_client_secret" placeholder="Enter client secret">
                                    @error('twitter_client_secret')
                                        <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Twitter Redirect Url</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" wire:model='twitter_redirect_url' readonly>
                                </div>
                            </div>
    
                            <div class="mb-3 row">
                                <label for="example-number-input" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-sm btn-primary">{!! loadingStateWithText('storeTwitterSecret', 'Submit') !!}</button>
                                </div>
                            </div>
                        </form>
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
        window.addEventListener('categoryDeleteError', event => {
            Swal.fire(
                'Error!',
                'Can not delete this category.<br>Because this category has active posts or subcategory.<br>Please delete them first.',
                'error'
            )
        });
    </script>
@endpush
