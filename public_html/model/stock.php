<?php
require_once "db-config.php";

function productHaveStock($id_prod)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT * FROM STOCK WHERE id_prod=:id_prod");
    $bddQuery->execute([
        "id_prod" => htmlspecialchars($id_prod)
    ]);
    $result = $bddQuery->fetch(PDO::FETCH_ASSOC);
    return !empty($result);
}

function getStocks($id_prod)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT * FROM STOCK WHERE id_prod=:id_prod");
    $bddQuery->execute([
        "id_prod" => htmlspecialchars($id_prod)
    ]);
    $result = $bddQuery->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function addStock($id_prod, $nom_stock, $qt_stock, $date_stock, $date_exp_stock)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("INSERT INTO STOCK(id_prod, nom_stock, qt_stock, date_stock, date_exp_stock) VALUES (:id_prod, :nom_stock, :qt_stock, :date_stock, :date_exp_stock)");
    $bddQuery->execute([
        "id_prod" => htmlspecialchars($id_prod),
        "nom_stock" => htmlspecialchars($nom_stock),
        "qt_stock" => htmlspecialchars($qt_stock),
        "date_stock" => htmlspecialchars($date_stock),
        "date_exp_stock" => htmlspecialchars($date_exp_stock)
    ]);
    return $bdd->lastInsertId();
}

function deleteStock($id_stock)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("DELETE FROM STOCK WHERE id_stock=:id_stock");
    $bddQuery->execute([
        "id_stock" => htmlspecialchars($id_stock)
    ]);
}