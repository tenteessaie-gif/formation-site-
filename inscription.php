<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Connexion à la base MySQL
$servername = "sql101.infinityfree.com";
$username   = "if0_40789341";
$password   = "Tenteessaie1"; // remplace ici
$dbname     = "if0_40789341_etudiants";

$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("❌ Connexion échouée : " . $conn->connect_error);
}

// Fonction pour générer un code unique
function genererCode($classe) {
    $prefix = strtoupper(substr($classe, 0, 1));
    $unique = rand(100000, 999999);
    return $prefix . "-" . $unique;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données
    $nom                = $_POST['nom'] ?? '';
    $prenom             = $_POST['prenom'] ?? '';
    $email              = $_POST['email'] ?? '';
    $telephone          = $_POST['telephone'] ?? '';
    $ville              = $_POST['ville'] ?? '';
    $pays               = $_POST['pays'] ?? '';
    $classe             = $_POST['classe'] ?? '';
    $profession         = $_POST['profession'] ?? '';
    $niveau_info        = $_POST['niveau_informatique'] ?? '';
    $niveau_formation   = $_POST['niveau_formation'] ?? '';
    $code               = genererCode($classe);

    // Préparation de la requête
    $stmt = $conn->prepare("INSERT INTO etudiants 
        (nom, prenom, email, telephone, ville, pays, classe, profession, niveau_informatique, niveau_formation, code) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        die("❌ Erreur préparation requête : " . $conn->error);
    }

    $stmt->bind_param("sssssssssss", $nom, $prenom, $email, $telephone, $ville, $pays, $classe, $profession, $niveau_info, $niveau_formation, $code);

    if ($stmt->execute()) {
    $stmt->close();
    // Redirection vers confirmation.php avec le code généré
    header("Location: confirmation.php?code=" . urlencode($code));
    exit();
} else {
    echo "❌ Erreur : " . $stmt->error;
}

$conn->close();
?>
