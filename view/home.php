<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>

<div class="mt-20 flex w-full d-flex justify-center">
    <h1>Hello</h1>
    <div class="absolute h-200 w-200" id="map"></div>
</div>

    <script>
        var map = L.map('map').setView([0,0],1)

        var leafletIcon = L.icon ({
            iconUrl: 'https://leafletjs.com/examples/custom-icons/leaf-green.png',
            iconSeize: [38,95],
            iconAnchor: [22,94],
        })

        L.tileLayer('https://api.maptiler.com/maps/openstreetmap/{z}/{x}/{y}.jpg?key=jEq1W2MCGWJIfonXJrwc', {
            attribution:'<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors </a>',

        }).addTo(map);

        var marker = L.marker([46, 6],{icon:leafletIcon}).addTo(map);

        var circle = L.circle([46, 6], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            raduis:500
        }).addTo(map);

        var polygon = L.polygon([
        [46.209045, 6.191841],
        [46.208986, 6.191946],
        [46.208807, 6.191727],
        [46.208867, 6.191626],
        [46.208914, 6.191683],
        [46.208889, 6.191729],
        [46.208925, 6.191778],
        [46.208954, 6.191729]
        ]).addTo(map);

        marker.bindPopup('<h1>Hey freezix</h1><br><p>I am a marker</p>').openPopup();

        /*
        var myGeoJSON = {dataa}
        //FETCH https://router.project-osrm.org/route/v1/driving/6.1432,46.2044;6.6323,46.5197?overview=full&geometries=geojson
        L.geoJSON(myGeoJSON).addTo(map);
        */
    </script>