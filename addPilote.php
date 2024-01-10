<?php
session_start();
$autorisation = $_SESSION['autorisation'];
if (empty($autorisation)) {
    // Redirection vers la page connexion
        header("Location: connexion.php");
        exit();
    }
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
    <link rel="stylesheet" href="Styles/reservation.css">
    <link href="Styles/bootstrap/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="Styles/formulaire.css" rel="stylesheet" type="text/css" media="all">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>
<?php
// Gestions des erreurs
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $errorName = (!empty($_POST['namePilote'])) ? nameError($_POST['namePilote']) : "<div class='erreur'> Le nom est obligatoire. </div><br>";
    $errorFirstname = (!empty($_POST['firstnamePilote'])) ? firstnameError($_POST['firstnamePilote']) : "<div class='erreur'> Le prénom est obligatoire. </div><br>";
}


    //navbar
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

    <!-- Formulaire, avec affichage des erreurs -->
    <h1 class="couleur-titre">Ajouter un pilote :</h1>

    <div class="backgroundcolor2 mx-auto text-center p-3 w-50">
    <div class="mb-3">Veuillez préciser le nom et prénom du pilote</div>
    <form class="reservation" action="addPilote.php" method="post">
        <label class="mb-3">Nom du pilote</label>
        <input placeholder="Nom" type="text" name="namePilote" id=""><br>
        <?php if (!empty($errorName)) { echo $errorName; } ?>

        <label class="mb-4">Prénom du pilote</label>
        <input placeholder="Prénom" type="text" name="firstnamePilote" id=""><br>
        <?php if (!empty($errorFirstname)) { echo $errorFirstname; } ?>

        <input type="submit" value="envoi">
    </form>
    </div>
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        // Envoie a la BDD si pas d'erreur
            if (empty($errorName) && empty($errorFirstname)){
            $query = $database->prepare("INSERT INTO plld_pilote(name, surname) VALUES (:namePilote, :firstnamePilote)");

            // Protection contre les injection SQL
            $query->bindParam(':namePilote', $_POST['namePilote']);
            $query->bindParam(':firstnamePilote', $_POST['firstnamePilote']);

            $query->execute();
            echo "<br><p class='text-center'>Le pilote a bien été ajouté</p><br>";
        }
    }
?>
