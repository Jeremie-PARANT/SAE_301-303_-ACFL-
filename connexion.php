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
    <title>Connexion</title>
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
                // Les identifiants saisis n'existent pas
                $error = "<div class='erreur'> Identifiant incorrectes </div>";
            }
        }
    ?>



    <form action="connexion.php" method="post">
        <input type="text" name="num" id="" placeholder="Numéro d'adhérent *">
        <input type="text" name="mail" id="" placeholder="Adresse e-mail *">
        <?php if (!empty($error)) { echo $error; } ?>
        <input type="submit" value="Connexion">
    </form>
</body>
</html>