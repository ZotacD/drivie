<?php

// Récupérer l'URL depuis le paramètre "url"
$requestUrl = isset($_GET['urlEndpoint']) ? $_GET['urlEndpoint'] : '/';

switch ($requestUrl) {
    case '/':
        $result = null;
        $search_term = "";
        $search_type = $_GET["type"];
        switch ($search_type) {
            case "1":
                require_once "model/product.php";
                $categories=getCategories();
                setupSearchProductsInputs();
                break;
            case "2":
                require_once "model/user.php";
                setupSearchProducteursInputs();
                break;
            default:
                header("Location: " . PROJECT_PATH . "search?type=" . SEARCH_TYPE_PRODUCTS);
                exit();
        }

        $popup = isset($_POST['popup']) ? $_POST['popup'] : NO_DATA_POPUP;

        switch ($popup) {
            case 'product':
                require_once("controller/popup/product.php");
                break;
            case 'productor':
                require_once("controller/popup/productor.php");
                break;
            default:
                break;
        }

        require_once "view/search.php";
        break;
    default:
        header("Location: " . PROJECT_PATH . "/404");
        exit();
}


function setupSearchProductsInputs()
{
    global $result, $search_term;

    if (isset($_GET["q"])) {
        $search_term = $_GET["q"];
    }

    $result=getProductsByNameOrCategory($search_term);  
}

function setupSearchProducteursInputs()
{

    global $result, $search_term;

    if (isset($_GET["q"])) {
        $search_term = $_GET["q"];
    }

    $result = getProductorsByName($search_term);
}

