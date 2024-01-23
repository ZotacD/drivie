<!DOCTYPE html>
<html lang="fr">

<head>
    <base href="<?php echo PROJECT_PATH ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/header.css" />
    <link rel="stylesheet" href="src/css/createProduct.css">
    <title>Créer un produit</title>
</head>

<body>
    <?php require_once "view/header.php"; ?>

    <div class="main">

        <div class="product-form">

            <form method="post" action='<?php echo PROJECT_PATH ?>product/create' enctype="multipart/form-data">
                <div class="photo">
                    <img src="src/svg/AddPicture.svg" alt="Ajouter une photo">
                    <input type="file" name="image_prod" placeholder="Sélectionner une image">
                </div>
                <div>
                    <label for="nom_prod">Nom</label>
                    <input name="nom_prod" type="text" id="nom_prod" placeholder="Ex : Tomates..." required>
                </div>

                <div>
                    <label for="description_prod">Description</label>
                    <textarea name="description_prod" id="description_prod"
                        placeholder="Ex : Ce produit a poussé dans une terre régulièrement ..."></textarea>
                </div>

                <div>
                    <label for="pu_prod">Prix unitaire</label>
                    <input name="pu_prod" type="text" id="pu_prod" placeholder="Ex : 2,50" required>
                </div>

                <div class="bio_group">
                    <label for="est_bio">Bio</label>
                    <input name="est_bio" type="checkbox" id="est_bio" value="off">
                </div>
                <div>
                    <label for="cat_prod">Catégorie</label>
                    <input name="nom_categorie" list="categories" id="nom_categorie" required>
                    <datalist id="categories">
                        <?php foreach ($productsCategory as $categorie) { ?>
                            <option value="<?php echo $categorie['nom_categorie']; ?>">
                            <?php } ?>
                    </datalist>
                </div>

                <div>
                    <label for="uni_prod">Unité</label>
                    <input name="nom_unite" list="unites" id="nom_unite" required>
                    <datalist id="unites">
                        <?php foreach ($productsUnite as $unite) { ?>
                            <option value="<?php echo $unite['nom_unite']; ?>">
                            <?php } ?>
                    </datalist>
                </div>
                <button type="submit">Enregistrer</button>
            </form>
        </div>

        <div class="photo">
            <button id="closeButton">
                <img src="src/img/croix.png" alt="Fermer">
                <p>Fermer</p>
            </button>
        </div>
    </div>
</body>

</html>