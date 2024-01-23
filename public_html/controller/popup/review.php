<?php

// Récupérer l'URL depuis le paramètre "urlEndpoint"
$requestPopup = isset($_POST['popupEndpoint']) ? $_POST['popupEndpoint'] : 'get';

switch ($requestPopup) {
    case 'create':
        require_once "model/review.php";

        $id_prod = null;

        setupCreateReviewInputs();

        require_once "view/createReviewPopup.php";
        break;

    default:
        header("Location: " . PROJECT_PATH . "search?type=" . SEARCH_TYPE_PRODUCTS);
        exit();

}

function setupCreateReviewInputs(){
    global $id_prod;
    if (
        !isset($_POST["id_prod"])
    ) {
        return;
    }

    $id_prod = $_POST["id_prod"];

    if (!isset($_POST["titre_avis"]) || !isset($_POST["note_avis"]) || !isset($_POST["description_avis"])) {
        return;
    }

    $titre_avis = $_POST["titre_avis"];
    $note_avis = $_POST["note_avis"];
    $description_avis = $_POST["description_avis"];
    $id_util = $_SESSION["id_util"];

    createReview($titre_avis, $description_avis, $note_avis, $id_util, $id_prod);

    header("Refresh:0");
    exit();
}
