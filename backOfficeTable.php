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
</head>
<body>
    <!-- Style temporaire -->
    <!-- MESSAGE IMPORTANT POUR LES FUTUR DEVELOPPEUR FRONT (a supprimer après lecture) :
    le code peut paraitre compliquer, mais pour le front, vous aurez principalement juste a mettre du css sur les balise suivantes :
    'td' 'tr' 'th' et 'table' 
    Ah oui, et aussi, met une animation sur les th (genre scale 1.1 en hover), car il permet de lancer une fonction -->
    <style>
        * {
            text-align: center;
        }
        td {
            padding : 5px 15px;
        }
        table {
            margin: auto;
        }
        th:hover {
            transition-duration: 300ms;
            scale: 1.1;
            cursor: pointer;
        }
        input {
            margin: 0 0 10px 0;
        }
    </style>

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
        echo "<h1>Réservation</h1>
        <input type='text' id='reservationSearch' onkeyup=\"search('reservationSearch', 'reservationTable')\" placeholder='recherche'>
        <table id='reservationTable'>
        <th onclick=\"sortTable(0, 'reservationTable')\">Adhérent</th><th onclick=\"sortTable(1, 'reservationTable')\">Date début</th><th onclick=\"sortTable(2, 'reservationTable')\">Date Fin</th><th onclick=\"sortTable(3, 'reservationTable')\">Status</th><th onclick=\"sortTable(4, 'reservationTable')\">Numéro de réservation</th><th onclick=\"sortTable(5, 'reservationTable')\">Détails</th>";
        foreach ($reservations as $reservation)
        {
            echo "<tr><td> {$reservation['adherent_name']} {$reservation['adherent_surname']} </td><td> {$reservation['date_debut']} </td><td> {$reservation['date_fin']} </td><td> {$reservation['status']} </td><td> {$reservation['num']} </td><td><a href=\"details.php?num={$reservation['num']}\"><div class=\"details\">Link</div></a></td></tr>";
        }
        echo '</table>';

        // Affiche le tableau des adhérents
        echo "<h1>Adherent</h1>
        <input type='text' id='adherentSearch' onkeyup=\"search('adherentSearch', 'adherentTable')\" placeholder='recherche'>
        <table id='adherentTable'>
        <th onclick=\"sortTable(0, 'adherentTable')\">Nom</th><th onclick=\"sortTable(1, 'adherentTable')\">Mail</th><th onclick=\"sortTable(2, 'adherentTable')\">Activité</th><th onclick=\"sortTable(3, 'adherentTable')\">Age</th><th onclick=\"sortTable(4, 'adherentTable')\">Numéro de téléphone</th><th onclick=\"sortTable(4, 'adherentTable')\">Numéro d'identification</th>";
        foreach ($adherents as $adherent)
        {
            echo "<tr><td> {$adherent['name']} {$adherent['surname']} </td><td> {$adherent['mail']} </td><td> {$adherent['activity']} </td><td> {$adherent['age']} </td><td> {$adherent['phone']} </td><td> {$adherent['num']} </td></tr>";
        }
        echo '</table>';

        // Affiche le tableau des pilotes
        echo "<h1>Pilote</h1>
        <input type='text' id='piloteSearch' onkeyup=\"search('piloteSearch', 'piloteTable')\" placeholder='recherche'>
        <table id='piloteTable'>
        <th onclick=\"sortTable(0, 'piloteTable')\">Nom</th><th onclick=\"sortTable(1, 'piloteTable')\">Numéro du pilote</th>";
        foreach ($pilotes as $pilote)
        {
            echo "<tr><td> {$pilote['name']} {$pilote['surname']} </td><td> {$pilote['num']} </td></tr>";
        }
        echo '</table>';

        // Affiche le tableau des ULM
        echo "<h1>ULM</h1>
        <input type='text' id='ulmSearch' onkeyup=\"search('ulmSearch', 'ulmTable')\" placeholder='recherche'>
        <table id='ulmTable'>
        <th onclick=\"sortTable(0, 'ulmTable')\">Modèle</th><th onclick=\"sortTable(1, 'ulmTable')\">Numéro du ulm</th>";
        foreach ($ulms as $ulm)
        {
            echo "<tr><td> {$ulm['type']} </td><td> {$ulm['num']} </td></tr>";
        }
        echo '</table>';
    ?>



    <script src="Script/backOffice.js"></script>
</body>
</html>