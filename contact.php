<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $to = "tenteessaie@gmail.com"; 
    $subject = "Nouveau message depuis le formulaire";
    $body = "Nom: $nom\nEmail: $email\nMessage:\n$message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
        echo "✅ Message envoyé avec succès.";
    } else {
        echo "❌ Une erreur est survenue, le message n'a pas pu être envoyé.";
    }
}
?>
