<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>@yield('title')</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{ setting()->fav_icon }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('/assets/front/plugins/css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/front/plugins/css/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/front/plugins/css/intlTelInput.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/front/plugins/css/niceCountryInput.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/front/plugins/css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/front/sass/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/front/plugins/css/selectr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/rating/starability-all.css') }}" rel="stylesheet" type="text/css" />

    <!-- Toaster -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/toastr.min.css') }}" />
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-230255794-1">
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-230255794-1');
    </script>

    {{-- Social share start --}}
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=629f6840703b77001ade9d4e&product=video-share-buttons' async='async'></script>
    {{-- Social share end --}}

    @livewireStyles
</head>

<style>
    .toast-message {
        font-size: 13px;
    }

    .colorDiv {
        font-size: 22px;
    }

    .product_details_wrapper .product_colorslist li {
        color: #424c60;
        background: #f7f7f7;
        border-radius: 5px;
        width: 36px;
        height: 36px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        cursor: pointer;
        border: 1px solid transparent;
    }

    .product_details_wrapper .product_colorslist li:hover {
        background: #e7e7e7;
    }

    .product_details_wrapper .product_colorslist .product_colorselected {
        border-color: #74c247;
    }

    #active_category {
        color: black;
        font-weight: 600;
    }

    #hide_category {
        display: none;
    }
</style>

<body>
    <!-- Scroll To Top -->
    <div class="scrolltop" id="scrollTop">
        <img src="{{ asset('assets/front/images/icon/cart_scroll_icon.svg') }}" alt="" />
    </div>
    <!-- Header Section  -->
    @livewire('layouts.inc.headerv3')
    <main>
        {{ $slot }}
    </main>

    <!-- Footer Section  -->
    @livewire('layouts.inc.footerv3')
    <!-- JS Here -->
    <script src="{{ asset('assets/front/plugins/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/front/plugins/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/front/plugins/js/zoomsl.min.js') }}"></script>
    <script src="{{ asset('assets/front/plugins/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/front/plugins/js/intlTelInput-jquery.min.js') }}"></script>
    <script src="{{ asset('assets/front/plugins/js/niceCountryInput.js') }}"></script>
    <script src="{{ asset('assets/front/plugins/js/multi-animated-counter.js') }}"></script>
    <script src="{{ asset('assets/front/plugins/js/jquery.ddslick.min.js') }}"></script>
    <script src="{{ asset('assets/front/plugins/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/front/plugins/js/selectr.min.js') }}"></script>
    
    <script src="{{ asset('assets/front/plugins/js/cleave.min.js') }}"></script>
    <script src="{{ asset('assets/front/plugins/js/multi-countdown.js') }}"></script>
    <script src="https://kit.fontawesome.com/46f35fbc02.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/front/js/main.js') }}"></script>

    {{-- sweet alert 2 --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('assets/jquery.countdown.min.js') }}"></script>

    {{-- Toaster --}}
    <script src="{{ asset('assets/admin/js/toastr.min.js') }}"></script>

    <script src="{{ asset('assets/admin/js/jquery.lazyload.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('img').lazyload();
        });
    </script>

    <script>
        $(document).ready(function(){
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
                "positionClass": "toast-top-right"
            };
        });

        //SWL
        window.addEventListener('show-delete-confirmation', event => {
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete !'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteConfirmed')
                }
            })
        });

        //Success Delete
        window.addEventListener('categoryDeleted', event => {
            Swal.fire(
                'Deleted!',
                'Category has been deleted successfully.',
                'success'
            )
        });

    </script>

    <script>
        $(document).ready(function(){
            $('.btnPreLoad').on('click', function(){
                $(this).html('<i class="fa fa-spinner fa-spin"></i> '+$(this).html());
            });
            $('.btnPreLoadR').on('click', function(){
                $(this).html('<i class="fa fa-spinner fa-spin"></i> Review');
            });
        });
    </script>


    <script>
        var languageSelect = $('#languageSelect');
        var languageSelectDesk = $('#languageSelectDesk');

        languageSelect.on('change', function(){
            var lang = $(this).val();
            window.location.href = "{{ url('/change') }}/"+lang;
        });

        languageSelectDesk.on('change', function(){
            var lang = $(this).val();
            window.location.href = "{{ url('/change') }}/"+lang;
        });

    </script>

    <script>
        var countrySelect = $('#countrySelect');

        countrySelect.on('change', function(){
            var country = $(this).val();
            window.location.href = "{{ url('/change/country') }}/"+country;
        });

    </script>

    @stack('scripts')

    @livewireScripts
</body>

</html>
