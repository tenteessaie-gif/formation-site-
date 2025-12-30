<?php
$servername = "sql101.infinityfree.com";
$username   = "if0_40789341";
$password   = "TON_MOT_DE_PASSE_MYSQL"; // remplace par ton mot de passe
$dbname     = "if0_40789341_etudiants";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("❌ Connexion échouée : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom       = $_POST['nom'];
    $email     = $_POST['email'];
    $classe    = $_POST['classe'];
    $code      = $_POST['code'];

    $stmt = $conn->prepare("INSERT INTO etudiants (nom, email, classe, code) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nom, $email, $classe, $code);
    $stmt->execute();
    $stmt->close();

    echo "✅ Inscription réussie.";
}

$conn->close();
?>
