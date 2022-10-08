<div>
    <footer class="footer_wrapper">
        <div class="my-container">
            <div class="footer_grid_area">
                <div class="footer_logo_area">
                    <a href="{{ route('home.index') }}">
                        <img src="{{ $setting->footer_logo }}" class="footer_logo" alt="" />
                    </a>
                    <p>{{ __('auth.footer_slogan') }}</p>
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
                        <ul class="footer_social_list d-flex align-items-center flex-wrap-wrap">
                            <li>
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('assets/front/images/others/payment_method1.png') }}"
                                        alt="bannk logo" />
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('assets/front/images/others/payment_method2.png') }}"
                                        alt="bannk logo" />
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('assets/front/images/others/payment_method3.png') }}"
                                        alt="bannk logo" />
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('assets/front/images/others/payment_method4.png') }}"
                                        alt="bannk logo" />
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('assets/front/images/others/payment_method5.png') }}"
                                        alt="bannk logo" />
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="footer_menu_area">
                    <h3>{{ __('auth.customer_care') }}</h3>
                    <ul class="footer_menu_list">
                        <li><a href="{{ route('contact-us') }}">{{ __('auth.call_us') }}</a></li>
                        <li><a href="{{ route('how-to-sell') }}">{{ __('auth.how_to_buy') }}</a></li>
                        <li><a href="{{ route('returns-refunds') }}">{{ __('auth.returns_and_refunds') }}</a></li>
                        <li><a href="{{ route('help-center') }}">{{ __('auth.help_center') }}</a></li>
                        <li><a href="{{ route('terms-conditon') }}">{{ __('auth.terms_and_onditions') }}</a></li>
                    </ul>
                </div>
                <div class="footer_menu_area">
                    <h3>{{ __('auth.about_us') }}</h3>
                    <ul class="footer_menu_list">
                        <li><a href="{{ route('about-bennebos') }}">{{ __('auth.about_bennebos') }}</a></li>
                        {{-- <li><a href="#">{{ __('auth.about_our_group') }}</a></li> --}}
                        <li><a href="{{ route('our-blog') }}">{{ __('auth.our_blog') }}</a></li>
                        <li><a
                                href="https://play.google.com/store/apps/details?id=com.bennebos_market&gl=TR">{{ __('auth.our_apps') }}</a>
                        </li>
                        <li><a href="{{ route('privacy-policy') }}">{{ __('auth.privacy_policy') }}</a></li>
                    </ul>
                </div>
                <div class="footer_menu_area">
                    <h3>{{ __('auth.our_service') }}</h3>
                    <ul class="footer_menu_list">
                        <li><a
                                href="{{ route('reports', ['slug' => 'turkey', 'type' => 'import']) }}">{{ __('auth.our_service') }}</a>
                        </li>
                        {{-- <li><a href="#">{{ __('auth.products_ervice') }}</a></li> --}}
                        <li><a href="#">{{ __('auth.sell_service') }}</a></li>
                        <li><a href="{{ route('seller.registration') }}">{{ __('auth.become_seller') }}</a></li>
                        <li><a href="{{ route('careers') }}">{{ __('auth.careers') }}</a></li>
                    </ul>
                </div>
                <div class="footer_menu_area">
                    <h3>{{ __('auth.download_apps') }}</h3>
                    <ul class="footer_app_list">
                        <li>
                            <a href="https://play.google.com/store/apps/details?id=com.bennebos_market&gl=TR"
                                target="_blank" class="download_app_area">
                                <div class="app_icon">
                                    <img src="{{ asset('assets/front/images/icon/google_play_icon.svg') }}"
                                        alt="google play icon" />
                                </div>
                                <div class="download_content">
                                    <h5>{{ __('auth.download_by') }}</h5>
                                    <h4>{{ __('auth.google_play') }}</h4>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#" target="_blank" class="download_app_area">
                                <div class="app_icon">
                                    <img src="{{ asset('assets/front/images/icon/apple_play_icon.svg') }}"
                                        alt="apple play icon" />
                                </div>
                                <div class="download_content">
                                    <h5>{{ __('auth.download_by') }}</h5>
                                    <h4>{{ __('auth.app_store') }}</h4>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <p class="copyright_text">Bennebos Market All Rights Reserved © 2022</p>
            <div class="footer_news_img">
                <img src="{{ asset('assets/front/images/footer/newsletter_new_img.png') }}" alt="news letter  img" />
            </div>
        </div>
    </footer>
</div>
