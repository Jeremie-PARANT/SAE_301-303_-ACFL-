<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $firstName = test_input($_POST["firstName"]);
    $lastName = test_input($_POST["lastName"]);
    $email = test_input($_POST["email"]);
    $message = test_input($_POST["message"]);

    // Construire le corps du message
    $email_body = "Nom: $lastName, Prénom: $firstName\n";
    $email_body .= "Email: $email\n\n";
    $email_body .= "Message:\n$message";

    // Envoyer l'e-mail
    $to = "d7shadow54@gmail.com"; // Remplacez par votre adresse e-mail
    $subject = "Nouveau message du formulaire de contact";
    $headers = "From: $email";

    // Utilisation de la fonction mail pour l'exemple (vous pouvez utiliser une bibliothèque comme PHPMailer pour une meilleure gestion des e-mails)
    mail($to, $subject, $email_body, $headers);

    // Réponse pour indiquer le succès
    http_response_code(200);
    echo json_encode(array("message" => "Message envoyé avec succès."));
} else {
    // Réponse en cas de méthode non autorisée
    http_response_code(405);
    echo json_encode(array("message" => "Méthode non autorisée."));
}

// Fonction pour nettoyer et valider les données du formulaire
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
