<?php

require_once './constants.php';

session_start();
if (!isset($_SESSION["id_util"])) {
    $_SESSION["id_util"] = NOT_CONNECTED_USER_ID;
    $_SESSION["id_type"] = NOT_CONNECTED_USER_TYPE_ID;
}

// Récupérer l'URL depuis le paramètre "url"
$requestUrl = isset($_GET['url']) ? $_GET['url'] : '/';

switch ($requestUrl) {
    case '/':
        require_once 'controller/home.php';
        break;
    case 'message':
        if ($_SESSION["id_type"] != NOT_CONNECTED_USER_TYPE_ID) {
            require_once 'controller/message.php';
        } else {
            header('Location: ' . PROJECT_PATH);
            exit();
        }
        break;
    case 'account':
        if ($_SESSION["id_type"] != NOT_CONNECTED_USER_TYPE_ID) {
            require_once 'controller/account.php';
        } else {
            header('Location: ' . PROJECT_PATH);
            exit();
        }
        break;
    case 'admin';
        if ($_SESSION["id_type"] == ID_TYPE_ADMIN) {
            require_once 'controller/admin.php';
        } else {
            header('Location: ' . PROJECT_PATH);
            exit();
        }
        break;
    case 'auth':
        require_once 'controller/auth.php';
        break;
    case 'productor':
        if ($_SESSION["id_type"] == ID_TYPE_PRODUCTEUR) {
            require_once 'controller/productor.php';
        } else {
            header('Location: ' . PROJECT_PATH);
            exit();
        }
        break;
    case 'search':
        require_once 'controller/search.php';
        break;
    case 'cart':
        require_once 'controller/cart.php';
        break;
    case 'orders':
        if ($_SESSION["id_type"] != NOT_CONNECTED_USER_TYPE_ID) {
            require_once 'controller/order.php';
        } else {
            header('Location: ' . PROJECT_PATH);
            exit();
        }
        break;
    case '403':
        var_dump("403");
        break;
    case '404':
        var_dump("404");
        break;
    default:
        header("Location: " . PROJECT_PATH . "404");
        exit();
}