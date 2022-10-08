@section('title') {{ __('auth.seller_registration') }} @endsection
<div>
    <style>
        .customSelect{
            height: 44px;
            border: 1.5px solid #e8e9ec;
            width: 100%;
            background: #f7f7f7;
            border-radius: 5px;
            padding-left: 16px;
            font-size: 16px;
            color: #13192b;
            padding-right: 16px;
        }
    </style>

    <section class="become_sellar_wrapper">
        <div class="my-container">
            <div class="sellar_title_header d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                <h3 class="sellar_title">{{ __('auth.become_a_seller') }}</h3>
                <div>
                    <button type="button" class="demo_video_btn" id="modalClickButton1">
                        <div class="video_btn_area">
                            <div class="video_play_button">
                                <svg width="37" height="40" viewBox="0 0 37 40" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M33.9297 15.683C37.263 17.6075 37.263 22.4187 33.9297 24.3432L8.23276 39.1794C4.89942 41.1039 0.732767 38.6982 0.732767 34.8492L0.732768 5.17698C0.732769 1.32798 4.89944 -1.07764 8.23277 0.846864L33.9297 15.683Z"
                                        fill="#EB5E10" />
                                </svg>
                                <span style="--i: 1"></span>
                                <span style="--i: 2"></span>
                                <span style="--i: 3"></span>
                            </div>
                        </div>
                        {{ __('auth.how_can_apply') }}
                    </button>
                </div>
            </div>
            <!-- Modal Adress -->
            <div class="modal_wrapper" id="modalID1">
                <div class="modal_dialog">
                    <div class="modal_header d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                        <h3> {{ __('auth.checkout_new_address') }}</h3>
                        <button type="button" id="modalClose1">
                            <img src="{{ asset('assets/front/images/icon/close_icon.svg') }}" alt="close icon" />
                        </button>
                    </div>
                    <div class="modal_body">
                        <div class="modal_video_area">
                            <video controls id="videoItem1">
                                <source src="{{ asset('assets/front/videos/featues_video.mp4') }}" type="video/mp4" />
                                {{ __('auth.video_not_support_text') }}
                            </video>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal_overlay" id="modalOverlay1"></div>
            <div class="become_sellar_form_area">
                <h4> {{ __('auth.bennebos_marketer') }}</h4>
                <div class="multistep_form_area">
                    <form id="msform" class="multistep_form form_area" wire:submit.prevent='signUp'>
                        <div class="modal_form_item_grid">
                            <div class="input_row">
                                <label for=""> {{ __('auth.first_name') }}</label>
                                <input type="text" placeholder=" {{ __('auth.placeholder_enter_first_name') }}" wire:model="first_name" />
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input_row">
                                <label for=""> {{ __('auth.last_name') }}</label>
                                <input type="text" placeholder=" {{ __('auth.placeholder_enter_last_name') }}" wire:model="last_name" />
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal_form_item_grid">
                            <div class="input_row">
                                <label for=""> {{ __('auth.e_mail_address') }}</label>
                                <input type="email" placeholder=" {{ __('auth.placeholder_e_mail') }}" wire:model="email" />
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input_row">
                                <label for=""> {{ __('auth.your_mobile_phone') }}</label>
                                <input type="number" placeholder="{{ __('auth.placeholder_mobile_number') }}" wire:model="phone" />
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal_form_item_grid">
                            <div class="input_row">
                                <label for="">{{ __('auth.password') }}</label>
                                <input type="password" placeholder="{{ __('auth.password') }}" wire:model='password' />
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input_row">
                                <label for="">{{ __('auth.confirm_password') }}</label>
                                <input type="password" placeholder="{{ __('auth.password') }}" wire:model='confirm_password' />
                                @error('confirm_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="modal_form_item_grid">
                            <div class="input_row">
                                <label for="">{{ __('auth.shop_name') }}</label>
                                <input type="text" placeholder="Enter shop name" wire:model="shop_name" />
                                @error('shop_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input_row">
                                <label for="">{{ __('auth.shop_address') }}</label>
                                <input type="text" placeholder="{{ __('auth.placeholder_enter_full_address') }}" wire:model="shop_address" />
                                @error('shop_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal_form_item_grid">
                            <div class="input_row">
                                <label for="">{{ __('auth.product_category_to_sell') }}</label>
                                <select class="customSelect" wire:model="category">
                                    <option value="">{{ __('auth.select_category') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input_row">
                                <label for="">{{ __('auth.company_type') }}</label>
                                <select class="customSelect" wire:model="company_type">
                                    <option value="">{{ __('auth.select_company_type') }}</option>
                                    <option value="Personal">{{ __('auth.personal') }}</option>
                                    <option value="Company">{{ __('auth.company') }}</option>
                                </select>
                                @error('company_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal_form_item_grid">
                            <div class="input_row">
                                <label for="">Trnc/TIN</label>
                                <input type="text" placeholder="Trnc/TIN" wire:model="tin" />
                                @error('tin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input_row">
                                <label for="">{{ __('auth.country') }} </label>
                                <select class="customSelect" wire:model='country_id'>
                                    <option value="">{{ __('auth.select_country') }}</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal_form_item_grid">
                            <div class="input_row">
                                <label for="state_id">{{ __('auth.state') }} </label>
                                <select class="customSelect" wire:model="state_id">
                                    <option value="">{{ __('auth.select_state') }}</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                                @error('state_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input_row">
                                <label for="">{{ __('auth.reference_code') }} </label>
                                <input type="number" placeholder="{{ __('auth.placeholder_enter_ref_code') }}" wire:model="reference_code" />
                                @error('reference_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal_form_item_grid">
                            <div class="input_row">
                                <div
                                    class="custom_checkbox_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                    <label class="checkbox_wrapper">{{ __('auth.agree_with') }}
                                        <input type="checkbox" wire:model="checkbox" />
                                        <span class="checkmark"></span>
                                        <a href="{{ route('terms-conditon') }}" class="forget_password">{{ __('auth.terms_conditions') }}</a>
                                    </label>
                                </div>
                                @error('checkbox')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="">
                            <div class="input_row text-center">
                                <button type="submit" class="become_btn btnPreLoad">{{ __('auth.register') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#select_country').change(function() {
                @this.set('country_id', $(this).val());

                if ($(this).val() != '') {
                    var country_id = $(this).val();
                    $.ajax({
                        url: "{{ route('getStates') }}",
                        method: "POST",
                        data: {
                            country_id: country_id,
                            _token: '<?php echo csrf_token() ?>',
                        },
                        success: function(result) {
                            $('#dependentStates').html(result);
                        }
                    })
                }
            });
        });
    </script>
@endpush