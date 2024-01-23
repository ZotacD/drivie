<?php

// Récupérer l'URL depuis le paramètre "url"
$requestUrl = isset($_GET['urlEndpoint']) ? $_GET['urlEndpoint'] : '/';

if ($requestUrl == '/') {
    require_once 'model/user.php';

    $user = getSimpleUser($_SESSION["id_util"]);
    myOrders();
    setupAccountInputs();
    logOut();
    setupUpdateImgUtilInputs();

    require_once 'view/account.php';
} else {
    header("Location: " . PROJECT_PATH . "account");
    exit();
}

function setupAccountInputs()
{

    if (
        !isset($_POST["prenom_util"]) || !isset($_POST["nom_util"]) || !isset($_POST["adresse_util"])
        || !isset($_POST["cp_util"]) || !isset($_POST["ville_util"]) || !isset($_POST["tel_util"])
    ) {
        return;
    }

    if ($_SESSION["id_type"] == ID_TYPE_PRODUCTEUR) {
        if (!isset($_POST["num_siret"])) {
            return;
        }
        if (!isset($_POST["description_util"])) {
            return;
        }
        $description_util = $_POST["description_util"];
        $num_siret = $_POST["num_siret"];
    }


    $prenom_util = $_POST["prenom_util"];
    $nom_util = $_POST["nom_util"];
    $adresse_util = $_POST["adresse_util"];
    $ville_util = $_POST["ville_util"];
    $cp_util = $_POST["cp_util"];
    $tel_util = $_POST["tel_util"];
    $id_util = $_POST["id_util"];

    updateUser($prenom_util, $nom_util, $adresse_util, $ville_util, $cp_util, $tel_util, $id_util, $num_siret, $description_util);

    header("Refresh:0");
    exit();
}

function logOut()
{
    if (!isset($_POST["action"])) {
        return;
    }

    if ($_POST["action"] == "logout") {
        session_destroy();
        header('Location: ' . PROJECT_PATH . "auth/login");
        exit();
    }
}

function setupUpdateImgUtilInputs()
{
    global $user;

    if (!isset($_POST["action"])) {
        return;
    }

    $url_image_util = $user["url_image_util"];
    $image_util = $_FILES["image_util"];
    $action = $_POST["action"];

    if ($action == "change_img") {
        if (!empty($image_util["tmp_name"])) {
            if ($url_image_util != DEFAULT_USER_IMAGE_PATH) {
                unlink($url_image_util);
            }

            $file_source = $image_util["tmp_name"];
            $url_image_util = "src/img/user/" . time() . "_" . $image_util["name"];
            move_uploaded_file($file_source, $url_image_util);

            updateUserImg($_SESSION["id_util"], $url_image_util);

            header("Refresh:0");
            exit();
        }
    }
}

function myOrders()
{
    if (!isset($_POST["action"])) {
        return;
    }

    if ($_POST["action"] == "myOrders") {
        header("Location: " . PROJECT_PATH . "orders");
    }

    if ($_SESSION["id_type"] != ID_TYPE_PRODUCTEUR) {
        return;
    }

    if ($_POST["action"] == "manageMyProducts") {
        header("Location: " . PROJECT_PATH . "productor/dashboard");
    }

}