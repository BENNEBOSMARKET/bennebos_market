<div>
    <div class="container-md">
        <div class="row vh-100 d-flex justify-content-center">
            <div class="col-12 align-self-center">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 mx-auto">
                            <div class="card">
                                <div class="card-body p-0 auth-header-box">
                                    <div class="text-center p-3">
                                        <a href="/" class="logo logo-admin">
                                            <img src="{{ asset('assets/admin/images/logo.png') }}" alt="logo-large" class="logo-lg logo-light" style="height: ; width: 190px;">
                                        </a>
                                        <h4 class="mt-4 mb-1 fw-semibold text-white font-18">Admin Login</h4>
                                    </div>
                                </div>
                                <div class="card-body pt-0 pb-5">
                                    <form class="my-4" wire:submit.prevent='adminLogin'>
                                        <div class="form-group mb-2">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email"
                                                placeholder="Enter email" wire:model='email'>
                                            @error('email')
                                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                            @enderror
                                            @if (session()->has('errorMessage'))
                                                <span class="text-danger" style="font-size: 12.5px;">{{ session('errorMessage') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="userpassword">Password</label>
                                            <input type="password" class="form-control" name="password"
                                                id="userpassword" placeholder="Enter password" wire:model='password'>
                                            @error('password')
                                                <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group row mt-3">
                                            <div class="col-sm-6">
                                                <div class="form-check form-switch form-switch-success">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="customSwitchSuccess">
                                                    <label class="form-check-label" for="customSwitchSuccess">Remember
                                                        me</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mb-0 row">
                                            <div class="col-12">
                                                <div class="d-grid mt-3">
                                                    <button class="btn btn-primary" type="submit">{!! loadingStateWithText('adminLogin', 'Log In') !!} <i
                                                            class="fas fa-sign-in-alt ms-1"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
