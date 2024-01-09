<?php
session_start();
// Appelle la BDD et de la classe adherent
require_once 'PHP/database.php';
$database = new App\Database\database();
require_once 'PHP/adherent.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Styles/index.css" rel="stylesheet" type="text/css" media="all">
    <link href="Styles/formulaire.css" rel="stylesheet" type="text/css" media="all">
    <link href="Styles/bootstrap/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <title>Connexion</title>
<style>


</style>
</head>
<body>
    <?php
        $error = null;
        // si les champs ont été remplis, effectue la vérification
        if(!empty($_POST['num']) && !empty($_POST['mail']))
        {
            $postNum = $_POST['num'];
            $postmail = $_POST['mail'];

            $query = $database->prepare("SELECT num FROM plld_adherent WHERE num = :num AND mail = :mail");
            $query->bindParam(':num', $postNum);
            $query->bindParam(':mail', $postmail);
            $query->execute();
            $num = $query->fetchColumn();

            // Les identifiants saisis existent
            if ($num !== false) {
                $_SESSION['currentAdherent'] = $num;
                header("Location: reservation.php");
            } else {
                // Les identifiants saisis n'existent pas, renvoie erreur
                $error = "<div class='erreur'> Identifiant incorrectes </div>";
            }
        }
    ?>


    <!-- Formulaire, avec affichage des erreurs -->
    <nav class="navbar navbar-expand-lg navbar-light backgroundDarkBlue fixed-top" id="main-navbar">
            <ul class="navbar-nav navbar-left mb-0" id="main-menu">
                <li class="nav-item navbar-brand mr-4"><a class="navLink ml-2" href="index.html">Accueil</a></li>
            </ul>
            <ul class="navbar-nav mb-0">
                <li class="nav-item navbar-brand mr-4"><a class="navLink2" href="formulaire.php">Inscription</a></li>
                <li class="nav-item navbar-brand"><a class="navLink2" href="connexion.php">Connexion</a></li>
            </ul>
		</nav>	


<div class="margint">
    <h1 class="text-center">Identifiants :</h1>
    <form action="connexion.php" method="post" class="login d-flex flex-column align-items-center">
        <input type="text" name="num" id="" placeholder="Numéro d'adhérent *">
        <input type="text" name="mail" id="" placeholder="Adresse e-mail *">
        <?php if (!empty($error)) { echo $error; } ?>
        <input type="submit" value="Connexion">
    </form>
</div>
</body>
</html>