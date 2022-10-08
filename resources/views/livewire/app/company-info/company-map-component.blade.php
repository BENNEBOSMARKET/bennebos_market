@section('title')
{{ __('auth.map_view') }}
@endsection
<div>
    <section class="map_wrapper">
        <div class="my-container">
            <div class="map_area">
                <div class="map_show" id="countryMap"></div>
                <div class="hide_divider"></div>
            </div>
        </div>
    </section>
    <div style="padding-bottom: 100px;"></div>
</div>

@push('scripts')
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="{{ asset('assets/front/plugins/map-data/geodata/country/usaLow.js') }}"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

    <script>
        am5.ready(function() {
            var data = [
                @foreach ($maps as $country)
                    {
                        id: "{{ $country->country_code }}",
                        name: "{{ $country->country }}",
                        value: {{ $country->value }},
                    },
                @endforeach
            ];

            var root = am5.Root.new("countryMap");
            root.setThemes([am5themes_Animated.new(root)]);

            var chart = root.container.children.push(
                am5map.MapChart.new(root, {
                    panX: "rotateX",
                    panY: "rotateY",
                    projection: am5map.geoOrthographic(),
                    paddingBottom: 20,
                    paddingTop: 80,
                    paddingLeft: 20,
                    paddingRight: 20,
                })
            );
            //Switch Toggle Map
            var cont = chart.children.push(
                am5.Container.new(root, {
                    layout: root.horizontalLayout,
                    x: 20,
                    y: 40,
                })
            );

            // Add labels and controls
            cont.children.push(
                am5.Label.new(root, {
                    centerY: am5.p50,
                    text: "Earth Globe",
                })
            );

            var switchButton = cont.children.push(
                am5.Button.new(root, {
                    themeTags: ["switch"],
                    centerY: am5.p50,
                    icon: am5.Circle.new(root, {
                        themeTags: ["icon"],
                    }),
                })
            );

            switchButton.on("active", function() {
                if (!switchButton.get("active")) {
                    chart.set("projection", am5map.geoOrthographic());
                    chart.set("panY", "rotateY");
                    backgroundSeries.mapPolygons.template.set("fillOpacity", 0.1);
                } else {
                    chart.set("projection", am5map.geoMercator());
                    chart.set("panY", "translateY");
                    chart.set("rotationY", 0);
                    backgroundSeries.mapPolygons.template.set("fillOpacity", 0);
                }
            });

            cont.children.push(
                am5.Label.new(root, {
                    centerY: am5.p50,
                    text: "Map",
                })
            );

            var polygonSeries = chart.series.push(
                am5map.MapPolygonSeries.new(root, {
                    geoJSON: am5geodata_worldLow,
                    exclude: ["AQ"],
                    fill: am5.color("#27AE60"),
                })
            );
            // Create series for background fill

            var backgroundSeries = chart.series.push(
                am5map.MapPolygonSeries.new(root, {})
            );
            backgroundSeries.mapPolygons.template.setAll({
                fill: root.interfaceColors.get("disabled"),
                fillOpacity: 0.3,
                strokeOpacity: 0,
            });

            // Create graticule series

            var graticuleSeries = chart.series.push(
                am5map.GraticuleSeries.new(root, {})
            );
            graticuleSeries.mapLines.template.setAll({
                strokeOpacity: 0.1,
                stroke: root.interfaceColors.get("alternativeBackground"),
            });

            // Rotate animation
            chart.animate({
                key: "rotationX",
                from: 0,
                to: 360,
                duration: 30000,
                loops: Infinity,
            });

            // Make stuff animate on load
            chart.appear(1000, 100);
            var bubbleSeries = chart.series.push(
                am5map.MapPointSeries.new(root, {
                    valueField: "value",
                    calculateAggregates: true,
                    polygonIdField: "id",
                })
            );

            var circleTemplate = am5.Template.new({});

            bubbleSeries.bullets.push(function(root, series, dataItem) {
                var container = am5.Container.new(root, {});

                var circle = container.children.push(
                    am5.Circle.new(
                        root, {
                            radius: 20,
                            fillOpacity: 0.8,
                            fill: am5.color(0xff0000),
                            cursorOverStyle: "pointer",
                            tooltipHTML: '',
                        },
                        circleTemplate
                    )
                );
                // Create Country Label
                var countryLabel = container.children.push(
                    am5.Label.new(root, {
                        text: "{name}",
                        paddingLeft: 25,
                        populateText: true,
                        fontWeight: "bold",
                        fontSize: 13,
                        centerY: am5.p50,
                    })
                );

                circle.on("radius", function(radius) {
                    countryLabel.set("x", radius);
                });

                return am5.Bullet.new(root, {
                    sprite: container,
                    dynamic: true,
                });
            });
            //Create Shop Number
            bubbleSeries.bullets.push(function(root, series, dataItem) {
                return am5.Bullet.new(root, {
                    sprite: am5.Label.new(root, {
                        text: "{value.formatNumber('#.')}",
                        fill: am5.color(0xffffff),
                        populateText: true,
                        centerX: am5.p50,
                        centerY: am5.p50,
                        textAlign: "center",
                    }),
                    dynamic: true,
                });
            });

            // minValue and maxValue must be set for the animations to work
            // bubbleSeries.set("heatRules", [
            //   {
            //     target: circleTemplate,
            //     dataField: "value",
            //     min: 10,
            //     max: 50,
            //     minValue: 0,
            //     maxValue: 100,
            //     key: "radius",
            //   },
            // ]);

            bubbleSeries.data.setAll(data);

            updateData();
            setInterval(function() {
                updateData();
            }, 2000);

            function updateData() {
                for (var i = 0; i < bubbleSeries.dataItems.length; i++) {
                    bubbleSeries.data.setIndex(i, {
                        // value: Math.round(Math.random() * 100),
                        id: data[i].id,
                        name: data[i].name,
                        link: data[i].link,
                        value: data[i].value,
                    });
                }
            }
        }); // end am5.ready()
    </script>
@endpush
