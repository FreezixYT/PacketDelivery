<div class="mt-20 flex w-full d-flex justify-center">
    <div class="grid grid-cols-2 gap-8 p-4">
        <div class="flex flex-col gap-2">
            <h2 class="text-sm text-center text-gray-500">Paquets</h2>
            <input class="input input-bordered input-sm w-full" type="text" />
            <ul class="menu menu-compact border border-base-300 rounded-lg p-0">
                <li><a>240006 <span class="text-gray-400 text-xs">(Pas encore livré)</span></a></li>
                <li><a>240001 <span class="text-gray-400 text-xs">(En cours de livraison)</span></a></li>
            </ul>
            <div class="flex justify-end gap-2 mt-auto">
                <button onclick="my_modal_1.showModal()" class="btn btn-circle btn-sm btn-outline"><i class="bi bi-plus-circle"></i></button>
                <button class="btn btn-circle btn-sm btn-outline"><i class="bi bi-pencil-square"></i></button>
            </div>
        </div>

        <div class="flex flex-col gap-2">
            <h2 class="text-sm text-center text-gray-500">Livreurs</h2>
            <input class="input input-bordered input-sm w-full" type="text" />
            <ul class="menu menu-compact border border-base-300 rounded-lg p-0">
                <li><a>Célère Jacques</a></li>
                <li><a>240001 <span class="text-gray-400 text-xs">(En cours de livraison)</span></a></li>
            </ul>
            <div class="flex justify-end mt-auto">
                <button class="btn btn-circle btn-sm btn-outline"><i class="bi bi-search"></i></button>
            </div>
        </div>

    </div>
</div>

<dialog id="my_modal_1" class="modal" <?= $_SERVER["REQUEST_METHOD"] == "POST" ? "open": "" ?>>
    <div class="modal-box">
        <h3 class="text-lg font-bold">Ajouter un packet</h3>
        <form action="/addPaquets" method="post" class="fieldset">
            <label class="label">Code Postal</label>
            <input type="text" placeholder="1223" name="numeroPostal" class="input" />

            <label class="label">Nom</label>
            <input type="text" placeholder="Nathan" name="nomDestinataire" class="input" />

            <label class="label">Prénom</label>
            <input type="text" placeholder="Pache" name="prenomDestinataire" class="input" />

            <label class="label">Adresse</label>
            <input type="text" placeholder="Pache" name="adresseDestinataire" class="input" />

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