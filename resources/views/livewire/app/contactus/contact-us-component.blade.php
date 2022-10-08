@section('title')
    Contact Us
@endsection
<div>
    <!-- Contact Section  -->
    <section class="contact_wrapper">
        <div class="my-container">
            <div class="contact_text_area">
                <h2>{{ __('auth.contact_us') }}</h2>
                <p>
                    {{ __('auth.contact_slugan') }}
                </p>
            </div>
        </div>
        <div class="contact_form_area">
            <div class="my-container">
                <div class="contact_address_grid">
                    <form action="" class="form_area" wire:submit.prevent="storeData">
                        <h3 class="form_title">{{ __('auth.send_your_request') }}</h3>
                        <div>
                            @if (session()->has('message'))
                                <div style="color: green;" class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                        </div>
                        <div class="contact_form_grid">
                            <div class="input_row">
                                <label for="">{{ __('auth.name') }}</label>
                                <input type="text" wire:model='name' placeholder="{{ __('auth.name_placeholder') }}" />
                                @error('name')
                                <span style="color:#ff3333" class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input_row">
                                <label for="">{{ __('auth.phone') }}</label>
                                <input type="text" wire:model='phone' placeholder="{{ __('auth.phone_placeholder') }}" />
                                @error('phone')
                                <span style="color:#ff3333" class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="contact_form_grid">
                            <div class="input_row">
                                <label for="">{{ __('auth.email') }}</label>
                                <input type="email" wire:model='email' placeholder="{{ __('auth.email_placeholder') }}" />
                                @error('email')
                                <span style="color:#ff3333" class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input_row">
                                <label for="">{{ __('auth.subject') }}</label>
                                <input type="text" wire:model='subject' placeholder="{{ __('auth.subject_placeholder') }}" />
                                @error('subject')
                                <span style="color:#ff3333" class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="input_row">
                            <label for="">{{ __('auth.message') }}</label>
                            <textarea wire:model='message' id="" rows="7" placeholder="{{ __('auth.message_placeholder') }}"></textarea>
                            @error('message')
                            <span style="color:#ff3333" class="text-danger" style="font-size: 12.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input_row">
                            <button type="submit" class="default_btn default_btn_bg">
                                {{ __('auth.send') }}
                            </button>
                        </div>
                    </form>
                    <div class="contact_address_area">
                        <h3>{{ __('auth.reach_us') }}</h3>
                        <ul class="contact_list">
                            <li>
                                <span>{{ __('auth.email') }}:</span>
                                <a href="mailto:destek@bennebosmarket.com">&nbsp;&nbsp;&nbsp;&nbsp;destek@bennebosmarket.com</a>
                            </li>
                            <li>
                                <span>{{ __('auth.teliphone') }}:</span>
                                <a href="mailto:0 212 234 56 36">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;444 4 615</a>
                            </li>
                            <li>
                                <span>{{ __('auth.address') }}:</span>
                                <a href="#" target="_blank">
                                    {{ __('auth.contact_address') }}  <br />
                                    {{ __('auth.contact_address_city') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>