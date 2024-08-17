@section('style')
    
@endsection
<div class="change-home">
    <div id="map"></div>
</div>

@section('scripts')

<script>
    $(document).ready(function(){
        // Initialize the map
        var map = L.map('map').setView([8, 12], 2.4); // Set initial view [latitude, longitude], zoom level

        // Load and display the map tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
            errorTileUrl: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', // Fallback URL for missing tiles
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Define the icons for each continent
        var iconOptions = {
            iconSize: [null, null], // Adjust the size of the icon as needed
            iconAnchor: [16, 32], // Anchor the icon to its bottom center
            popupAnchor: [0, -40], // Adjust the popup position to be above the icon
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
            {name: 'europe', latlng: [60.5260, 15.2551], icon: europeIcon},
            {name: 'north-america', latlng: [60.0902, -120.7129], icon: northAmericaIcon},
            {name: 'south-america', latlng: [-40.2350, -80.9253], icon: southAmericaIcon},
            {name: 'australia', latlng: [-25.2744, 133.7751], icon: australiaIcon},
            {name: 'antarctica', latlng: [-63.8628, 40.0000], icon: antarcticaIcon}
        ];

        continents.forEach(function(continent) {
            // Create the marker
            const marker = L.marker(continent.latlng, { icon: continent.icon })
                .addTo(map);
                // .bindPopup(`<b>${continent.name}</b>`); // Bind the popup

            // // Show the popup when hovering over the marker
            // marker.on('mouseover', function() {
            //     this.openPopup();
            // });

            // // Hide the popup when the mouse leaves the marker
            // marker.on('mouseout', function() {
            //     this.closePopup();
            // });

            // Redirect to the continent page on click
            marker.on('click', function() {
                window.location.href = `/continents/${continent.name}/culture`;
            });
        });

    });
</script>africa
@endsection
