<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "sql101.infinityfree.com";
$username   = "if0_40789341";
$password   = "Tenteessaie1"; // remplace ici
$dbname     = "if0_40789341_etudiants";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("❌ Connexion échouée : " . $conn->connect_error);
}
echo "✅ Connexion réussie.<br>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom    = $_POST['nom'] ?? '';
    $email  = $_POST['email'] ?? '';
    $classe = $_POST['classe'] ?? '';
    $code   = $_POST['code'] ?? '';

    echo "<h3>Données reçues :</h3>";
    echo "Nom : $nom<br>Email : $email<br>Classe : $classe<br>Code : $code<br>";

    $stmt = $conn->prepare("INSERT INTO etudiants (nom, email, classe, code) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("❌ Erreur préparation requête : " . $conn->error);
    }

    $stmt->bind_param("ssss", $nom, $email, $classe, $code);
    if (!$stmt->execute()) {
        die("❌ Erreur exécution requête : " . $stmt->error);
    }

    echo "<br>✅ Insertion réussie.";
    $stmt->close();
}

$conn->close();
?>
