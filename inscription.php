<?php
// Connexion à ta base MySQL sur InfinityFree
$servername = "sql101.infinityfree.com";
$username   = "if0_40789341"; // ton identifiant MySQL
$password   = "TON_MOT_DE_PASSE_MYSQL"; // remplace par ton mot de passe
$dbname     = "if0_40789341_etudiants"; // nom exact de ta base

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("❌ Connexion échouée : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom       = htmlspecialchars($_POST['nom']);
    $email     = htmlspecialchars($_POST['email']);
    $classe    = htmlspecialchars($_POST['classe']);
    $code      = htmlspecialchars($_POST['code']);
    $telephone = isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : "";
    $adresse   = isset($_POST['adresse']) ? htmlspecialchars($_POST['adresse']) : "";

    // Enregistrement dans la base
    $stmt = $conn->prepare("INSERT INTO etudiants (nom, email, classe, code, telephone, adresse) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nom, $email, $classe, $code, $telephone, $adresse);
    $stmt->execute();
    $stmt->close();

    echo "✅ Inscription réussie. Les informations ont été enregistrées.";
}

$conn->close();
?>
