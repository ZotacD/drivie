<!DOCTYPE html>
<html lang="fr">

<head>
    <base href="<?php echo PROJECT_PATH ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/header.css" />
    <link rel="stylesheet" href="src/css/account.css" />
    <title>Document</title>
</head>

<body>
    <?php require_once "view/header.php"; ?>

    <div class="main">

        <div class="profilePic">
            <form method="post" enctype="multipart/form-data">
                <h2>Photo de profil</h2>
                <div class="popupFile">
                    <img src="<?php echo $user["url_image_util"] ?>" class="popupImg" id="imagePreview"
                        accept="image/*" />
                    <input type="file" id="imageInput" name="image_util" />
                </div>
                <button name="action" value="change_img" type="submit" class="green">Valider les modifications</button>
            </form>
        </div>

        <div class="personnal_info">
            <h2>Informations personnelles</h2>
            <form method="post">
                <span class="lineForm">
                    <div class="formElement">
                        <label for="prenomUser">Prénom</label>
                        <input type="text" name="prenom_util" id="prenomUser" value="<?php echo $user["prenom_util"] ?>"
                            required>
                    </div>
                    <div class="formElement">
                        <label for="nomUser">Nom</label>
                        <input type="text" name="nom_util" id="nomUser" value="<?php echo $user["nom_util"] ?>"
                            required>
                    </div>
                </span>
                <div class="formElement">
                    <label for="pseudoUser">Pseudonyme</label>
                    <input type="text" name="pseudo_util" id="pseudoUser" value="<?php echo $user["pseudo_util"] ?>"
                        readonly required>
                </div>
                <div class="formElement">
                    <label for="adresseUser">Adresse</label>
                    <input type="text" name="adresse_util" id="adresseUser" value="<?php echo $user["adresse_util"] ?>"
                        required>
                </div>
                <span class="lineForm">
                    <div class="formElement">
                        <label for="cpUser">Code Postal</label>
                        <input type="text" name="cp_util" id="cpUser" value="<?php echo $user["cp_util"] ?>"
                            pattern="[0-9]{5}" required>
                    </div>
                    <div class="formElement">
                        <label for="villeUser">Ville</label>
                        <input type="text" name="ville_util" id="villeUser" value="<?php echo $user["ville_util"] ?>"
                            required>
                    </div>
                </span>
                <div class="formElement">
                    <label for="mailUser">Adresse Mail</label>
                    <input type="text" name="mail_util" id="mailUser" value="<?php echo $user["mail_util"] ?> " readonly
                        required>
                </div>
                <div class="formElement">
                    <label for="phoneUser">Numéro de téléphone</label>
                    <input type="tel" name="tel_util" id="phoneUser" value="<?php echo $user["tel_util"] ?>"
                        pattern="[0-9]{10}" required>
                </div>
                <?php if ($user["id_type"] == ID_TYPE_PRODUCTEUR) { ?>
                    <div class="formElement">
                        <label for="siretUser">SIRET</label>
                        <input type="text" name="num_siret" id="siretUser" value="<?php echo $user["num_siret"] ?>"
                            pattern="[0-9]{14}" required>
                    </div>
                    <div class="formElement">
                        <label for="descriptionUser">Description</label>
                        <textarea name="description_util" id="descriptionUser"
                            style="resize: vertical;"><?php echo $user["description_util"] ?></textarea>
                    </div>
                <?php } ?>
                <input type="hidden" name="id_util" id="idUtil" value="<?php echo $user["id_util"] ?>">
                <button type="submit" class="green">Valider les modifications</button>
            </form>
        </div>

        <div class="rightPart">
            <div class="connexion_info">
                <h2>Informations de connexion</h2>
                <form method="post" id="buttonForm">
                    <button type="submit" class="green" name="action" value="password">Modifier mon mot de passe</button>
                    <button type="submit" class="red" name="action" value="logout">Me déconnecter</button>
                </form>
            </div>
            <div class="myOrders">
                <form method="post">
                    <button type="submit" name="action" id="myOrders" value="myOrders">Mes Commandes</button>
                </form>
            </div>
            <?php if ($_SESSION["id_type"] == ID_TYPE_PRODUCTEUR) { ?>
                <div class="manageMyProducts">
                    <form method="post">
                        <button type="submit" name="action" id="manageMyProducts" value="manageMyProducts">Gérer mes
                            produits</button>
                    </form>
                </div>
            <?php } ?>

        </div>
    </div>

    <script>
        async function handleFileInput() {
            const input = document.getElementById('imageInput');
            const previewImage = document.getElementById('imagePreview');

            const file = input.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                };

                reader.readAsDataURL(file);
            }
        }

        const imageInput = document.getElementById('imageInput');
        imageInput.addEventListener('change', handleFileInput);
    </script>

</body>

</html>