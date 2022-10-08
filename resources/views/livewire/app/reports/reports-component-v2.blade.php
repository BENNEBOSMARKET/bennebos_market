@section('title')
    Reports
@endsection
<div>
    <section class="map_wrapper">
        <div class="my-container">
            <div class="map_area">
                <div class="map_button_area">
                    <a href="{{ route('reports', ['slug' => $slug, 'type' => 'import']) }}" class="map_btn import_btn">
                        Import
                        <span><svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.25 11C5.25 11.4142 5.58579 11.75 6 11.75C6.41421 11.75 6.75 11.4142 6.75 11L5.25 11ZM6.53033 0.46967C6.23744 0.176777 5.76256 0.176777 5.46967 0.46967L0.696699 5.24264C0.403806 5.53553 0.403806 6.01041 0.696699 6.3033C0.989593 6.59619 1.46447 6.59619 1.75736 6.3033L6 2.06066L10.2426 6.3033C10.5355 6.59619 11.0104 6.59619 11.3033 6.3033C11.5962 6.01041 11.5962 5.53553 11.3033 5.24264L6.53033 0.46967ZM6.75 11L6.75 1L5.25 1L5.25 11L6.75 11Z"
                                    fill="#EB5757" />
                            </svg>
                        </span>
                    </a>
                    <a href="{{ route('reports', ['slug' => $slug, 'type' => 'export']) }}" class="map_btn export_btn">
                        Export
                        <span>
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.75 1C6.75 0.585786 6.41421 0.25 6 0.25C5.58579 0.25 5.25 0.585786 5.25 1L6.75 1ZM5.46967 11.5303C5.76256 11.8232 6.23744 11.8232 6.53033 11.5303L11.3033 6.75736C11.5962 6.46447 11.5962 5.98959 11.3033 5.6967C11.0104 5.40381 10.5355 5.40381 10.2426 5.6967L6 9.93934L1.75736 5.6967C1.46447 5.40381 0.989593 5.40381 0.696699 5.6967C0.403806 5.98959 0.403806 6.46447 0.696699 6.75736L5.46967 11.5303ZM5.25 1L5.25 11L6.75 11L6.75 1L5.25 1Z"
                                    fill="#27AE60" />
                            </svg>
                        </span>
                    </a>
                </div>
                <div class="map_grid">
                    <div class="position-relative">
                        <h2 class="page_title">{{ $mapDetails->country }} Trade Profile ({{ ucfirst($type) }})</h2>
                        <div class="map_show single_country_area">
                            <img src="{{ $mapDetails->vector_map }}"
                                style="height: 540px; width: 100%; padding-top: 50px;" alt="">
                        </div>
                        <div class="hide_divider"></div>
                    </div>
                    <div class="position-relative">
                        <div id="countryMap"></div>
                        <div class="hide_divider"></div>
                    </div>
                </div>
                <div class="position-relative">

                    <div class="map_show single_country_area" id="columnChart"></div>
                    <div class="hide_divider" style="bottom: -4px;"></div>
                </div>
            </div>
            <div class="text-center" style="margin-top: 30px; margin-bottom: 20px;">
                <a href="{{ route('reportDetails', ['slug'=>$slug]) }}" class="default_btn default_btn_bg">
                    Load More
                </a>
            </div>
        </div>
    </section>
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
            // Create root and chart
            var root = am5.Root.new("countryUSA");

            // Set themes
            root.setThemes([am5themes_Animated.new(root)]);

            var chart = root.container.children.push(
                am5map.MapChart.new(root, {
                    panX: "rotateX",
                    projection: am5map.geoAlbersUsa(),
                })
            );

            // Create polygon series
            var polygonSeries = chart.series.push(
                am5map.MapPolygonSeries.new(root, {
                    geoJSON: am5geodata_usaLow,
                })
            );

            polygonSeries.mapPolygons.template.setAll({
                tooltipText: "{name}",
            });

            polygonSeries.mapPolygons.template.states.create("hover", {
                fill: am5.color(0x297373),
            });

            // Create series for labels
            var pointSeries = chart.series.push(
                am5map.MapPointSeries.new(root, {
                    polygonIdField: "polygonId",
                })
            );
            pointSeries.bullets.push(function() {
                return am5.Bullet.new(root, {
                    sprite: am5.Label.new(root, {
                        fontSize: 12,
                        fontWeight: 500,
                        centerX: am5.p30,
                        centerY: am5.p40,
                        text: "{name}",
                        populateText: true,
                    }),
                });
            });

            // Add state labels
            polygonSeries.events.on("datavalidated", function(ev) {
                var series = ev.target;
                var labelData = [];
                series.mapPolygons.each(function(polygon) {
                    var id = polygon.dataItem.get("id");
                    labelData.push({
                        polygonId: id,
                        name: id.split("-").pop(),
                    });
                });
                pointSeries.data.setAll(labelData);
            });

            var zoomOut = root.tooltipContainer.children.push(
                am5.Button.new(root, {
                    x: am5.p100,
                    y: 0,
                    centerX: am5.p100,
                    centerY: 0,
                    paddingTop: 18,
                    paddingBottom: 18,
                    paddingLeft: 12,
                    paddingRight: 12,
                    dx: -20,
                    dy: 20,
                    themeTags: ["zoom"],
                    icon: am5.Graphics.new(root, {
                        themeTags: ["button", "icon"],
                        strokeOpacity: 0.7,
                        draw: function(display) {
                            display.moveTo(0, 0);
                            display.lineTo(12, 0);
                        },
                    }),
                })
            );

            zoomOut.get("background").setAll({
                cornerRadiusBL: 40,
                cornerRadiusBR: 40,
                cornerRadiusTL: 40,
                cornerRadiusTR: 40,
            });
            zoomOut.events.on("click", function() {
                if (currentSeries) {
                    currentSeries.hide();
                }
                chart.goHome();
                zoomOut.hide();
                currentSeries = regionalSeries.US.series;
                currentSeries.show();
            });
            zoomOut.hide();

            // =================================
            // Set up point series
            // =================================

            // Load store data
            am5.net
                .load("assets/plugins/map-data/geodata/store-data/usaStores.json")
                .then(function(result) {
                    var stores = am5.JSONParser.parse(result.response);
                    setupStores(stores);
                });

            var regionalSeries = {};
            var currentSeries;

            // Parses data and creats map point series for domestic and state-level
            function setupStores(data) {
                console.log(data);

                // Init country-level series
                regionalSeries.US = {
                    markerData: [],
                    series: createSeries("stores"),
                };

                // Set current series
                currentSeries = regionalSeries.US.series;

                // Process data
                am5.array.each(data.query_results, function(store) {
                    // Get store data
                    var store = {
                        state: store.MAIL_ST_PROV_C,
                        long: am5.type.toNumber(store.LNGTD_I),
                        lat: am5.type.toNumber(store.LATTD_I),
                        location: store.co_loc_n,
                        city: store.mail_city_n,
                        count: am5.type.toNumber(store.count),
                    };

                    // Process state-level data
                    if (regionalSeries[store.state] == undefined) {
                        var statePolygon = getPolygon("US-" + store.state);
                        if (statePolygon) {
                            var centroid = statePolygon.visualCentroid();

                            // Add state data
                            regionalSeries[store.state] = {
                                target: store.state,
                                type: "state",
                                name: statePolygon.dataItem.dataContext.name,
                                count: store.count,
                                stores: 1,
                                state: store.state,
                                markerData: [],
                                geometry: {
                                    type: "Point",
                                    coordinates: [centroid.longitude, centroid.latitude],
                                },
                            };
                            regionalSeries.US.markerData.push(regionalSeries[store.state]);
                        } else {
                            // State not found
                            return;
                        }
                    } else {
                        regionalSeries[store.state].stores++;
                        regionalSeries[store.state].count += store.count;
                    }

                    // Process city-level data
                    if (regionalSeries[store.city] == undefined) {
                        regionalSeries[store.city] = {
                            target: store.city,
                            type: "city",
                            name: store.city,
                            count: store.count,
                            stores: 1,
                            state: store.state,
                            markerData: [],
                            geometry: {
                                type: "Point",
                                coordinates: [store.long, store.lat],
                            },
                        };
                        regionalSeries[store.state].markerData.push(
                            regionalSeries[store.city]
                        );
                    } else {
                        regionalSeries[store.city].stores++;
                        regionalSeries[store.city].count += store.count;
                    }

                    // Process individual store
                    regionalSeries[store.city].markerData.push({
                        name: store.location,
                        count: store.count,
                        stores: 1,
                        state: store.state,
                        geometry: {
                            type: "Point",
                            coordinates: [store.long, store.lat],
                        },
                    });
                });
                console.log(regionalSeries.US.markerData);
                regionalSeries.US.series.data.setAll(regionalSeries.US.markerData);
            }

            // Finds polygon in series by its id
            function getPolygon(id) {
                var found;
                polygonSeries.mapPolygons.each(function(polygon) {
                    if (polygon.dataItem.get("id") == id) {
                        found = polygon;
                    }
                });
                return found;
            }

            // Creates series with heat rules
            function createSeries(heatfield) {
                // Create point series
                var pointSeries = chart.series.push(
                    am5map.MapPointSeries.new(root, {
                        valueField: heatfield,
                        calculateAggregates: true,
                    })
                );

                // Add store bullet
                var circleTemplate = am5.Template.new(root);
                pointSeries.bullets.push(function() {
                    var container = am5.Container.new(root, {});

                    var circle = container.children.push(
                        am5.Circle.new(
                            root, {
                                radius: 10,
                                fill: am5.color(0x000000),
                                fillOpacity: 0.7,
                                cursorOverStyle: "pointer",
                                tooltipText: "{name}:\n[bold]{stores} stores[/]",
                            },
                            circleTemplate
                        )
                    );

                    var label = container.children.push(
                        am5.Label.new(root, {
                            text: "{stores}",
                            fill: am5.color(0xffffff),
                            populateText: true,
                            centerX: am5.p50,
                            centerY: am5.p50,
                            textAlign: "center",
                        })
                    );

                    // Set up drill-down
                    circle.events.on("click", function(ev) {
                        // Determine what we've clicked on

                        var data = ev.target.dataItem.dataContext;

                        // No id? Individual store - nothing to drill down to further
                        if (!data.target) {
                            return;
                        }

                        // Create actual series if it hasn't been yet created
                        if (!regionalSeries[data.target].series) {
                            regionalSeries[data.target].series = createSeries("count");
                            regionalSeries[data.target].series.data.setAll(data.markerData);
                        }

                        // Hide current series
                        if (currentSeries) {
                            currentSeries.hide();
                        }

                        // Control zoom
                        if (data.type == "state") {
                            var statePolygon = getPolygon("US-" + data.state);
                            polygonSeries.zoomToDataItem(statePolygon.dataItem);
                        } else if (data.type == "city") {
                            chart.zoomToGeoPoint({
                                    latitude: data.geometry.coordinates[1],
                                    longitude: data.geometry.coordinates[0],
                                },
                                64,
                                true
                            );
                        }
                        zoomOut.show();

                        // Show new targert series
                        currentSeries = regionalSeries[data.target].series;
                        currentSeries.show();
                    });

                    return am5.Bullet.new(root, {
                        sprite: container,
                    });
                });

                // Add heat rule for circles
                pointSeries.set("heatRules", [{
                    target: circleTemplate,
                    dataField: "value",
                    min: 10,
                    max: 30,
                    key: "radius",
                }, ]);

                // Set up drill-down
                // TODO

                return pointSeries;
            }
        }); // end am5.ready()
    </script>

    <script>
        am5.ready(function() {
            var data = [
                @foreach ($maps as $country)
                    {
                        id: "{{ $country->country_code }}",
                        name: "{{ $country->country }}",
                        link: "{{ route('reports', ['slug' => $country->slug, 'type' => 'import']) }}",
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

    <script>
        am5.ready(function() {

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("columnChart");


            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
                am5themes_Animated.new(root)
            ]);


            // Create chart
            // https://www.amcharts.com/docs/v5/charts/xy-chart/
            var chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: false,
                panY: false,
                wheelX: "panX",
                wheelY: "zoomX",
                layout: root.verticalLayout
            }));


            // Data
            var colors = chart.get("colors");

            var data = [
                @if ($type == 'import')
                    @foreach ($importCountries as $impcountry)
                        {
                            country: "{{ $impcountry->country }}",
                            visits: {{ $impcountry->trade_value }},
                            icon: "https://www.amcharts.com/wp-content/uploads/flags/{{ Str::slug($impcountry->country) }}.svg",
                            columnSettings: {
                                fill: colors.next()
                            }
                        },
                    @endforeach
                @else
                    @foreach ($exportCountries as $expcountry)
                        {
                            country: "{{ $expcountry->country }}",
                            visits: {{ $expcountry->trade_value }},
                            icon: "https://www.amcharts.com/wp-content/uploads/flags/{{ Str::slug($expcountry->country) }}.svg",
                            columnSettings: {
                                fill: colors.next()
                            }
                        },
                    @endforeach
                @endif

            ];


            // Create axes
            // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
            var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                categoryField: "country",
                renderer: am5xy.AxisRendererX.new(root, {
                    minGridDistance: 30
                }),
                bullet: function(root, axis, dataItem) {
                    return am5xy.AxisBullet.new(root, {
                        location: 0.5,
                        sprite: am5.Picture.new(root, {
                            width: 24,
                            height: 24,
                            centerY: am5.p50,
                            centerX: am5.p50,
                            src: dataItem.dataContext.icon
                        })
                    });
                }
            }));

            xAxis.get("renderer").labels.template.setAll({
                paddingTop: 20
            });

            xAxis.data.setAll(data);

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                renderer: am5xy.AxisRendererY.new(root, {})
            }));


            // Add series
            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
            var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "visits",
                categoryXField: "country"
            }));

            series.columns.template.setAll({
                tooltipText: "{categoryX}: {valueY}",
                tooltipY: 0,
                strokeOpacity: 0,
                templateField: "columnSettings"
            });

            series.data.setAll(data);


            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            series.appear();
            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>
@endpush
