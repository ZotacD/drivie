<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Dashboard</title>
    <base href="<?php echo PROJECT_PATH ?>">
    <meta charset="utf-8">
    <link rel="stylesheet" href="src/css/header.css" />
    <link rel="stylesheet" href="src/css/popup.css" />
    <link rel="stylesheet" href="src/css/dashboard.css" />
</head>

<body>
    <?php include "view/header.php" ?>
    <div class="main">
        <div id="infoCardSectionGroup">

            <div id="infoCardSectionHeader">
                <label class="title">Commandes</label>
                <a href="productor/orders">Voir plus</a>
            </div>

            <div id="infoCardSection">
                <div class="infoCard">
                    <label class="content">TOTAL Ventes</label>
                    <label class="title">
                        <?php echo $user["total_ventes"] ? $user["total_ventes"] : 0 ?>€
                    </label>
                </div>

                <div class="infoCard">
                    <label class="content">Commandes en préparation</label>
                    <label class="title">
                        <?php echo $user["nb_commandes_preparation"] ?>
                    </label>
                </div>

                <div class="infoCard">
                    <label class="content">Commandes en attentes</label>
                    <label class="title">
                        <?php echo $user["nb_commandes_attente"] ?>
                    </label>
                </div>

                <div class="infoCard">
                    <label class="content">Commandes terminées</label>
                    <label class="title">
                        <?php echo $user["nb_commandes_terminees"] ?>
                    </label>
                </div>
            </div>
        </div>

        <div id="infoCardSectionGroup">
            <div id="infoCardSectionHeader">
                <label class="title">Produits</label>
                <a onclick="location.hash = '#produits';">Voir plus</a>
            </div>
            <div id="infoCardSection">
                <form class="infoCard" method="post">
                    <button name="popup" value="product" type="submit">
                        <label class=" content">Créer un</label>
                        <label class="title">PRODUIT</label>
                    </button>
                    <input type="hidden" name="popupEndpoint" value="create" />
                </form>
                <div id="sepBarV"></div>
                <div class="infoCard">
                    <label class="content">Produits</label>
                    <label class="title">
                        <?php echo $user["nb_produits"] ?>
                    </label>
                </div>

                <div class="infoCard">
                    <label class="content">Produits en rupture de stock</label>
                    <label class="title">
                        <?php echo $nbProduitsRupture ? $nbProduitsRupture : 0 ?>
                    </label>
                </div>
            </div>
        </div>

        <div id="sepBarH"></div>

        <?php foreach ($products as $product) { ?>
            <div class="product">
                <form method="post" class="productHeader">
                    <label class="title">
                        <span style="text-transform:uppercase;">
                            <?php echo $product["nom_prod"] ?>
                        </span>
                        -
                        <span>
                            <?php echo isset($product["qt_stock"]) ? $product["qt_stock"] : 0 ?> disponible
                        </span>
                    </label>
                    <div class="productButtons">
                        <form method="post">
                            <input type="hidden" name="popupEndpoint" value="get" />
                            <input type="hidden" name="id_prod" value="<?php echo $product["id_prod"] ?>" />
                            <button class="textButton" type="submit" name="popup" value="product">Voir</button>
                        </form>
                        <div id="sepBarV"></div>
                        <form method="post">
                            <input type="hidden" name="popupEndpoint" value="update" />
                            <input type="hidden" name="id_prod" value="<?php echo $product["id_prod"] ?>" />
                            <input type="hidden" name="popup" value="alert">
                            <input type="hidden" name="infoMessage" value="Votre produit a bien été modifié">
                            <button class="textButton" type="submit" name="popup" value="product">Modifier</button>
                        </form>
                        <div id="sepBarV"></div>
                        <form method="post">
                            <input type="hidden" name="popupEndpoint" value="delete" />
                            <input type="hidden" name="id_prod" value="<?php echo $product["id_prod"] ?>" />
                            <button class="textButton" type="submit" name="popup" value="product">Supprimer</button>
                        </form>
                    </div>
                </form>

                <div class="productBody">
                    <div>
                        <table>
                            <tr>
                                <td>ID</td>
                                <td>Nom</td>
                                <td>Unite</td>
                                <td>TOTAL Stock</td>
                                <td></td>
                                <!-- <td></td> -->
                            </tr>
                            <?php foreach (getStocks($product["id_prod"]) as $stock) { ?>
                                <tr>
                                    <td>
                                        <?php echo $stock["id_stock"] ?>
                                    </td>
                                    <td>
                                        <?php echo $stock["nom_stock"] ?>
                                    </td>
                                    <td>
                                        <?php echo $product["nom_unite"] ?>
                                    </td>
                                    <td>
                                        <?php echo $stock["qt_stock"] ?>
                                    </td>
                                    <!-- <td class="viewItem">
                                        <form method="post">
                                            <input type="hidden" name="popupEndpoint" value="update" />
                                            <input type="hidden" name="id_stock" value="  echo $stock["id_stock"] " />
                                            <button class="textButton" name="popup" value="stock"
                                                type="submit">Modifier</button>
                                        </form>
                                    </td> -->
                                    <td class="viewItem">
                                        <form method="post">
                                            <input type="hidden" name="popupEndpoint" value="delete" />
                                            <input type="hidden" name="id_stock" value="<?php echo $stock["id_stock"] ?>" />
                                            <button class="textButton" name="popup" value="stock"
                                                type="submit">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <span id="produits"></span>
                </div>

                <form method="post" class="productFooter">
                    <input type="hidden" name="popupEndpoint" value="create" />
                    <input type="hidden" name="id_prod" value="<?php echo $product["id_prod"] ?>" />
                    <button name="popup" value="stock" type="submit">Ajouter un stock</button>
                </form>
            </div>
        <?php } ?>
    </div>
</body>

</html>