<?php
require_once "db-config.php";

function getGroups()
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT * FROM GROUPE WHERE id_groupe NOT IN (1,2,3,4,5)");
    $bddQuery->execute();
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
}

function getGroupIds()
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT id_groupe FROM GROUPE WHERE id_groupe NOT IN (1,2,3,4,5)");
    $bddQuery->execute();
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
}

function getGroup($id_groupe)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT * FROM GROUPE WHERE id_groupe NOT IN (1,2,3,4,5) AND id_groupe=:id_groupe");
    $bddQuery->execute([
        "id_groupe" => $id_groupe
    ]);
    return $bddQuery->fetch(PDO::FETCH_ASSOC);
}