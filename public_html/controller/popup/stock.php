<?php

// Récupérer l'URL depuis le paramètre "urlEndpoint"
$requestPopup = isset($_POST['popupEndpoint']) ? $_POST['popupEndpoint'] : 'get';

switch ($requestPopup) {
    case 'create':
        require_once "model/stock.php";

        $id_prod = null;

        setupCreateStockInputs();
        require_once "view/createStockPopup.php";
        break;
    case 'delete':
        require_once "model/stock.php";

        $id_stock = null;

        setupDeleteStockInputs();
        require_once "view/deleteStockPopup.php";
        break;
    default:
        header("Location: " . PROJECT_PATH . "search?type=" . SEARCH_TYPE_PRODUCTS);
        exit();

}


function setupCreateStockInputs()
{
    global $id_prod;

    if (
        !isset($_POST["id_prod"])
    ) {
        header("Refresh:0");
        exit();
    }

    $id_prod = $_POST["id_prod"];

    if (!isset($_POST["qt_stock"]) || !isset($_POST["nom_stock"]) || !isset($_POST["date_stock"]) || !isset($_POST["date_exp_stock"])) {
        return;
    }

    $id_prod = $_POST["id_prod"];
    $qt_stock = $_POST["qt_stock"];
    $nom_stock = $_POST["nom_stock"];
    $date_stock = $_POST["date_stock"];
    $date_exp_stock = $_POST["date_exp_stock"];

    addStock($id_prod, $nom_stock, $qt_stock, $date_stock, $date_exp_stock);

    header("Refresh:0");
    exit();
}

function setupDeleteStockInputs()
{
    global $id_stock;

    if (
        !isset($_POST["id_stock"])
    ) {
        header("Refresh:0");
        exit();
    }

    $id_stock = $_POST["id_stock"];

    if (!isset($_POST["action"])) {
        return;
    }

    deleteStock($id_stock);

    header("Refresh:0");
    exit();
}
