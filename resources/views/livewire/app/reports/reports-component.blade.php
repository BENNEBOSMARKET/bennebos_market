@section('title')
    Reports
@endsection
<div>
    <style>
        .map_wrapper text tspan {
            font-size: 8px;
        }
    </style>
    <!-- Map Section  -->
    <section class="map_wrapper">
        <div class="my-container">
            <div class="map_area">
                <div class="map_button_area">
                </div>
                <div class="world">
                    <div class="map"></div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js" charset="utf-8">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.2.7/raphael.min.js" charset="utf-8"></script>
    <script src="{{ asset('assets/front/plugins/js/jquery.mapael.min.js') }}" charset="utf-8"></script>
    <script src="{{ asset('assets/front/plugins/js/world_countries.min.js') }}" charset="utf-8"></script>


    <script type="text/javascript">
        $(function() {
            // Default plots params
            var plots = {
                @foreach ($maps as $country)
                    {{ $country->id }}: {
                        latitude: {{ $country->latitude }},
                        longitude: {{ $country->longitude }},
                        tooltip: {
                            content: '<div class="map_hover_card"><div class="map_hover_img"><img src="{{ asset('assets/images/mapicon.png') }}" alt=""> </div> <h3>{{ $country->name }}</h3><p></p></div>',
                        },
                        text: {
                            position: "{{ $country->position }}",
                            content: "{{ $country->name }}",
                        },
                        href: "{{ route('reportDetails', ['slug' => $country->slug]) }}",
                    },
                @endforeach

            };

            // Mapael initialisation
            $world = $(".world");
            $world.mapael({
                map: {
                    name: "world_countries",
                    defaultArea: {
                        attrs: {
                            fill: "#EBEBEB",
                            stroke: "#27AE60",
                            "stroke-width": 0.3,
                        },
                        attrsHover: {
                            fill: "#EBEBEB",
                        },
                    },

                    defaultPlot: {
                        text: {
                            attrs: {
                                fill: "#6B7280",
                                "font-weight": "bold",
                            },
                            attrsHover: {
                                fill: "#27AE60",
                            },
                            margin: 3,
                        },

                        attrs: {
                            fill: "#27AE60",
                        },

                        attrsHover: {
                            fill: "#EB5757",
                        },
                        tooltip: {
                            offset: {
                                top: -200,
                                left: 20,
                            },
                        },
                        type: "image",
                        width: 10,
                        height: 12,
                        url: "{{ asset('assets/front/images/icon/map_location.svg') }}",
                    },
                    zoom: {
                        enabled: true,
                        step: 0.75, //step ratio between zoom
                        // minLevel:40, // min level zoom
                        maxLevel: 40, // max level zoom
                    },
                },

                plots: $.extend(true, {}, plots),
            });
        });
    </script>
@endpush
