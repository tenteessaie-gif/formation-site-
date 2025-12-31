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

$result = $conn->query("SELECT * FROM etudiants ORDER BY date_inscription DESC");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Liste des étudiants inscrits</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    h2 { color: #333; }
    input[type="text"] {
      padding: 8px;
      width: 320px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    table {
      border-collapse: collapse;
      width: 100%;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
      vertical-align: top;
    }
    th {
      background-color: #f7f7f7;
      cursor: pointer;
    }
    tr:hover {
      background-color: #fafafa;
    }
    .muted { color: #666; font-size: 12px; }
  </style>
</head>
<body>

<h2>Liste des étudiants inscrits</h2>
<input type="text" id="searchInput" placeholder="🔍 Rechercher par nom, email ou ville...">

<table id="etudiantsTable" data-sort="asc">
  <thead>
    <tr>
      <th onclick="sortTable(0)">ID</th>
      <th onclick="sortTable(1)">Nom</th>
      <th onclick="sortTable(2)">Prénom</th>
      <th onclick="sortTable(3)">Email</th>
      <th onclick="sortTable(4)">Téléphone</th>
      <th onclick="sortTable(5)">Ville</th>
      <th onclick="sortTable(6)">Pays</th>
      <th onclick="sortTable(7)">Classe</th>
      <th onclick="sortTable(8)">Profession</th>
      <th onclick="sortTable(9)">Niveau Info</th>
      <th onclick="sortTable(10)">Niveau Formation</th>
      <th onclick="sortTable(11)">Code</th>
      <th onclick="sortTable(12)">Date</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if ($result && $result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".htmlspecialchars($row['id'])."</td>
                <td>".htmlspecialchars($row['nom'])."</td>
                <td>".htmlspecialchars($row['prenom'])."</td>
                <td>".htmlspecialchars($row['email'])."</td>
                <td>".htmlspecialchars($row['telephone'])."</td>
                <td>".htmlspecialchars($row['ville'])."</td>
                <td>".htmlspecialchars($row['pays'])."</td>
                <td>".htmlspecialchars($row['classe'])."</td>
                <td>".htmlspecialchars($row['profession'])."</td>
                <td>".htmlspecialchars($row['niveau_informatique'])."</td>
                <td>".htmlspecialchars($row['niveau_formation'])."</td>
                <td>".htmlspecialchars($row['code'])."</td>
                <td>".htmlspecialchars($row['date_inscription'])."</td>
              </tr>";
      }
    } else {
      echo "<tr><td colspan='13'>⚠️ Aucun étudiant inscrit pour le moment.</td></tr>";
    }
    $conn->close();
    ?>
  </tbody>
</table>

<p class="muted">Astuce : cliquez sur un en-tête pour trier, tapez dans la barre pour filtrer.</p>

<script>
// Recherche dynamique
document.getElementById("searchInput").addEventListener("keyup", function() {
  const filter = this.value.toLowerCase();
  const rows = document.querySelectorAll("#etudiantsTable tbody tr");
  rows.forEach(row => {
    const nom = row.cells[1].textContent.toLowerCase();
    const email = row.cells[3].textContent.toLowerCase();
    const ville = row.cells[5].textContent.toLowerCase();
    row.style.display = (nom.includes(filter) || email.includes(filter) || ville.includes(filter)) ? "" : "none";
  });
});

// Tri par colonne
function sortTable(n) {
  const table = document.getElementById("etudiantsTable");
  const tbody = table.tBodies[0];
  const rows = Array.from(tbody.rows);
  const asc = table.getAttribute("data-sort") !== "asc";

  rows.sort((a, b) => {
    const x = a.cells[n].textContent.trim().toLowerCase();
    const y = b.cells[n].textContent.trim().toLowerCase();
    return asc ? x.localeCompare(y) : y.localeCompare(x);
  });

  rows.forEach(row => tbody.appendChild(row));
  table.setAttribute("data-sort", asc ? "asc" : "desc");
}
</script>

</body>
</html>
