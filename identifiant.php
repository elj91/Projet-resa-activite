<?php
require 'config/db.php';  // Inclus votre connexion PDO
include 'header.php';     // Si vous avez un en-tête à inclure

// Requête SQL pour récupérer tous les utilisateurs
$sql = "SELECT USER, MDP FROM COMPTE";

// Préparation et exécution de la requête
$stmt = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Liste des Utilisateurs</title>
    <link rel="stylesheet" href="css/identifiants.css">
</head>
<body>
    <h1>Liste des Identifiants</h1>
    
    <main>
        <?php
        // Vérification s'il y a des résultats
        if ($stmt->rowCount() > 0): ?>
            <div class="users-card">
                <div class="users-header">
                    <span>Identifiants système</span>
                    <span class="users-badge">
                        <i class="fas fa-users"></i> 
                        <?= $stmt->rowCount() ?> utilisateur(s)
                    </span>
                </div>
                <div class="users-content">
                    <table>
                        <thead>
                            <tr>
                                <th>Nom d'utilisateur</th>
                                <th>Mot de passe</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = $stmt->fetch()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row["USER"]) ?></td>
                                <td><?= htmlspecialchars($row["MDP"]) ?></td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else: ?>
            <p class="no-results">
                <i class="fas fa-info-circle"></i> Aucun utilisateur trouvé.
            </p>
        <?php endif; ?>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
