<?php

// Récupérer l'URL depuis le paramètre "url"
$requestUrl = isset($_GET['urlEndpoint']) ? $_GET['urlEndpoint'] : '/';

switch ($requestUrl) {
    case '/':
        header("Location: " . PROJECT_PATH . "auth/login");
        exit();
    case 'login':
        require_once "model/user.php";
        require_once "model/cart.php";

        setupLoginInputs();
        require_once "view/login.php";
        break;
    case 'register':
        $type = $_GET["type"];
        if (!isset($_GET["type"])) {
            header("Location: " . PROJECT_PATH . "auth/register?type=1");
            exit();
        }

        require_once "model/user.php";
        setupRegisterInputs();
        require_once "view/register.php";
        break;
    default:
        header("Location: " . PROJECT_PATH . "404");
        exit();
}

function setupLoginInputs()
{
    if (!isset($_POST["pseudo_mail_util"]) || !isset($_POST["mdp_util"])) {
        return;
    }

    $pseudo_mail_util = $_POST["pseudo_mail_util"];
    $mdp_util = $_POST["mdp_util"];

    $id_util = getUserId($pseudo_mail_util, $mdp_util);
    $user = getUser($id_util);

    if ($id_util == constant("USER_NOT_FOUND")) {
        echo "<script>alert('Utilisateur introuvable')</script>";
    } else {
        $_SESSION["id_util"] = $id_util;
        $_SESSION["id_type"] = $user["id_type"];
        $_SESSION["id_groupe"] = $user["id_groupe"];
        $_SESSION["id_panier"] = getCart($id_util)["id_panier"];
        $_SESSION["pseudo_util"] = $user["pseudo_util"];

        header("Location: " . PROJECT_PATH);
        exit();
    }
}

function setupRegisterInputs()
{
    if (
        !isset($_POST["prenom_util"]) || !isset($_POST["nom_util"]) || !isset($_POST["pseudo_util"])
        || !isset($_POST["mail_util"]) || !isset($_POST["adresse_util"]) || !isset($_POST["ville_util"])
        || !isset($_POST["cp_util"]) || !isset($_POST["tel_util"]) || !isset($_POST["mdp_util"])
        || !isset($_POST["c_mdp_util"])
    ) {
        return;
    }

    $prenom_util = $_POST["prenom_util"];
    $nom_util = $_POST["nom_util"];
    $pseudo_util = $_POST["pseudo_util"];
    $mail_util = $_POST["mail_util"];
    $adresse_util = $_POST["adresse_util"];
    $ville_util = $_POST["ville_util"];
    $cp_util = $_POST["cp_util"];
    $tel_util = $_POST["tel_util"];
    $num_siret = isset($_POST["num_siret"]) ? $_POST["num_siret"] : null;
    $mdp_util = $_POST["mdp_util"];
    $c_mdp_util = $_POST["c_mdp_util"];

    if ($mdp_util != $c_mdp_util) {
        echo "<script>alert('Mot de passe différent')</script>";
        return;
    }

    if (isUserCanRegister($pseudo_util, $mail_util)) {
        addUser(
            $prenom_util,
            $nom_util,
            $pseudo_util,
            $adresse_util,
            $ville_util,
            $cp_util,
            $mail_util,
            $tel_util,
            $mdp_util,
            $num_siret
        );
        header("Location: " . PROJECT_PATH . "auth/login");
        exit();
    } else {
        echo "<script>alert('Utilisateur déjà existant')</script>";
    }
}