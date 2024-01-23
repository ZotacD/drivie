<?php

// Récupérer l'URL depuis le paramètre "url"
$requestUrl = isset($_GET['urlEndpoint']) ? $_GET['urlEndpoint'] : '/';

switch ($requestUrl) {
    case '/':
        require_once "model/cart.php";
        $isEmptyCart = false;
        $total = 0;
        $articles = null;

        $popup = isset($_POST['popup']) ? $_POST['popup'] : NO_DATA_POPUP;
        setupCartInputs();

        switch ($popup) {
            case 'alert':
                require_once("controller/popup/alert.php");
                break;
            default:
                break;
        }

        require_once "view/cart.php";
        break;


    default:
        header("Location: " . PROJECT_PATH . "cart");
        exit();
}


function setupCartInputs()
{
    global $isEmptyCart, $total, $articles;

    if ($_SESSION["id_util"] == NOT_CONNECTED_USER_ID) {
        $isEmptyCart = true;
        return;
    }

    $id_util = $_SESSION["id_util"];
    $articles = getCartProducts($id_util);

    if (empty($articles)) {
        $isEmptyCart = true;
        return;
    }

    foreach ($articles as $article) {
        $total += $article["qt_prod"] * $article["pu_prod"];
    }

    if (!isset($_POST["action"])) {
        return;
    }

    $action = $_POST["action"];

    switch ($action) {
        case BUY_CART_ACTION:
            validateCart($_SESSION["id_panier"]);
            $_SESSION["id_panier"] = getCart($id_util)["id_panier"];

        case DELETE_CART_PRODUCT_ACTION:
            if (!isset($_POST["id_prod"])) {
                return;
            }
            $id_prod = $_POST["id_prod"];
            deleteCartProduct($_SESSION["id_panier"], $id_prod);
            header("Refresh:0");
            break;
    }
}
