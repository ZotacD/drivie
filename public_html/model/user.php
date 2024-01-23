<?php
require_once "db-config.php";

function hashPassword($mdp_util)
{
    return hash("crc32", $mdp_util);
}

function getUserId($pseudo_mail_util, $mdp_util)
{

    $hashed_mdp_util = hashPassword($mdp_util);
    $bdd = dbConnect();

    $bddQuery = $bdd->prepare("SELECT id_util FROM UTILISATEUR WHERE (pseudo_util=:pseudo_util OR mail_util=:mail_util) AND mdp_util=:mdp_util");
    $bddQuery->execute([
        'pseudo_util' => htmlspecialchars($pseudo_mail_util),
        'mail_util' => htmlspecialchars($pseudo_mail_util),
        'mdp_util' => htmlspecialchars($hashed_mdp_util)
    ]);

    $user = $bddQuery->fetch(PDO::FETCH_ASSOC);
    if (empty($user)) {
        return constant("USER_NOT_FOUND");
    }

    return $user["id_util"];
}

function isUserCanRegister($pseudo_util, $mail_util)
{
    $bdd = dbConnect();

    $bddQuery = $bdd->prepare("SELECT id_util FROM UTILISATEUR WHERE pseudo_util=:pseudo_util OR mail_util=:mail_util");
    $bddQuery->execute([
        'pseudo_util' => htmlspecialchars($pseudo_util),
        'mail_util' => htmlspecialchars($mail_util)
    ]);

    $user = $bddQuery->fetch(PDO::FETCH_ASSOC);
    if (empty($user)) {
        return true;
    }
    return false;
}

function getUser($id_util)
{
    $bdd = dbConnect();

    $bddQuery = $bdd->prepare("SELECT * FROM infosUtil WHERE id_util=:id_util");
    $bddQuery->execute(["id_util" => htmlspecialchars($id_util)]);
    return $bddQuery->fetch(PDO::FETCH_ASSOC);
}

function getSimpleUser($id_util)
{
    $bdd = dbConnect();

    $bddQuery = $bdd->prepare("SELECT * FROM UTILISATEUR WHERE id_util=:id_util");
    $bddQuery->execute(["id_util" => htmlspecialchars($id_util)]);
    return $bddQuery->fetch(PDO::FETCH_ASSOC);
}

function getNbProduitsRupture($id_util)
{
    $bdd = dbConnect();

    $bddQuery = $bdd->prepare("CALL nbProduitsRupture(:id_util, @nb_produits_rupture)");
    $bddQuery->execute(["id_util" => htmlspecialchars($id_util)]);

    $bddQuery = $bdd->prepare("SELECT @nb_produits_rupture");
    $bddQuery->execute();
    return $bddQuery->fetch(PDO::FETCH_ASSOC)["@nb_produits_rupture"];
}

function getUsers()
{
    $bdd = dbConnect();

    $bddQuery = $bdd->query("SELECT * FROM infosUtil");
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
}
function addUser($prenom_util, $nom_util, $pseudo_util, $adresse_util, $ville_util, $cp_util, $mail_util, $tel_util, $mdp_util, $num_siret = null, $description_util = null)
{
    $bdd = dbConnect();

    if ($num_siret != null) {
        $id_type = constant("ID_TYPE_PRODUCTEUR");
    } else {
        $id_type = constant("ID_TYPE_CLIENT");
    }

    $bddQuery = $bdd->prepare("CALL creerUtil(:prenom_util, :nom_util, :adresse_util, :ville_util, :cp_util, :mail_util, :tel_util, :num_siret, :pseudo_util, :description_util,:mdp_util, :id_type)");
    $bddQuery->execute([
        'prenom_util' => htmlspecialchars($prenom_util),
        'nom_util' => htmlspecialchars($nom_util),
        'pseudo_util' => htmlspecialchars($pseudo_util),
        'adresse_util' => htmlspecialchars($adresse_util),
        'ville_util' => htmlspecialchars($ville_util),
        'cp_util' => htmlspecialchars($cp_util),
        'mail_util' => htmlspecialchars($mail_util),
        'tel_util' => htmlspecialchars($tel_util),
        'mdp_util' => hashPassword($mdp_util),
        'num_siret' => htmlspecialchars($num_siret),
        'description_util' => htmlspecialchars($description_util),
        'id_type' => htmlspecialchars($id_type)
    ]);
}

function getNbSales($id_util)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT COUNT(*) AS 'nb_ventes' FROM COMMANDE WHERE id_util=:id_util");
    $bddQuery->execute([
        'id_util' => htmlspecialchars($id_util)
    ]);
    return $bddQuery->fetch(PDO::FETCH_ASSOC)['nb_ventes'];
}

function getProductorsByName($pseudo_nom_prenom_util)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare('
    SELECT * FROM UTILISATEUR WHERE (LOWER(pseudo_util) LIKE LOWER(:pseudo_util) OR LOWER(nom_util) LIKE LOWER(:nom_util) OR LOWER(prenom_util) LIKE LOWER(:prenom_util)) AND id_type=
    ' . ID_TYPE_PRODUCTEUR);
    $bddQuery->execute([
        'pseudo_util' => "%" . htmlspecialchars($pseudo_nom_prenom_util) . "%",
        'nom_util' => "%" . htmlspecialchars($pseudo_nom_prenom_util) . "%",
        'prenom_util' => "%" . htmlspecialchars($pseudo_nom_prenom_util) . "%"
    ]);
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);

}

function getProductors()
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare('SELECT * FROM infosUtil WHERE id_type=' . ID_TYPE_PRODUCTEUR . " ORDER BY nb_commandes_terminees+nb_commandes_preparation+nb_commandes_attente DESC");
    $bddQuery->execute();
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);

}

function getProductor($id_util)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare('SELECT * FROM infosUtil WHERE id_util=:id_util AND id_type=2');
    $bddQuery->execute([
        'id_util' => htmlspecialchars($id_util)
    ]);
    return $bddQuery->fetch(PDO::FETCH_ASSOC);
}

function deleteProductor($id_util)
{
    $user = getUser($id_util);
    if ($user["url_image_util"] != DEFAULT_USER_IMAGE_PATH) {
        unlink($user["url_image_util"]);
    }

    $bdd = dbConnect();

    $bddQuery = $bdd->prepare("CALL SuppProd(:id_util)");
    $bddQuery->execute([
        'id_util' => htmlspecialchars($id_util)
    ]);
}

function getCustomersByName($pseudo_nom_prenom_util)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare('
    SELECT * FROM infosUtil WHERE (LOWER(pseudo_util) LIKE LOWER(:pseudo_util) OR LOWER(nom_util) LIKE LOWER(:nom_util) OR LOWER(prenom_util) LIKE LOWER(:prenom_util)) AND id_type=
    ' . ID_TYPE_CLIENT);
    $bddQuery->execute([
        'pseudo_util' => "%" . htmlspecialchars($pseudo_nom_prenom_util) . "%",
        'nom_util' => "%" . htmlspecialchars($pseudo_nom_prenom_util) . "%",
        'prenom_util' => "%" . htmlspecialchars($pseudo_nom_prenom_util) . "%"
    ]);
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);

}

function getCustomers()
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare('
    SELECT * FROM UTILISATEUR WHERE id_type=
    ' . ID_TYPE_CLIENT);
    $bddQuery->execute();
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);

}

function deleteCustomer($id_util)
{
    $bdd = dbConnect();

    $bddQuery = $bdd->prepare("CALL SuppClient(:id_util)");
    $bddQuery->execute([
        'id_util' => htmlspecialchars($id_util)
    ]);
}

function updateUser($prenom_util, $nom_util, $adresse_util, $ville_util, $cp_util, $tel_util, $id_util, $num_siret = null, $description_util = null)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("UPDATE UTILISATEUR
    SET prenom_util=:prenom_util,
        nom_util=:nom_util,
        adresse_util=:adresse_util,
        ville_util=:ville_util,
        cp_util=:cp_util,
        tel_util=:tel_util,
        num_siret=:num_siret,
        description_util=:description_util
    WHERE id_util=:id_util;
    ");
    $bddQuery->execute([
        'prenom_util' => htmlspecialchars($prenom_util),
        'nom_util' => htmlspecialchars($nom_util),
        'adresse_util' => htmlspecialchars($adresse_util),
        'ville_util' => htmlspecialchars($ville_util),
        'cp_util' => htmlspecialchars($cp_util),
        'tel_util' => htmlspecialchars($tel_util),
        'num_siret' => htmlspecialchars($num_siret),
        'description_util' => htmlspecialchars($description_util),
        'id_util' => htmlspecialchars($id_util)
    ]);
}

function updateUserImg($id_util, $url_image_util)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("UPDATE UTILISATEUR
    SET url_image_util=:url_image_util
    WHERE id_util=:id_util;
    ");
    $bddQuery->execute([
        'url_image_util' => htmlspecialchars($url_image_util),
        'id_util' => htmlspecialchars($id_util)
    ]);
}