@section('title') {{ __('auth.order_successful') }} @endsection
<div>
    <section class="successfull_wrapper">
        <div class="my-container">
            <div class="successfull_grid">
                <div class="successfull_content">
                    <h2>{{ __('auth.order_successful') }}</h2>
                    <p>
                        {{ __('auth.order_sucess_text') }}
                    </p>
                    <div class="successfull_button">
                        <a href="/" class="success_home_btn">{{ __('auth.go_to_home_page') }}</a>
                        <a href="/" class="success_shipping_btn">{{ __('auth.continue_shopping') }}</a>
                    </div>
                </div>
                <div class="successful_img">
                    <img src="{{ asset('assets/front/images/others/successfull_order_img.png') }}" alt="success img" />
                </div>
            </div>
        </div>
    </section>
</div>
