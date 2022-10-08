@section('title')
{{ __('auth.privacy_policy') }}
@endsection
<div>
    <section class="story_wrapper">
        <div class="my-container">
            <h2 class="about_title">     {{ __('auth.privacy_policy') }}</h2>
            {!! $privacypolicy->description !!}
        </div>
    </section>
</div>