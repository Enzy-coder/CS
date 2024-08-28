document.addEventListener('DOMContentLoaded', function() {
    const svg = document.querySelector('svg');
    const flagsData = [
        { url: 'https://example.com/flag1.png', lat: 30, lon: 20 },
        { url: 'https://example.com/flag2.png', lat: -30, lon: -20 },
        // Add more flag data here
    ];

    flagsData.forEach(flagData => {
        const flag = document.createElementNS('http://www.w3.org/2000/svg', 'image');
        flag.setAttribute('href', flagData.url);
        flag.setAttribute('class', 'flag');
        flag.setAttribute('x', calculateX(flagData.lon));
        flag.setAttribute('y', calculateY(flagData.lat));
        svg.appendChild(flag);
    });

    function calculateX(lon) {
        // Transform longitude to X position (simplified)
        return 50 + lon;
    }

    function calculateY(lat) {
        // Transform latitude to Y position (simplified)
        return 50 - lat;
    }
});