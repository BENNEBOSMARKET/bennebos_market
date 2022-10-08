@section('title')
    {{ __('customer.my_profile') }}
@endsection
<div>
    <style>
        .save_changes_buttonss {
            padding: 7px 20px;
            background-color: #74c247;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
        }
        .text-danger{
            color: red;
        }
        select{
            width: 100%;
            background: #ffffff;
            border: 1px solid #e8e9ec;
            border-radius: 15px;
            padding-left: 16px;
            height: 56px;
            font-size: 16px;
            color: #13192b;
            padding-right: 16px;
        }
    </style>
    <!-- Profile Account Section  -->
    <section class="profile_account_wrapper">
        <div class="my-container">
            <div class="profile_title_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                <h3 class="cart_title">{{ __('customer.dashboard') }}</h3>
                <button type="button" id="profileSidebarIcon">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
            <div class="profile_sidebar_grid_area">

                @livewire('customer.inc.sidebar')

                <div class="profile_content_wrapper">
                    <div
                        class="profile_content_title_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                        <h3>{{ __('customer.my_profile') }}</h3>
                    </div>
                    <div class="profile_account_form">
                        <form class="form_area" wire:submit.prevent="storeData" enctype="multipart/form-data">
                            <div
                                class="profile_content_profile d-flex align-items-center justify-content-center flex-wrap-wrap g-sm">
                                <div class="user_img_area position-relative" style="text-align: center;">

                                    @if ($avatar)
                                        <img src="{{ $avatar->temporaryUrl() }}" class="user_img"
                                            alt="user image" height="200" width="200" />
                                    @else
                                        @if (user()->avatar)
                                            <img src="{{ user()->avatar }}" alt="" class="user_img" height="200"
                                                width="200" />
                                        @else
                                            <img src="{{ asset('assets/images/avatar-place.png') }}" alt=""
                                                class="user_img" height="200" width="200" />
                                        @endif
                                    @endif

                                    <label for="userProfileFile">
                                        <img src="{{ asset('assets/front/images/icon/user_pic_select_icon.png') }}"
                                            alt="user pic select" />
                                    </label>
                                    <input type="file" id="userProfileFile" class="user_file_input"
                                        wire:model='avatar' />
                                </div>
                                
                            </div>
                            <div class="profile_content_profile" id="profileAccountArea">
                                <div class="input_row" style="display: flex">
                                    <div style="width: 48%">
                                        <label for="">{{ __('customer.first_name') }}</label>
                                        <input type="text" wire:model="first_name" />
                                        @error('first_name')
                                            <span class="text-danger"
                                                style="font-size: 12.5px; color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div style="width: 48%; margin-left: 4%;">
                                        <label for="">{{ __('customer.last_name') }}</label>
                                        <input type="text" wire:model="last_name" />
                                        @error('last_name')
                                            <span class="text-danger"
                                                style="font-size: 12.5px; color: red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input_row">
                                    <label for="">{{ __('customer.date_birth') }}</label>
                                    <input type="date" value="2022-07-22" />
                                </div>
                                <div class="input_row">
                                    <label for="">{{ __('customer.gender') }}</label>
                                    <div class="gender_radion_button_area d-flex align-items-center flex-wrap-wrap">
                                        <label class="custom_radio_button_area">
                                            <span class="radio_text">{{ __('customer.male') }}</span>
                                            <input type="radio" value="Male" name="gender" wire:model="gender" />
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="custom_radio_button_area">
                                            <span class="radio_text">{{ __('customer.female') }}</span>
                                            <input type="radio" name="gender" value="Female" wire:model="gender" />
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="input_row">
                                    <label for="">{{ __('customer.phone_number') }}</label>
                                    <div style="display: flex">
                                        <div style="width: 15%">
                                            <select id="code" wire:model="phonecode">
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->phonecode }}">+{{ $country->phonecode }} ({{ $country->sortname }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div style="width: 83%; margin-left: 2%;">
                                            <input type="text" placeholder=" 17552364" wire:model="phone" />
                                        </div>
                                    </div>
                                    @error('phone')
                                        <span class="text-danger"
                                            style="font-size: 12.5px; color: red;">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="input_row">
                                    <label for="">{{ __('customer.email') }}</label>
                                    <input type="email" wire:model="email" disabled />
                                    @error('email')
                                        <span class="text-danger"
                                            style="font-size: 12.5px; color: red;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input_row" style="text-align: right;">
                                    <button type="submit" class="save_changes_buttonss btnPreLoad">{{ __('customer.update_profile') }}</button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                


                    <div class="profile_content_title_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm" style="margin-top: 100px;">
                        <h3>{{ __('customer.change_password') }}</h3>
                    </div>
                    <div class="profile_content_profile">
                        <form wire:submit.prevent="changePassword" class="form_area">
                            <div class="input_row">
                                <label for="">{{ __('customer.old_password') }}</label>
                                <input type="password" placeholder="{{ __('customer.old_password_place') }}" id="password_input1"
                                    wire:model='current_password' />
                                @error('current_password')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                                <div wire:ignore>
                                    <div class="password_eye_icon_area" id="password_eye_icon_area1">
                                        <i class="fas fa-eye eye_open" id="eyeOpen1"></i>
                                        <i class="fas fa-eye-slash eye_close" id="eyeClose1"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="input_row">
                                <label for="">{{ __('customer.new_password') }}</label>
                                <input type="password" wire:model='password' placeholder="{{ __('customer.new_password_place') }}"
                                    id="password_input2" />
                                @error('password')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                                <div wire:ignore>
                                    <div class="password_eye_icon_area" id="password_eye_icon_area2">
                                        <i class="fas fa-eye eye_open" id="eyeOpen2"></i>
                                        <i class="fas fa-eye-slash eye_close" id="eyeClose2"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="input_row">
                                <label for="">{{ __('customer.confirm_password') }}</label>
                                <input type="password" wire:model="confirm_password" placeholder="{{ __('customer.confirm_password_place') }}"
                                    id="password_input3" />
                                @error('confirm_password')
                                    <span class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                                <div wire:ignore>
                                    <div class="password_eye_icon_area" id="password_eye_icon_area3">
                                        <i class="fas fa-eye eye_open" id="eyeOpen3"></i>
                                        <i class="fas fa-eye-slash eye_close" id="eyeClose3"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="input_row" style="text-align: right;">
                                <button type="submit" class="save_changes_buttonss btnPreLoad">{{ __('customer.change_password') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile_sidebar_overlay" id="sidebarOverlay"></div>
    </section>
</div>
@push('scripts')
<script>
    window.addEventListener('success', event => {
        toastr.success(event.detail.message);
    });
    window.addEventListener('warning', event => {
        toastr.warning(event.detail.message);
    });
    window.addEventListener('error', event => {
        toastr.error(event.detail.message);
    });
</script>
@endpush