<?php
session_start();
$userType = $_SESSION['user']['TYPEPROFIL'] ?? null; // Vérifie le type de profil
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Projet</title>
    <link rel="stylesheet" href="css/asset.css"> <!-- Inclure ton CSS -->
    <style>
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #333;
            color: white;
        }
        .header-container h1 {
            margin: 0;
        }
        .header-container nav {
            display: flex;
            gap: 15px;
        }
        .header-container a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .header-container a:hover {
            background-color: #555;
        }
        .admin-button {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-left: 20px;
        }
        .admin-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <h1>VVA</h1>
            <nav>
                <a href="index.php" class="nav-button">Home</a>
                <?php if ($userType === 'ad' || $userType === 'en'): ?>
                    <a href="suppression.php" class="nav-button">Gérer</a>
                    <a href="afficher_participant.php" class="nav-button">Liste Participant</a>
                <?php endif; ?>
                <?php if ($userType === 'ad'): ?>
                    <!-- Bouton spécifique aux administrateurs -->
                    <a href="identifiant.php" class="admin-button">Identifiant</a>
                <?php endif; ?>
                <?php if (isset($_SESSION['user'])): ?>
                    <a href="logout.php" class="nav-button">Déconnexion</a>
                <?php else: ?>
                    <a href="login.php" class="nav-button">Se connecter</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
</body>
</html>
