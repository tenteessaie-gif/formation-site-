<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Connexion à ta base MySQL
$servername = "sql101.infinityfree.com";
$username   = "if0_40789341";
$password   = "Tenteessaie1"; // remplace ici
$dbname     = "if0_40789341_etudiants";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("❌ Connexion échouée : " . $conn->connect_error);
}
echo "✅ Connexion réussie.<br>";

// Vérifier les données reçues
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<h3>Données reçues :</h3>";
    echo "Nom : " . $_POST['nom'] . "<br>";
    echo "Email : " . $_POST['email'] . "<br>";
    echo "Classe : " . $_POST['classe'] . "<br>";
    echo "Code : " . $_POST['code'] . "<br>";

    // Préparer l'insertion
    $nom    = $_POST['nom'];
    $email  = $_POST['email'];
    $classe = $_POST['classe'];
    $code   = $_POST['code'];

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
