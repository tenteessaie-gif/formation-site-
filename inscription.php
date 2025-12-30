<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomEleve = htmlspecialchars($_POST['nom']);
    $emailEleve = htmlspecialchars($_POST['email']);
    $classe = htmlspecialchars($_POST['classe']);
    $codeIntegration = htmlspecialchars($_POST['code']);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'tonemail@gmail.com'; // ton Gmail
        $mail->Password   = 'TON_MOT_DE_PASSE_APPLICATION'; // mot de passe d'application
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('tonemail@gmail.com', 'Administration');
        $mail->addAddress($emailEleve);

        $mail->isHTML(true);
        $mail->Subject = "Votre code d'intégration au cours";
        $mail->Body    = "Bonjour $nomEleve,<br><br>
        Merci pour votre inscription à la classe <b>$classe</b>.<br>
        Voici votre code d'intégration : <b>$codeIntegration</b><br><br>
        Conservez-le précieusement pour accéder à votre cours.";

        $mail->send();
        echo "✅ Votre code d'intégration a été envoyé à votre adresse email.";
    } catch (Exception $e) {
        echo "❌ Erreur lors de l'envoi : {$mail->ErrorInfo}";
    }
}
?>
