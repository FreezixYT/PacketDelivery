<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>

<div class="mt-20 flex w-full d-flex justify-center">
    <h1>Hello</h1>
    <div class="absolute h-200 w-200" id="map"></div>
</div>



<script>
    var map = L.map('map', {
        center: [46.2017576, 6.1275494],
        zoom: 13
    });

    var points = [];

    function addPaquets(numeroPostal, nomDestinataire, prenomDestinataire, adresseDestinataire, latitudeAdresse, longitudeAdresse, statutLivraison)
    {
        L.marker([latitudeAdresse, longitudeAdresse]).addTo(map).bindPopup("<h1>" + prenomDestinataire + " " + nomDestinataire + "<br>" + adresseDestinataire +"<br> Status : " + statutLivraison);
        points.push([latitudeAdresse, longitudeAdresse]);
    }


    L.tileLayer('https://api.maptiler.com/maps/openstreetmap/{z}/{x}/{y}.jpg?key=jEq1W2MCGWJIfonXJrwc', {
        attribution: '<a href="https://freezix.com/" target="_blank">Paquet Delivery</a> | <a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors </a>',

    }).addTo(map);
</script>

<?php
foreach ($paquets as $paquet)
{
?>
<script>
    addPaquets(
        <?= json_encode($paquet['numeroPostal']) ?>,
        <?= json_encode($paquet['nomDestinataire']) ?>,
        <?= json_encode($paquet['prenomDestinataire']) ?>,
        <?= json_encode($paquet['adresseDestinataire']) ?>,
        <?= json_encode($paquet['latitudeAdresse']) ?>,
        <?= json_encode($paquet['longitudeAdresse']) ?>,
        <?= json_encode($paquet['statutLivraison']) ?>
    );
</script>
<?php
}
?>
<script>
    L.polyline(points, {
        color: 'blue',
        weight: 4
    }).addTo(map);
</script>