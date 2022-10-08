@section('title')
    {{ $blogDetails->title }}
@endsection
<div>
    <section class="blog_details_wrapper">
        <div class="my-container">
            <div class="blog_details_grid">
                <article class="blog_details_content_area" id="blogDetailsContent">
                    <div class="blog_details_title" id="blogDetailsTitle">
                        <h2>
                            {{ $blogDetails->title }}
                        </h2>
                        <ul class="d-flex align-items-center flex-wrap-wrap">
                            <li>
                                <img src="{{ asset('assets/front/images/icon/blog_time.svg') }}" alt="" />
                            </li>
                            {{ Carbon\Carbon::parse($blogDetails->created_at)->format('M d, Y H:i A') }}
                        </ul>
                    </div>

                    <div class="blog_details_img">
                        <figure>
                            <img src="{{ $blogDetails->banner }}" style="width: 100%;" alt="" />
                        </figure>
                    </div>
                    <div class="blog_para">
                        {!! $blogDetails->content !!}
                    </div>
                </article>
                <aside class="blog_sidebar">
                    <div class="sidebar_title">{{ __('auth.for_you') }}</div>
                    <div class="blog_sidebar_grid">
                        @foreach ($blogsForYou as $blogitem)
                            <div class="blog_item">
                                <div class="blog_img">
                                    <a href="{{ route('blogDetails', ['slug'=>$blogitem->slug]) }}" class="skew_hover_effect">
                                        <img src="{{ $blogitem->banner }}" alt="blog img" />
                                    </a>
                                </div>
                                <div class="blog_content">
                                    <ul class="blog_info_list d-flex align-items-center flex-wrap-wrap g-sm">
                                        <li>
                                            <a href="{{ route('blogDetails', ['slug'=>$blogitem->slug]) }}">{{ $blogitem->created_at }}</a>
                                        </li>
                                    </ul>
                                    <h4>
                                        <a href="{{ route('blogDetails', ['slug'=>$blogitem->slug]) }}">{{ $blogitem->title }}</a>
                                    </h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </aside>
            </div>
        </div>
    </section>
    <!-- Popular Product Section  -->
    <section class="popular_prodcut_wrapper default_section_gap">
        <div class="my-container">
            <div class="header_area d-flex align-items-center justify-content-between flex-wrap-wrap g-sm">
                <h2 class="page_title">{{ __('auth.top_blog') }}</h2>
                <div class="sell_all d-flex align-items-center g-sm">
                    <h4><a href="{{ route('our-blog') }}">{{ __('auth.see_all') }}</a></h4>

                    <div class="slider_arrow d-flex align-items-center">
                        <div class="slider_prev_arrow top_blog_prev_arrow">
                            <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.5 15L1.5 8L8.5 1" stroke="#130F26" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="slider_next_arrow top_blog_next_arrow">
                            <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.5 1L8.5 8L1.5 15" stroke="#130F26" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="top_blog_slider_area" wire:ignore>
                <!-- Swiper -->
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @foreach ($topBlogs as $tblog)
                            <div class="swiper-slide">
                                <div class="blog_item">
                                    <div class="blog_img">
                                        <a href="{{ route('blogDetails', ['slug'=>$blogitem->slug]) }}" class="skew_hover_effect">
                                            <img src="{{ $blogitem->banner }}" alt="blog img" />
                                        </a>
                                    </div>
                                    <div class="blog_content">
                                        <ul class="blog_info_list d-flex align-items-center flex-wrap-wrap g-sm">
                                            <li>
                                                <a href="{{ route('blogDetails', ['slug'=>$blogitem->slug]) }}">{{ $blogitem->created_at }}</a>
                                            </li>
                                        </ul>
                                        <h4>
                                            <a href="{{ route('blogDetails', ['slug'=>$blogitem->slug]) }}">{{ $blogitem->title }}</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
