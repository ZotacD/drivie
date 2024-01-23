<?php



$requestPopup = isset($_POST['popupEndpoint']) ? $_POST['popupEndpoint'] : 'get';

switch ($requestPopup) {
    case 'get':
        $infoMessage=null;
        setupMessageInfoInputs(); 
        require_once "view/alert.php";
        break;
    case 'update':
        $infoMessage=null;
        setupMessageInfoInputs(); 
        require_once "view/alert.php";
        break;
    default:
        header("Location: " . PROJECT_PATH . "search?type=" . SEARCH_TYPE_PRODUCTS);
        exit();
}

function setupMessageInfoInputs(){
    global $infoMessage;
    if(!isset($_POST["infoMessage"])){
        header("Refresh:0");
        exit();
    }
    $infoMessage=$_POST["infoMessage"];
}