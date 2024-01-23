<?php
require_once "db-config.php";

function addCartProduct($id_panier, $id_prod, $qt_prod, $pu_prod)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("INSERT INTO ARTICLE(id_panier, id_prod, qt_prod, pu_prod) VALUES (:id_panier, :id_prod, :qt_prod, :pu_prod);");
    $bddQuery->execute([
        "id_panier" => htmlspecialchars($id_panier),
        "id_prod" => htmlspecialchars($id_prod),
        "qt_prod" => htmlspecialchars($qt_prod),
        "pu_prod" => htmlspecialchars($pu_prod)
    ]);
    return $bdd->lastInsertId();
}

function getCartProduct($id_panier, $id_prod)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT * FROM ARTICLE WHERE id_panier=:id_panier AND id_prod=:id_prod");
    $bddQuery->execute([
        "id_panier" => htmlspecialchars($id_panier),
        "id_prod" => htmlspecialchars($id_prod)
    ]);
    return $bddQuery->fetch(PDO::FETCH_ASSOC);
}

function deleteCartProduct($id_panier, $id_prod)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("DELETE FROM ARTICLE WHERE id_panier=:id_panier AND id_prod=:id_prod");
    $bddQuery->execute([
        "id_panier" => htmlspecialchars($id_panier),
        "id_prod" => htmlspecialchars($id_prod)
    ]);
}

function updateCartProduct($id_panier, $id_prod, $qt_prod)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("UPDATE ARTICLE SET qt_prod=qt_prod + :qt_prod WHERE id_panier=:id_panier AND id_prod=:id_prod");
    $bddQuery->execute([
        "id_panier" => htmlspecialchars($id_panier),
        "id_prod" => htmlspecialchars($id_prod),
        "qt_prod" => htmlspecialchars($qt_prod)
    ]);
}

function validateCart($id_panier)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("CALL validerPanier(:id_panier);");
    $bddQuery->execute([
        "id_panier" => htmlspecialchars($id_panier)
    ]);
}

function getCartProducts($id_util)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT * FROM articlesNonCommandes WHERE id_client=:id_util");
    $bddQuery->execute([
        "id_util" => htmlspecialchars($id_util),
    ]);
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
}

function updateCart($id_panier, $nom_panier)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("UPDATE PANIER SET nom_panier=:nom_panier WHERE id_panier=:id_panier");
    $bddQuery->execute([
        "id_panier" => htmlspecialchars($id_panier),
        "nom_panier" => htmlspecialchars($nom_panier)
    ]);
}

function deleteCart($id_panier)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("DELETE FROM PANIER WHERE id_panier=:id_panier");
    $bddQuery->execute([
        "id_panier" => htmlspecialchars($id_panier)
    ]);
}

function getCart($id_util)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT * FROM paniersNonCommandes WHERE id_util=:id_util");
    $bddQuery->execute([
        "id_util" => htmlspecialchars($id_util)
    ]);
    $cart = $bddQuery->fetch(PDO::FETCH_ASSOC);
    return $cart;
}