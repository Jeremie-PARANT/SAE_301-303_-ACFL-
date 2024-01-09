<?php
session_start();
$adherent = $_SESSION['currentAdherent'];
$autorisation = $_SESSION['autorisation'];
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
    <link href="Styles/profil.css" rel="stylesheet" type="text/css" media="all">
    <link href="Styles/bootstrap/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>
    <?php
        // Récupère les données nécéssaire, pour les différents tableaux
        $queryReserv = $database->prepare("SELECT plld_reservation.*, plld_adherent.name AS adherent_name, plld_adherent.surname AS adherent_surname FROM plld_reservation INNER JOIN plld_adherent ON plld_reservation.num_adherent = plld_adherent.num where plld_adherent.num = :adherent;");
        $queryReserv->bindParam(':adherent', $adherent, PDO::PARAM_INT);
        $queryReserv->execute();
        $reservations = $queryReserv->fetchAll();

        $queryAdherent = $database->prepare('SELECT * FROM plld_adherent WHERE num = :adherent;');
        $queryAdherent->bindParam(':adherent', $adherent, PDO::PARAM_INT);
        $queryAdherent->execute();
        $rows = $queryAdherent->fetchAll(PDO::FETCH_ASSOC);
        
        // Nav bar
        echo '<nav class="navbar navbar-expand-lg navbar-light backgroundDarkBlue fixed-top" id="main-navbar">
                <ul class="navbar-nav navbar-left mb-0" id="main-menu">
                    <li class="nav-item navbar-brand mr-4"><a class="navLink ml-2" href="profil.php">Profil</a></li>
                    <li class="nav-item navbar-brand mr-4"><a class="navLink ml-2" href="reservation.php">Réserver</a></li>'; 
                if ($autorisation == 1){
                    echo '<li class="nav-item navbar-brand mr-4"><a class="navLink ml-2" href="backOfficeTable.php">BackOffice</a></li>';
                    echo '<li class="nav-item navbar-brand mr-4"><a class="navLink ml-2" href="addPilote.php">AddPilote</a></li>';
                }
                echo '</ul>
                <ul class="navbar-nav mb-0">
                    <li class="nav-item navbar-brand mr-4"><a class="navLink2" href="PHP/deconnecter.php">Se déconnecter</a></li>
                </ul>
            </nav><br><br><br>';
        
        
        
            // Affiche les information de l'utilisateur actuel
            echo '<h1 class="sectionTitle"> Vos informations personnelles </h1>';
        echo '<div class="infos_p mx-auto mb-5"">';
        foreach ($rows as $row) {
            echo "Nom: " . $row['name'] . ' ' . $row['surname'] . "<br>";
            echo "Age: " . $row['age'] . "<br>";
            echo "Numéro de téléphone: " . $row['phone'] . "<br>";
            echo "E-mail: " . $row['mail'] . "<br>";
            echo "Numéro d'adhérent: " . $row['num'] . "<br>";
            echo "Information complémentaires: " . $row['other'] . "<br>";
            echo "Activité: " . $row['activity'] . "<br>";
            //Ajout d'un bouton pour modifier les informations personnelles
        //    if (isset($_SESSION["currentAdherent"])) {
        //        echo '<a href="#modalEditUser" data-toggle="modal" class="btn btn btn-primary float-right">Modifier vos informations</a>';
        //        }
                
                
    }

        echo '</div>';


        // Affiche le tableau des réservations
        echo "<h1 class='sectionTitle'>Vos réservation :</h1>
        
        <table id='reservationTable'>
        <th onclick=\"sortTable(0, 'reservationTable')\"><div>Adhérent<div></th><th onclick=\"sortTable(1, 'reservationTable')\"><div>Date début<div></th><th onclick=\"sortTable(2, 'reservationTable')\"><div>Date Fin<div></th><th onclick=\"sortTable(3, 'reservationTable')\"><div>Model<div></th><th onclick=\"sortTable(4, 'reservationTable')\"><div>Status<div></th><th onclick=\"sortTable(5, 'reservationTable')\"><div>Numéro de réservation<div></th>";
        foreach ($reservations as $reservation)
        {
            echo "<tr><td>" . htmlspecialchars("{$reservation['adherent_name']} {$reservation['adherent_surname']}") . "</td><td>" . htmlspecialchars("{$reservation['date_debut']}") . "</td><td>" . htmlspecialchars("{$reservation['date_fin']}") . "</td><td>" . htmlspecialchars("{$reservation['model']}") . "</td><td>" . htmlspecialchars("{$reservation['status']}") . "</td><td>" . htmlspecialchars("{$reservation['num']}") . "</td></tr>";
        }
        echo '</table><hr>';
    ?>



    <script src="Script/backOffice.js"></script>
</body>
</html>