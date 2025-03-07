<?php
require 'config/db.php';  // Inclus votre connexion PDO
include 'header.php';     // Si vous avez un en-tête à inclure

// Requête SQL pour récupérer tous les utilisateurs
$sql = "SELECT USER, MDP FROM COMPTE";

// Préparation et exécution de la requête
$stmt = $pdo->query($sql);

// Début du contenu HTML
echo "<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Liste des Utilisateurs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px 20px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        td {
            color: #333;
        }
        .no-results {
            text-align: center;
            margin-top: 50px;
            font-size: 18px;
            color: #666;
        }
    </style>
</head>
<body>";

// Vérification s'il y a des résultats
if ($stmt->rowCount() > 0) {
    // Début du tableau HTML
    echo "<table>
            <tr>
                <th>Nom d'utilisateur</th>
                <th>Mot de passe</th>
            </tr>";

    // Affichage des données dans le tableau
    while ($row = $stmt->fetch()) {
        echo "<tr>
                <td>" . htmlspecialchars($row["USER"]) . "</td>
                <td>" . htmlspecialchars($row["MDP"]) . "</td>
              </tr>";
    }

    // Fin du tableau HTML
    echo "</table>";
} else {
    // Message si aucun résultat
    echo "<p class='no-results'>Aucun utilisateur trouvé.</p>";
}

// Fin du contenu HTML
echo "</body>
</html>";
?>
