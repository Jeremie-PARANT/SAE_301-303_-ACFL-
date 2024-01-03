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
    <title>Document</title>
</head>
<body>
<?php
// Gestions des erreurs
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $errorModel = (!empty($_POST['model'])) ? modelError($_POST['model']) : false;
    $errorDate = (!empty($_POST['date_debut']) && !empty($_POST['date_fin'])) ? dateError($_POST['date_debut'], $_POST['date_fin']) : "<div class='erreur'> Les dates sont obligatoires. </div><br>";
}
?>




    <!-- Formulaire, avec affichage des erreurs -->
    <h1>Réservation</h1>
    <div>Veuillez préciser un interval de date de disponibilité</div>
    <form class="reservation" action="reservation.php" method="post">
        <label for="date_debut">Date de début *</label>
        <input type="date" name="date_debut" id=""><br>

        <label for="date_fin">Date de fin *</label>
        <input type="date" name="date_fin" id=""><br>
        <?php if (!empty($errorModel)) { echo $errorModel; } ?>

        <input type="text" name="model" id="" placeholder="Modèle souhaité">
        <?php if (!empty($errorDate)) { echo $errorDate; } ?>

        <input type="submit" value="envoie">
    </form>





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

            }
        }
    ?>
</body>
</html>