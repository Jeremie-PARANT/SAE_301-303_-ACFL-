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
    <title>Document</title>
    <link href="Styles/index.css" rel="stylesheet" type="text/css" media="all">
    <link href="Styles/formulaire.css" rel="stylesheet" type="text/css" media="all">
    <link href="Styles/bootstrap/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Création des des variable optionnel
            $activity = "";
            if (isset($_POST['maintenance'])) {$activity .= "Maintenance des ULM Moteur<br>";}
            if (isset($_POST['montage'])) {$activity .= "Montage des ULM<br>";}
            if (isset($_POST['restauration'])) {$activity .= "Service de restauration rapide<br>";}
            if (isset($_POST['hebergement'])) {$activity .= "Hébergement des stagiaires<br>";}
            if (isset($_POST['location'])) {$activity .= "Location d’emplacement ULM<br>";}
            if (isset($_POST['age'])) {$age = $_POST['age'];} else{$age=null;}
            if (isset($_POST['phone'])) {$phone = $_POST['phone'];} else{$phone=null;}
            if (isset($_POST['other'])) {$other = $_POST['other'];} else{$other="";}

            // Création de la classe adhérent
            if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['mail'])) {
                $newAdherent = new App\Database\adherent($_POST['name'], $_POST['surname'], $_POST['mail'], $age, $phone, $activity, $other);
            }
        
            // Vérification des erreurs
            $errorName = (!empty($_POST['name'])) ? App\Database\adherent::nameError($_POST['name']) : "<div class='erreur'> Le nom est obligatoire. </div><br>";
            $errorSurname = (!empty($_POST['surname'])) ? App\Database\adherent::surnameError($_POST['surname']) : "<div class='erreur'> Le prénom est obligatoire. </div><br>";
            $errorMail = (!empty($_POST['mail'])) ? App\Database\adherent::mailError($_POST['mail']) : "<div class='erreur'> L'email est obligatoire. </div><br>";
            $errorAge = (!empty($_POST['age'])) ? App\Database\adherent::ageError($_POST['age']) : false;
            $errorPhone = (!empty($_POST['phone'])) ? App\Database\adherent::phoneError($_POST['phone']) : false;
            $errorOther = (!empty($_POST['other'])) ? App\Database\adherent::otherError($_POST['other']) : false;
        }
    ?>





    <!-- Formulaire d'inscription -->
    <form class="inscriptionAdherant" action="formulaire.php" method="post">
        <h1>Formulaire d'inscription</h1>
        <!-- Input + affichage des erreurs -->
        <input type="text" name="name" id="" placeholder="Nom *"><br>
        <?php if (!empty($errorName)) { echo $errorName; } ?>
            
        <input type="text" name="surname" id="" placeholder="Prénom *"><br>
        <?php if (!empty($errorSurname)) { echo $errorSurname; } ?>

        <input type="text" name="mail" id="" placeholder="Email *"><br>
        <?php if (!empty($errorMail)) { echo $errorMail; } ?>

        <input type="number" name="age" id="" placeholder="Age"><br>
        <?php if (!empty($errorAge)) { echo $errorAge; } ?>

        <input type="number" name="phone" id="" placeholder="Téléphone"><br>
        <?php if (!empty($errorPhone)) { echo $errorPhone; } ?>

        <input type="text" name="other" id="" placeholder="Other"><br>
        <?php if (!empty($errorOther)) { echo $errorOther; } ?>

        <!-- Activité -->
        <h2>Activité</h2>
        <div class="checkbox">
            <input type="checkbox" id="" name="maintenance" />
            <label for="scales">Maintenance des ULM Moteur</label>
        </div>
        <div class="checkbox">
            <input type="checkbox" id="" name="montage" />
            <label for="scales">Montage des ULM</label>
        </div>
        <div class="checkbox">
            <input type="checkbox" id="" name="restauration" />
            <label for="scales">Service de restauration rapide</label>
        </div>
        <div class="checkbox">
            <input type="checkbox" id="" name="hebergement" />
            <label for="scales">Hébergement des stagiaires</label>
        </div>
        <div class="checkbox">
            <input type="checkbox" id="" name="location" />
            <label for="scales">Location d’emplacement ULM</label>
        </div>

        <!-- Bouton submit -->
        <input type="submit">
    </form>





    <?php
        // Envoie vers BDD
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($errorName) && empty($errorSurname) && empty($errorMail) && empty($errorAge) && empty($errorPhone) && empty($errorOther)) {
                // Récupérer la plus grande id (nouvelle num = maxId + 1)
                $query = $database->query("SELECT MAX(num) as maxId FROM plld_adherent");
                $result = $query->fetch(PDO::FETCH_ASSOC);
                $newNum = $result['maxId'] + 1;

                $query = $database->prepare("INSERT INTO plld_adherent(name, surname, mail, age, phone, activity, other, num) VALUES (:nom, :surname, :mail, :age, :phone, :activity, :other, $newNum)");

                // Protection contre les injection SQL
                $query->bindParam(':nom', $newAdherent->name);
                $query->bindParam(':surname', $newAdherent->surname);
                $query->bindParam(':mail', $newAdherent->mail);
                $query->bindParam(':age', $newAdherent->age);
                $query->bindParam(':phone', $newAdherent->phone);
                $query->bindParam(':activity', $newAdherent->activity);
                $query->bindParam(':other', $newAdherent->other);

                $query->execute();

                // Sauvegarder nouveau num, pour afficher dans page de remerciement
                $_SESSION['currentAdherent'] = $newNum;
                header("Location: remerciement.php");
                
            }
        }
    ?>
    






</body>
</html>

