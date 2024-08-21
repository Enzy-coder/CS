$(document).ready(function() {
    var map = L.map('map', {
        center: [70, -3],
        zoom: 3,
        crs: L.CRS.EPSG4326,
        scrollWheelZoom: false,
        dragging: false,
        doubleClickZoom: false,
        touchZoom: false,
        boxZoom: false,
        keyboard: false
    });
    var bounds = L.latLngBounds(
        L.latLng(0, -180),
        L.latLng(7, 180)
    );
    map.fitBounds(bounds);

    // Set max bounds to restrict panning
    map.setMaxBounds(bounds);

    // Function to update map settings based on screen width
    function updateMapSettings() {
        if (window.innerWidth <= 768) { // Mobile screen width
            map.scrollWheelZoom.enable();
            map.dragging.enable();
            map.doubleClickZoom.enable();
            map.touchZoom.enable();
            map.boxZoom.enable(); // Enable box zoom on mobile
        } else { // Desktop screen width
            map.scrollWheelZoom.disable();
            map.dragging.disable();
            map.doubleClickZoom.disable();
            map.touchZoom.disable();
            map.boxZoom.disable(); // Disable box zoom on desktop
        }
    }

    // Call the function on page load
    updateMapSettings();

    // Call the function on window resize
    $(window).resize(updateMapSettings);

   

    L.tileLayer('https://stamen-tiles.a.ssl.fastly.net/watercolor/{z}/{x}/{y}.jpg', {
        attribution: 'Map tiles by Stamen Design, under CC BY 3.0. Data by OpenStreetMap, under ODbL.',
        maxZoom: 18
    }).addTo(map);

    map.fitBounds(bounds);

    var iconOptions = {
        iconSize: [75, null],
        iconAnchor: [25, 25],
        popupAnchor: [0, 0],
        className: 'landmark-icon'
    };

    var landmarks = [
        {name: 'Europe', continent: 'europe', continentName: 'Europe', latlng: [54.5260, 15.2551], iconUrl: '/continents/landmarks/efel.png'},
        {name: 'Africa', continent: 'africa', continentName: 'Africa', latlng: [0.0, 20.0], iconUrl: '/continents/landmarks/africa.png'},
        {name: 'Asia', continent: 'asia', continentName: 'Asia', latlng: [34.0479, 100.6197], iconUrl: '/continents/landmarks/asia.png'},
        {name: 'North America', continent: 'north-america', continentName: 'North America', latlng: [54.5260, -105.2551], iconUrl: '/continents/landmarks/north-america.png'},
        {name: 'South America', continent: 'south-america', continentName: 'South America', latlng: [-14.2350, -51.9253], iconUrl: '/continents/landmarks/south-america.png'},
        {name: 'Australia', continent: 'australia', continentName: 'Australia', latlng: [-25.2744, 133.7751], iconUrl: '/continents/landmarks/australia.png'},
        {name: 'Antarctica', continent: 'antarctica', continentName: 'Antarctica', latlng: [-82.8628, 135.0000], iconUrl: '/continents/landmarks/antarctica.png'}
    ];

    landmarks.forEach(function(landmark) {
        var icon = L.icon({...iconOptions, iconUrl: landmark.iconUrl});
        
        L.marker(landmark.latlng, {icon: icon})
            .addTo(map)
            .bindPopup(landmark.continentName)
            .on('click', function() {
                fetchCountries(landmark.continent);
                $("#continent-name").html('<a style="color:orange" href="/continents/'+ landmark.continent +'/culture">' + landmark.continentName + '</a>');
                $("#continent-info").text(landmark.continentName);
            });
    });

    var geojson;

    $.getJSON('/continents/continents.json', function(data) {
        geojson = L.geoJson(data, {
            filter: function(feature) {
                return feature.properties.continentName !== 'Antarctica';
            },
            style: function (feature) {
                return {
                    color: "#A7DDE2",
                    fillOpacity: .8,
                    weight: 0
                };
            },
            onEachFeature: function (feature, layer) {
                var continentName = feature.properties.CONTINENT;

                layer.bindTooltip(continentName, {
                    permanent: false, // Tooltip will be shown on hover
                    direction: 'auto', // Automatically adjust direction
                    className: 'continent-tooltip' // Custom class for styling
                });

                layer.on({
                    mouseover: function(e) {
                        var layer = e.target;
                        layer.setStyle({
                            fillColor: '#3498db',
                            fillOpacity: 0.8,
                            weight: 0,
                            color: '#2980b9'
                        });
                    },
                    mouseout: function(e) {
                        geojson.resetStyle(e.target);
                    },
                    click: function(e) {
                        zoomToFeature(e.latlng);
                        const slug = convertToSlug(continentName);
                        fetchCountries(slug);
                        $("#continent-name").html('<a style="color:orange" href="/continents/'+ slug +'/culture">' + continentName + '</a>');
                        $("#continent-info").text(continentName);
                    }
                });
            }
        }).addTo(map);
    });

    function zoomToFeature(latlng) {
        // map.setView(latlng, 5);
    }

    let isFetchingCountries = false;

    function fetchCountries(continentName) {
        if (isFetchingCountries) return;
        isFetchingCountries = true;

        if ($('#country-slider').hasClass('slick-initialized')) {
            $('#country-slider').slick('unslick');
        }

        $('#country-slider').html('');

        $.get(`/continents/${continentName}/culture?limit=all`, function(data) {
            if (data) {
                $('#continent-info').html(`<strong>${data.length}</strong> countries`);
                let sliderContent = '';
                data.forEach(function(country) {
                    sliderContent += `<div class="cursor-pointer country-item" data-id="${country.id}"><img src="/continents/flags/${country.slug}.svg" alt="${country.name}"><div>${country.name}</div></div>`;
                });

                $('#country-slider').html(sliderContent).slick({
                    infinite: true,
                    slidesToShow: 8,
                    slidesToScroll: 7,
                    arrows: true,
                    autoplay: true,
                    autoplaySpeed: 6000,
                    responsive: [
                        { breakpoint: 1024, settings: { slidesToShow: 4 } },
                        { breakpoint: 768, settings: { slidesToShow: 3 } },
                        { breakpoint: 480, settings: { slidesToShow: 1 ,slidesToScroll: 1} }
                    ]
                }).on('init', function(event, slick) {
                    $('#country-slider .slick-prev').html('<i class="las la-angle-left"></i>');
                    $('#country-slider .slick-next').html('<i class="las la-angle-right"></i>');
                }).slick('refresh');

                setTimeout(function() {
                    $('#country-slider .slick-prev').html('<i class="las la-angle-left"></i>');
                    $('#country-slider .slick-next').html('<i class="las la-angle-right"></i>');
                }, 10);

            } else {
                $('#continent-info').html(`<strong>${continentName}</strong>: No countries found`);
                $('#country-slider').html('');
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX request failed:', textStatus, errorThrown);
            $('#continent-info').html(`Error fetching countries for <strong>${continentName}</strong>`);
            $('#country-slider').html('');
        }).always(function() {
            isFetchingCountries = false;
        });
    }

    $(document).on('click', '.country-item', function() {
        let id = $(this).attr('data-id');
        window.location.href = "/countries/categories/" + id;
    });
    function convertToSlug(continentName) {
        return continentName.toLowerCase().replace(/\s+/g, '-');
    }
});
