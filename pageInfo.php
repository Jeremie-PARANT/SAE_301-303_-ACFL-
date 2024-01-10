<?php
session_start();
$autorisation = $_SESSION['autorisation'];

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
    <title>Page d'information</title>
    <link href="Styles/index.css" rel="stylesheet" type="text/css" media="all">
    <link href="Styles/formulaire.css" rel="stylesheet" type="text/css" media="all">
    <link href="Styles/bootstrap/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>
    <!-- Navbar -->
    <?php
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
?>
            <br><br><br>

    <h1 class="sectionTitle">Page d'information</h1>
    <div>
        Votre réservation à bien été envoyer. <br>
        Nous comfirmerons votre réservation, ainsi que la date la date précise, dans les jours à venir.
    </div>
    <div id="countdown" class="text-danger">Redirection vers votre profil dans :</div>
    <?php
    /*
        if(!empty($CurrentNum))
        {
            $query = $database->prepare('SELECT * FROM plld_adherent WHERE num = :num');
            $query->bindParam(':num', $CurrentNum, PDO::PARAM_INT);
            $query->execute();
            $adherent = $query->fetch(PDO::FETCH_ASSOC);

             // Vérifier si l'adhérent existe
            if ($adherent) {
                // Information du mail
                $destinataire = $adherent['mail'];
                $sujet = "Confirmation de réservation";
                $headers = "From: votreadresse@example.com\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                $message = "<html><body><h1>Votre réservation a été confirmée</h1><p>Merci M/Mme. {$adherent['name']} {$adherent['surname']} pour avoir réserver un baptème de l'air dans notre club.</p><p>Nous comfirmerons votre réservation, ainsi que la date la date précise, dans les jours à venir.</p></body></html>";

                // envoie du mail
                mail($destinataire, $sujet, $message, $headers);
            }

        }
    */
    ?>
<script>
var seconds = 10;

function updateCountdown() {
    document.getElementById('countdown').innerHTML = "Redirection vers votre profil dans : " + seconds + " secondes";
    seconds--;

    if (seconds < 0) {
        window.location.href = 'profil.php';
    } else {
        setTimeout(updateCountdown, 1000);
    }
}

// Appelle la fonction pour la première fois
updateCountdown();
</script>
</body>