<?php
// Activer l'affichage des erreurs
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Récupérer le code depuis l'URL
$code = $_GET['code'] ?? '';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Confirmation d'inscription</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      padding: 40px;
      text-align: center;
    }
    .card {
      background: white;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      display: inline-block;
    }
    h1 {
      color: #2c3e50;
    }
    .code {
      font-size: 24px;
      font-weight: bold;
      color: #27ae60;
      margin-top: 20px;
    }
    .btn {
      margin-top: 30px;
      padding: 10px 20px;
      background: #3498db;
      color: white;
      border: none;
      border-radius: 5px;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="card">
    <h1>🎉 Inscription réussie !</h1>
    <p>Merci pour votre inscription. Voici votre code étudiant :</p>
    <div class="code"><?= htmlspecialchars($code) ?></div>
    <a href="index.html" class="btn">Retour à l'accueil</a>
  </div>
</body>
</html>