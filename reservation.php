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
    <title>Réservation</title>
    <link href="Styles/index.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="Styles/reservation.css">
    <link rel="stylesheet" href="Styles/formulaire.css">
    <link href="Styles/bootstrap/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>
<?php
// Gestions des erreurs
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $errorModel = (!empty($_POST['model'])) ? modelError($_POST['model']) : false;
    $errorDate = (!empty($_POST['date_debut']) && !empty($_POST['date_fin'])) ? dateError($_POST['date_debut'], $_POST['date_fin']) : "<div class='erreur'> Les dates sont obligatoires. </div><br>";
}

    //Navbar
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
            </nav><br><br><br>';

            ?>


    <!-- Formulaire, avec affichage des erreurs -->
    <h1 class="couleur-titre">Réservation :</h1>
<div class="backgroundcolor2 w-50 mx-auto">


    <!-- Formulaire, avec affichage des erreurs -->

    <div class="mb-3">Veuillez préciser un interval de date de disponibilité :</div>
    <form class="reservation" action="reservation.php" method="post">
        <label class="mb-3" for="date_debut">Date de début *</label>
        <input type="date" name="date_debut" id=""><br>

        <label class="mb-3"  for="date_fin">Date de fin *</label>
        <input type="date" name="date_fin" id=""><br>
        <?php if (!empty($errorModel)) { echo $errorModel; } ?>

        <input class="mb-4" type="text" name="model" id="" placeholder="Modèle souhaité">
        <?php if (!empty($errorDate)) { echo $errorDate; } ?>
        <br>
        <input class="d-block mx-auto" type="submit" value="envoie">
    </form>
</div>





    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            // Envoie a la BDD si pas d'erreur
            if (empty($errorDate) && empty($errorModel))
            {
                if (empty($_POST['model'])) {$model = "";} else {$model = $_POST['model'];}

                $query = $database->prepare("INSERT INTO plld_reservation(date_debut, date_fin, model, status, num_adherent) VALUES (:date_debut, :date_fin, :model, 'en attente', $CurrentNum)");

                // Protection contre les injection SQL
                $query->bindParam(':date_debut', $_POST['date_debut']);
                $query->bindParam(':date_fin', $_POST['date_fin']);
                $query->bindParam(':model', $model);

                $query->execute();
                header("Location: pageInfo.php");
            }
        }
    ?>
</body>
</html>