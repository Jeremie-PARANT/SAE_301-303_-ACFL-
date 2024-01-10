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
    $errorType = (!empty($_POST['typeULM'])) ? typeError($_POST['typeULM']) : "<div class='erreur'> Le type est obligatoire. </div><br>";
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
    <h1 class="couleur-titre">Ajouter un ULM</h1>
    <div class="backgroundcolor2 mx-auto text-center p-3 w-50 p-3 ">
    <div class="mb-3">Veuillez préciser le type de l'ULM</div>
    <form class="reservation" action="addULM.php" method="post">
        <label class="mb-4">Type de l'ULM</label>
        <input placeholder="Type" type="text" name="typeULM" id=""><br>
        <?php if (!empty($errorType)) { echo $errorType; } ?>

        <input type="submit" value="Envoyer">
    </form>
    </div>
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
    // Envoie a la BDD si pas d'erreur
        /*if (empty($errorType)){*/
        $query = $database->prepare("INSERT INTO plld_ulm(type) VALUES (:typeULM)");

        // Protection contre les injection SQL
        $query->bindParam(':typeULM', $_POST['typeULM']);

        $query->execute();
        echo "<br><p class='text-center'>L'ULM a bien été ajouté</p><br>";
        /*}*/
    }
?>
