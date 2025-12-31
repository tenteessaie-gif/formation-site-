<?php
// Activer l'affichage des erreurs
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Connexion à la base
$servername = "sql101.infinityfree.com";
$username   = "if0_40789341";
$password   = "Tenteessaie1";
$dbname     = "if0_40789341_etudiants";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("❌ Connexion échouée : " . $conn->connect_error);
}

// Récupération des données
$nom               = $_POST['nom'] ?? '';
$prenom            = $_POST['prenom'] ?? '';
$email             = $_POST['email'] ?? '';
$telephone         = $_POST['telephone'] ?? '';
$ville             = $_POST['ville'] ?? '';
$pays              = $_POST['pays'] ?? '';
$classe            = $_POST['classe'] ?? '';
$profession        = $_POST['profession'] ?? '';
$niveau_info       = $_POST['niveau_informatique'] ?? '';
$niveau_formation  = $_POST['niveau_formation'] ?? '';
$code              = $_POST['code'] ?? '';

// Préparation de la requête
$stmt = $conn->prepare("INSERT INTO etudiants 
(nom, Prenom, email, telephone, ville, pays, classe, profession, niveau_informatique, niveau_formation, code)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die("❌ Erreur préparation requête : " . $conn->error);
}

// Association des paramètres
$stmt->bind_param(
    "sssssssssss",
    $nom,
    $prenom,
    $email,
    $telephone,
    $ville,
    $pays,
    $classe,
    $profession,
    $niveau_info,
    $niveau_formation,
    $code
);

// Exécution
if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    header("Location: confirmation.php?code=" . urlencode($code));
    exit();
} else {
    die("❌ Erreur exécution : " . $stmt->error);
}
?>    
