<?php

// Récupérer l'URL depuis le paramètre "urlEndpoint"
$requestUrl = isset($_GET['urlEndpoint']) ? $_GET['urlEndpoint'] : '/';

switch ($requestUrl) {
    case '/':
        require_once('model/user.php');
        require_once('model/product.php');
        require_once('model/review.php');

        $result = null;
        $search_term = "";
        $search_type = $_GET["type"];

        switch ($search_type) {
            case SEARCH_TYPE_PRODUCTORS:
                require_once("model/product.php");
                setupSearchProductorsInputs();
                break;
            case SEARCH_TYPE_PRODUCTS:
                require_once("model/user.php");
                setupSearchProductsInputs();
                break;
            case SEARCH_TYPE_CUSTOMERS:
                require_once("model/user.php");
                setupSearchCustomersInputs();
                break;
            case SEARCH_TYPE_review:
                require_once("model/review.php");
                setupSearchReviewsInputs();
                break;
            default:
                header("Location: " . PROJECT_PATH . "admin?type=" . ID_TYPE_PRODUCTEUR);
                exit();
        }
        require_once("view/admin.php");
        break;
    default:
        header("Location: " . PROJECT_PATH . "");
        exit();

}

function setupSearchProductorsInputs()
{
    global $result, $search_term;

    if (isset($_GET["q"])) {
        $search_term = $_GET["q"];
    }

    $result = getProductorsByName($search_term);

    if (!isset($_POST["action"])) {
        return;
    }

    if (!isset($_POST["id_util"])) {
        return;
    }

    $id_util = $_POST["id_util"];
    $action = $_POST["action"];

    switch ($action) {
        case DELETE_ADMIN_PRODUCTOR_ACTION:
            deleteProductor($id_util);
            header("Refresh:0");
            break;
    }
}
function setupSearchProductsInputs()
{
    global $result, $search_term;

    if (isset($_GET["q"])) {
        $search_term = $_GET["q"];
    }

    $result = getProductsByName($search_term);

    if (!isset($_POST["action"])) {
        return;
    }

    if (!isset($_POST["id_prod"])) {
        return;
    }

    $id_prod = $_POST["id_prod"];
    $action = $_POST["action"];

    switch ($action) {
        case DELETE_ADMIN_PRODUCT_ACTION:
            deleteProduct($id_prod);
            header("Refresh:0");
            break;
    }
}

function setupSearchCustomersInputs()
{
    global $result, $search_term;

    if (isset($_GET["q"])) {
        $search_term = $_GET["q"];
    }

    $result = getCustomersByName($search_term);

    if (!isset($_POST["action"])) {
        return;
    }

    if (!isset($_POST["id_util"])) {
        return;
    }

    $id_util = $_POST["id_util"];
    $action = $_POST["action"];

    switch ($action) {
        case DELETE_ADMIN_CUSTOMER_ACTION:
            deleteCustomer($id_util);
            header("Refresh:0");
            break;
    }
}

function setupSearchReviewsInputs()
{
    global $result, $search_term;

    if (isset($_GET["q"])) {
        $search_term = $_GET["q"];
    }

    $result = getReviewsByTitle($search_term);

    if (!isset($_POST["action"])) {
        return;
    }

    if (!isset($_POST["id_avis"])) {
        return;
    }

    $id_avis = $_POST["id_avis"];
    $action = $_POST["action"];

    switch ($action) {
        case DELETE_ADMIN_REVIEW_ACTION:
            deleteReview($id_avis);
            header("Refresh:0");
            break;
    }
}