<!DOCTYPE html>
<html lang="fr">

<head>
    <base href="<?php echo PROJECT_PATH ?>">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/header.css" />
    <link rel="stylesheet" href="src/css/productorStocks.css" />
    <title>Document</title>
</head>

<body>
    <?php require_once "view/header.php"; ?>

    <div class="main">
        <h1>STOCKS</h1>

        <div class="container">
            <div class="card">
                <img src="tomate-grappe.jpg" alt="Tomate grappe" class="image">
                <p class="name">Tomate grappe</p>
                <div class="info">
                    <p class="qt_prod">4.50€/kg</p>
                    <button class="button2">Supprimer</button>
                </div>
            </div>
            <div class="card">
                <img src="bois.jpg" alt="bois cheminé" class="image">
                <p class="name">bois cheminé</p>
                <div class="info">
                    <p class="qt_prod">3.00€/kg</p>
                    <button class="button2">Supprimer</button>
                </div>
            </div>

            <div class="card">
                <img src="tomate-grappe.jpg" alt="Tomate coeur de boeuf" class="image">
                <p class="name">Tomate coeur de boeuf</p>
                <div class="info">
                    <p class="qt_prod">4.50€/kg</p>
                    <button class="button2">Supprimer</button>
                </div>
            </div>

            <div class="card">
                <img src="tomate-grappe.jpg" alt="Tomate coeur de boeuf" class="image">
                <p class="name">Tomate coeur de boeuf</p>
                <div class="info">
                    <p class="qt_prod">4.50€/kg</p>
                    <button class="button2">Supprimer</button>
                </div>
            </div>


            <button class="button">Ajouter</button>
        </div>

    </div>
</body>

</html>