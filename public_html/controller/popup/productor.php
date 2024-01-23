<?php

// Récupérer l'URL depuis le paramètre "urlEndpoint"
$requestPopup = isset($_POST['popupEndpoint']) ? $_POST['popupEndpoint'] : 'get';

switch ($requestPopup) {
    case 'get':
        require_once "model/user.php";
        
        $user = null;

        setupDisplayProductorInputs();

        require_once "view/productorPopup.php";
        break;
    default:
        header("Location: " . PROJECT_PATH . "search?type=" . SEARCH_TYPE_PRODUCTORS);
        exit();
}

function setupDisplayProductorInputs()
{
    global $user;

    if (!isset($_POST["id_util"])) {
        header("Refresh:0");
        exit();
    }

    $id_util = $_POST["id_util"];
    // var_dump($id_util);
    $user = getProductor($id_util);
}
