<div id="globe-container" style="width: 100%; height: 100vh;"></div>

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script>
        $(document).ready(function () {
    var container = document.getElementById('globe-container');
    var scene = new THREE.Scene();
    var camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    var renderer = new THREE.WebGLRenderer({ antialias: true });

    renderer.setSize(window.innerWidth, window.innerHeight);
    container.appendChild(renderer.domElement);

    // Create the globe (a sphere)
    var geometry = new THREE.SphereGeometry(5, 32, 32);
    var material = new THREE.MeshBasicMaterial({
        color: 0xffffff,
        wireframe: true,
    });
    var globe = new THREE.Mesh(geometry, material);
    scene.add(globe);

    camera.position.z = 10;

    // Function to animate the globe
    function animate() {
        requestAnimationFrame(animate);
        globe.rotation.y += 0.005;
        renderer.render(scene, camera);
    }

    animate();

    // Example of adding a flag (replace with actual flag texture)
    var flagTexture = new THREE.TextureLoader().load('path/to/flag-image.jpg');
    var flagMaterial = new THREE.SpriteMaterial({ map: flagTexture });
    var flag = new THREE.Sprite(flagMaterial);

    flag.position.set(2, 2, 5.5); // Position the flag
    flag.scale.set(1, 1, 1); // Scale the flag
    scene.add(flag);

    // Event listener for clicking the flag
    $(flagMaterial).on('click', function () {
        window.location.href = 'http://www.example.com'; // Replace with actual URL
    });

    // Handle window resize
    window.addEventListener('resize', function () {
        var width = window.innerWidth;
        var height = window.innerHeight;
        renderer.setSize(width, height);
        camera.aspect = width / height;
        camera.updateProjectionMatrix();
    });
});

    </script>
    @endsection
