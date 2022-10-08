@section('title')
    Reports
@endsection
<div>
    <section class="map_wrapper">
        <div class="my-container">
            <div class="map_area" style="padding-bottom: 100px;">
                {{-- <div class="map_button_area">
                    <button type="button" class="map_btn import_btn">
                        Import
                        <span><svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.25 11C5.25 11.4142 5.58579 11.75 6 11.75C6.41421 11.75 6.75 11.4142 6.75 11L5.25 11ZM6.53033 0.46967C6.23744 0.176777 5.76256 0.176777 5.46967 0.46967L0.696699 5.24264C0.403806 5.53553 0.403806 6.01041 0.696699 6.3033C0.989593 6.59619 1.46447 6.59619 1.75736 6.3033L6 2.06066L10.2426 6.3033C10.5355 6.59619 11.0104 6.59619 11.3033 6.3033C11.5962 6.01041 11.5962 5.53553 11.3033 5.24264L6.53033 0.46967ZM6.75 11L6.75 1L5.25 1L5.25 11L6.75 11Z"
                                    fill="#EB5757" />
                            </svg>
                        </span>
                    </button>
                    <button type="button" class="map_btn export_btn">
                        Export
                        <span>
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.75 1C6.75 0.585786 6.41421 0.25 6 0.25C5.58579 0.25 5.25 0.585786 5.25 1L6.75 1ZM5.46967 11.5303C5.76256 11.8232 6.23744 11.8232 6.53033 11.5303L11.3033 6.75736C11.5962 6.46447 11.5962 5.98959 11.3033 5.6967C11.0104 5.40381 10.5355 5.40381 10.2426 5.6967L6 9.93934L1.75736 5.6967C1.46447 5.40381 0.989593 5.40381 0.696699 5.6967C0.403806 5.98959 0.403806 6.46447 0.696699 6.75736L5.46967 11.5303ZM5.25 1L5.25 11L6.75 11L6.75 1L5.25 1Z"
                                    fill="#27AE60" />
                            </svg>
                        </span>
                    </button>
                </div> --}}
                <div class="map_show" id="countryMap" style="height: 750px;"></div>
                <div class="hide_divider"></div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script>
        am5.ready(function() {
            var data = [
                @foreach ($maps as $country)
                    {
                        id: "{{ $country->country_code }}",
                        name: "{{ $country->country }}",
                        link: "{{ route('reportDetails', ['slug' => $country->slug]) }}",
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
                    paddingBottom: 80,
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
                            tooltipHTML: '<a href="{link}" class="map_hover_link">View More </a>',
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
