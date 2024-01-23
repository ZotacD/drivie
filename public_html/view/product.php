<!DOCTYPE html>
<html lang="fr">

<head>
    <base href="<?php echo PROJECT_PATH ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/header.css" />

    <link rel="stylesheet" href="src/css/product.css" />
    <title>Document</title>
</head>

<body>

    <?php require_once "view/header.php"; ?>

    <div class="main">

        <div class="back">
            <button class="backButton">
                <img src="src/svg/back.svg" alt="retour">
            </button>
        </div>
        <div class="info">
            <div class="article">
                <img class="image" src="<?php echo $product["url_image_prod"] ?>" alt="image produit" />
                <div class="text">
                    <div class="product_name">
                        <?php echo $product["nom_prod"] ?>
                    </div>
                    <div class="productor_name">
                        <?php echo $product["pseudo_util"] ?>
                    </div>
                    <div class="prix">
                        <label id="prixUnit">
                            <?php echo $product["pu_prod"] ?>
                        </label>
                        <label id="rapport">€ /</label>
                        <label id="unite">
                            <?php echo $product["nom_unite"] ?>
                        </label>
                    </div>
                </div>
            </div>
            <div class="description">
                <?php echo $product["description_prod"] ?>
            </div>
            <form class="add" method="post" action="">
                <div class="chiffr">
                    <div class="qte">
                        Quantité :
                        <input min="1" name="qt_prod" type="number" value="1" required /><br>
                    </div>
                    <div class="prixTotal">
                        Prix :
                        <label id="qte">
                            <?php echo $product["pu_prod"] ?>€
                        </label>
                    </div>
                </div>
                <button type="submit" class="addToCart">Ajouter au panier</button>
            </form>
        </div>
        <div class="avis">
            <div class="top">Avis (3)</div>
            <div class="reviewContainer">

                <!-- template d'un avis -->

                <!--
                <div class="review">
                    <div class="pp">
                        <img src="./src/img/pp.jpg" alt="pp">
                    </div>
                    <div class="content">
                        <div class="name">
                            clientavistest@gmail.com
                        </div>
                        <div class="stars">
                            <img src="./src/svg/star/pleine.svg" alt="1">
                            <img src="./src/svg/star/pleine.svg" alt="1">
                            <img src="./src/svg/star/pleine.svg" alt="1">
                            <img src="./src/svg/star/pleine.svg" alt="1">
                            <img src="./src/svg/star/vide.svg" alt="0">
                        </div>
                        <div class="text">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae rhoncus sapien.
                            Cras molestie dignissim congue.
                        </div>
                    </div>
                </div>
                -->

                <!-- template sep -->
                <!--
                <div class="sep"></div>
                -->

            </div>
            <div class="bottom"></div>
        </div>

    </div>

</body>

</html>