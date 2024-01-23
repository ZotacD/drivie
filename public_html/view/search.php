<!DOCTYPE html>
<html lang="fr">

<head>
    <base href="<?php echo PROJECT_PATH ?>">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/header.css" />
    <link rel="stylesheet" href="src/css/popup.css" />
    <link rel="stylesheet" href="src/css/search.css" />
    <title>Document</title>
</head>

<body>
    <?php require_once "view/header.php"; ?>

    <div class="main">
        <div class="filter">
            <?php if ($search_type === SEARCH_TYPE_PRODUCTS) { ?>
                <form method="get" action="<?php echo PROJECT_PATH ?>search">
                    <button class="item" type="submit">
                        <img src="src/svg/productor.svg" alt="selection producteur">
                        Producteurs
                    </button>
                    <input type="hidden" name="type" value="<?php echo SEARCH_TYPE_PRODUCTORS ?>" />
                </form>
                <div class="item selected">
                    <img src="src/svg/produit.svg" alt="selection produit">
                    Produits
                </div>
            <?php } ?>

            <?php if ($search_type === SEARCH_TYPE_PRODUCTORS) { ?>
                <div class="item selected">
                    <img src="src/svg/productor.svg" alt="selection producteur">
                    Producteurs
                </div>
                <form method="get" action="<?php echo PROJECT_PATH ?>search">
                    <button class="item" type="submit">
                        <img src="src/svg/produit.svg" alt="selection produit">
                        Produits
                    </button>
                    <input type="hidden" name="type" value="<?php echo SEARCH_TYPE_PRODUCTS ?>" />
                </form>
            <?php } ?>
        </div>
        <div class="products">
            <?php if ($search_type === SEARCH_TYPE_PRODUCTS) { ?>
                <?php foreach ($result as $product) { ?>
                    <form class="article" method="post">
                        <img class=" image" src="<?php echo $product['url_image_prod']; ?>" alt="image produit" />
                        <button name="popup" value="product" type="submit" class="text">
                            <div class="product_name">
                                <?php echo $product['nom_prod']; ?>
                            </div>
                            <div class="productor_name">
                                <?php echo $product['pseudo_util']; ?>
                            </div>
                            <div class="prix">
                                <label id="prixUnit">
                                    <?php echo $product['pu_prod']; ?>
                                </label>
                                <label id="rapport">€ /</label>
                                <label id="unite">
                                    <?php echo $product['nom_unite']; ?>
                                </label>
                            </div>
                        </button>
                        <input type="hidden" name="popupEndpoint" value="get" />
                        <input type="hidden" name="id_prod" value="<?php echo $product["id_prod"] ?>" />
                    </form>
                <?php } ?>
            <?php } ?>

            <?php if ($search_type === SEARCH_TYPE_PRODUCTORS) { ?>
                <?php foreach ($result as $producteur) { ?>
                    <div class="producteur">
                        <form method="post">
                            <button name="popup" value="productor" type="submit">
                                <div class="text">
                                    <div class="nom_producteur">
                                        <?php echo $producteur['prenom_util'] . ' ' . $producteur['nom_util']; ?>
                                    </div>
                                    <div class="adresse">
                                        <?php echo $producteur['adresse_util'] . ' ' . $producteur['ville_util']; ?>
                                    </div>
                                    <div class="nb_ventes">
                                        <?php echo getNbSales($producteur['id_util']) . " vente(s)"; ?>
                                    </div>
                                </div>
                                <img class="image_producteur" src="<?php echo $producteur['url_image_util']; ?>"
                                    alt="image producteur" />
                            </button>
                            <input type="hidden" name="popupEndpoint" value="get" />
                            <input type="hidden" name="id_util" value="<?php echo $producteur["id_util"] ?>" />
                        </form>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>

</body>

</html>