<!DOCTYPE html>
<html lang="fr">

<head>
    <base href="<?php echo PROJECT_PATH ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/header.css" />
    <link rel="stylesheet" href="src/css/thankOrder.css" />
    <title>Document</title>
</head>

<body>
    <?php require_once "view/header.php"; ?>
    <div class="main">

        <div class="glob">

            <h1>Merci d'avoir commandé</h1>

            <div class="set">

                <br>

                <div class="from-group">
                    <div class="unit">
                        <label for="qt_prod">2</label>
                        <label for="nom_unit">kg</label>
                    </div>

                    <div class="desc">
                        <label for="nom_prod">Description</label>
                    </div>

                    <div class="price">
                        <label for="pu_prod">11.9€</label>
                    </div>

                </div>

                <div class="separate"></div>

                <br>

                <div class="from-group">
                    <div class="unit">
                        <label for="qt_prod">3</label>
                        <label for="nom_unit">kg</label>
                    </div>

                    <div class="desc">
                        <label for="nom_prod">Description</label>
                    </div>

                    <div class="price">
                        <label for="pu_prod">12.9€</label>
                    </div>

                </div>

                <div class="separate"></div>

                <br>

                <div class="from-group">
                    <div class="unit">
                        <label for="qt_prod">3</label>
                        <label for="nom_unit">kg</label>
                    </div>

                    <div class="desc">
                        <label for="nom_prod">Description</label>
                    </div>

                    <div class="price">
                        <label for="pu_prod">13.9€</label>
                    </div>

                </div>

                <div class="separate"></div>
                <br>

                <div class="from-group">
                    <div class="unit">
                        <label for="qt_prod">4</label>
                        <label for="nom_unit">kg</label>
                    </div>

                    <div class="desc">
                        <label for="nom_prod">Description</label>
                    </div>

                    <div class="price">
                        <label for="pu_prod">14.9€</label>
                    </div>

                </div>

                <div class="from-group2">
                    <div class="Tot">
                        <h2>Prix TOTAL</h2>
                    </div>

                    <div class="price">
                        <label for="pu_prod">50.9€</label>
                    </div>

                </div>
            </div>
            <div class="download_group">
                <button type="submit">Télécharger en PDF</button>
            </div>

        </div>
    </div>
</body>

</html>