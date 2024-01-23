<!DOCTYPE html>
<html lang="fr">

<head>
    <base href="<?php echo PROJECT_PATH ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/header.css" />
    <link rel="stylesheet" href="src/css/home.css" />
    <link rel="stylesheet" href="src/css/popup.css" />
    <title>Accueil</title>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1b70Jq6RpWG1xDGrPx04yFwdU-UMWyWo&callback=initMap&libraries=&v=weekly"
        async></script>
    <script>
        <?php echo $productorsMapScript; ?>
    </script>

</head>

<body>
    <?php include_once "view/header.php"; ?>

    <div class="main">
        <div class="head_coverImage">
            <h3>Découvrez une nouvelle manière de consommer local et de soutenir nos producteurs.
                Rapprochez vous de la fraîcheur de nos terroirs en un <a href="search?type=1">clic</a> !</h3>
            <img src="src/img/image_fond_fruits-legumes.png" alt="image de fond avec des fruits et légumes">
        </div>

        <div class="promotions">
            <div class="headerProduits">
                <div class="titreH2Title">
                    <h2>Nouveaux articles</h2>
                </div>
                <div class="plus">
                    <a href="search?type=1">Voir plus</a>
                </div>
            </div>

            <div class="promotions_scroll">
                <?php foreach ($products as $product) { ?>
                    <form method="post" class="product">
                        <img src=" <?php echo $product["url_image_prod"] ?> " alt="product">
                        <h5>
                            <?php echo $product["nom_prod"] ?>
                        </h5>
                        <h6>
                            <?php echo $product["pseudo_util"] ?>
                        </h6>
                        <span>
                            <h4>
                                <?php echo $product["pu_prod"] ?>
                                €/
                                <?php echo $product["nom_unite"] ?>
                            </h4>
                        </span>
                        <input type="hidden" name="popupEndpoint" value="get" />
                        <input type="hidden" name="id_prod" value="<?php echo $product["id_prod"] ?>" />
                        <button id="voirprod" name="popup" value="product" type="submit">Voir
                            produit</button>
                    </form>
                <?php } ?>
            </div>

        </div>

        <div class="best_productors">
            <div class="headerProduits">
                <div class="titreH2Title">
                    <h2>Nos meilleurs producteurs</h2>
                </div>
                <div class="plus">
                    <a href="search?type=2">Voir plus</a>
                </div>
            </div>
            <div class="best_productors_scroll">
                <?php foreach ($productors as $productor) { ?>
                    <form method="post" class="productor">
                        <div class="productor_info">
                            <h5>
                                <?php echo $productor["nom_util"] . " " . $productor["prenom_util"] ?>
                            </h5>
                            <h6>
                                <?php echo $productor["pseudo_util"] ?>
                            </h6>
                            <label>
                                <?php echo $productor["nb_commandes_terminees"] + $productor["nb_commandes_preparation"] + $productor["nb_commandes_attente"] ?>
                            </label>
                        </div>
                        <div class="productor_img">
                            <img src=" <?php echo $productor["url_image_util"] ?> " alt="">
                        </div>
                        <input type="hidden" name="popupEndpoint" value="get" />
                        <input type="hidden" name="id_util" value="<?php echo $productor["id_util"] ?>" />
                        <button id="voirprod" name="popup" value="productor" type="submit">Voir
                            Producteur</button>
                    </form>
                <?php } ?>
            </div>
        </div>


        <div id="map"></div>

        <div class="howTo_steps">
            <h3>Faites votre marché en 4 étapes</h3>
            <div class="steps">
                <a href="search?type=1">
                    <div class="step">
                        <img src="src/img/steps/step_1.svg" alt="étape 1">
                        <h4>Sélectionnez vos produits</h4>
                        <h6>1</h6>
                    </div>
                </a>
                <a href="cart">
                    <div class="step">
                        <img src="src/img/steps/step_2.svg" alt="étape 2">
                        <h4>Validez votre commande</h4>
                        <h6>2</h6>
                    </div>
                </a>
                <div class="step">
                    <img src="src/img/steps/step_3.svg" alt="étape 3">
                    <h4>Venez la chercher</h4>
                    <h6>3</h6>
                </div>
                <div class="step">
                    <img src="src/img/steps/step_4.svg" alt="étape 4">
                    <h4>Payez auprès du producteur</h4>
                    <h6>4</h6>
                </div>
            </div>
        </div>
    </div>

</body>

</html>