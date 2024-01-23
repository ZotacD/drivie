<?php
require_once "db-config.php";

function groupeTypeUser($id_util)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT id_type FROM UTILISATEUR WHERE id_util=:id_util");
    $bddQuery->execute([
        "id_util" => htmlspecialchars($id_util)
    ]);
    return $bddQuery->fetch(PDO::FETCH_ASSOC);
}

function getReceivedMessages($id_groupe, $id_type)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT * FROM infosMessages WHERE dest_groupe_mess IN (:id_groupe, :id_type, 4)");
    $bddQuery->execute([
        "id_groupe" => htmlspecialchars($id_groupe),
        "id_type" => htmlspecialchars($id_type)
    ]);
    $result = $bddQuery->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function getSentMessages($id_groupe)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT DISTINCT id_mess, objet_mess, contenu_mess, date_mess, nom_groupe_exp FROM infosMessages WHERE exp_groupe_mess = :id_groupe");
    $bddQuery->execute([
        "id_groupe" => htmlspecialchars($id_groupe)
    ]);
    $result = $bddQuery->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function deleteMessage($id_mess)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("CALL SupprimerMessage(:id_mess)");
    $bddQuery->execute([
        "id_mess" => htmlspecialchars($id_mess)
    ]);
}

function createMessage($objet_mess, $contenu_mess, $exp_groupe_mess)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("INSERT INTO MESSAGE(objet_mess, contenu_mess, date_mess, exp_groupe_mess) VALUES (:objet_mess, :contenu_mess, NOW(), :exp_groupe_mess)");
    $bddQuery->execute([
        "objet_mess" => htmlspecialchars($objet_mess),
        "contenu_mess" => htmlspecialchars($contenu_mess),
        "exp_groupe_mess" => htmlspecialchars($exp_groupe_mess)
    ]);
    return $bdd->lastInsertId();
}

function getMessage($id_mess)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT id_mess, objet_mess, contenu_mess, date_mess, nom_groupe_exp FROM infosMessages WHERE id_mess=:id_mess");
    $bddQuery->execute([
        "id_mess" => htmlspecialchars($id_mess)
    ]);
    return $bddQuery->fetch(PDO::FETCH_ASSOC);
}

function searchReceivedMessages($searchTerm, $id_groupe, $id_type)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT * FROM infosMessages WHERE (LOWER(objet_mess) LIKE LOWER(:searchTerm) OR LOWER(contenu_mess) LIKE LOWER(:searchTerm)) AND dest_groupe_mess IN (:id_groupe, :id_type, 4)");
    $bddQuery->execute([
        "searchTerm" => "%" . htmlspecialchars($searchTerm) . "%",
        "id_groupe" => htmlspecialchars($id_groupe),
        "id_type" => htmlspecialchars($id_type)
    ]);
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
}

function searchSentMessages($searchTerm, $id_groupe)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT DISTINCT id_mess, objet_mess, contenu_mess, date_mess, nom_groupe_exp FROM infosMessages WHERE (LOWER(objet_mess) LIKE LOWER(:searchTerm) OR LOWER(contenu_mess) LIKE LOWER(:searchTerm)) AND exp_groupe_mess = :id_groupe");
    $bddQuery->execute([
        "searchTerm" => "%" . htmlspecialchars($searchTerm) . "%",
        "id_groupe" => htmlspecialchars($id_groupe)
    ]);
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
}

function addReceiver($id_mess, $dest_group_mess, $ordre_groupe_dest)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("INSERT INTO DESTINATAIRE(id_mess, dest_groupe_mess, ordre_groupe_dest) VALUES (:id_mess, :dest_groupe_mess, :ordre_groupe_dest)");
    $bddQuery->execute([
        "id_mess" => htmlspecialchars($id_mess),
        "dest_groupe_mess" => htmlspecialchars($dest_group_mess),
        "ordre_groupe_dest" => htmlspecialchars($ordre_groupe_dest)
    ]);
    return $bdd->lastInsertId();
}

function getReceivers($id_mess)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT dest_groupe_mess, nom_groupe_dest FROM infosMessages WHERE id_mess=:id_mess");
    $bddQuery->execute([
        "id_mess" => htmlspecialchars($id_mess)
    ]);
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
}
?>