<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>
<div class="mt-10 flex w-full d-flex justify-center">
    <div class="join">
        <button id="past" class="join-item btn">&lt;&lt;</button>
        <button id="actuel" class="join-item btn"></button>
        <button id="next" class="join-item btn">&gt;&gt;</button>
    </div>
</div>
<div class="mt-10 flex w-full d-flex justify-center">
    <div class="absolute h-2/3 w-3/4" id="map"></div>
</div>

<script>
    const btnPast = document.getElementById("past");
    const btnNext = document.getElementById("next");
    const actuel = document.getElementById("actuel");

    let currentDate = new Date("<?= $date ?>");

    function formatDate(date) {
        return date.toLocaleDateString("fr-FR", {
            weekday: "short",
            year: "numeric",
            month: "2-digit",
            day: "2-digit"
        });
    }

    function updateDisplay() {
        actuel.innerText = formatDate(currentDate);
    }

    function goToDate(date) {
        const dateStr = date.toISOString().split('T')[0];
        const idLivreur = <?= json_encode($idLivreur) ?>;
        window.location.href = `/${idLivreur}/${dateStr}/`;
    }

    btnPast.addEventListener("click", () => {
        currentDate.setDate(currentDate.getDate() - 1);
        goToDate(currentDate);
    });

    btnNext.addEventListener("click", () => {
        currentDate.setDate(currentDate.getDate() + 1);
        goToDate(currentDate);
    });

    updateDisplay();



    //map
    var map = L.map('map', {
        center: [46.2017576, 6.1275494],
        zoom: 13
    });

    var points = [];

    function addPaquets(id, numeroPostal, nomDestinataire, prenomDestinataire, adresseDestinataire, latitudeAdresse, longitudeAdresse, statutLivraison) {
        if (latitudeAdresse === null || longitudeAdresse === null) return;

        const badgeStatut = statutLivraison == "en_attente" ?
            "<span class='badge badge-error'>Pas livré</span>" :
            (statutLivraison == "en_cours" ?
                "<span class='badge badge-warning'>En cours</span>" :
                "<span class='badge badge-success'>Livré</span>");

        let popup = `<b>${prenomDestinataire} ${nomDestinataire}</b><br> ${adresseDestinataire}<br> N° postal : ${numeroPostal}<br> Statut : ${badgeStatut}<br>`;

        if (statutLivraison != "livre") {
            popup += `
                <form action="/paquet/livrer/${id}" method="POST">
                    <button type="submit" class="btn btn-sm btn-success mt-2">Marquer comme livré</button>
                </form>
            `;
        }

        const blueIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
        });

        const greenIcon = L.icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
        });
        const icon = statutLivraison == "livre" ? greenIcon : blueIcon;

        L.marker([latitudeAdresse, longitudeAdresse], {
            icon: icon
        }).addTo(map).bindPopup(popup);
        points.push([latitudeAdresse, longitudeAdresse]);
    }


    L.tileLayer('https://api.maptiler.com/maps/openstreetmap/{z}/{x}/{y}.jpg?key=jEq1W2MCGWJIfonXJrwc', {
        attribution: '<a href="https://freezix.com/" target="_blank">Paquet Delivery</a> | <a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors </a>',

    }).addTo(map);
</script>

<div>

</div>

<?php
foreach ($paquets as $paquet) {
?>
    <script>
        addPaquets(
            <?= json_encode($paquet['id']) ?>,
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