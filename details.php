<?php
session_start();
$autorisation = $_SESSION['autorisation'];
// Appelle la BDD et de la classe adherent
require_once 'PHP/database.php';
$database = new App\Database\database();
require_once 'PHP/fonction.php';
$url = $_SERVER['REQUEST_URI'];
$envoyer = '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=*, initial-scale=1.0">
    <title>Détails de la réservation</title>
    <link href="Styles/index.css" rel="stylesheet" type="text/css" media="all">
    <link href="Styles/details.css" rel="stylesheet" type="text/css" media="all">
    <link href="Styles/bootstrap/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>
    <?php
    // MESSAGE POUR LE FUTUR DEV FRONT --> Le code peut paraite compliquer, du coup ignore la moitier du code, il n'y a que 2 endroit a modifier
    // endroit avec du front a modifier "Récapitulatif des information de réservations" et "Formulaire + affichage des erreurs"
    // supprime ce msg après lecture




    // Vérifie si il y a une réservation est sélectionner
    if(!empty($_GET['num']))
    {
        $num = $_GET['num'];
        $queryReserv = $database->prepare('SELECT plld_reservation.*, plld_adherent.name AS adherent_name, plld_adherent.surname AS adherent_surname FROM plld_reservation INNER JOIN plld_adherent ON plld_reservation.num_adherent = plld_adherent.num WHERE plld_reservation.num = :num;');

        $queryReserv->bindParam(':num', $num, PDO::PARAM_INT);
        $queryReserv->execute();
        $reservations = $queryReserv->fetchAll();



        // Affiche la page, si la réservation existe
        if (count($reservations) > 0)
        {
        // Nav bar
        echo '<nav class="navbar navbar-expand-lg navbar-light backgroundDarkBlue fixed-top" id="main-navbar">
                <ul class="navbar-nav navbar-left mb-0" id="main-menu">
                    <li class="nav-item navbar-brand mr-4"><a class="navLink ml-2" href="profil.php">Profil</a></li>
                    <li class="nav-item navbar-brand mr-4"><a class="navLink ml-2" href="reservation.php">Réserver</a></li>
                </ul>';
                if ($autorisation == 1){
                    echo '<li class="nav-item navbar-brand mr-4"><a class="navLink ml-2" href="backOfficeTable.php">BackOffice</a></li>';
                    echo '<li class="nav-item navbar-brand mr-4"><a class="navLink ml-2" href="addPilote.php">AddPilote</a></li>';
                }
            echo '<ul class="navbar-nav mb-0">
                    <li class="nav-item navbar-brand mr-4"><a class="navLink2" href="PHP/deconnecter.php">Se déconnecter</a></li>
                </ul>
            </nav><br><br><br>';
            echo "<br><h2 class='subTitle'>Détails de la réservations</h2>";
            // Récapitulatif des information de réservations
            foreach ($reservations as $reservation)
            {
                $dateDebut = $reservation['date_debut'];
                $dateFin = $reservation['date_fin'];
                echo
                "<div class='reservation'>
                    <div class='info'> Nom : {$reservation['adherent_name']} {$reservation['adherent_surname']} </div>
                    <div class='info'> date de fin : {$dateDebut} </div>
                    <div class='info'> date de fin : {$dateFin} </div>
                    <div class='info'> modèle souhaité : {$reservation['model']} </div>
                    <div class='info'> Status de la réservation {$reservation['status']} </div>
                    <div class='info'> Numéro de la réservation {$reservation['num']} </div>
                </div>";
            }





            // Gestion des erreur
            $errorNum_pilote = (!empty($_POST['num_pilote'])) ? numError($_POST['num_pilote']) : false;
            $errorNum_ulm = (!empty($_POST['num_ulm'])) ? numError($_POST['num_ulm']) : false;
            $errorDate = (!empty($_POST['date'])) ? dateReservError($dateDebut, $dateFin, $_POST['date']) : false;

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (empty($errorNum_pilote))
                {
                    $queryPilote = $database->prepare('SELECT * FROM plld_pilote WHERE num = :num;');
                    $queryPilote->bindParam(':num', $_POST['num_pilote'], PDO::PARAM_INT);
                    $queryPilote->execute();
                    $pilote = $queryPilote->fetchAll();
                    if (count($pilote) === 0) {
                        $errorNum_pilote = '<div class="erreur"> Aucun pilote ne correspond  </div></br>';
                    }
                }
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (empty($errorNum_ulm))
                {
                    $queryUlm = $database->prepare('SELECT * FROM plld_ulm WHERE num = :num;');
                    $queryUlm->bindParam(':num', $_POST['num_ulm'], PDO::PARAM_INT);
                    $queryUlm->execute();
                    $ulm = $queryUlm->fetchAll();
                    if (count($ulm) === 0) {
                        $errorNum_ulm = '<div class="erreur"> Aucun pilote ne correspond  </div></br>';
                    }
                }
            }





            // Formulaire + affichage des erreurs
            echo "<br><h2 class='subTitle'>Formulaire pour gérer les réservations</h2>
            <form class='inscriptionAdherant' action='{$url}' method='post'>";
            echo '<br><input type="number" name="num_pilote" id="" placeholder="Numéro de pilote *"><br>';
            if (!empty($errorNum_pilote)) { echo $errorNum_pilote; }
            
            echo '<br><input type="number" name="num_ulm" id="" placeholder="Numéro d\'ulm *"><br>';
            if (!empty($errorNum_ulm)) { echo $errorNum_ulm; }
            
            echo '<br><label for="date">Date *</label>';
            echo '<input type="date" name="date" id=""><br>';
            if (!empty($errorDate)) { echo $errorDate; }

            echo '<br><input type="submit"><br>';
            


            


            // Envoie a la BDD si il n'y a aucune erreur
            if ($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                // Envoie a la BDD si pas d'erreur
                if (empty($errorNum_pilote) && empty($errorNum_ulm) && empty($errorDate))
                {
                    $query = $database->prepare("UPDATE plld_reservation SET date = :date, num_ulm = :num_ulm, num_pilote = :num_pilote, status = 'accepter' WHERE num = :reservationNum");

                    // Protection contre les injection SQL
                    $query->bindParam(':date', $_POST['date']);
                    $query->bindParam(':num_ulm', $_POST['num_ulm']);
                    $query->bindParam(':num_pilote', $_POST['num_pilote']);
                    $query->bindParam(':reservationNum', $num, PDO::PARAM_INT);

                    $query->execute();
                    $envoyer = "<div class='reussie'> La modification a bien été éffectuer  </div>";
                    if (!empty($envoyer)) {echo $envoyer;}
                }
            }
        }
        else
        {
            echo "aucune réservation ne correspond";
        }
    }
    else
    {
        echo "aucune réservation sélectionner";
    }
    ?>
</body>
</html>