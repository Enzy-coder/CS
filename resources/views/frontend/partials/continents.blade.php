 @section('style')
 <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
 <style>
        #map {
            width: 100%;
            height: 100vh;
        }
        .continent-icon {
            width: 50px;
            height: 50px;
            cursor: pointer;
        }
    </style>
 @endsection
 <div id="map"></div>

 @section('scripts')
 <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
 <script>
        // Initialize the map
        var map = L.map('map').setView([20, 0], 2); // Set initial view [latitude, longitude], zoom level

        // Load and display the map tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Define the icons for each continent
        var iconOptions = {
            iconSize: [50, 50],
            className: 'continent-icon'
        };

        var africaIcon = L.icon($.extend({iconUrl: 'path/to/africa-icon.png'}, iconOptions));
        var asiaIcon = L.icon($.extend({iconUrl: 'path/to/asia-icon.png'}, iconOptions));
        var europeIcon = L.icon($.extend({iconUrl: 'path/to/europe-icon.png'}, iconOptions));
        var northAmericaIcon = L.icon($.extend({iconUrl: 'path/to/north-america-icon.png'}, iconOptions));
        var southAmericaIcon = L.icon($.extend({iconUrl: 'path/to/south-america-icon.png'}, iconOptions));
        var australiaIcon = L.icon($.extend({iconUrl: 'path/to/australia-icon.png'}, iconOptions));
        var antarcticaIcon = L.icon($.extend({iconUrl: 'path/to/antarctica-icon.png'}, iconOptions));

        // Add markers to the map for each continent
        var continents = [
            {name: 'Africa', latlng: [0, 20], icon: africaIcon},
            {name: 'Asia', latlng: [34, 100], icon: asiaIcon},
            {name: 'Europe', latlng: [54, 15], icon: europeIcon},
            {name: 'North America', latlng: [40, -100], icon: northAmericaIcon},
            {name: 'South America', latlng: [-15, -60], icon: southAmericaIcon},
            {name: 'Australia', latlng: [-25, 133], icon: australiaIcon},
            {name: 'Antarctica', latlng: [-75, 0], icon: antarcticaIcon}
        ];

        continents.forEach(function(continent) {
            L.marker(continent.latlng, {icon: continent.icon})
                .addTo(map)
                .on('click', function() {
                    window.location.href = `continent.html?name=${continent.name}`;
                });
        });
    </script>
 @endsection