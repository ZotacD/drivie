<?php

// Récupérer l'URL depuis le paramètre "endpoint"
$requestUrl = isset($_GET['urlEndpoint']) ? $_GET['urlEndpoint'] : '/';

switch ($requestUrl) {
    case '/':
        require_once 'model/order.php';

        $id_util = $_SESSION["id_util"];

        $ordersPreparing = getClientOrdersPreparing($id_util);
        $nbOrdersPreparing = getNbOrdersByStatut($id_util, 'En cours de preparation');

        $ordersWaiting = getClientOrdersWaiting($id_util);
        $nbOrdersWaiting = getNbOrdersByStatut($id_util, 'En attente');

        $ordersFinished = getClientOrdersFinished($id_util);
        $nbOrdersFinished = getNbOrdersByStatut($id_util, 'Terminee');

        $ordersRefused = getClientOrdersRefused($id_util);
        $nbOrdersRefused = getNbOrdersByStatut($id_util, 'Refusee');

        $popup = isset($_POST['popup']) ? $_POST['popup'] : NO_DATA_POPUP;


        switch($popup){
            case 'order':
                require_once 'controller/popup/order.php';
                break;
            case 'productor':
                require_once 'controller/popup/productor.php';
                break;
            case 'product':
                require_once 'controller/popup/product.php';
                break;
            case 'review':
                require_once 'controller/popup/review.php';
            default:
                break;
    }

        require_once 'view/orders.php';
        break;
    default :
        header("Location: " . PROJECT_PATH . "orders");
        exit();
}

function setUpOrderInputs(){
    if(!isset($_POST["id_commande"])){
        return;
    }

    $id_commande=$_POST["id_commande"];
}


        