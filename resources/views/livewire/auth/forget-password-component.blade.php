@section('title')
{{ __('auth.forget_password') }}
@endsection
<div>
    <main>
        <section class="forget_password_wrapper">
            <div class="my-container">
                <div class="forget_form_area">
                    <form class="form_area" wire:submit.prevent='forgetPassword'>
                        <div class="form_title_area text-center">
                            <h3>{{ __('auth.forgot_your_password') }}</h3>
                            <h5>
                                {{ __('auth.enter_your_email_check_link') }}
                            </h5>
                        </div>

                        <div class="input_row">
                            <label for="">{{ __('auth.email') }}</label>
                            <input type="email" placeholder="{{ __('auth.email_placeholder') }}" wire:model='email' />
                            @error('email')
                                <p style="color: red; font-size: 12.5px;">{{ $message }}</p>
                            @enderror
                            @if (session()->has('error_email'))
                                <p style="color: red; font-size: 12.5px;">{{ __('auth.invalid_email_address') }}</p>
                            @endif
                        </div>

                        <div class="sign_up_button">
                            <button type="submit" class="btnPreLoad">{{ __('auth.send_email') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
</div>

@push('scripts')
    <script>
        window.addEventListener('linkMailSent', event => {
            Swal.fire(
                'Success!',
                'The link has been sent to your email',
                'success'
            )
        });
    </script>
@endpush