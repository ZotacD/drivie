<?php
require_once "db-config.php";

function getOrdersNotPrepared($id_util)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT id_commande, statut_commande, pseudo_util, date_commande FROM COMMANDE 
    INNER JOIN PANIER ON COMMANDE.id_panier=PANIER.id_panier
    INNER JOIN UTILISATEUR ON UTILISATEUR.id_util=PANIER.id_util 
    WHERE COMMANDE.id_util=:id_util AND statut_commande='En cours de preparation'");
    $bddQuery->execute([
        "id_util" => htmlspecialchars($id_util)
    ]);
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
}

function getOrdersNotCollected($id_util)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT id_commande, statut_commande, pseudo_util, date_commande FROM COMMANDE 
    INNER JOIN PANIER ON COMMANDE.id_panier=PANIER.id_panier
    INNER JOIN UTILISATEUR ON UTILISATEUR.id_util=PANIER.id_util
    WHERE COMMANDE.id_util=:id_util AND statut_commande='En attente de recuperation'");
    $bddQuery->execute([
        "id_util" => htmlspecialchars($id_util)
    ]);
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
}

function getArticles($id_commande)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT * FROM articlesCommandes WHERE id_commande=:id_commande");
    $bddQuery->execute([
        "id_commande" => htmlspecialchars($id_commande)
    ]);
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
}

function validateOrder($id_commande)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("UPDATE COMMANDE SET statut_commande='Disponible' WHERE id_commande=:id_commande");
    $bddQuery->execute([
        "id_commande" => htmlspecialchars($id_commande)
    ]);
}

function updateOrderStatut($id_commande, $statut_commande)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("UPDATE COMMANDE SET statut_commande=:statut_commande WHERE id_commande=:id_commande");
    $bddQuery->execute([
        "statut_commande" => htmlspecialchars($statut_commande),
        "id_commande" => htmlspecialchars($id_commande)
    ]);
}

function getClientOrdersPreparing($id_util)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT COMMANDE.id_util, id_commande, date_commande, statut_commande
    FROM COMMANDE INNER JOIN PANIER ON COMMANDE.id_panier=PANIER.id_panier 
    WHERE PANIER.id_util=:id_util AND statut_commande='En cours de preparation'");
    $bddQuery->execute([
        "id_util" => htmlspecialchars($id_util)
    ]);
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
}

function getClientOrdersWaiting($id_util)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT COMMANDE.id_util, id_commande, date_commande, statut_commande
    FROM COMMANDE INNER JOIN PANIER ON COMMANDE.id_panier=PANIER.id_panier 
    WHERE PANIER.id_util=:id_util AND statut_commande='En attente'");
    $bddQuery->execute([
        "id_util" => htmlspecialchars($id_util)
    ]);
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
}

function getClientOrdersFinished($id_util)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT COMMANDE.id_util, id_commande, date_commande, statut_commande
    FROM COMMANDE INNER JOIN PANIER ON COMMANDE.id_panier=PANIER.id_panier 
    WHERE PANIER.id_util=:id_util AND statut_commande='Terminee'");
    $bddQuery->execute([
        "id_util" => htmlspecialchars($id_util)
    ]);
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
}

function getClientOrdersRefused($id_util)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT COMMANDE.id_util, id_commande, date_commande, statut_commande
    FROM COMMANDE INNER JOIN PANIER ON COMMANDE.id_panier=PANIER.id_panier 
    WHERE PANIER.id_util=:id_util AND statut_commande='Refusee'");
    $bddQuery->execute([
        "id_util" => htmlspecialchars($id_util)
    ]);
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
}

function getNbOrdersByStatut($id_util, $statut_commande)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT COUNT(id_commande) AS 'nb_commande' FROM COMMANDE INNER JOIN PANIER ON COMMANDE.id_panier=PANIER.id_panier 
    WHERE PANIER.id_util=:id_util AND statut_commande=:statut_commande");
    $bddQuery->execute([
        "id_util" => htmlspecialchars($id_util),
        "statut_commande" => htmlspecialchars($statut_commande)
    ]);
    return $bddQuery->fetch(PDO::FETCH_ASSOC);
}

function getOrder($id_commande){
    $bdd=dbConnect();
    $bddQuery=$bdd->prepare("SELECT * FROM articlesCommandes WHERE id_commande=:id_commande");
    $bddQuery->execute([
        "id_commande" => htmlspecialchars($id_commande)
    ]);
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
}