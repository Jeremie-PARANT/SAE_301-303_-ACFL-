<?php
session_start();
$autorisation = $_SESSION['autorisation'];
// Appelle la BDD et de la classe adherent
require_once 'PHP/database.php';
$database = new App\Database\database();
require_once 'PHP/fonction.php';
if (empty($autorisation)) {
// Redirection vers la page connexion
    header("Location: connexion.php");
    exit();
}

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
        
        // Nav bar
        echo '<nav class="navbar navbar-expand-lg navbar-light backgroundDarkBlue fixed-top" id="main-navbar">
                <ul class="navbar-nav navbar-left mb-0" id="main-menu">
                    <li class="nav-item navbar-brand mr-4"><a class="navLink ml-2" href="profil.php">Profil</a></li>
                    <li class="nav-item navbar-brand mr-4"><a class="navLink ml-2" href="reservation.php">Réserver</a></li>'; 
                    if ($autorisation == 1){
                        echo '<li class="nav-item navbar-brand mr-4"><a class="navLink ml-2" href="backOfficeTable.php">BackOffice</a></li>';
                        echo '<li class="nav-item navbar-brand mr-4"><a class="navLink ml-2" href="addPilote.php">AddPilote</a></li>';
                        echo '<li class="nav-item navbar-brand mr-4"><a class="navLink ml-2" href="addULM.php">AddULM</a></li>';
                    }
                echo '</ul>
                <ul class="navbar-nav mb-0">
                    <li class="nav-item navbar-brand mr-4"><a class="navLink2" href="PHP/deconnecter.php">Se déconnecter</a></li>
                </ul>
            </nav>';
            


        // Affiche le tableau des réservations
        echo "<h1 class='sectionTitle reserv'>Réservation</h1>
        <input type='text' id='reservationSearch' onkeyup=\"search('reservationSearch', 'reservationTable')\" placeholder='Recherche'>
        <table id='reservationTable'>
        <th onclick=\"sortTable(0, 'reservationTable')\"><div>Adhérent<div></th><th onclick=\"sortTable(1, 'reservationTable')\"><div>Date début<div></th><th onclick=\"sortTable(2, 'reservationTable')\"><div>Date Fin<div></th><th onclick=\"sortTable(3, 'reservationTable')\"><div>Status<div></th><th onclick=\"sortTable(4, 'reservationTable')\"><div>Numéro de réservation<div></th><th onclick=\"sortTable(5, 'reservationTable')\"><div>Détails</th>";
        foreach ($reservations as $reservation)
        {
            echo "<tr><td>" . htmlspecialchars("{$reservation['adherent_name']} {$reservation['adherent_surname']}") . "</td><td>" . htmlspecialchars("{$reservation['date_debut']}") . "</td><td>" . htmlspecialchars("{$reservation['date_fin']}") . "</td><td>" . htmlspecialchars("{$reservation['status']}") . "</td><td>" . htmlspecialchars("{$reservation['num']}") . "</td><td><a href=\"details.php?num=" . htmlspecialchars($reservation['num']) . "\"><div class=\"details\">Détails</div></a></td></tr>";
        }
        echo '</table><hr>';

        // Affiche le tableau des adhérents
        echo "<h1 class='sectionTitle'>Adherent</h1>
        <input type='text' id='adherentSearch' onkeyup=\"search('adherentSearch', 'adherentTable')\" placeholder=Recherche'>
        <table id='adherentTable'>
        <th onclick=\"sortTable(0, 'adherentTable')\"><div>Nom<div></th><th onclick=\"sortTable(1, 'adherentTable')\"><div>Mail<div></th><th onclick=\"sortTable(2, 'adherentTable')\"><div>Activité<div></th><th onclick=\"sortTable(3, 'adherentTable')\"><div>Age<div></th><th onclick=\"sortTable(4, 'adherentTable')\"><div>Numéro de téléphone<div></th><th onclick=\"sortTable(4, 'adherentTable')\"><div>Numéro d'identification</th>";
        foreach ($adherents as $adherent)
        {
            echo "<tr><td>" . htmlspecialchars("{$adherent['name']} {$adherent['surname']}") . "</td><td>" . htmlspecialchars("{$adherent['mail']}") . "</td><td>" . "{$adherent['activity']}" . "</td><td>" . htmlspecialchars("{$adherent['age']}") . "</td><td>" . htmlspecialchars("{$adherent['phone']}") . "</td><td>" . htmlspecialchars("{$adherent['num']}") . "</td></tr>";
        }
        echo '</table><hr>';

        // Affiche le tableau des pilotes
        echo "<h1 class='sectionTitle'>Pilote</h1>
        <input type='text' id='piloteSearch' onkeyup=\"search('piloteSearch', 'piloteTable')\" placeholder='Recherche'>
        <table id='piloteTable'>
        <th onclick=\"sortTable(0, 'piloteTable')\"><div>Nom<div></th><th onclick=\"sortTable(1, 'piloteTable')\"><div>Numéro du pilote</th>";
        foreach ($pilotes as $pilote)
        {
            echo "<tr><td>" . htmlspecialchars("{$pilote['name']} {$pilote['surname']}") . "</td><td>" . htmlspecialchars("{$pilote['num']}") . "</td></tr>";
        }
        echo '</table><hr>';

        // Affiche le tableau des ULM
        echo "<h1 class='sectionTitle'>ULM</h1>
        <input type='text' id='ulmSearch' onkeyup=\"search('ulmSearch', 'ulmTable')\" placeholder='Recherche'>
        <table id='ulmTable'>
        <th onclick=\"sortTable(0, 'ulmTable')\"><div>Modèle<div></th><th onclick=\"sortTable(1, 'ulmTable')\"><div>Numéro de l'ULM</th>";
        foreach ($ulms as $ulm)
        {
            echo "<tr><td>" . htmlspecialchars("{$ulm['type']}") . "</td><td>" . htmlspecialchars("{$ulm['num']}") . "</td></tr>";
        }
        echo '</table><hr>';
    ?>



    <script src="Script/backOffice.js"></script>
</body>
</html>