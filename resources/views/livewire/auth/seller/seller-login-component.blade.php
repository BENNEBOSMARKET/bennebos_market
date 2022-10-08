@section('title') {{ __('auth.login') }} @endsection
<div>
    <style>
        .error-message{
            background: red;
            color: white;
            padding: 17px 10px;
            font-size: 14px;
            text-align: center;
            margin: 10px 0px;
        }
    </style>
    <main>
        <section class="sign_up_wrapper">
            <div class="my-container">
                <div class="sign_up_grid">
                    <div class="sing_up_img">
                        <img src="{{ asset('assets/front/images/profile/sign_up_img.svg') }}" alt="sign up image">
                    </div>

                    <div class="sign_up_form_area">
                        <form wire:submit.prevent='signIn' class="form_area">
                            <div class="form_title_area text-center">
                                <h3>{{ __('auth.welcome_back_bennebos') }}</h3>
                                <h5>{{ __('auth.Please_sign_seller_account') }}</h5>
                            </div>
                            @if (session()->has('disabledMessage'))
                                <div class="error-message">{{ session('disabledMessage') }}</div>
                            @endif
                            <div class="input_row">
                                <label for="email">{{ __('auth.email') }}</label>
                                <input type="email" name="email" id="email" placeholder="{{ __('auth.email_placeholder') }}" wire:model='email'>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if (session()->has('errorMessage'))
                                    <div class="invalid-feedback">{{ session('errorMessage') }}</div>
                                @endif
                            </div>

                            <div class="input_row">
                                <label for="password_input1">{{ __('auth.password') }}</label>
                                <input type="password" name="password" placeholder="{{ __('auth.placeholder_enter_your_password') }}"
                                    id="password_input1" wire:model='password'>
                                <div class="password_eye_icon_area" id="password_eye_icon_area1">
                                    <i class="fas fa-eye eye_open" id="eyeOpen1"></i>
                                    <i class="fas fa-eye-slash eye_close" id="eyeClose1"></i>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div
                                class="custom_checkbox_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                <label class="checkbox_wrapper">{{ __('auth.remember_me') }}
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                                <a href="#" class="forget_password">{{ __('auth.forget_password') }}</a>
                            </div>

                            <div class="sign_up_button">
                                <button type="submit" class="btnPreLoad">{{ __('auth.sign_in') }}</button>
                            </div>
                        </form>
                        <h6 class="already_account">{{ __('auth.register_seller_now') }}<a href="{{ route('seller.registration') }}">{{ __('auth.sign_up') }}</a>
                        </h6>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
