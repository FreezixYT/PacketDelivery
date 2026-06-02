<div class="mt-20 flex w-full d-flex justify-center">
    <div class="grid grid-cols-2 gap-8 p-4">
        <div class="flex flex-col gap-2">
            <h2 class="text-sm text-center text-gray-500">Paquets</h2>
            <input class="input input-bordered input-sm w-full" type="text" />
            <ul class="w-full menu menu-compact border border-base-300 rounded-lg p-0">
                <?php
                foreach ($paquets as $paquet) { ?>

                    <li>
                        <a onclick="openEditModal(<?= $paquet['id'] ?>)" class="cursor-pointer">
                            <?= $paquet['id'] ?> <span class="text-gray-400 text-xs">(<?= $paquet['statutLivraison'] ?>)</span>
                        </a>
                    </li>

                <?php
                } ?>
            </ul>
            <div class="flex justify-end gap-2 mt-auto">
                <button onclick="my_modal_1.showModal()" class="btn btn-primary w-full">Ajouter</button>
            </div>
        </div>

        <div class="flex flex-col gap-2">
            <h2 class="text-sm text-center text-gray-500">Livreurs</h2>
            <input class="input input-bordered input-sm w-full" type="text" />
            <ul class="w-full menu menu-compact border border-base-300 rounded-lg p-0">
                <?php
                foreach ($livreurs as $livreur) { ?>

                    <li><a><?= $livreur['prenom'] ?> <?= $livreur['nom'] ?></a></li>

                <?php
                } ?>
            </ul>
            <div class="flex justify-end mt-auto">
                <button class="btn btn-circle btn-sm btn-outline"><i class="bi bi-search"></i></button>
            </div>
        </div>

    </div>
</div>
<dialog id="my_modal_1" class="modal" <?= $_SERVER["REQUEST_METHOD"] == "POST" ? "open" : "" ?>>
    <div class="modal-box">
        <h3 class="text-lg font-bold">Ajouter un packet</h3>
        <form class="fieldset" action="/paquet/add" method="POST">
            <label class="label">Code Postal</label>
            <input type="text" placeholder="1223" name="numeroPostal" class="input  w-full" />

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
        <input type="hidden" name="id" id="editId" />

        <label class="label">Nom</label>
        <input type="text" name="nomDestinataire" id="editNom" class="input w-full" />

        <label class="label">Prénom</label>
        <input type="text" name="prenomDestinataire" id="editPrenom" class="input w-full" />

        <label class="label">Adresse</label>
        <input type="text" name="adresseDestinataire" id="editAdresse" class="input w-full" />

        <label class="label">Date de livraison</label>
        <input type="date" name="dateLivraison" id="editDate" class="input w-full" />
        <form action="/paquet/edit/<?= $paquet['id'] ?>" method="POST">
            <button class="w-full btn btn-neutral mt-4" type="submit">Modifier</button>
        </form>
        <form action="/paquet/delete/<?= $paquet['id'] ?>" method="POST">
            <button type="submit" class="w-full btn btn-error">Supprimer</button>
        </form>

        <div class="modal-action">
            <form method="dialog">
                <button class="btn">Fermer</button>
            </form>
        </div>
    </div>
</dialog>

<script>
    //Modal edit
    const paquets = <?= json_encode($paquets) ?>;

    function openEditModal(id) {
        const paquet = paquets.find(p => p.id == id);
        if (!paquet) return;

        document.getElementById("editId").value = paquet.id;
        document.getElementById("editNom").value = paquet.nomDestinataire;
        document.getElementById("editPrenom").value = paquet.prenomDestinataire;
        document.getElementById("editAdresse").value = paquet.adresseDestinataire;
        document.getElementById("editDate").value = paquet.dateLivraison;

        my_modal_2.showModal();
    }
    //--------------

    const btnConvert = document.getElementById("btnConvert");
    const adresseDestinataire = document.getElementById("adresseDestinataire");
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
                const response = await fetchCoordonee(adresseDestinataire.value);

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

    async function fetchCoordonee(adresse) {
        const response = await fetch("https://photon.komoot.io/api/?q=" + adresse);

        const result = await response.json();

        return result;

    }
</script>