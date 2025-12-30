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

// Requête SQL
$result = $conn->query("SELECT * FROM etudiants");
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
      width: 300px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
    }
    table {
      border-collapse: collapse;
      width: 100%;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: left;
    }
    th {
      background-color: #f2f2f2;
      cursor: pointer;
    }
    tr:hover {
      background-color: #f9f9f9;
    }
  </style>
</head>
<body>

<h2>Liste des étudiants inscrits</h2>
<input type="text" id="searchInput" placeholder="🔍 Rechercher par nom ou email...">

<table id="etudiantsTable">
  <thead>
    <tr>
      <th onclick="sortTable(0)">ID</th>
      <th onclick="sortTable(1)">Nom</th>
      <th onclick="sortTable(2)">Email</th>
      <th onclick="sortTable(3)">Classe</th>
      <th onclick="sortTable(4)">Code</th>
      <th onclick="sortTable(5)">Date d'inscription</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nom']}</td>
                <td>{$row['email']}</td>
                <td>{$row['classe']}</td>
                <td>{$row['code']}</td>
                <td>{$row['date_inscription']}</td>
              </tr>";
      }
    } else {
      echo "<tr><td colspan='6'>⚠️ Aucun étudiant inscrit pour le moment.</td></tr>";
    }
    $conn->close();
    ?>
  </tbody>
</table>

<script>
// Recherche dynamique
document.getElementById("searchInput").addEventListener("keyup", function() {
  let filter = this.value.toLowerCase();
  let rows = document.querySelectorAll("#etudiantsTable tbody tr");
  rows.forEach(row => {
    let nom = row.cells[1].textContent.toLowerCase();
    let email = row.cells[2].textContent.toLowerCase();
    row.style.display = (nom.includes(filter) || email.includes(filter)) ? "" : "none";
  });
});

// Tri par colonne
function sortTable(n) {
  let table = document.getElementById("etudiantsTable");
  let rows = Array.from(table.rows).slice(1);
  let asc = table.getAttribute("data-sort") !== "asc";
  rows.sort((a, b) => {
    let x = a.cells[n].textContent.trim().toLowerCase();
    let y = b.cells[n].textContent.trim().toLowerCase();
    return asc ? x.localeCompare(y) : y.localeCompare(x);
  });
  rows.forEach(row => table.tBodies[0].appendChild(row));
  table.setAttribute("data-sort", asc ? "asc" : "desc");
}
</script>

</body>
</html>
