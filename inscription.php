<?php
// Activer l'affichage des erreurs pour le debug
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

// Récupération des données envoyées par le formulaire invisible
$nom             = $_POST['nom'] ?? '';
$prenom          = $_POST['prenom'] ?? '';
$email           = $_POST['email'] ?? '';
$telephone       = $_POST['telephone'] ?? '';
$ville           = $_POST['ville'] ?? '';
$pays            = $_POST['pays'] ?? '';
$classe          = $_POST['classe'] ?? '';
$profession      = $_POST['profession'] ?? '';
$niveau_info     = $_POST['niveau_informatique'] ?? '';
$niveau_formation= $_POST['niveau_formation'] ?? '';
$code            = $_POST['code'] ?? '';
$paiement        = $_POST['paiement'] ?? ''; // optionnel

// Préparation de la requête
$stmt = $conn->prepare("INSERT INTO etudiants
    (nom, prenom, email, telephone, ville, pays, classe, profession, niveau_informatique, niveau_formation, code, paiement)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die("❌ Erreur préparation requête : " . $conn->error);
}

// Associer les paramètres
$stmt->bind_param(
    "ssssssssssss",
    $nom,
    $prenom,
    $email,
    $telephone,
    $ville,
    $pays,
    $classe,
    $profession,
    $niveau_informatique,
    $niveau_formation,
    $code,
    $paiement
);

// Exécution
if ($stmt->execute()) {
    $stmt->close();
    $conn->close();
    // Redirection vers confirmation.php avec le code
    header("Location: confirmation.php?code=" . urlencode($code));
    exit();
} else {
    die("❌ Erreur exécution : " . $stmt->error);
}
?>
