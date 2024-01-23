<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Dashboard</title>
    <base href="<?php echo PROJECT_PATH ?>">
    <meta charset="utf-8">
    <link rel="stylesheet" href="src/css/header.css" />
    <link rel="stylesheet" href="src/css/order.css" />
    <link rel="stylesheet" href="src/css/popup.css" />
</head>

<body>
    <?php include "view/header.php" ?>
    <div class="main">
        <div class="product">
            <div class="productHeader">
                <label class="title">Commande(s) en préparation - <?php echo $nbOrdersPreparing["nb_commande"]; ?> Commande(s)</label>
            </div>

            <div class="productBody">
                <div>
                    <table>
                        <tr>
                            <td>Numéro</td>
                            <td>Date</td>
                            <td>Statut Commande</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php foreach($ordersPreparing as $order) { ?>
                        <tr>
                            <td><?php echo $order["id_commande"]; ?></td>
                            <td><?php echo $order["date_commande"]; ?></td>
                            <td><?php echo $order["statut_commande"]; ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="popupEndpoint" value="get" />
                                    <input type="hidden" name="id_util" value="<?php echo $order["id_util"] ?>" />
                                    <button class="textButton" type="submit" name="popup" value="productor">Voir
                                    producteur</button>
                                </form>
                            </td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="popupEndpoint" value="get" />
                                    <input type="hidden" name="id_commande" value="<?php echo $order["id_commande"] ?>" />
                                    <button class="textButton" type="submit" name="popup" value="order">Voir
                                    commande</button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
                <span id="table-anchor"></span>
            </div>
        </div>

        <div class="product">
            <div class="productHeader">
                <label class="title">Commande(s) en attente de récupération - <?php echo $nbOrdersWaiting["nb_commande"]; ?> Commande(s)</label>
            </div>

            <div class="productBody">
                <div>
                    <table>
                        <tr>
                            <td>Numéro</td>
                            <td>Date</td>
                            <td>Statut Commande</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php foreach($ordersWaiting as $order) { ?>
                        <tr>
                            <td><?php echo $order["id_commande"]; ?></td>
                            <td><?php echo $order["date_commande"]; ?></td>
                            <td><?php echo $order["statut_commande"]; ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="popupEndpoint" value="get" />
                                    <input type="hidden" name="id_util" value="<?php echo $order["id_util"] ?>" />
                                    <button class="textButton" type="submit" name="popup" value="productor">Voir
                                    producteur</button>
                                </form>
                            </td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="popupEndpoint" value="get" />
                                    <input type="hidden" name="id_commande" value="<?php echo $order["id_commande"] ?>" />
                                    <button class="textButton" type="submit" name="popup" value="order">Voir
                                    commande</button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
                <span id="table-anchor"></span>
            </div>
        </div>
        
        <div class="product">
            <div class="productHeader">
                <label class="title">Commande(s) terminée(s)  - <?php echo $nbOrdersFinished["nb_commande"]; ?> Commande(s)</label>
            </div>

            <div class="productBody">
                <div>
                    <table>
                        <tr>
                            <td>Numéro</td>
                            <td>Date</td>
                            <td>Statut Commande</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php foreach($ordersFinished as $order) { ?>
                        <tr>
                            <td><?php echo $order["id_commande"]; ?></td>
                            <td><?php echo $order["date_commande"]; ?></td>
                            <td><?php echo $order["statut_commande"]; ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="popupEndpoint" value="get" />
                                    <input type="hidden" name="id_util" value="<?php echo $order["id_util"] ?>" />
                                    <button class="textButton" type="submit" name="popup" value="productor">Voir
                                    producteur</button>
                                </form>
                            </td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="popupEndpoint" value="get" />
                                    <input type="hidden" name="id_commande" value="<?php echo $order["id_commande"] ?>" />
                                    <button class="textButton" type="submit" name="popup" value="order">Voir
                                    commande</button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
                <span id="table-anchor"></span>
            </div>
        </div>

        <div class="product">
            <div class="productHeader">
                <label class="title">Commande(s) refusée(s) - <?php echo $nbOrdersRefused["nb_commande"]; ?> Commande(s)</label>
            </div>

            <div class="productBody">
                <div>
                    <table>
                        <tr>
                            <td>Numéro</td>
                            <td>Date</td>
                            <td>Statut Commande</td>    
                            <td></td>
                            <td></td>
                        </tr>
                        <?php foreach($ordersRefused as $order) { ?>
                        <tr>
                            <td><?php echo $order["id_commande"]; ?></td>
                            <td><?php echo $order["date_commande"]; ?></td>
                            <td><?php echo $order["statut_commande"]; ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="popupEndpoint" value="get" />
                                    <input type="hidden" name="id_util" value="<?php echo $order["id_util"] ?>" />
                                    <button class="textButton" type="submit" name="popup" value="productor">Voir
                                    producteur</button>
                                </form>
                            </td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="popupEndpoint" value="get" />
                                    <input type="hidden" name="id_commande" value="<?php echo $order["id_commande"] ?>" />
                                    <button class="textButton" type="submit" name="popup" value="order">Voir
                                    commande</button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
                <span id="table-anchor"></span>
            </div>
        </div>
    </div>
</body>

</html>