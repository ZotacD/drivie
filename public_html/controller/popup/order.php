<?php

// Récupérer l'URL depuis le paramètre "urlEndpoint"
$requestPopup = isset($_POST['popupEndpoint']) ? $_POST['popupEndpoint'] : 'get';

switch ($requestPopup) {
    case 'get':
        require_once "model/order.php";
        $id_commande=null;
        $articles=null;
        $totalPrice=0;
        setupOrderPopUpInputs();    

        require_once "view/orderPopup.php";
        break;

    default:
        header("Location: " . PROJECT_PATH . "search?type=" . SEARCH_TYPE_PRODUCTS);
        exit();
}

function setupOrderPopUpInputs()
{
    global $id_commande, $articles;

    if (!isset($_POST["id_commande"]) || empty($_POST["id_commande"])) {
        return;
    }

    $id_commande = $_POST["id_commande"];
    $articles = getArticles($id_commande);
}

function displayProductInputs(){

    global $id_prod;

    if(!isset($_POST["product"])){
        header("Refresh:0");
        exit();
    }

    if(!isset($_POST["product"])){
        return;
    }

    $id_prod=$_POST["id_prod"];
}