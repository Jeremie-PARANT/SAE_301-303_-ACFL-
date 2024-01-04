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
    <title>Document</title>
</head>
<body>
    <!-- Style temporaire -->
    <!-- MESSAGE IMPORTANT POUR LES FUTUR DEVELOPPEUR FRONT (a supprimer après lecture) :
    le code peut paraitre compliquer, mais pour le front, vous aurez principalement juste a mettre du css sur les balise suivantes :
    'td' 'tr' 'th' et 'table' 
    Ah oui, et aussi, met une animation sur les th (genre scale 1.1 en hover), car il permet de lancer une fonction -->
    <style>
        td {
            text-align: center;
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
    </style>

    <?php
        // Récupère les données nécéssaire, pour les différents tableaux
        $queryReserv = $database->prepare('SELECT plld_reservation.*, plld_adherent.name AS adherent_name, plld_adherent.surname AS adherent_surname FROM plld_reservation INNER JOIN plld_adherent ON plld_reservation.num_adherent = plld_adherent.num;');
        $queryReserv->execute();
        $reservations = $queryReserv->fetchAll();
        

        // Affiche le tableau des réservations
        echo "<input type='text' id='reservationSearch' onkeyup=\"search('reservationSearch', 'reservationTable')\" placeholder='recherche'>
        <table id='reservationTable'>
        <th onclick=\"sortTable(0, 'reservationTable')\">Adhérent</th><th onclick=\"sortTable(1, 'reservationTable')\">Date début</th><th onclick=\"sortTable(2, 'reservationTable')\">Date Fin</th><th onclick=\"sortTable(3, 'reservationTable')\">Status</th><th onclick=\"sortTable(4, 'reservationTable')\">Numéro de réservation</th>";
        foreach ($reservations as $reservation)
        {
            echo "<tr><td> {$reservation['adherent_name']} {$reservation['adherent_surname']} </td><td> {$reservation['date_debut']} </td><td> {$reservation['date_fin']} </td><td> {$reservation['status']} </td><td> {$reservation['num']} </td></tr>";
        }
        echo '</table>';
    ?>



    <script src="Script/backOffice.js"></script>
</body>
</html>