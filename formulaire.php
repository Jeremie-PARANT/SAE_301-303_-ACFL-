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
    <title>Formulaire</title>
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
            if (isset($_POST['pilotage'])) {$activity .= "Cours de pilotage<br>";}
            if (isset($_POST['bapteme'])) {$activity .= "Baptême de l'air<br>";}
            if (isset($_POST['reparation'])) {$activity .= "Cours de réparation<br>";}
            if (!empty($_POST['age'])) {$age = $_POST['age'];} else{$age=null;}
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

                $query2 = $database->prepare("SELECT autorisation FROM plld_adherent WHERE num = :num");
                $query2->bindParam(':num', $newNum);
                $query2->execute();
                $admin = $query2->fetch(PDO::FETCH_ASSOC);
                $autorisation = $admin['autorisation'];
                // Sauvegarder nouveau num, pour afficher dans page de remerciement
                $_SESSION['currentAdherent'] = $newNum;
                $_SESSION['autorisation'] = $autorisation;
                header("Location: remerciement.php");
                
            }
        }
    ?>

<nav class="navbar navbar-expand-lg navbar-light backgroundDarkBlue fixed-top" id="main-navbar">
    <ul class="navbar-nav navbar-left mb-0" id="main-menu">
        <li class="nav-item navbar-brand mr-4"><a class="navLink ml-2" href="index.html">Accueil</a></li>
    </ul>
    <ul class="navbar-nav mb-0">
        <li class="nav-item navbar-brand mr-4"><a class="navLink2" href="formulaire.php">Inscription</a></li>
        <li class="nav-item navbar-brand"><a class="navLink2" href="connexion.php">Connexion</a></li>
    </ul>
</nav>
<br>
    <section>
        <h1 class="ml-5 mt-5 mb-4 sectionTitle">Formulaire</h1>
        <div class="form p-3">
            <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    //Création des des variable optionnel
                    $activity = "";
                    if (isset($_POST['pilotage'])) {$activity .= "Cours de pilotage<br>";}
                    if (isset($_POST['bapteme'])) {$activity .= "Baptême de l'air<br>";}
                    if (isset($_POST['reparation'])) {$activity .= "Cours de réparation<br>";}
                    if (!empty($_POST['age'])) {$age = $_POST['age'];} else{$age=null;}
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
                <div class="d-flex justify-content-around">
                    <div class="flex-column">
                        <h1>Informations personnelles</h1>
                        <div class="d-flex">

                            <!-- Input + affichage des erreurs -->
                            <input class="mx-3 my-2" type="text" name="name" id="" placeholder="Nom *"><br>
                            <?php if (!empty($errorName)) { echo $errorName; } ?>
                                
                            <input class="mx-3 my-2" type="text" name="surname" id="" placeholder="Prénom *"><br>
                            <?php if (!empty($errorSurname)) { echo $errorSurname; } ?>
                        </div>
                        <div class="d-flex">
                            <input class="mx-3 my-2" type="text" name="phone" id="" placeholder="Téléphone"><br>
                            <?php if (!empty($errorPhone)) { echo $errorPhone; } ?>

                            <input class="mx-3 my-2" type="number" name="age" id="" placeholder="Age"><br>
                            <?php if (!empty($errorAge)) { echo $errorAge; } ?>
                        </div>
                        <input class="mail my-2" type="text" name="mail" id="" placeholder="Email *"><br>
                        <?php if (!empty($errorMail)) { echo $errorMail; } ?>
                    </div>

                    <!-- Activité -->
                    <div class="flex-column">
                        <div class="px-4 d-flex align-items-center">
                            <div class="px-3 flex-column">
                                <h2>Activités</h2>
                                <div class="checkbox">
                                    <input type="checkbox" id="" name="pilotage" />
                                    <label class="px-2" for="scales">Cours de Pilotage</label>
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" id="" name="bapteme" />
                                    <label class="px-2" for="scales">Baptême de l’air</label>
                                </div>
                            </div>
                            <div class="flex-column">
                                <div class="checkbox">
                                    <input type="checkbox" id="" name="reparation" />
                                    <label class="px-2" for="scales">Cours de réparation</label>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

                <!-- Input + affichage des erreurs -->
                <input class="other my-2" type="text" name="other" id="" placeholder="Other"><br>
                <?php if (!empty($errorOther)) { echo $errorOther; } ?>
                <!-- Bouton submit -->
                <input class="mx-auto my-3" type="submit">
            </form>
        </div>
    </section>
    
    <script>
    // Fonction pour afficher l'alerte
    function showAlert() {
        return "Attention ! Vous avez des informations non sauvegardées. Êtes-vous sûr de vouloir quitter cette page ?";
    }

    // Attachement de l'événement "beforeunload" pour détecter la tentative de fermeture de la page
    $(window).on('beforeunload', function () {
        // Vérifie si des champs du formulaire ont été remplis
        var formFields = $('form :input').filter(function () {
            return $.trim($(this).val()).length > 0;
        });

        // Affiche l'alerte si des champs sont remplis
        if (formFields.length > 0) {
            return showAlert();
        }
    });

    // Attachement de l'événement "submit" pour vider les champs lorsque le formulaire est soumis
    $('form').submit(function () {
        $(window).off('beforeunload');
    });
</script>

    
</body>
</html>

