<?php
session_start();
// Appelle la BDD et de la classe adherent
require_once 'PHP/database.php';
$database = new App\Database\database();
require_once 'PHP/fonction.php';
$CurrentNum = $_SESSION['currentAdherent'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation</title>
    <link href="Styles/index.css" rel="stylesheet" type="text/css" media="all">
    <link href="Styles/bootstrap/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>

    <!-- Formulaire, avec affichage des erreurs -->
    <h1>Ajouter un pilote</h1>
    <div>Veuillez préciser le nom et prénom du pilote</div>
    <form class="reservation" action="addPilote.php" method="post">
        <label for="date_debut">Nom du pilote</label>
        <input type="date" name="nomPilote" id=""><br>

        <label for="date_fin">Prénom du pilote</label>
        <input type="date" name="prenomPilote" id=""><br>
        <?php if (!empty($errorModel)) { echo $errorModel; } ?>

        <input type="text" name="model" id="" placeholder="Modèle souhaité">
        <?php if (!empty($errorDate)) { echo $errorDate; } ?>

        <input type="submit" value="envoie">
    </form>
