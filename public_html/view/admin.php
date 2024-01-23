<!DOCTYPE html>
<html lang="fr">

<head>
    <base href="<?php echo PROJECT_PATH ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/header.css" />
    <link rel="stylesheet" href="src/css/admin.css" />
    <title>Document</title>
</head>

<body>
    <?php require_once "view/header.php"; ?>

    <div class="main">
        <div class="filter">
            <a class="item" href="<?php echo PROJECT_PATH ?>admin?type=<?php echo SEARCH_TYPE_PRODUCTORS ?>">
                <img src="src/svg/productor.svg" alt="selection producteur">
                Producteurs
            </a>
            <a class="item" href="<?php echo PROJECT_PATH ?>admin?type=<?php echo SEARCH_TYPE_PRODUCTS ?>">
                <img src="src/svg/produit.svg" alt="selection produit">
                Produits
            </a>
            <a class="item" href="<?php echo PROJECT_PATH ?>admin?type=<?php echo SEARCH_TYPE_CUSTOMERS ?>">
                <img src="src/svg/client.svg" alt="selection produit">
                Clients
            </a>
            <a class="item" href="<?php echo PROJECT_PATH ?>admin?type=<?php echo SEARCH_TYPE_review ?>">
                <img src="src/svg/avis.svg" alt="selection produit">
                Avis
            </a>
        </div>
        <div class="content">
            <div class="bar"></div>
            <?php if ($search_type == SEARCH_TYPE_PRODUCTORS) { ?>
                <table>
                    <tr>
                        <td>ID</td>
                        <td>Prénom</td>
                        <td>Nom</td>
                        <td>EMAIL</td>
                        <td>Téléhpone</td>
                        <td>Adresse</td>
                        <td>SIRET</td>
                        <td></td>
                    </tr>
                    <?php foreach ($result as $productor) { ?>
                        <tr>
                            <td>
                                <?php echo $productor["id_util"] ?>
                            </td>

                            <td>
                                <?php echo $productor["prenom_util"] ?>
                            </td>

                            <td>
                                <?php echo $productor["nom_util"] ?>
                            </td>

                            <td>
                                <?php echo $productor["mail_util"] ?>
                            </td>

                            <td>
                                <?php echo $productor["tel_util"] ?>
                            </td>

                            <td>
                                <?php echo $productor["adresse_util"] . " " . $productor["cp_util"] . " " . $productor["ville_util"] ?>
                            </td>

                            <td>
                                <?php echo $productor["num_siret"] ?>
                            </td>

                            <td>
                                <form method="post" class="buttons"
                                    action="<?php echo PROJECT_PATH ?>admin?type=<?php echo $search_type ?>">
                                    <button type="submit" class="productor_buttons">
                                        <img src="src/svg/admin/bin.svg" alt="profil">
                                    </button>
                                    <input type="hidden" name="id_util" value="<?php echo $productor["id_util"] ?>" />
                                    <input type="hidden" name="action" value="<?php echo DELETE_ADMIN_PRODUCTOR_ACTION ?>" />
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>

            <?php if ($search_type == SEARCH_TYPE_PRODUCTS) { ?>
                <table>
                    <tr>
                        <td>ID</td>
                        <td>ID Producteur</td>
                        <td>Produit</td>
                        <td>Catégorie</td>
                        <td>Prix unitaire</td>
                        <td>Stock</td>
                        <td>Unite</td>
                        <td></td>
                    </tr>
                    <?php foreach ($result as $product) { ?>
                        <tr>
                            <td>
                                <?php echo $product["id_prod"] ?>
                            </td>

                            <td>
                                <?php echo $product["id_util"] ?>
                            </td>

                            <td>
                                <?php echo $product["nom_prod"] ?>
                            </td>

                            <td>
                                <?php echo $product["nom_categorie"] ?>
                            </td>

                            <td>
                                <?php echo $product["pu_prod"] ?>
                            </td>

                            <td>
                                <?php echo $product["qt_stock"] ?>
                            </td>

                            <td>
                                <?php echo $product["nom_unite"] ?>
                            </td>

                            <td>
                                <form method="post" class="buttons"
                                    action="<?php echo PROJECT_PATH ?>admin?type=<?php echo $search_type ?>">
                                    <button type="submit" class="productor_buttons">
                                        <img src="src/svg/admin/bin.svg" alt="profil">
                                    </button>
                                    <input type="hidden" name="id_prod" value="<?php echo $product["id_prod"] ?>" />
                                    <input type="hidden" name="action" value="<?php echo DELETE_ADMIN_PRODUCT_ACTION ?>" />
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>

            <?php if ($search_type == SEARCH_TYPE_CUSTOMERS) { ?>
                <table>
                    <tr>
                        <td>ID</td>
                        <td>Prénom</td>
                        <td>Nom</td>
                        <td>EMAIL</td>
                        <td>Téléhpone</td>
                        <td>Adresse</td>
                        <td>Pseudo</td>
                        <td></td>
                    </tr>
                    <?php foreach ($result as $customer) { ?>
                        <tr>
                            <td>
                                <?php echo $customer["id_util"] ?>
                            </td>

                            <td>
                                <?php echo $customer["prenom_util"] ?>
                            </td>

                            <td>
                                <?php echo $customer["nom_util"] ?>
                            </td>

                            <td>
                                <?php echo $customer["mail_util"] ?>
                            </td>

                            <td>
                                <?php echo $customer["tel_util"] ?>
                            </td>

                            <td>
                                <?php echo $customer["adresse_util"] . " " . $customer["cp_util"] . " " . $customer["ville_util"] ?>
                            </td>

                            <td>
                                <?php echo $customer["pseudo_util"] ?>
                            </td>

                            <td>
                                <form method="post" class="buttons"
                                    action="<?php echo PROJECT_PATH ?>admin?type=<?php echo $search_type ?>">
                                    <button type="submit" class="productor_buttons">
                                        <img src="src/svg/admin/bin.svg" alt="profil">
                                    </button>
                                    <input type="hidden" name="id_util" value="<?php echo $customer["id_util"] ?>" />
                                    <input type="hidden" name="action" value="<?php echo DELETE_ADMIN_CUSTOMER_ACTION ?>" />
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>

            <?php if ($search_type == SEARCH_TYPE_review) { ?>
                <table>
                    <tr>
                        <td>ID</td>
                        <td>Titre</td>
                        <td>Description</td>
                        <td>Note</td>
                        <td>Date</td>
                        <td>Client</td>
                        <td>Producteur</td>
                        <td></td>
                    </tr>
                    <?php foreach ($result as $review) { ?>
                        <tr>
                            <td>
                                <?php echo $review["id_avis"] ?>
                            </td>

                            <td>
                                <?php echo $review["titre_avis"] ?>
                            </td>

                            <td>
                                <?php echo $review["description_avis"] ?>
                            </td>

                            <td>
                                <?php echo $review["note_avis"] ?>
                            </td>

                            <td>
                                <?php echo $review["date_avis"] ?>
                            </td>

                            <td>
                                <?php echo $review["id_util"] ?>
                            </td>

                            <td>
                                <?php echo $review["id_prod"] ?>
                            </td>

                            <td>
                                <form method="post" class="buttons"
                                    action="<?php echo PROJECT_PATH ?>admin?type=<?php echo $search_type ?>">
                                    <button type="submit" class="productor_buttons">
                                        <img src="src/svg/admin/bin.svg" alt="profil">
                                    </button>
                                    <input type="hidden" name="id_avis" value="<?php echo $review["id_avis"] ?>" />
                                    <input type="hidden" name="action" value="<?php echo DELETE_ADMIN_REVIEW_ACTION ?>" />
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>
        </div>
    </div>

</body>

</html>