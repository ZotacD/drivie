<?php
require_once "db-config.php";

function getReviews($id_prod)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT * FROM infosAvis WHERE id_prod=:id_prod");
    $bddQuery->execute([
        "id_prod" => htmlspecialchars($id_prod)
    ]);
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
}

function getReviewsByTitle($titleReview)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("SELECT * FROM AVIS WHERE LOWER(titre_avis) LIKE LOWER(:titre_avis)");
    $bddQuery->execute([
        "titre_avis" => "%" . htmlspecialchars($titleReview) . "%"
    ]);
    return $bddQuery->fetchAll(PDO::FETCH_ASSOC);
    ;
}

function deleteReview($id_avis)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("DELETE FROM AVIS WHERE id_avis=:id_avis;");
    $bddQuery->execute([
        "id_avis" => htmlspecialchars($id_avis)
    ]);
}

function createReview($titre_avis, $description_avis, $note_avis, $id_util, $id_prod)
{
    $bdd = dbConnect();
    $bddQuery = $bdd->prepare("INSERT INTO AVIS(titre_avis, description_avis, note_avis, date_avis, id_util, id_prod) 
    VALUES (:titre_avis, :description_avis, :note_avis, NOW(), :id_util, :id_prod)");
    $bddQuery->execute([
        "titre_avis" => htmlspecialchars($titre_avis),
        "description_avis" => htmlspecialchars($description_avis),
        "note_avis" => htmlspecialchars($note_avis),
        "id_util" => htmlspecialchars($id_util),
        "id_prod" => htmlspecialchars($id_prod)
    ]);
}