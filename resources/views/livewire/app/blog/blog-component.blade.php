@section('title')
{{ __('auth.our_bogs') }}
@endsection

<div>
    <section class="breadcrumb_wrapper" style="
          background-image: url(assets/front/images/breadcrumb/breadcrumb_img2.png);
         margin-top: 15px;">
        <div class="my-container">
            <div class="breadcrumb_title_area">
                <h4 class="sellar_title">{{ __('auth.blog') }}</h4>
            </div>
        </div>
    </section>
    <!-- Blog Section  -->
    @if ($blogs->count() > 0)
        <section class="blog_page_wrapper">
            <div class="my-container">
                <h2 class="blog_title">{{ __('auth.latest_blogs') }}</h2>

                <div class="blog_first_item_grid">
                    <div class="blog_img">
                        <a href="{{ route('blogDetails', ['slug'=>$blogs[0]->slug]) }}" class="skew_hover_effect">
                            <img src="{{ $blogs[0]->banner }}" alt="blog img" />
                        </a>
                    </div>
                    <div class="blog_content">
                        <ul class="blog_info_list d-flex align-items-center flex-wrap-wrap g-sm">
                            <li>
                                <a href="{{ route('blogDetails', ['slug'=>$blogs[0]->slug]) }}">{{ $blogs[0]->created_at }}</a>
                            </li>
                        </ul>
                        <h4>
                            <a href="{{ route('blogDetails', ['slug'=>$blogs[0]->slug]) }}">{{ $blogs[0]->title }}</a>
                        </h4>
                    </div>
                </div>



                <div class="blog_item_grid">
                    @foreach ($blogs as $key => $blog)
                        @if ($key != 0)
                            <div class="blog_item">
                                <div class="blog_img">
                                    <a href="{{ route('blogDetails', ['slug'=>$blog->slug]) }}" class="skew_hover_effect">
                                        <img src="{{ $blog->banner }}" alt="blog img" />
                                    </a>
                                </div>
                                <div class="blog_content">
                                    <ul class="blog_info_list d-flex align-items-center flex-wrap-wrap g-sm">
                                        <li>
                                            <a href="{{ route('blogDetails', ['slug'=>$blog->slug]) }}">{{ $blog->created_at }}</a>
                                        </li>
                                    </ul>
                                    <h4>
                                        <a href="{{ route('blogDetails', ['slug'=>$blog->slug]) }}">{{ $blog->title }}</a>
                                    </h4>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>