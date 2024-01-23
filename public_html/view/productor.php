<!DOCTYPE html>
<html lang="fr">

<head>
    <base href="<?php echo PROJECT_PATH ?>">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/header.css" />
    <link rel="stylesheet" href="src/css/productor.css" />

    <title>Document</title>
</head>

<body>
    <?php require_once "view/header.php"; ?>
    <div class="main">
        <div class="fiche">
            <div id="fermer">
                <img src="src/img/croixRouge.png" alt="fermer">
            </div>
            <div class="quart1">
                <div id="url_image_prod">
                    <img src="src/img/exemple.png" alt="image producteur">
                </div>
                <div id="name_part">
                    <div id="nom_prod">
                        Prénom + Nom
                    </div>
                    <div id="pseudo_prod">
                        Pseudo
                    </div>
                </div>
            </div>

            <div class="quart2">
                <div id="">

                </div>
            </div>
            <div class="quart3">

            </div>
            <div class="quart4">

            </div>
        </div>
    </div>
</body>

</html>