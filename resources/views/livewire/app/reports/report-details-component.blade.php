@section('title')
    {{ $country->name }} Trade Profile
@endsection

<div>
    <!-- Single Country Section  -->
    <section class="single_country_wrapper">
        <div class="my-container">
            <div class="single_country_gird">
                <div class="single_country_content">
                    <h4>{{ $country->name }} Trade Profile</h4>
                    @if ($tradeProfile)
                        <p style="color: black; font-size: 14px;">Import:</p>
                        <p style="font-size: 13.5px; margin-top: 0px;">
                            {{ $tradeProfile->description_import }}
                        </p>
                        <p style="color: black; font-size: 14px;">Export:</p>
                        <p style="font-size: 13.5px; margin-top: 0px;">
                            {{ $tradeProfile->description_export }}
                        </p>
                    @endif
                </div>
                @if ($country->vector_map != '')
                    <div class="sinlge_country_map" style="text-align: center;">
                        <img src="{{ $country->vector_map }}" class="img_map" alt="single map" />
                        <div class="single_contet_wrapper">
                            <div class="locatin_map">
                                <img src="{{ asset('assets/front/images/icon/single_country_location.svg') }}"
                                    style="height: 50px; width: 50px;" class="map_location_icon" alt="" />
                            </div>
                            <div class="single_map_content">
                                <div>
                                    <h4>{{ $country->name }}</h4>
                                    <p>
                                        Import Marketing is the one which is brought into a
                                        jurisdiction, especially across a national border.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>

    <!-- Import Country Map Section  -->
    <section class="import_country_map_wrapper">
        <div class="my-container">
            <div class="map_header_area">
                <h2 class="map_title">
                    {{ $country->name }} Top Trading Partners <span>- Exports</span>
                </h2>
            </div>
            <div class="map_area">
                <div class="map_show" id="importCountryMap"></div>
                <div class="hide_divider"></div>
            </div>
        </div>
    </section>
    <!-- Import(Export) Country Map Section  -->
    <section class="import_country_map_wrapper">
        <div class="my-container">
            <div class="map_header_area">
                <h2 class="map_title">
                    {{ $country->name }} Top Trading Partners <span>- Imports</span>
                </h2>
            </div>
            <div class="map_area">
                <div class="map_show" id="exportCountryMap"></div>
                <div class="hide_divider"></div>
            </div>
        </div>
    </section>

    <!--Trade Progress Section  -->
    @if ($tradeProfile)
        @if ($trade_surplus->count() > 0 || $trade_deficit->count() > 0)
            <section class="trade_progress_wrapper default_map_gap">
                <div class="my-container">
                    <div class="map_header_area">
                        <h2 class="map_title">Trade Surplus and Trade Deficit</h2>
                        <p>
                            Open the report you'd like to export. Analytics exports the report
                            as it is currently displayed on your screen.
                        </p>
                    </div>
                    <div class="trend_progress_grid">
                        <div class="trend_progress_item">
                            <h3>Trade Surplus</h3>
                            <div class="trend_progress_bar_area">

                                @foreach ($trade_surplus as $tsurplus)
                                    <div class="progress_bar_item">
                                        <h4>{{ $tsurplus->country }}</h4>
                                        <div class="progress_bar_line">
                                            <span class="progress_top_line"
                                                style="width: {{ $tsurplus->trade_value }}"></span>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="progress_bar_number_item">
                                    <div></div>
                                    <ul class="number_list">
                                        <li>0</li>
                                        <li>10</li>
                                        <li>20</li>
                                        <li>40</li>
                                        <li>60</li>
                                        <li>80</li>
                                        <li>100</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="trend_progress_item">
                            <h3>Trade Deficit</h3>
                            <div class="trend_progress_bar_area">
                                @foreach ($trade_deficit as $tdeficit)
                                    <div class="progress_bar_item">
                                        <h4>{{ $tdeficit->country }}</h4>
                                        <div class="progress_bar_line">
                                            <span class="progress_top_line"
                                                style="width: {{ $tdeficit->trade_value }}"></span>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="progress_bar_number_item">
                                    <div></div>
                                    <ul class="number_list">
                                        <li>0</li>
                                        <li>10</li>
                                        <li>20</li>
                                        <li>40</li>
                                        <li>60</li>
                                        <li>80</li>
                                        <li>100</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endif

    <!-- Import Status Section  -->
    <section class="import_status_wrapper default_map_gap">
        <div class="my-container">
            <div class="map_header_area">
                <h2 class="map_title">Top {{ $country->name }} Import</h2>
                <p>
                    Key commodities {{ $country->name }} imports, Analytics exports the report
                    as it is currently displayed on your screen.
                </p>
            </div>
            <div class="import_status_grid">
                @if ($tradeProfile)
                    @foreach ($category_import as $catImp)
                        <div class="import_status_item text-center">
                            <h3>{{ $catImp->category }}</h3>
                            <img src="assets/images/icon/import_status_icon1.svg" alt="" />
                            <h4 style="--import-color: #2f80ed">{{ $catImp->trade_percentage }}</h4>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- Country Import List Section  -->
    <section class="country_import_wrapper default_map_gap">
        <div class="my-container">
            <h2 class="map_title">
                Import Statistics from Top 5 Countries/Territories
            </h2>
            <div class="country_import_grid">
                @if ($tradeProfile)
                    <div class="country_import_item">
                        <ul>
                            @foreach ($country_import as $key => $countryImp)
                                @if ($key < 5)
                                    <li>
                                        <div class="list_item">
                                            <h4>{{ $countryImp->country }}</h4>
                                            <h5>{{ $countryImp->trade_percentage }}</h5>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="country_import_item">
                        <ul>
                            @foreach ($country_import as $key => $countryImp)
                                @if ($key < 10 && $key > 4)
                                    <li>
                                        <div class="list_item">
                                            <h4>{{ $countryImp->country }}</h4>
                                            <h5>{{ $countryImp->trade_percentage }}</h5>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="country_import_item">
                        <ul>
                            @foreach ($country_import as $key => $countryImp)
                                @if ($key < 15 && $key > 9)
                                    <li>
                                        <div class="list_item">
                                            <h4>{{ $countryImp->country }}</h4>
                                            <h5>{{ $countryImp->trade_percentage }}</h5>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="country_import_item">
                        <ul>
                            @foreach ($country_import as $key => $countryImp)
                                @if ($key < 20 && $key > 14)
                                    <li>
                                        <div class="list_item">
                                            <h4>{{ $countryImp->country }}</h4>
                                            <h5>{{ $countryImp->trade_percentage }}</h5>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Import Status Section  -->
    <section class="import_status_wrapper default_map_gap">
        <div class="my-container">
            <div class="map_header_area">
                <h2 class="map_title">Top {{ $country->name }} Export</h2>
                <p>
                    Key commodities {{ $country->name }} exports, Analytics exports the report
                    as it is currently displayed on your screen.
                </p>
            </div>
            <div class="import_status_grid">
                @if ($tradeProfile)
                    @foreach ($category_export as $catExp)
                        <div class="import_status_item text-center">
                            <h3>{{ $catExp->category }}</h3>
                            <img src="assets/images/icon/import_status_icon1.svg" alt="" />
                            <h4 style="--import-color: #2f80ed">{{ $catExp->trade_percentage }}</h4>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <!-- Country Import List Section  -->
    <section class="country_import_wrapper country_export_wrapper default_map_gap">
        <div class="my-container">
            <h2 class="map_title">
                Export Statistics from Top 5 Countries/Territories
            </h2>
            <div class="country_import_grid">
                @if ($tradeProfile)
                    <div class="country_import_item">
                        <ul>
                            @foreach ($country_export as $key => $countryExp)
                                @if ($key < 5)
                                    <li>
                                        <div class="list_item">
                                            <h4>{{ $countryExp->country }}</h4>
                                            <h5>{{ $countryExp->trade_percentage }}</h5>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="country_import_item">
                        <ul>
                            @foreach ($country_export as $key => $countryExp)
                                @if ($key < 10 && $key > 4)
                                    <li>
                                        <div class="list_item">
                                            <h4>{{ $countryExp->country }}</h4>
                                            <h5>{{ $countryExp->trade_percentage }}</h5>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="country_import_item">
                        <ul>
                            @foreach ($country_export as $key => $countryExp)
                                @if ($key < 15 && $key > 9)
                                    <li>
                                        <div class="list_item">
                                            <h4>{{ $countryExp->country }}</h4>
                                            <h5>{{ $countryExp->trade_percentage }}</h5>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="country_import_item">
                        <ul>
                            @foreach ($country_export as $key => $countryExp)
                                @if ($key < 20 && $key > 14)
                                    <li>
                                        <div class="list_item">
                                            <h4>{{ $countryExp->country }}</h4>
                                            <h5>{{ $countryExp->trade_percentage }}</h5>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif
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
            // Create root and chart
            var root = am5.Root.new("importCountryMap");

            // Set themes
            root.setThemes([am5themes_Animated.new(root)]);

            // ====================================
            // Create map
            // ====================================

            var map = root.container.children.push(
                am5map.MapChart.new(root, {
                    panX: "rotateX",
                    panY: "rotateY",
                    projection: am5map.geoOrthographic(),
                    paddingBottom: 20,
                    paddingTop: 80,
                    paddingLeft: 20,
                    paddingRight: 20,
                    // homeGeoPoint: { latitude: 2, longitude: 2 },
                })
            );
            //Switch Toggle Map
            var cont = map.children.push(
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
                    map.set("projection", am5map.geoOrthographic());
                    map.set("panY", "rotateY");
                    backgroundSeries.mapPolygons.template.set("fillOpacity", 0.1);
                } else {
                    map.set("projection", am5map.geoMercator());
                    map.set("panY", "translateY");
                    map.set("rotationY", 0);
                    backgroundSeries.mapPolygons.template.set("fillOpacity", 0);
                }
            });

            cont.children.push(
                am5.Label.new(root, {
                    centerY: am5.p50,
                    text: "Map",
                })
            );
            // Create polygon series
            var polygonSeries = map.series.push(
                am5map.MapPolygonSeries.new(root, {
                    geoJSON: am5geodata_worldLow,
                    exclude: ["antarctica"],
                    fill: am5.color("#27AE60"),
                })
            );
            // Create series for background fill

            var backgroundSeries = map.series.push(
                am5map.MapPolygonSeries.new(root, {})
            );
            backgroundSeries.mapPolygons.template.setAll({
                fill: root.interfaceColors.get("disabled"),
                fillOpacity: 0.3,
                strokeOpacity: 0,
            });

            // Create graticule series

            var graticuleSeries = map.series.push(
                am5map.GraticuleSeries.new(root, {})
            );
            graticuleSeries.mapLines.template.setAll({
                strokeOpacity: 0.1,
                stroke: root.interfaceColors.get("alternativeBackground"),
            });

            // Rotate animation
            map.animate({
                key: "rotationX",
                from: 0,
                to: 360,
                duration: 30000,
                loops: Infinity,
            });

            // Make stuff animate on load
            map.appear(1000, 100);

            var pointSeries = map.series.push(am5map.MapPointSeries.new(root, {}));
            var colorSet = am5.ColorSet.new(root, {
                step: 2
            });
            pointSeries.bullets.push(function(root, series, dataItem) {
                var value = dataItem.dataContext.value;
                var container = am5.Container.new(root, {});
                var color = colorSet.next();
                var radius = 15 + (value / 50) * 5;
                var circle = container.children.push(
                    am5.Circle.new(root, {
                        radius: radius,
                        fill: color,
                        dy: -radius * 2,
                    })
                );

                var pole = container.children.push(
                    am5.Line.new(root, {
                        stroke: color,
                        height: -40,
                        strokeGradient: am5.LinearGradient.new(root, {
                            stops: [{
                                opacity: 1
                            }, {
                                opacity: 1
                            }, {
                                opacity: 0
                            }],
                        }),
                    })
                );

                var label = container.children.push(
                    am5.Label.new(root, {
                        text: value + "%",
                        fill: am5.color(0xffffff),
                        fontWeight: "400",
                        fontSize: "14px",
                        centerX: am5.p50,
                        centerY: am5.p50,
                        dy: -radius * 2,
                    })
                );

                var titleLabel = container.children.push(
                    am5.Label.new(root, {
                        text: dataItem.dataContext.title,
                        fill: am5.color("#424C60"),
                        fontWeight: "500",
                        fontSize: "16px",
                        centerY: am5.p50,
                        dy: -radius * 2,
                        dx: radius,
                    })
                );
                return am5.Bullet.new(root, {
                    sprite: container,
                });
            });

            // ====================================
            // Create pins
            // ====================================

            var data = [{
                    title: "United States",
                    latitude: 39.563353,
                    longitude: -99.316406,
                    width: 50,
                    height: 50,
                    value: 100,
                },
                {
                    title: "European",
                    latitude: 50.896104,
                    longitude: 19.160156,
                    width: 50,
                    height: 50,
                    value: 15,
                },
                {
                    title: "Asia",
                    latitude: 47.212106,
                    longitude: 103.183594,
                    width: 50,
                    height: 50,
                    value: 8,
                },
                {
                    title: "Africa",
                    latitude: 11.081385,
                    longitude: 21.621094,
                    width: 50,
                    height: 50,
                    value: 5,
                },
            ];

            for (var i = 0; i < data.length; i++) {
                var d = data[i];
                pointSeries.data.push({
                    geometry: {
                        type: "Point",
                        coordinates: [d.longitude, d.latitude]
                    },
                    title: d.title,
                    value: d.value,
                    value2: d.value,
                });
            }
        }); // end am5.ready()
        am5.ready(function() {
            // Create root and chart
            var root = am5.Root.new("exportCountryMap");

            // Set themes
            root.setThemes([am5themes_Animated.new(root)]);

            // ====================================
            // Create map
            // ====================================

            var map = root.container.children.push(
                am5map.MapChart.new(root, {
                    panX: "rotateX",
                    panY: "rotateY",
                    projection: am5map.geoOrthographic(),
                    paddingBottom: 20,
                    paddingTop: 80,
                    paddingLeft: 20,
                    paddingRight: 20,
                    // homeGeoPoint: { latitude: 2, longitude: 2 },
                })
            );
            //Switch Toggle Map
            var cont = map.children.push(
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
                    map.set("projection", am5map.geoOrthographic());
                    map.set("panY", "rotateY");
                    backgroundSeries.mapPolygons.template.set("fillOpacity", 0.1);
                } else {
                    map.set("projection", am5map.geoMercator());
                    map.set("panY", "translateY");
                    map.set("rotationY", 0);
                    backgroundSeries.mapPolygons.template.set("fillOpacity", 0);
                }
            });

            cont.children.push(
                am5.Label.new(root, {
                    centerY: am5.p50,
                    text: "Map",
                })
            );
            // Create polygon series
            var polygonSeries = map.series.push(
                am5map.MapPolygonSeries.new(root, {
                    geoJSON: am5geodata_worldLow,
                    exclude: ["antarctica"],
                    fill: am5.color("#27AE60"),
                })
            );
            // Create series for background fill

            var backgroundSeries = map.series.push(
                am5map.MapPolygonSeries.new(root, {})
            );
            backgroundSeries.mapPolygons.template.setAll({
                fill: root.interfaceColors.get("disabled"),
                fillOpacity: 0.3,
                strokeOpacity: 0,
            });

            // Create graticule series

            var graticuleSeries = map.series.push(
                am5map.GraticuleSeries.new(root, {})
            );
            graticuleSeries.mapLines.template.setAll({
                strokeOpacity: 0.1,
                stroke: root.interfaceColors.get("alternativeBackground"),
            });

            // Rotate animation
            map.animate({
                key: "rotationX",
                from: 0,
                to: 360,
                duration: 30000,
                loops: Infinity,
            });

            // Make stuff animate on load
            map.appear(1000, 100);

            var pointSeries = map.series.push(am5map.MapPointSeries.new(root, {}));
            var colorSet = am5.ColorSet.new(root, {
                step: 2
            });
            pointSeries.bullets.push(function(root, series, dataItem) {
                var value = dataItem.dataContext.value;
                var container = am5.Container.new(root, {});
                var color = colorSet.next();
                var radius = 15 + (value / 50) * 5;
                var circle = container.children.push(
                    am5.Circle.new(root, {
                        radius: radius,
                        fill: color,
                        dy: -radius * 2,
                    })
                );

                var pole = container.children.push(
                    am5.Line.new(root, {
                        stroke: color,
                        height: -40,
                        strokeGradient: am5.LinearGradient.new(root, {
                            stops: [{
                                opacity: 1
                            }, {
                                opacity: 1
                            }, {
                                opacity: 0
                            }],
                        }),
                    })
                );

                var label = container.children.push(
                    am5.Label.new(root, {
                        text: value + "%",
                        fill: am5.color(0xffffff),
                        fontWeight: "400",
                        fontSize: "14px",
                        centerX: am5.p50,
                        centerY: am5.p50,
                        dy: -radius * 2,
                    })
                );

                var titleLabel = container.children.push(
                    am5.Label.new(root, {
                        text: dataItem.dataContext.title,
                        fill: am5.color("#424C60"),
                        fontWeight: "500",
                        fontSize: "16px",
                        centerY: am5.p50,
                        dy: -radius * 2,
                        dx: radius,
                    })
                );
                return am5.Bullet.new(root, {
                    sprite: container,
                });
            });

            // ====================================
            // Create pins
            // ====================================

            var data = [{
                    title: "United States",
                    latitude: 39.563353,
                    longitude: -99.316406,
                    width: 50,
                    height: 50,
                    value: 100,
                },
                {
                    title: "European",
                    latitude: 50.896104,
                    longitude: 19.160156,
                    width: 50,
                    height: 50,
                    value: 15,
                },
                {
                    title: "Asia",
                    latitude: 47.212106,
                    longitude: 103.183594,
                    width: 50,
                    height: 50,
                    value: 8,
                },
                {
                    title: "Africa",
                    latitude: 11.081385,
                    longitude: 21.621094,
                    width: 50,
                    height: 50,
                    value: 5,
                },
            ];

            for (var i = 0; i < data.length; i++) {
                var d = data[i];
                pointSeries.data.push({
                    geometry: {
                        type: "Point",
                        coordinates: [d.longitude, d.latitude]
                    },
                    title: d.title,
                    value: d.value,
                    value2: d.value,
                });
            }
        }); // end am5.ready()
    </script>
@endpush