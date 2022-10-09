@section('title') {{ __('auth.login') }} @endsection
<div>
    <style>
        .success-message{
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
                                <h5>{{ __('auth.Please_sign_customer_account') }}</h5>
                                <h6 class="already_account" style="margin-top: 0px;">Are you a seller? <a href="{{ route('seller.login') }}">Login as Seller</a></h6>
                            </div>
                            

                            @if (session()->has('success'))
                                <div class="success-message">{{ session('success') }}</div>
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
                                <a href="{{ route('forgetPassword') }}" class="forget_password">{{ __('auth.forget_password') }}</a>
                            </div>

                            <div class="sign_up_button">
                                <button type="submit" class="btnPreLoad">{{ __('auth.sign_in') }}</button>
                            </div>
                            @if( $social != null )
                                @if ($social->google_login == 1 || $social->facebook_login == 1 || $social->twitter_login == 1)
                                    <h6 class="counnect_other_text"> <span>{{ __('auth.or_continue_with') }}</span> </h6>
                                    <ul class="login_option_list ">
                                        @if ($social->google_login == 1)
                                            <li>
                                                <a href="{{ route('authGoogle') }}">
                                                    <button type="button">
                                                        <i class="fa fa-google"></i>
                                                    </button>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($social->facebook_login == 1)
                                            <li>
                                                <a href="{{ route('authFacebook') }}">
                                                    <button type="button">
                                                        <i class="fa fa-facebook"></i>
                                                    </button>
                                                </a>
                                            </li>
                                        @endif

                                        @if ($social->twitter_login == 1)
                                            <li>
                                                <a href="{{ route('authTwitter') }}">
                                                    <button type="button">
                                                        <i class="fa fa-twitter"></i>
                                                    </button>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                @endif
                            @endif
                        </form>
                        <h6 class="already_account">Don't have an account? <a href="{{ route('registration') }}">{{ __('auth.sign_up_here') }}</a>
                        </h6>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
