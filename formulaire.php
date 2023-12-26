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
<h1>TESTE</h1>
<body>
    <form  action="formulaire.php" method="post">
        <input type="text" name="name" id="" placeholder="Nom"><br>
        <input type="text" name="surname" id="" placeholder="Prénom"><br>
        <input type="text" name="age" id="" placeholder="Age"><br>
        <input type="text" name="phone" id="" placeholder="Tel"><br>
        <input type="text" name="email" id="" placeholder="Email">
        <input type="submit">
    </form>
    
    <?php
    // Appelle la BDD et de la classe adherent
    require_once 'PHP/database.php';
    $database = new App\Database\database();
    require_once 'PHP/adherent.php';

    // Envoie vers BDD


    if (!empty($_POST['name'])) {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];

        $query = $database->prepare("INSERT INTO plld_adherent(name, surname, mail) VALUES ('$name', '$surname', '$email')");
        $query->execute();
    }
    ?>





</body>
</html>

