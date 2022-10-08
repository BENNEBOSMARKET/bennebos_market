<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title>Registration</title>
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="shortcut icon" href="{{ asset('assets/front/images/header/favicon.png"') }} type=" image/x-icon" />
        <link rel="stylesheet" href="{{ asset('/assets/front/plugins/css/swiper-bundle.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/front/sass/style.css') }}" />
    </head>
<body>
    @livewire('layouts.inc.header')
        <main>
            <section class="sign_up_wrapper">
                <div class="my-container">
                    <div class="sign_up_grid">
                        <div class="sing_up_img">
                            <img src="{{ asset('assets/front/images/profile/sign_up_img.svg') }}" alt="sign up image">

                        </div>
                        <div class="sign_up_form_area">
                            <form action="{{ route('register') }}" method="POST" class="form_area" >
                                @csrf
                                <div class="form_title_area text-center">
                                    <h3>Welcome Back to Bennebos</h3>
                                    <h5>Please Sign Up Your Account</h5>
                                </div>
                                <div class="input_row">
                                    <label for="">Name</label>
                                    <input type="text" name="name" placeholder="Enter your full name" >

                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input_row">
                                    <label for="">Email</label>
                                    <input type="email" name="email" placeholder="Enter your email" >
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input_row">
                                    <label for="">Password</label>
                                    <input type="password" name="password" placeholder="Enter your password"
                                    id="password_input1"
                                    >
                                    <div class="password_eye_icon_area" id="password_eye_icon_area1">
                                      <i class="fas fa-eye eye_open" id="eyeOpen1"></i>
                                      <i class="fas fa-eye-slash eye_close" id="eyeClose1"></i>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="input_row">
                                    <label for="">Confirm Password</label>
                                    <input type="password" name="confirm_password" placeholder="Enter your password"
                                    id="password_input1"
                                    >
                                    <div class="password_eye_icon_area" id="password_eye_icon_area1">
                                      <i class="fas fa-eye eye_open" id="eyeOpen1"></i>
                                      <i class="fas fa-eye-slash eye_close" id="eyeClose1"></i>
                                    </div>
                                    @error('confirm_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="custom_checkbox_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">

                                    <label class="checkbox_wrapper">Remember Me
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                      </label>
                                      <a href="" class="forget_password">Forgot Password</a>

                                </div>

                                <div class="sign_up_button">
                                  <button type="submit">Sign In</button>
                                </div>

                                <h6 class="counnect_other_text"> <span>or continue with</span> </h6>

                                <ul class="login_option_list ">
                                  <li>
                                    <button type="button">
                                      <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.7321 3.70256C17.1059 3.98006 16.4331 4.16756 15.7259 4.25231C16.4556 3.81566 17.0016 3.12841 17.2619 2.31881C16.5763 2.72606 15.8259 3.01271 15.0434 3.16631C14.5172 2.60446 13.8202 2.23206 13.0606 2.10692C12.3011 1.98178 11.5215 2.11091 10.8428 2.47425C10.1642 2.8376 9.62447 3.41483 9.3075 4.11634C8.99053 4.81785 8.91404 5.60438 9.08988 6.35381C7.70065 6.28406 6.34161 5.92298 5.10095 5.29399C3.8603 4.66501 2.76577 3.78218 1.88839 2.70281C1.58839 3.22031 1.41589 3.82031 1.41589 4.45931C1.41555 5.03456 1.55721 5.601 1.8283 6.10836C2.09938 6.61573 2.49151 7.04834 2.96989 7.36781C2.41509 7.35016 1.87254 7.20025 1.38739 6.93056V6.97556C1.38733 7.78237 1.66641 8.56435 2.17727 9.18881C2.68814 9.81327 3.39931 10.2418 4.19014 10.4016C3.67547 10.5408 3.13589 10.5614 2.61214 10.4616C2.83526 11.1558 3.26988 11.7628 3.85516 12.1978C4.44044 12.6327 5.14707 12.8737 5.87614 12.8871C4.63851 13.8586 3.11005 14.3856 1.53664 14.3833C1.25792 14.3834 0.979444 14.3671 0.702637 14.3346C2.29974 15.3614 4.15889 15.9064 6.05764 15.9043C12.4851 15.9043 15.9989 10.5808 15.9989 5.96381C15.9989 5.81381 15.9951 5.66231 15.9884 5.51231C16.6719 5.01804 17.2618 4.40599 17.7306 3.70481L17.7321 3.70256Z" fill="black"/>
                                        </svg>


                                    </button>
                                  </li>
                                  <li>
                                    <button type="button">
                                      <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18.3999 7.90909H16.7635V6.27273H15.1272V7.90909H13.4908V9.54545H15.1272V11.1818H16.7635V9.54545H18.3999M6.12717 7.90909V9.87273H9.3999C9.23627 10.6909 8.41808 12.3273 6.12717 12.3273C4.16354 12.3273 2.60899 10.6909 2.60899 8.72727C2.60899 6.76364 4.16354 5.12727 6.12717 5.12727C7.27263 5.12727 8.00899 5.61818 8.41808 6.02727L9.97263 4.55455C8.99081 3.57273 7.68172 3 6.12717 3C2.93627 3 0.399902 5.53636 0.399902 8.72727C0.399902 11.9182 2.93627 14.4545 6.12717 14.4545C9.3999 14.4545 11.609 12.1636 11.609 8.89091C11.609 8.48182 11.609 8.23636 11.5272 7.90909H6.12717Z" fill="#1E1F20"/>
                                        </svg>

                                    </button>
                                  </li>
                                  <li>
                                    <button type="button">
                                      <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="18" height="18" transform="translate(0.799805)" fill="white"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.7998 0V3.6H12.9998C12.3788 3.6 12.0998 4.329 12.0998 4.95V7.2H14.7998V10.8H12.0998V18H8.4998V10.8H5.7998V7.2H8.4998V3.6C8.4998 1.61177 10.1116 0 12.0998 0H14.7998Z" fill="black"/>
                                        </svg>

                                    </button>
                                  </li>
                                  <li>
                                    <button type="button">
                                      <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.6652 15C13.9538 16.0629 13.1995 17.1 12.0509 17.1171C10.9024 17.1429 10.5338 16.44 9.23094 16.44C7.91951 16.44 7.51665 17.1 6.42808 17.1429C5.30522 17.1857 4.45665 16.0114 3.73665 14.9743C2.27094 12.8571 1.14808 8.95714 2.65665 6.33429C3.40236 5.03143 4.73951 4.20857 6.18808 4.18286C7.28522 4.16571 8.33094 4.92857 9.00808 4.92857C9.67665 4.92857 10.9452 4.01143 12.2738 4.14857C12.8309 4.17429 14.3909 4.37143 15.3938 5.84571C15.3166 5.89714 13.5338 6.94286 13.5509 9.11143C13.5766 11.7 15.8224 12.5657 15.8481 12.5743C15.8224 12.6343 15.4881 13.8086 14.6652 15ZM9.77094 1.28571C10.3966 0.574286 11.4338 0.0342857 12.2909 0C12.4024 1.00286 11.9995 2.01429 11.3995 2.73429C10.8081 3.46286 9.83094 4.02857 8.87094 3.95143C8.74236 2.96571 9.22236 1.93714 9.77094 1.28571Z" fill="#1E1F20"/>
                                        </svg>

                                    </button>
                                  </li>
                                </ul>
                            </form>
                            <h6 class="already_account">Already have an account?<a href="{{ route('login') }}">Sign In Here</a> </h6>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    @livewire('layouts.inc.footer')

    <!-- JS Here -->
    <script src="{{ asset('assets/front/plugins/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/front/plugins/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/front/plugins/js/zoomsl.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/46f35fbc02.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/front/js/main.js') }}"></script>
</body>
</html>
