<!DOCTYPE html>
<html lang="fr">

<head>
    <base href="<?php echo PROJECT_PATH ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/header.css" />
    <link rel="stylesheet" href="src/css/cart.css" />
    <link rel="stylesheet" href="src/css/popup.css" />
    <title>Document</title>
</head>

<body>
    <?php require_once "view/header.php"; ?>

    <div class="main">
        <?php if (!$isEmptyCart) { ?>
            <div class="products_col">
                <div class="products_header">
                    <div class="title">MON PANIER</div>
                    <div class="content">Les articles seront
                        réservés pendant 60 minutes</div>
                </div>

                <?php foreach ($articles as $article) { ?>
                    <div class="product">
                        <div class="start">
                            <img class="img" src="<?php echo $article["url_image_prod"] ?>" alt="image produit" />
                        </div>
                        <div class="middle">
                            <div class="title">
                                <?php echo $article["nom_prod"] ?>
                            </div>
                            <div class="content">
                                <?php echo $article["pseudo_producteur"] ?>
                            </div>
                        </div>
                        <div class="end">
                            <form method="post" action="<?php echo PROJECT_PATH ?>cart">
                                <button type="submit">
                                    <img class="cross" src="src/img/croix.png" alt="fermer" />
                                </button>
                                <input type="hidden" name="id_prod" value="<?php echo $article['id_prod'] ?>" />
                                <input type="hidden" name="action" value="<?php echo DELETE_CART_PRODUCT_ACTION ?>" />
                            </form>
                            <div class="price">
                                <?php echo $article["pu_prod"] * $article["qt_prod"] ?>€
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
            <div class="total_col">
                <div class="total_header">
                    <div class="title">Total</div>
                </div>
                <div class="total">
                    <div class="infos">
                        <div class="title">Sous-total</div>
                        <div class="content">
                            <?php echo $total ?>€
                        </div>
                    </div>
                    <div class="infos">
                        <div class="title">Livraison</div>
                        <img class="img" src="src/svg/information.svg" alt="informations de livraison" />
                    </div>
                    <form method="post" action="<?php echo PROJECT_PATH ?>cart">
                        <button type="submit" class="rounded_green_button">
                            <div class="content">Commander</div>
                        </button>
                        <input type="hidden" name="popup" value="alert">
                        <input type="hidden" name="infoMessage" value="Votre panier a bien été commandé">
                        <input type="hidden" name="action" value="<?php echo BUY_CART_ACTION ?>" />
                    </form>
                </div>
            </div>
        <?php } ?>
        <?php if ($isEmptyCart) { ?>
            <div class="empty_cart_col">
                <img class="img" src="src/img/panier.png" alt="panier" />
                <div class="title">Votre panier est actuellement
                    vide.</div>
                <div id="green_sep_bar"></div>
                <div class="content">Vos articles restent dans votre panier pendant
                    60 minutes, puis sont déplacés dans vos articles
                    sauvegardés.</div>
                <div id="green_sep_bar"></div>
                <div class="content">Connectez-vous pour consulter votre
                    panier et commencez vos achats !</div>
                <a class="rounded_green_button"
                    href="<?php echo PROJECT_PATH ?>search?type=<?php echo SEARCH_TYPE_PRODUCTS ?>">
                    <div class="content">Commander</div>
                </a>
            </div>
        <?php } ?>
    </div>
</body>

</html>