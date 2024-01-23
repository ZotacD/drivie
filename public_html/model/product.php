<?php
require_once "db-config.php";


function getProducts()
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT * FROM infosProduits");
    $bddQuery->execute();
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
}

function get10NewProducts()
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT * FROM infosProduits ORDER BY date_prod ASC LIMIT 10;");
    $bddQuery->execute();
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
}

function getProductorProducts($id_util)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT * FROM infosProduits WHERE id_util=:id_util");
    $bddQuery->execute([
        "id_util" => htmlspecialchars($id_util)
    ]);
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
}

function getCategories()
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT * FROM CATEGORIE");
    $bddQuery->execute();
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
}

function getUnites()
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT * FROM UNITE");
    $bddQuery->execute();
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
}

function getProduct($id_prod)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT * FROM infosProduits WHERE id_prod=:id_prod");
    $bddQuery->execute([
        "id_prod" => htmlspecialchars($id_prod)
    ]);
    return $bddQuery->fetch(PDO::FETCH_ASSOC);
}

function addProduct($nom_prod, $description_prod, $pu_prod, $url_image_prod, $est_bio, $id_categorie, $id_unite, $id_util)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("
        INSERT INTO PRODUIT(nom_prod, description_prod, pu_prod, url_image_prod, date_prod, est_bio, id_categorie, id_unite, id_util)
        VALUES (:nom_prod, :description_prod, :pu_prod, :url_image_prod,:date_prod, :est_bio, :id_categorie, :id_unite, :id_util);
        ");
    $date = getdate();
    $date_prod = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'] . ' ' . $date['hours'] . ':' . $date['minutes'] . ':' . $date['seconds'];
    $bddQuery->execute([
        "nom_prod" => htmlspecialchars($nom_prod),
        "description_prod" => htmlspecialchars($description_prod),
        "pu_prod" => htmlspecialchars($pu_prod),
        "url_image_prod" => htmlspecialchars($url_image_prod),
        "date_prod" => htmlspecialchars($date_prod),
        "est_bio" => htmlspecialchars($est_bio),
        "id_categorie" => htmlspecialchars($id_categorie),
        "id_unite" => htmlspecialchars($id_unite),
        "id_util" => htmlspecialchars($id_util)
    ]);
    return $bdd->lastInsertId();
}


function updateProduct($id_prod, $nom_prod, $description_prod, $est_bio, $id_categorie, $id_unite, $pu_prod, $url_image_prod)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("CALL modifierProduit(:id_prod, :nom_prod, :description_prod, :est_bio, :id_categorie, :id_unite, :pu_prod, :url_image_prod)");
    $bddQuery->execute([
        "id_prod" => htmlspecialchars($id_prod),
        "nom_prod" => htmlspecialchars($nom_prod),
        "description_prod" => htmlspecialchars($description_prod),
        "est_bio" => htmlspecialchars($est_bio),
        "id_categorie" => htmlspecialchars($id_categorie),
        "id_unite" => htmlspecialchars($id_unite),
        "pu_prod" => htmlspecialchars($pu_prod),
        "url_image_prod" => htmlspecialchars($url_image_prod)
    ]);
}
function deleteProduct($id_prod)
{
    $product = getProduct($id_prod);
    if ($product["url_image_prod"] != DEFAULT_PRODUCT_IMAGE_PATH) {
        unlink($product["url_image_prod"]);
    }

    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("CALL SuppProduit(:id_prod);");
    $bddQuery->execute([
        "id_prod" => htmlspecialchars($id_prod)
    ]);
}

function getProductsByCategory($id_categorie)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT * FROM PRODUIT WHERE id_categorie=:id_categorie");
    $bddQuery->execute([
        "id_categorie" => htmlspecialchars($id_categorie)
    ]);
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
    ;
}

function getLatestProducts()
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT * FROM PRODUIT ORDER BY date_prod DESC");
    $bddQuery->execute();
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
    ;
}

function getProductsByName($nom_prod)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT * FROM infosProduits WHERE LOWER(nom_prod) LIKE LOWER(:nom_prod)");
    $bddQuery->execute([
        "nom_prod" => "%" . htmlspecialchars($nom_prod) . "%"
    ]);
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
}

function getProductsByNameOrCategory($search_term)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT * FROM infosProduits WHERE LOWER(nom_prod) LIKE LOWER(:search_term) OR LOWER(nom_categorie) LIKE LOWER(:search_term)");
    $bddQuery->execute([
        "search_term" => "%" . htmlspecialchars($search_term) . "%",
    ]);
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
}
