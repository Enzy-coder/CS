@section('style')
    <style>
        #map {
            height: 500px; /* Adjust the height as needed */
            width: 100%;
        }

        .continent-highlight {
            fill-opacity: 0.6;
            fill-color: #f39c12; /* Highlight color */
            stroke: #e67e22; /* Border color */
            stroke-width: 2;
        }

        #continent-info {
            margin-top: 15px;
            padding: 10px;
            background: #f1f1f1;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-weight: bold;
            font-size: 16px;
            text-align: center;
        }

        #country-slider {
            margin-top: 15px;
            overflow: hidden;
            white-space: nowrap;
        }

        .country-item {
            display: inline-block;
            margin-right: 10px;
            text-align: center;
        }

        .country-item img {
            width: 100px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .country-item span {
            display: block;
            margin-top: 5px;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
@endsection

<div class="change-home">
    <div id="map"></div>
    <h3 id="continent-name"></h3>
    <h3 class="text-center" id="continent-info"></h3>
    <div id="country-slider"></div> 
</div>
@section('scripts')
<script>
    $(document).ready(function(){
        // Initialize the map
        var map = L.map('map', {
            center: [55, 0], // Adjust the center to fit your needs
            zoom: 2, // Adjust zoom to fit the globe
            crs: L.CRS.EPSG3857 // Use EPSG3857 projection
        });

        // Load and display the map tiles
        L.tileLayer('https://stamen-tiles.a.ssl.fastly.net/watercolor/{z}/{x}/{y}.jpg', {
            attribution: 'Map tiles by Stamen Design, under CC BY 3.0. Data by OpenStreetMap, under ODbL.',
            maxZoom: 18
        }).addTo(map);

        // Define the icons for landmarks
        var iconOptions = {
            iconAnchor: [25, 25],
            popupAnchor: [0, 0],
            className: 'landmark-icon'
        };

        // Landmarks for each continent with corrected coordinates
        var landmarks = [
            {name: 'Eiffel Tower', continent: 'europe',continentName: 'Europe', latlng: [58.8584, 2.2945], iconUrl: '/continents/landmarks/efel.png'},
            {name: 'Pyramids of Giza', continent: 'africa',continentName: 'Africa', latlng: [22.9792, 22.1342], iconUrl: '/continents/landmarks/africa.png'},
            {name: 'Taj Mahal', continent: 'asia',continentName: 'Asia', latlng: [48.1751, 78.0421], iconUrl: '/continents/landmarks/asia.png'},
            {name: 'Statue of Liberty', continent: 'north-america',continentName: 'North America', latlng: [74.6892, -120.0445], iconUrl: '/continents/landmarks/north-america.png'},
            {name: 'south-america', continent: 'south-america',continentName: 'South America', latlng: [0.9519, -100.2105], iconUrl: '/continents/landmarks/south-america.png'},
            {name: 'Sydney Opera House', continent: 'australia',continentName: 'Australia', latlng: [-5.8568, 151.2153], iconUrl: '/continents/landmarks/australia.png'},
            {name: 'South Pole', continent: 'antarctica',continentName: 'Antarctica', latlng: [-90.0000, 0.0000], iconUrl: '/continents/landmarks/antarctic.png'},
            // Add more landmarks as needed
        ];

        // Add landmarks to the map
        landmarks.forEach(function(landmark) {
            var icon = L.icon({...iconOptions, iconUrl: landmark.iconUrl});
            
            var marker = L.marker(landmark.latlng, {icon: icon}).addTo(map)
                .bindPopup(landmark.continentName)
                .on('click', function() {
                    window.location.href = '/continents/' + landmark.continent +'/culture';
                })
                .on('mouseover', function(e) {
                    // Open the popup on hover
                    fetchCountries(landmark.continent);
                    $('#continent-info').html(`<strong style="color:orange">${landmark.continentName}</strong>`); // Update info
                    marker.openPopup();
                })
                .on('mouseout', function(e) {
                    // Close the popup when the mouse leaves
                    marker.closePopup();
                });
        });

        // Initialize the GeoJSON layer variable
        var geojson;

        // Load the GeoJSON file directly from the public folder
        $.getJSON('/continents/continent.geo.json', function(data) {
            geojson = L.geoJson(data, {
                style: function (feature) {
                    return {
                        color: "#A7DDE2",
                        fillOpacity: .8,
                        weight: 0
                    };
                },
                onEachFeature: function (feature, layer) {
                    layer.on({
                        mouseover: function(e) {
                            var layer = e.target;
                            layer.setStyle({
                                fillColor: '#3498db', // Change fill color on hover
                                fillOpacity: 0.8,
                                weight: 0,
                                color: '#2980b9' // Change border color on hover
                            });
                            $('#continent-info').html(`<strong>${feature.properties.name}</strong>`); // Update info
                        },
                        mouseout: function(e) {
                            geojson.resetStyle(e.target); // Reset style when not hovering
                        },
                        click: function(e) {
                            zoomToFeature(e.latlng); // Zoom to feature on click
                            // highlightFeature(feature.properties.name); // Highlight feature info
                        }
                    });
                }
            }).addTo(map);
        });

        // Function to highlight continent and show info
        function highlightFeature(layer) {
           return true;
        }

        // Function to reset the feature style
        function resetHighlight(e) {
            geojson.resetStyle(e.target);
        }

        // Function to zoom to feature
        function zoomToFeature(latlng) {
            // map.setView(latlng, 5); // Zoom to the clicked landmark or feature
        }

        // Function to fetch and display countries in the slider
        let isFetchingCountries = false;

        function fetchCountries(continentName) {
            if (isFetchingCountries) return; // Prevents multiple rapid calls
            isFetchingCountries = true;

            if ($('#country-slider').hasClass('slick-initialized')) {
                $('#country-slider').slick('unslick');
            }

            $('#country-slider').html(''); // Clear previous content

            setTimeout(() => {
                $.get(`/continents/${continentName}/culture?limit=all`, function(data) {
                    if (data) {
                        $('#continent-info').html(`<strong>${continentName}</strong>: ${data.length} countries`);
                        let sliderContent = '';
                        data.forEach(function(country) {
                            sliderContent += `<div class="cursor-pointer country-item" data-id="${country.id}"><img src="/continents/flags/${country.slug}.svg" alt="${country.name}"><div>${country.name}</div></div>`;
                        });

                        $('#country-slider').html(sliderContent).slick({
                            infinite: true,
                            slidesToShow: 8, // Default number of slides to show
                            slidesToScroll: 1,
                            arrows: true, // Enable arrows
                            autoplay: true, // Optional: to automatically scroll
                            autoplaySpeed: 3000, // Optional: adjust speed if autoplay is enabled
                            responsive: [
                                {
                                    breakpoint: 1024, // For screens smaller than 1024px
                                    settings: {
                                        slidesToShow: 4
                                    }
                                },
                                {
                                    breakpoint: 768, // For screens smaller than 768px
                                    settings: {
                                        slidesToShow: 3
                                    }
                                },
                                {
                                    breakpoint: 480, // For screens smaller than 480px
                                    settings: {
                                        slidesToShow: 2
                                    }
                                }
                            ]
                        }).on('init', function(event, slick) {
                            // Apply custom arrows after initialization
                            $('#country-slider .slick-prev').html('<i class="las la-angle-left"></i>');
                            $('#country-slider .slick-next').html('<i class="las la-angle-right"></i>');
                        }).slick('refresh'); // Refresh slick to ensure changes are applied

                        // Optional: if you need to make sure the arrows are applied after a slight delay
                        setTimeout(function() {
                            $('#country-slider .slick-prev').html('<i class="las la-angle-left"></i>');
                            $('#country-slider .slick-next').html('<i class="las la-angle-right"></i>');
                        }, 10);

                    } else {
                        $('#continent-info').html(`<strong>${continentName}</strong>: No countries found`);
                        $('#country-slider').html(''); // Clear the slider if no countries are found
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX request failed:', textStatus, errorThrown);
                    $('#continent-info').html(`Error fetching countries for <strong>${continentName}</strong>`);
                    $('#country-slider').html(''); // Clear the slider in case of an error
                }).always(function() {
                    isFetchingCountries = false; // Reset the flag after AJAX call is done
                });
            }, 800);
        }
        $(document).on('click','.country-item',function(){
            let id = $(this).attr('data-id');
            window.location.href = "/countries/categories/" + id;
        });
    });
</script>


@endsection
