<div>
    <style>
        #customSwitchSuccess {
            font-size: 25px;
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
                            <li class="breadcrumb-item active">Features Activation</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Features Activation</h4>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-12 text-center">
                <h4><strong>System</strong></h4>
            </div>
        </div>
        <div class="row mb-3 justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5><strong>App Debug</strong></h5>
                    </div>
                    <div class="card-body d-flex justify-content-center pt-4 pb-5">
                        <div class="form-check form-switch form-switch-success">
                            <input class="form-check-input" type="checkbox" wire:click="appDebug"
                                id="customSwitchSuccess" {{ $app_debug == 'true' ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mb-3">
            <div class="col-md-12 text-center">
                <h4><strong>Social Media Login</strong></h4>
            </div>
        </div>
        <div class="row mb-3 justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5><strong>Google Login</strong></h5>
                    </div>
                    <div class="card-body d-flex justify-content-center pt-4 pb-4">
                        <div class="form-check form-switch form-switch-success">
                            <input class="form-check-input" type="checkbox" wire:click="socialLoginStatus('google')"
                                id="customSwitchSuccess" {{ $google_login == 1 ? 'checked' : '' }}>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <div class="alert alert-primary">
                            <small>
                                You need to configure Twitter Client correctly to enable this feature.
                                <br>
                                <a href="{{ route('admin.socialLoginSetting') }}" style="color: red;">Configure Now</a>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5><strong>Facebook Login</strong></h5>
                    </div>
                    <div class="card-body d-flex justify-content-center pt-4 pb-4">
                        <div class="form-check form-switch form-switch-success">
                            <input class="form-check-input" type="checkbox" wire:click="socialLoginStatus('facebook')" id="customSwitchSuccess" {{ $facebook_login == 1 ? 'checked' : '' }}>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <div class="alert alert-primary">
                            <small>
                                You need to configure Twitter Client correctly to enable this feature.
                                <br>
                                <a href="{{ route('admin.socialLoginSetting') }}" style="color: red;">Configure Now</a>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5><strong>Twitter Login</strong></h5>
                    </div>
                    <div class="card-body d-flex justify-content-center pt-4 pb-4">
                        <span class="form-check form-switch form-switch-success">
                            <input class="form-check-input" type="checkbox" wire:click="socialLoginStatus('twitter')"
                                id="customSwitchSuccess" {{ $twitter_login == 1 ? 'checked' : '' }}>
                        </span>
                    </div>
                    <div class="card-footer text-center">
                        <div class="alert alert-primary">
                            <small>
                                You need to configure Twitter Client correctly to enable this feature.
                                <br>
                                <a href="{{ route('admin.socialLoginSetting') }}" style="color: red;">Configure Now</a>
                            </small>
                        </div>
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
