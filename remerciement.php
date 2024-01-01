<?php
    session_start();
    // Appelle la BDD et de la classe adherent
    require_once 'PHP/database.php';
    $database = new App\Database\database();
    require_once 'PHP/adherent.php';
    if (!empty($_SESSION['currentAdherent'])){$currentAdherent = $_SESSION['currentAdherent'];}
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="Styles/index.css" rel="stylesheet" type="text/css" media="all">
    <link href="Styles/formulaire.css" rel="stylesheet" type="text/css" media="all">
    <link href="Styles/bootstrap/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>
    <?php
        if (!empty($currentAdherent)) {
            // Get les information de l'utlisateur actuel
            $query = $database->query("SELECT * FROM plld_adherent WHERE num=$currentAdherent");
            $query->execute();
            $rows = $query->fetchAll(PDO::FETCH_ASSOC);

            // Affiche les information de l'utilisateur actuel
            foreach ($rows as $row) {
                echo "Nom: " . $row['name'] . $row['surname'] . "<br>";
                echo "Age: " . $row['age'] . "<br>";
                echo "Némero de téléphone: " . $row['phone'] . "<br>";
                echo "Email: " . $row['mail'] . "<br>";
                echo "Numéro d'adhérent: " . $row['num'] . "<br>";
                echo "Information complémentaires: " . $row['other'] . "<br>";
                echo "Activité: " . $row['activity'] . "<br>";
            }
        }
    ?>
</body>
</html>