<?php
// Appelle la BDD et de la classe adherent
require_once 'PHP/database.php';
$database = new App\Database\database();
require_once 'PHP/fonction.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableaux des informations essentiels</title>
    <link href="Styles/index.css" rel="stylesheet" type="text/css" media="all">
    <link href="Styles/backOffice.css" rel="stylesheet" type="text/css" media="all">
    <link href="Styles/bootstrap/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>
    <?php
        // Récupère les données nécéssaire, pour les différents tableaux
        $queryReserv = $database->prepare('SELECT plld_reservation.*, plld_adherent.name AS adherent_name, plld_adherent.surname AS adherent_surname FROM plld_reservation INNER JOIN plld_adherent ON plld_reservation.num_adherent = plld_adherent.num;');
        $queryReserv->execute();
        $reservations = $queryReserv->fetchAll();

        $queryAdherent = $database->prepare('SELECT * FROM plld_adherent;');
        $queryAdherent->execute();
        $adherents = $queryAdherent->fetchAll();

        $queryPilote = $database->prepare('SELECT * FROM plld_pilote;');
        $queryPilote->execute();
        $pilotes = $queryPilote->fetchAll();

        $queryUlm = $database->prepare('SELECT * FROM plld_ulm;');
        $queryUlm->execute();
        $ulms = $queryUlm->fetchAll();
        

        // Affiche le tableau des réservations
        echo "<h1 class='sectionTitle'>Réservation</h1>
        <input type='text' id='reservationSearch' onkeyup=\"search('reservationSearch', 'reservationTable')\" placeholder='recherche'>
        <table id='reservationTable'>
        <th onclick=\"sortTable(0, 'reservationTable')\"><div>Adhérent<div></th><th onclick=\"sortTable(1, 'reservationTable')\"><div>Date début<div></th><th onclick=\"sortTable(2, 'reservationTable')\"><div>Date Fin<div></th><th onclick=\"sortTable(3, 'reservationTable')\"><div>Status<div></th><th onclick=\"sortTable(4, 'reservationTable')\"><div>Numéro de réservation<div></th><th onclick=\"sortTable(5, 'reservationTable')\"><div>Détails</th>";
        foreach ($reservations as $reservation)
        {
            echo "<tr><td> {$reservation['adherent_name']} {$reservation['adherent_surname']} </td><td> {$reservation['date_debut']} </td><td> {$reservation['date_fin']} </td><td> {$reservation['status']} </td><td> {$reservation['num']} </td><td><a href=\"details.php?num={$reservation['num']}\"><div class=\"details\">Link</div></a></td></tr>";
        }
        echo '</table>';

        // Affiche le tableau des adhérents
        echo "<h1 class='sectionTitle'>Adherent</h1>
        <input type='text' id='adherentSearch' onkeyup=\"search('adherentSearch', 'adherentTable')\" placeholder='recherche'>
        <table id='adherentTable'>
        <th onclick=\"sortTable(0, 'adherentTable')\"><div>Nom<div></th><th onclick=\"sortTable(1, 'adherentTable')\"><div>Mail<div></th><th onclick=\"sortTable(2, 'adherentTable')\"><div>Activité<div></th><th onclick=\"sortTable(3, 'adherentTable')\"><div>Age<div></th><th onclick=\"sortTable(4, 'adherentTable')\"><div>Numéro de téléphone<div></th><th onclick=\"sortTable(4, 'adherentTable')\"><div>Numéro d'identification</th>";
        foreach ($adherents as $adherent)
        {
            echo "<tr><td> {$adherent['name']} {$adherent['surname']} </td><td> {$adherent['mail']} </td><td> {$adherent['activity']} </td><td> {$adherent['age']} </td><td> {$adherent['phone']} </td><td> {$adherent['num']} </td></tr>";
        }
        echo '</table>';

        // Affiche le tableau des pilotes
        echo "<h1 class='sectionTitle'>Pilote</h1>
        <input type='text' id='piloteSearch' onkeyup=\"search('piloteSearch', 'piloteTable')\" placeholder='recherche'>
        <table id='piloteTable'>
        <th onclick=\"sortTable(0, 'piloteTable')\"><div>Nom<div></th><th onclick=\"sortTable(1, 'piloteTable')\"><div>Numéro du pilote</th>";
        foreach ($pilotes as $pilote)
        {
            echo "<tr><td> {$pilote['name']} {$pilote['surname']} </td><td> {$pilote['num']} </td></tr>";
        }
        echo '</table>';

        // Affiche le tableau des ULM
        echo "<h1 class='sectionTitle'>ULM</h1>
        <input type='text' id='ulmSearch' onkeyup=\"search('ulmSearch', 'ulmTable')\" placeholder='recherche'>
        <table id='ulmTable'>
        <th onclick=\"sortTable(0, 'ulmTable')\"><div>Modèle<div></th><th onclick=\"sortTable(1, 'ulmTable')\"><div>Numéro du ulm</th>";
        foreach ($ulms as $ulm)
        {
            echo "<tr><td> {$ulm['type']} </td><td> {$ulm['num']} </td></tr>";
        }
        echo '</table>';
    ?>



    <script src="Script/backOffice.js"></script>
</body>
</html>