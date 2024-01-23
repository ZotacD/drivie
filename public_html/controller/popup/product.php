<?php

// Récupérer l'URL depuis le paramètre "urlEndpoint"
$requestPopup = isset($_POST['popupEndpoint']) ? $_POST['popupEndpoint'] : 'get';

switch ($requestPopup) {
    case 'get':
        require_once "model/product.php";
        require_once "model/cart.php";
        require_once "model/review.php";

        $product = null;
        $reviews = null;

        $isAddedInCart = setupDisplayProductInputs();

        if ($isAddedInCart) {
            require_once("controller/popup/alert.php");
        } else {
            require_once "view/productPopup.php";
        }
        break;
    case 'create':
        require_once "model/product.php";

        $categories = getCategories();
        $unites = getUnites();

        setupCreateProductInputs();

        require_once "view/createProductPopup.php";
        break;
    case "update":
        require_once "model/product.php";

        $product = null;
        $id_prod = null;
        $nom_prod = null;
        $pu_prod = null;
        $id_unite = null;
        $est_bio = null;
        $id_categorie = null;
        $description_prod = null;
        $url_image_prod = null;

        $categories = getCategories();
        $unites = getUnites();

        $isUpdated = setupUpdateProductInputs();
        if ($isUpdated) {
            require_once "controller/popup/alert.php";
        } else {
            require_once "view/updateProductPopup.php";
        }
        break;
    case "delete":
        require_once "model/product.php";

        $id_prod = null;


        setupDeleteProductInputs();
        require_once "view/deleteProductPopup.php";

        break;
    default:
        header("Location: " . PROJECT_PATH . "search?type=" . SEARCH_TYPE_PRODUCTS);
        exit();


}

function setupUpdateProductInputs()
{
    global $product, $id_prod, $nom_prod, $pu_prod, $id_unite, $est_bio, $id_categorie, $description_prod, $url_image_prod;

    if (
        !isset($_POST["id_prod"])
    ) {
        return;
    }

    $id_prod = $_POST["id_prod"];
    $product = getProduct($id_prod);

    if (
        empty($_POST["nom_prod"]) ||
        empty($_POST["pu_prod"])
    ) {
        return;
    }


    if ($_POST["popup"] === NO_DATA_POPUP) {
        return;
    }

    $nom_prod = $_POST["nom_prod"];
    $pu_prod = $_POST["pu_prod"];
    $id_unite = $_POST["id_unite"];

    switch ($_POST["est_bio"]) {
        case '1':
            $est_bio = true;
            break;
        case '0':
            $est_bio = false;
            break;
        default:
            $est_bio = false;
            break;
    }

    $id_categorie = $_POST["id_categorie"];
    $description_prod = $_POST["description_prod"];
    $image_prod = $_FILES["image_prod"];
    $url_image_prod = $product["url_image_prod"];

    if (!empty($image_prod["tmp_name"])) {
        if ($url_image_prod != DEFAULT_PRODUCT_IMAGE_PATH) {
            unlink(PROJECT_PATH . $url_image_prod);
        }

        $file_source = $image_prod["tmp_name"];
        $url_image_prod = "src/img/product/" . time() . "_" . $image_prod["name"];
        move_uploaded_file($file_source, $url_image_prod);
    }

    updateProduct($id_prod, $nom_prod, $description_prod, $est_bio, $id_categorie, $id_unite, $pu_prod, $url_image_prod);

    return true;
}

function setupCreateProductInputs()
{
    if (
        !isset($_POST["nom_prod"]) || empty($_POST["nom_prod"])
        || !isset($_POST["description_prod"])
        || !isset($_POST["pu_prod"]) || empty($_POST["pu_prod"])
        || !isset($_POST["id_categorie"]) || empty($_POST["id_categorie"])
        || !isset($_POST["id_unite"]) || empty($_POST["id_unite"])
    ) {
        return;
    }

    if ($_POST["popup"] === NO_DATA_POPUP) {
        return;
    }

    $nom_prod = $_POST["nom_prod"];
    $description_prod = $_POST["description_prod"];
    $pu_prod = $_POST["pu_prod"];
    $image_prod = $_FILES["image_prod"];

    switch ($_POST["est_bio"]) {
        case '1':
            $est_bio = true;
            break;
        case '0':
            $est_bio = false;
            break;
        default:
            $est_bio = false;
            break;
    }

    $id_categorie = $_POST['id_categorie'];
    $id_unite = $_POST["id_unite"];

    if (empty($image_prod["tmp_name"])) {
        $url_image_prod = DEFAULT_PRODUCT_IMAGE_PATH;
    } else {
        $file_source = $image_prod["tmp_name"];
        $url_image_prod = "src/img/product/" . time() . "_" . $image_prod["name"];
        move_uploaded_file($file_source, $url_image_prod);
    }

    addProduct($nom_prod, $description_prod, $pu_prod, $url_image_prod, $est_bio, $id_categorie, $id_unite, $_SESSION["id_util"]);

    header("Refresh:0");
    exit();
}

function setupDisplayProductInputs()
{
    global $product, $reviews;

    if (!isset($_POST["id_prod"])) {
        header("Refresh:0");
        exit();
    }

    $id_prod = $_POST["id_prod"];

    $product = getProduct($id_prod);
    $reviews = getReviews($id_prod);

    if (!isset($_POST["qt_prod"])) {
        return;
    }

    if ($_SESSION["id_util"] === NOT_CONNECTED_USER_ID) {
        header("Location: /SAE301/sae3.01/public_html/auth/login");
        exit();
    }

    $qt_prod = $_POST["qt_prod"];
    $pu_prod = $product["pu_prod"];

    if ($qt_prod <= 0) {
        echo "<script>alert('Veuillez entrer une valeur plus grande que 0')</script>";
        return;
    }

    $article = getCartProduct($_SESSION["id_panier"], $id_prod);

    if (empty($article)) {
        if ($qt_prod <= $product["qt_stock"]) {
            addCartProduct($_SESSION["id_panier"], $id_prod, $qt_prod, $pu_prod);
        } else {
            return;
        }
    } else {
        if ($qt_prod <= $product["qt_stock"]) {
            updateCartProduct($_SESSION["id_panier"], $id_prod, $qt_prod);
        } else {
            return false;
        }
    }

    return true;
}


function setupDeleteProductInputs()
{

    global $id_prod;

    if (!isset($_POST["id_prod"])) {
        header("Refresh:0");
        exit();
    }

    $id_prod = $_POST["id_prod"];

    if (!isset($_POST["action"])) {
        return;
    }

    deleteProduct($id_prod);

    header("Refresh:0");
    exit();
}