<div>
    <footer class="footer_wrapper @if (request()->is('/')) mt-0 @endif" style="margin-top: 40px;">
        <div class="my-container">
            <div class="footer_grid_area">
                <div class="footer_logo_area">
                    <a href="{{ route('home.index') }}">
                        <img src="{{ $setting->footer_logo }}" style="max-height: 48px;" alt="Footer logo" />
                    </a>
                    <p>{{ __('auth.failed') }}</p>
                    <ul class="footer_social_list d-flex align-items-center flex-wrap-wrap">
                        <li>
                            <a href="{{ $setting->facebook_url }}" target="_blank">
                                <img src="{{ asset('assets/front/images/footer/social_icon_1.svg') }}"
                                    alt="footer social" />
                            </a>
                        </li>
                        <li>
                            <a href="{{ $setting->twitter_url }}" target="_blank">
                                <img src="{{ asset('assets/front/images/footer/social_icon_2.svg') }}"
                                    alt="footer social" />
                            </a>
                        </li>
                        <li>
                            <a href="{{ $setting->whatsapp_url }}" target="_blank">
                                <img src="{{ asset('assets/front/images/footer/social_icon_3.svg') }}"
                                    alt="footer social" />
                            </a>
                        </li>
                        <li>
                            <a href="{{ $setting->linkedin_url }}" target="_blank">
                                <img src="{{ asset('assets/front/images/footer/social_icon_4.svg') }}"
                                    alt="footer social" />
                            </a>
                        </li>
                    </ul>
                    <div class="footer_payment_list">
                        <ul class="footer_social_list  d-flex align-items-center flex-wrap-wrap">
                          <li><a href="#">
                            <img src="{{ asset('assets/front/images/others/payment_method1.png') }}" alt="bannk logo">
                          </a></li>
                          <li><a href="#">
                            <img src="{{ asset('assets/front/images/others/payment_method2.png') }}" alt="bannk logo">
                          </a></li>
                          <li><a href="#">
                            <img src="{{ asset('assets/front/images/others/payment_method3.png') }}" alt="bannk logo">
                          </a></li>
                          <li><a href="#">
                            <img src="{{ asset('assets/front/images/others/payment_method4.png') }}" alt="bannk logo">
                          </a></li>
                          <li><a href="#">
                            <img src="{{ asset('assets/front/images/others/payment_method5.png') }}" alt="bannk logo">
                          </a></li>
                        </ul>
                      </div>
                </div>
                <div class="footer_menu_area">
                    <h3>{{ __('auth.customer_care') }}</h3>
                    <ul class="footer_menu_list">
                        <li><a href="{{ route('help-center') }}">{{ __('auth.help_center') }}</a></li>
                        <li><a href="{{ route('how-to-sell') }}">{{ __('auth.how_to_buy') }}</a></li>
                        <li><a href="{{ route('returns-refunds') }}">{{ __('auth.returns_and_refunds') }}</a></li>
                        <li><a href="#">{{ __('auth.contact_us') }}</a></li>
                        <li><a href="{{ route('terms-conditon') }}">{{ __('auth.terms_and_onditions') }}</a></li>
                    </ul>
                </div>
                <div class="footer_menu_area">
                    <h3>{{ __('auth.about_us') }}</h3>
                    <ul class="footer_menu_list">
                        <li><a href="{{ route('about-bennebos') }}">{{ __('auth.about_bennebos') }}</a></li>
                        <li><a href="{{ route('seller.registration') }}">{{ __('auth.become_seller') }}</a></li>
                        <li><a href="{{ route('our-blog') }}">{{ __('auth.our_blog') }}</a></li>
                        <li><a href="#">{{ __('auth.our_apps') }}</a></li>
                        <li><a href="{{ route('privacy-policy') }}">{{ __('auth.privacy_policy') }}</a></li>
                    </ul>
                </div>
                <div class="footer_menu_area">
                    <h3>{{ __('auth.our_service') }}</h3>
                    <ul class="footer_menu_list">
                        <li><a href="{{ route('reports') }}">{{ __('auth.our_service') }}</a></li>
                        <li><a href="#">{{ __('auth.products_ervice') }}</a></li>
                        <li><a href="{{ route('seller.login') }}">{{ __('auth.sell_service') }}</a></li>
                        <li><a href="#">{{ __('auth.careers') }}</a></li>
                    </ul>
                </div>
                <div class="footer_menu_area">
                    <h3>{{ __('seller.download_apps') }}</h3>
                    <ul class="footer_app_list">
                        <li>
                            <a href="#" target="_blank">
                                <img src="{{ asset('assets/front/images/footer/google_play.svg') }}"
                                    alt="google play icon" />
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank">
                                <img src="{{ asset('assets/front/images/footer/apple_play_store.svg') }}"
                                    alt="apple play icon" />
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>
