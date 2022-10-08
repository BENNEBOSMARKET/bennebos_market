@section('title')
{{ __('customer.payment_method') }}
@endsection
<div>
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
                        <h3>{{ __('customer.payment_method') }}</h3>
                    </div>
                    <div class="payment_info_area">
                        <div>
                            <button type="button" class="modal_payment_button" id="modalClickButton1">
                                + {{ __('customer.add_payment_method') }}
                            </button>
                        </div>

                        <div class="payment_card_info">
                            <h4>{{ __('customer.account_details') }}</h4>
                            <div class="payment_card_list">
                                @if ($paymet_methods->count() > 0)
                                @foreach ($paymet_methods as $method)
                                <div
                                    class="payment_card_list_item d-flex align-items-center justify-content-between g-sm">
                                    <div class="card_icon_name_title d-flex align-items-center flex-wrap-wrap">
                                        @if ($method->card_name == 'Visa Card')
                                        <img src="{{ asset('assets/front/images/icon/payment_option_img_2.svg') }}"
                                            alt="payment card" />
                                        @else
                                        <img src="{{ asset('assets/front/images/icon/payment_option_img_3.svg') }}"
                                            alt="payment card" />
                                        @endif

                                        <h5>{{ $method->card_number }}</h5>
                                    </div>
                                    <button type="button" wire:click.prevent="deleteCard({{ $method->id }})">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M19.3248 9.46777C19.3248 9.46777 18.7818 16.2028 18.4668 19.0398C18.3168 20.3948 17.4798 21.1888 16.1088 21.2138C13.4998 21.2608 10.8878 21.2638 8.27979 21.2088C6.96079 21.1818 6.13779 20.3778 5.99079 19.0468C5.67379 16.1848 5.13379 9.46777 5.13379 9.46777"
                                                stroke="#EB5757" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M20.708 6.23926H3.75" stroke="#EB5757" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path
                                                d="M17.4406 6.23949C16.6556 6.23949 15.9796 5.68449 15.8256 4.91549L15.5826 3.69949C15.4326 3.13849 14.9246 2.75049 14.3456 2.75049H10.1126C9.53358 2.75049 9.02558 3.13849 8.87558 3.69949L8.63258 4.91549C8.47858 5.68449 7.80258 6.23949 7.01758 6.23949"
                                                stroke="#EB5757" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </div>
                                @endforeach
                                @else
                                {{ __('customer.no_details_available') }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Modal Adress -->
                    <div class="modal_wrapper" id="modalID1" wire:ignore.self>
                        <div class="modal_dialog">
                            <div
                                class="modal_header d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                                <h3>{{ __('customer.add_new_card') }}</h3>
                                <button type="button" id="modalClose1">
                                    <img src="{{ asset('assets/front/images/icon/close_icon.svg') }}"
                                        alt="close icon" />
                                </button>
                            </div>
                            <div class="modal_body">
                                <form wire:submit.prevent="storeData" class="form_area">
                                    <div class="modal_form_item_grid">
                                        <div class="input_row">
                                            <label for="">{{ __('customer.select_card') }}</label>
                                            <span wire:ignore>
                                                <select id='niceSelectAddress' class="niceSelect">
                                                    <option value="">{{ __('customer.select_card') }}</option>
                                                    <option value="Master Card">{{ __('customer.master_card') }}
                                                    </option>
                                                    <option value="Credit Card">{{ __('customer.credit_card') }}
                                                    </option>
                                                    <option value="Visa Card">{{ __('customer.visa_card') }}</option>
                                                    <option value="Others">{{ __('customer.others') }}</option>
                                                </select>
                                            </span>
                                            @error('card_name')
                                            <p style="color: red; font-size: 12.5px;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal_form_item_grid">
                                        <div class="input_row">
                                            <label for="">{{ __('customer.card_number') }}</label>
                                            <input wire:model="card_number" type="number"
                                                placeholder="{{ __('customer.card_number') }}" />
                                            @error('card_number')
                                            <p style="color: red; font-size: 12.5px;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="sign_up_button">
                                        <button type="submit">{{ __('customer.add_card') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal_overlay" id="modalOverlay1" wire:ignore.self></div>
                </div>
            </div>
        </div>
        <div class="profile_sidebar_overlay" id="sidebarOverlay"></div>
    </section>
</div>
@push('scripts')
<script>
    $(document).ready(function() {
            $('#niceSelectAddress').on('change', function() {
                var val = $(this).val();
                @this.set('card_name', val);
            });
        });
</script>
<script>
    window.addEventListener('closeModal', event => {
            modalHide("modalID1", "modalOverlay1");
        });

</script>

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