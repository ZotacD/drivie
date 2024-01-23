<!DOCTYPE html>
<html lang="fr">

<head>
    <base href="<?php echo PROJECT_PATH ?>">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/header.css" />
    <link rel="stylesheet" href="src/css/productorOrders.css" />
    <title>Mes commandes</title>
</head>

<body>
    <?php include_once "view/header.php"; ?>

    <div class="main">
        <a class="back" href="productor/dashboard">
            <img src="src/svg/back.svg" alt="<">
        </a>

        <div class="left">
            <div class="topLeft">Commandes en attente de préparation</div>
            <div class="leftContent">
                <div class="barLeftPart"></div>
                <div class="container">
                    <?php foreach ($orders_not_prepared as $order) { ?>
                        <div class="commandesPrep">
                            <div class="titreCommande">
                                <div id="nbCommande">
                                    Commande n°
                                    <?php echo $order['id_commande'] ?>
                                    --
                                    <?php echo $order['pseudo_util']; ?>
                                </div>
                                <div id="dateCommande">
                                    <?php echo $order['date_commande'] ?>
                                </div>
                            </div>
                            <div class="commande">
                                <div class="listArticles">
                                    <?php foreach (getArticles($order['id_commande']) as $article) { ?>
                                        <div class="fiche">
                                            <img src="<?php echo $article['url_image_prod']; ?>" alt="image produit">
                                            <div id="nom_produit">
                                                <?php echo $article['nom_prod']; ?>
                                            </div>
                                            <div id="qte">
                                                <?php echo $article['qt_prod']; ?>
                                                <?php echo $article['nom_unite']; ?>
                                            </div>
                                            <div id="prixTotProd">
                                                <?php echo ($article['qt_prod'] * $article['pu_prod']); ?>
                                                €
                                            </div>
                                            <?php $totalPrice += ($article['qt_prod'] * $article['pu_prod']); ?>
                                        </div>
                                    <?php } ?>
                                    <div class="sep"></div>
                                    <div class="prixTotalCommande">
                                        Total :
                                        <?php echo $totalPrice; ?>
                                        €
                                    </div>
                                </div>

                                <!-- <div class="bouttons"> -->
                                <form method="GET" class="bouttons">
                                    <input type="hidden" name="id_commande" value="<?php echo $order['id_commande']; ?>" />
                                    <button type="submit" value="accepter" name="action" id="accepterCommande">
                                        <img src="src/svg/valid.svg" alt="accepter la commande" />
                                    </button>
                                    <button type="submit" value="refuser" name="action" id="refuserCommande">
                                        <img src="src/svg/croix.svg" alt="refuser la commande">
                                    </button>
                                </form>
                                <!-- </div> -->
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="right">
            <div class="topRight">Commandes en attente de récupération</div>
            <div class="rightContent">
                <div class="barRightPart"></div>
                <div class="container">
                    <?php foreach ($orders_not_collected as $order) { ?>
                        <div class="commandesRecup">
                            <div class="titreCommande">
                                <div id="nbCommande">
                                    Commande n°
                                    <?php echo $order['id_commande'] ?>
                                    --
                                    <?php echo $order['pseudo_util']; ?>
                                </div>
                                <div id="dateCommande">
                                    <?php echo $order['date_commande'] ?>
                                </div>
                            </div>
                            <div class="commande">
                                <div class="recap">
                                    <?php $articles = getArticles($order['id_commande']);
                                    $prixTotal = 0;
                                    $nbArticles = 0; ?>
                                    <?php foreach ($articles as $article) {
                                        $prixTotal += ($article['qt_prod'] * $article['pu_prod']);
                                        $nbArticles++;
                                    } ?>
                                    <div class="commandeRecap">
                                        <img src="src/svg/symboleCommande.svg" alt="image produit">
                                        <div id="nom_produit">
                                            <?php echo $nbArticles; ?>
                                            articles
                                        </div>
                                    </div>
                                    <div class="sep"></div>
                                    <div class="prixTotalCommande">
                                        Total :
                                        <?php echo $prixTotal; ?>
                                        €
                                    </div>
                                </div>

                                <!-- <div class="bouttons"> -->
                                <form class="bouttons" method="get">
                                    <input type="hidden" name="id_commande" value="<?php echo $order["id_commande"]; ?>" />
                                    <button type="submit" name="action" value="valider" id="accepterCommande">
                                        <img src="src/svg/valid.svg" alt="accepter la commande" />
                                    </button>
                                    <button type="submit" id="refuserCommande" name="action" value="refuser">
                                        <img src="src/svg/croix.svg" alt="refuser la commande">
                                    </button>
                                </form>
                                <!-- </div> -->
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>