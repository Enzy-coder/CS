@section('style')
    
@endsection
<div class="change-home">
    <div id="map"></div>
</div>

@section('scripts')

<script>
    $(document).ready(function(){
        // Initialize the map
        var map = L.map('map').setView([20, 0], 2.4); // Set initial view [latitude, longitude], zoom level

        // Load and display the map tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            errorTileUrl: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', // Fallback URL for missing tiles
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Define the icons for each continent
        var iconOptions = {
            iconSize: [null, null],
            iconAnchor: [50, 100], // Anchor the icon to its bottom center
            popupAnchor: [0, -100], // Popup appears above the icon
            className: 'continent-icon'
        };

        var africaIcon = L.icon({iconUrl: '/continents/africa.png', ...iconOptions});
        var asiaIcon = L.icon({iconUrl: '/continents/asia.png', ...iconOptions});
        var europeIcon = L.icon({iconUrl: '/continents/europe.png', ...iconOptions});
        var northAmericaIcon = L.icon({iconUrl: '/continents/north-america.png', ...iconOptions});
        var southAmericaIcon = L.icon({iconUrl: '/continents/south-america.png', ...iconOptions});
        var australiaIcon = L.icon({iconUrl: '/continents/australia.png', ...iconOptions});
        var antarcticaIcon = L.icon({iconUrl: '/continents/antarctica.png', ...iconOptions});

        // Add markers to the map for each continent
        var continents = [
            {name: 'africa', latlng: [9.0820, 21.4694], icon: africaIcon},
            {name: 'asia', latlng: [34.0479, 100.6197], icon: asiaIcon},
            {name: 'europe', latlng: [54.5260, 15.2551], icon: europeIcon},
            {name: 'north-america', latlng: [37.0902, -95.7129], icon: northAmericaIcon},
            {name: 'south-america', latlng: [-14.2350, -51.9253], icon: southAmericaIcon},
            {name: 'australia', latlng: [-25.2744, 133.7751], icon: australiaIcon},
            {name: 'antarctica', latlng: [-82.8628, 135.0000], icon: antarcticaIcon}
        ];

        continents.forEach(function(continent) {
            L.marker(continent.latlng, {icon: continent.icon})
                .addTo(map)
                .bindPopup(`<b>${continent.name}</b><br>Click to explore!`)
                .on('click', function() {
                    window.location.href = `/continents/${continent.name}/culture`;
                });
        });
    });
</script>
@endsection
