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
    <title>Page d'information</title>
    <link href="Styles/index.css" rel="stylesheet" type="text/css" media="all">
    <link href="Styles/formulaire.css" rel="stylesheet" type="text/css" media="all">
    <link href="Styles/bootstrap/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light backgroundDarkBlue fixed-top" id="main-navbar">
        <ul class="navbar-nav navbar-left mb-0" id="main-menu">
            <li class="nav-item navbar-brand mr-4"><a class="navLink ml-2" href="#home">Accueil</a></li>
        </ul>
        <ul class="navbar-nav mb-0">
            <li class="nav-item navbar-brand mr-4"><a class="navLink2" href="formulaire.php">Inscription</a></li>
            <li class="nav-item navbar-brand"><a class="navLink2" href="connexion.php">Connexion</a></li>
        </ul>
    </nav><br><br><br>

    <h1 class="sectionTitle">Page d'information</h1>
    <div>
        Votre réservation à bien été envoyer. <br>
        Nous comfirmerons votre réservation, ainsi que la date la date précise, dans les jour a venir.
    </div>
    
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
</body>