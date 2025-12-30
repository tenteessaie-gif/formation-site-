<?php
// Connexion à ta base MySQL
$servername = "sql101.infinityfree.com";
$username   = "if0_40789341"; // ton identifiant MySQL
$password   = "TON_MOT_DE_PASSE_MYSQL"; // remplace par ton mot de passe
$dbname     = "if0_40789341_etudiants"; // nom exact de ta base

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("❌ Connexion échouée : " . $conn->connect_error);
}

// Requête pour récupérer tous les étudiants
$result = $conn->query("SELECT * FROM etudiants");

echo "<h2>Liste des étudiants inscrits</h2>";
echo "<table border='1' cellpadding='6' cellspacing='0'>";
echo "<tr style='background:#eee;'>
        <th>ID</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Classe</th>
        <th>Code</th>
        <th>Téléphone</th>
        <th>Adresse</th>
        <th>Date d'inscription</th>
      </tr>";

while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['nom']}</td>
            <td>{$row['email']}</td>
            <td>{$row['classe']}</td>
            <td>{$row['code']}</td>
            <td>{$row['telephone']}</td>
            <td>{$row['adresse']}</td>
            <td>{$row['date_inscription']}</td>
          </tr>";
}

echo "</table>";

$conn->close();
?>
