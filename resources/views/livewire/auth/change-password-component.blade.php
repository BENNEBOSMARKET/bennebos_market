@section('title')
{{ __('auth.chnage_password') }}
@endsection
<div>
    <main>
        <section class="forget_password_wrapper">
            <div class="my-container">
                <div class="forget_form_area">
                    @if ($status == 0)
                        <form class="form_area" wire:submit.prevent='updatePassword'>
                            <div class="form_title_area text-center" style="margin-bottom: 35px;">
                                <h3>{{ __('auth.chnage_password') }}</h3>
                            </div>
                            <div class="input_row">
                                <label for="">{{ __('auth.email') }}</label>
                                <input type="email" placeholder="{{ __('auth.email_placeholder') }}" wire:model='email' />
                                @error('email')
                                    <p style="color: red; font-size: 12.5px;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="input_row">
                                <label for="">{{ __('auth.new_password') }}</label>
                                <input type="password" wire:model='password' />
                                @error('password')
                                    <p style="color: red; font-size: 12.5px;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="input_row">
                                <label for="">{{ __('auth.confirm_password') }}</label>
                                <input type="password" wire:model='confirm_password' />
                                @error('confirm_password')
                                    <p style="color: red; font-size: 12.5px;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sign_up_button">
                                <button type="submit" class="btnPreLoad">{{ __('auth.submit') }}</button>
                            </div>
                        </form>
                    @else
                        <div class="form_area">
                            <div class="form_title_area text-center" style="margin-bottom: 35px;">
                                <h3 style="color: green;">{{ __('auth.password_changed_successfully') }}</h3>
                            </div>

                            <div class="sign_up_button">
                                <a href="{{ route('customerLogin') }}"><button class="btnPreLoad">{{ __('auth.login_to_your_account') }}</button></a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </section>
    </main>
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