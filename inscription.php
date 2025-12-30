<?php
// ⚠️ Remplace ces valeurs par celles de ta base MySQL sur free.nf
$servername = "sqlXXX.free.nf";   // ton serveur MySQL (ex: sql213.free.nf)
$username   = "ton_user";         // ton identifiant MySQL
$password   = "ton_password";     // ton mot de passe MySQL
$dbname     = "ton_database";     // le nom de ta base

// Connexion à la base
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("❌ Connexion échouée : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer toutes les infos envoyées par le formulaire
    $nomEleve   = htmlspecialchars($_POST['nom']);
    $emailEleve = htmlspecialchars($_POST['email']);
    $classe     = htmlspecialchars($_POST['classe']);
    $code       = htmlspecialchars($_POST['code']);

    // ⚠️ Si tu as d’autres champs (téléphone, adresse, etc.), ajoute-les ici :
    $telephone  = isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : "";
    $adresse    = isset($_POST['adresse']) ? htmlspecialchars($_POST['adresse']) : "";

    // Enregistrer dans la base MySQL
    $stmt = $conn->prepare("INSERT INTO etudiants (nom, email, classe, code, telephone, adresse) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nomEleve, $emailEleve, $classe, $code, $telephone, $adresse);
    $stmt->execute();
    $stmt->close();

    echo "✅ Inscription réussie. Les informations de l’étudiant ont été enregistrées.";
}

$conn->close();
?>
