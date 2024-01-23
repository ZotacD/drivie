<?php

// Récupérer l'URL depuis le paramètre "urlEndpoint"
$requestUrl = isset($_GET['urlEndpoint']) ? $_GET['urlEndpoint'] : '/';

switch ($requestUrl) {
    case 'orders':
        require_once "model/order.php";

        $orders_not_prepared = getOrdersNotPrepared($_SESSION["id_util"]);
        $orders_not_collected = getOrdersNotCollected($_SESSION["id_util"]);
        $totalPrice = 0;

        changeOrderStatut();
        require_once("view/productorOrders.php");
        break;
    case 'dashboard':
        require_once "model/user.php";
        require_once "model/product.php";
        require_once "model/stock.php";
        require_once("model/order.php");

        $nbrProducts = 0;
        $nbrOutOfStockProducts = 0;

        $user = getUser($_SESSION["id_util"]);
        $nbProduitsRupture = getNbProduitsRupture($_SESSION["id_util"]);
        $products = getProductorProducts($_SESSION["id_util"]);

        setupDashboardInputs();

        $popup = isset($_POST['popup']) ? $_POST['popup'] : NO_DATA_POPUP;

        switch ($popup) {
            case 'product':
                require_once("controller/popup/product.php");
                break;
            case 'stock':
                require_once("controller/popup/stock.php");
                break;
            default:
                break;
        }

        require_once("view/dashboard.php");
        break;
    default:
        header("Location: " . PROJECT_PATH . "search?type=" . SEARCH_TYPE_PRODUCTORS);
        exit();
}

function setupDashboardInputs()
{
}

function changeOrderStatut()
{
    if (!isset($_GET["action"])) {
        return;
    }

    if (!isset($_GET["id_commande"])) {
        return;
    }

    $newStatut = "";
    $action = $_GET["action"];
    $id_commande = $_GET["id_commande"];

    switch ($action) {
        case 'accepter':
            $newStatut = 'En attente de recuperation';
            break;
        case 'valider':
            $newStatut = 'Terminee';
            break;
        case 'refuser':
            $newStatut = 'Refusee';
            break;
        default:
            header("Location: " . PROJECT_PATH . "productor/orders");
            exit();
    }

    updateOrderStatut($id_commande, $newStatut);

    header("Location: orders");
    exit();
}