<div class="mt-20 flex w-full d-flex justify-center">
    <div class="grid grid-cols-2 gap-8 p-4">
        <div class="flex flex-col gap-2">
            <h2 class="text-sm text-center text-gray-500">Paquets</h2>
            <label class="input">
                <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g
                        stroke-linejoin="round"
                        stroke-linecap="round"
                        stroke-width="2.5"
                        fill="none"
                        stroke="currentColor">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.3-4.3"></path>
                    </g>
                </svg>
                <input placeholder="Rechercher un Paquets" id="inputSearchPaquet" type="text" />
            </label>
            <div class="flex justify-end gap-2 mt-auto">
                <button onclick="my_modal_1.showModal()" class="btn btn-primary w-full">Ajouter</button>
            </div>
            <ul id="listePaquets" class="w-full menu menu-compact border border-base-300 rounded-lg p-0">
                <?php
                foreach ($paquets as $paquet) { ?>

                    <li>
                        <a onclick="openEditModal(<?= $paquet['id'] ?>)" class="cursor-pointer">
                            <div class="badge badge-primary"><?= $paquet['id'] ?></div> <?= $paquet['numeroPostal'] ?>
                            <?= $paquet['statutLivraison'] == "en_attente" ? "<div class='badge badge-error'>Pas livré</div>" : ($paquet['statutLivraison'] == "en_cours" ? "<div class='badge badge-warning'>En cours</div>" : "<div class='badge badge-success'>Livré</div>") ?>
                        </a>
                    </li>

                <?php
                } ?>
            </ul>
        </div>

        <div class="flex flex-col gap-2">
            <h2 class="text-sm text-center text-gray-500">Livreurs</h2>
            <label class="input">
                <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g
                        stroke-linejoin="round"
                        stroke-linecap="round"
                        stroke-width="2.5"
                        fill="none"
                        stroke="currentColor">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.3-4.3"></path>
                    </g>
                </svg>
                <input placeholder="Rechercher un livreur" id="inputSearchLivreur" type="text" />
            </label>
            <ul id="listeLivreurs" class="w-full menu menu-compact border border-base-300 rounded-lg p-0">
                <?php
                foreach ($livreurs as $livreur) { ?>
                    <li>
                        <a onclick="openLivreurModal(<?= $livreur['id'] ?>)" class="cursor-pointer">
                            <?= $livreur['prenom'] ?> <?= $livreur['nom'] ?>
                        </a>
                    </li>


                <?php
                } ?>
            </ul>
        </div>

    </div>
</div>
<dialog id="my_modal_1" class="modal" <?= $_SERVER["REQUEST_METHOD"] == "POST" ? "open" : "" ?>>
    <div class="modal-box">
        <h3 class="text-lg font-bold">Ajouter un packet</h3>
        <form class="fieldset" action="/paquet/add" method="POST">
            <label class="label">Code Postal</label>
            <input type="text" placeholder="1223" id="numeroPostal" name="numeroPostal" class="input  w-full" />

            <label class="label">Nom</label>
            <input type="text" placeholder="Nathan" name="nomDestinataire" class="input  w-full" />

            <label class="label">Prénom</label>
            <input type="text" placeholder="Pache" name="prenomDestinataire" class="input  w-full" />

            <label class="label">Adresse</label>
            <input type="text" placeholder="Pache" id="adresseDestinataire" name="adresseDestinataire" class="input  w-full" />
            <p class="text-red-500" id="errorAdresse"></p>


            <label class="label">Coordonnee</label>
            <div class="flex gap-2">
                <input type="text" placeholder="longitude" name="longitudeAdresse" id="longitudeAdresse" class="input w-30" readonly />
                <input type="text" placeholder="latitude" name="latitudeAdresse" id="latitudeAdresse" class="input w-30" readonly />
            </div>

            <button type="button" id="btnConvert" class="btn btn-primary">Convetir d'adresse</button>

            <label class="label">Date de livraison</label>
            <input type="date" placeholder="Pache" id="dateLivraison" name="dateLivraison" class="input  w-full" />

            <label class="label">Livreurs</label>
            <select class="select select-bordered w-full" name="idLivreur">
                <?php foreach ($livreurs as $livreur) : ?>
                    <option class="w-full" value="<?= $livreur['id'] ?>"><?= $livreur['prenom'] ?> <?= $livreur['nom'] ?></option>
                <?php endforeach; ?>
            </select>



            <?php if (!empty($errors)) : ?>
                <ul style="color:red;">
                    <?php foreach ($errors as $error) : ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php $error = [] ?>

            <button class="btn btn-neutral mt-4" type="submit">Ajouter</button>

        </form>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Fermer</button>
            </form>
        </div>
    </div>
</dialog>

<dialog id="my_modal_2" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">Modifier un paquet</h3>
        <form id="formEdit" action="/paquet/edit/0" method="POST">
            <input type="hidden" name="id" id="editId" />

            <label class="label">Code Postal</label>
            <input type="text" name="numeroPostal" id="editNumeroPostal" class="input w-full" />

            <label class="label">Nom</label>
            <input type="text" name="nomDestinataire" id="editNom" class="input w-full" />

            <label class="label">Prénom</label>
            <input type="text" name="prenomDestinataire" id="editPrenom" class="input w-full" />

            <label class="label">Adresse</label>
            <input type="text" id="editAdresseDestinataire" name="adresseDestinataire" class="input w-full" />
            <p class="text-red-500" id="editErrorAdresse"></p>
                         
            <label class="label">Coordonnée</label>
            <div class="flex gap-2">
                <input type="text" placeholder="longitude" name="longitudeAdresse" id="editLongitudeAdresse" class="input w-30" readonly />
                <input type="text" placeholder="latitude" name="latitudeAdresse" id="editLatitudeAdresse" class="input w-30" readonly />
            </div>
            <button type="button" id="btnConvertEdit" class="btn btn-primary mt-2">Convertir l'adresse</button>
            <br>   
            <label class="label">Date de livraison</label>
            <input type="date" name="dateLivraison" id="editDate" class="input w-full" />

            <label class="label">Livreurs</label>
            <select class="select select-bordered w-full" name="idLivreur">
                <?php foreach ($livreurs as $livreur) : ?>
                    <option value="<?= $livreur['id'] ?>"><?= $livreur['prenom'] ?> <?= $livreur['nom'] ?></option>
                <?php endforeach; ?>
            </select>

            <button class="w-full btn btn-neutral mt-4" type="submit">Modifier</button>
        </form>
        <form id="formDelete" action="/paquet/delete/0" method="POST">
            <button type="submit" class="w-full btn btn-error mt-2">Supprimer</button>
        </form>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Fermer</button>
            </form>
        </div>
    </div>
</dialog>

<!-- Modal livreur-->
<dialog id="my_modal_3" class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold text-center" id="nomLivreur"></h3>
        <p class="text-gray-400 text-sm text-center mb-4" id="prenomLivreur"></p>

        <label class="label">Journée de livraison</label>
        <input type="date" id="inputDateLivreur" class="input input-bordered w-full mb-4" />

        <h4 class="text-sm text-gray-500 mb-2">Paquets a livre</h4>
        <ul id="listePaquetsLivreur" class="w-full menu menu-compact border border-base-300 rounded-lg p-0">
            <li class="text-gray-400 text-sm p-2 text-center" id="emptyMessage">Sélectionnez une date</li>

        </ul>

        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Fermer</button>
            </form>
        </div>
    </div>
</dialog>

<script>
    const paquets = <?= json_encode($paquets) ?>;
    const livreurs = <?= json_encode($livreurs) ?>;

    //Modal edit
    function openEditModal(id) {
        const paquet = paquets.find(p => p.id == id);

        document.getElementById("editId").value = paquet.id;
        document.getElementById("editNom").value = paquet.nomDestinataire;
        document.getElementById("editPrenom").value = paquet.prenomDestinataire;
        document.getElementById("editNumeroPostal").value = paquet.numeroPostal;
        document.getElementById("editAdresseDestinataire").value = paquet.adresseDestinataire;
        document.getElementById("editLatitudeAdresse").value = paquet.latitudeAdresse ?? "";
        document.getElementById("editLongitudeAdresse").value = paquet.longitudeAdresse ?? "";
        document.getElementById("editDate").value = paquet.dateLivraison;

        document.getElementById("formEdit").action = `/paquet/edit/${paquet.id}`;
        document.getElementById("formDelete").action = `/paquet/delete/${paquet.id}`;

        my_modal_2.showModal();
    }

    function openLivreurModal(id) {
        const livreur = livreurs.find(p => p.id == id);

        document.getElementById("nomLivreur").innerText = livreur.prenom + " " + livreur.nom;

        afficherPaquetsLivreur(id, document.getElementById("inputDateLivreur").value);

        document.getElementById("inputDateLivreur").onchange = function() {
            afficherPaquetsLivreur(id, this.value);
        };

        my_modal_3.showModal();
    }

    function afficherPaquetsLivreur(idLivreur, date) {
        const filtered = paquets.filter(p => p.employe_livreur_id == idLivreur && p.dateLivraison == date);
        const liste = document.getElementById("listePaquetsLivreur");

        liste.innerHTML = "";

        if (filtered.length === 0) 
        {
            liste.innerHTML = '<li class="text-gray-400 text-sm p-2 text-center">Aucun colis ce jour</li>';
            return;
        }

        filtered.forEach(p => {
            liste.innerHTML += `
            <li>
                <a>
                    <div class="badge badge-primary">${p.id}</div>
                    ${p.numeroPostal} - ${p.prenomDestinataire} ${p.nomDestinataire}
                    <span class="text-xs ml-auto">${p.statutLivraison}</span>
                </a>
            </li>
        `;
        });
    }

    document.getElementById("btnConvertEdit").addEventListener("click", async () => {
        const adresse = document.getElementById("editAdresseDestinataire").value;
        const errorAdresse = document.getElementById("editErrorAdresse");
        const numeroPostal = document.getElementById("editNumeroPostal");

        errorAdresse.innerText = "";

        if (adresse == "") {
            errorAdresse.innerText = "Erreur : adresse invalide";
        } else {
            try {
                const response = await fetchCoordonee(adresse, numeroPostal.value ?? " ");
                if (response.features && response.features.length > 0) {
                    document.getElementById("editLongitudeAdresse").value = response.features[0].geometry.coordinates[0];
                    document.getElementById("editLatitudeAdresse").value = response.features[0].geometry.coordinates[1];
                } else {
                    errorAdresse.innerText = "Erreur : adresse invalide";
                }
            } catch (error) {
                errorAdresse.innerText = "Erreur de l'api, veuillez réessayer plus tard";
            }
        }
    });

    // -- rechercher un packet --
    const inputSearchPaquet = document.getElementById("inputSearchPaquet");
    const listePaquets = document.getElementById("listePaquets");

    inputSearchPaquet.addEventListener("input", () => {
        const search = inputSearchPaquet.value.toLowerCase();

        listePaquets.querySelectorAll("li").forEach(li => {
            li.style.display = li.innerText.toLowerCase().includes(search) ? "" : "none";
        });
    });

    // -- rechercher un livreur --
    const inputSearchLivreur = document.getElementById("inputSearchLivreur");
    const listeLivreurs = document.getElementById("listeLivreurs");

    inputSearchLivreur.addEventListener("input", () => {
        const search = inputSearchLivreur.value.toLowerCase();

        listeLivreurs.querySelectorAll("li").forEach(li => {
            li.style.display = li.innerText.toLowerCase().includes(search) ? "" : "none";
        });
    });

    // --------

    const btnConvert = document.getElementById("btnConvert");
    const adresseDestinataire = document.getElementById("adresseDestinataire");
    const numeroPostal = document.getElementById("numeroPostal");
    const errorAdresse = document.getElementById("errorAdresse");
    const latitudeAdresse = document.getElementById("latitudeAdresse");
    const longitudeAdresse = document.getElementById("longitudeAdresse");

    btnConvert.addEventListener("click", async () => {

        errorAdresse.innerText = "";
        latitudeAdresse.value = "";
        longitudeAdresse.value = "";

        if (adresseDestinataire.value == "") {
            errorAdresse.innerText = "Erreur : adress invalide";
        } else {
            try {
                const response = await fetchCoordonee(adresseDestinataire.value, numeroPostal.value ?? "");

                if (response.features && response.features.length > 0) {
                    let lon = response.features[0].geometry.coordinates[0];
                    let lat = response.features[0].geometry.coordinates[1];

                    latitudeAdresse.value = lat;
                    longitudeAdresse.value = lon;
                } else {
                    errorAdresse.innerText = "Erreur : adresse invalide";
                }
            } catch (error) {
                errorAdresse.innerText = "Erreur de l'api, Veuillez ressayer plus tard";
            }

        }
    })

    async function fetchCoordonee(adresse, codePostal) {
        const response = await fetch("https://photon.komoot.io/api/?q=" + adresse + " " + codePostal);

        const result = await response.json();

        return result;

    }
</script>