<?php
session_start();
$userType = $_SESSION['user']['TYPEPROFIL'] ?? null; // Vérifie le type de profil
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Projet</title>
    <link rel="stylesheet" href=""> <!-- Inclure ton CSS -->
    <style>
        /* Variables de couleurs et effets visuels */
:root {
  --primary-color: #4A6FFF;
  --primary-hover: #3457D5;
  --secondary-color: #FF6B6B;
  --text-dark: #333333;
  --text-light: #FFFFFF;
  --bg-light: #F8F9FA;
  --shadow-soft: 0 10px 30px rgba(0, 0, 0, 0.1);
  --shadow-hover: 0 15px 35px rgba(0, 0, 0, 0.2);
  --border-radius: 12px;
  --transition-speed: 0.3s;
}

/* Style du header */
header {
  position: sticky;
  top: 0;
  left: 0;
  width: 100%;
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  z-index: 1000;
  transition: all 0.3s ease;
}

header:hover {
  background: rgba(255, 255, 255, 0.98);
}

.header-container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0.8rem 2rem;
}

/* Style du logo VVA */
header h1 {
  font-size: 2rem;
  font-weight: 700;
  color: var(--text-dark);
  margin: 0;
  position: relative;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  cursor: pointer;
}

/* Ajout d'un icône avant le texte du logo */
header h1::before {
  content: '⛰️';
  font-size: 1.6rem;
  margin-right: 0.5rem;
  transition: transform 0.5s ease;
  display: inline-block;
}

header:hover h1::before {
  transform: rotate(15deg);
}

/* Effet de soulignement au survol */
header h1::after {
  content: '';
  position: absolute;
  bottom: -4px;
  left: 0;
  width: 0;
  height: 3px;
  background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
  transition: width 0.3s ease;
  border-radius: 2px;
}

header h1:hover::after {
  width: 100%;
}

/* Style de la navigation */
header nav {
  display: flex;
  gap: 1rem;
  align-items: center;
}

/* Style des boutons de navigation */
.nav-button {
  background: transparent;
  color: var(--text-dark);
  border: none;
  border-radius: 50px;
  padding: 0.6rem 1.2rem;
  font-size: 0.95rem;
  font-weight: 500;
  text-decoration: none;
  transition: all var(--transition-speed) ease;
  position: relative;
  overflow: hidden;
}

.nav-button::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(74, 111, 255, 0.1);
  transform: translateY(100%);
  transition: transform 0.3s ease;
  border-radius: 50px;
  z-index: -1;
}

.nav-button:hover {
  color: var(--primary-color);
  transform: translateY(-2px);
}

.nav-button:hover::before {
  transform: translateY(0);
}

/* Style pour le bouton administrateur */
.admin-button {
  background: linear-gradient(135deg, var(--primary-color), var(--primary-hover));
  color: var(--text-light);
  border: none;
  border-radius: 50px;
  padding: 0.6rem 1.2rem;
  font-size: 0.95rem;
  font-weight: 500;
  text-decoration: none;
  transition: all var(--transition-speed) ease;
  box-shadow: 0 4px 8px rgba(74, 111, 255, 0.3);
}

.admin-button:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 12px rgba(74, 111, 255, 0.4);
}

/* Animation pour le bouton de déconnexion */
nav a[href="logout.php"] {
  background: var(--secondary-color);
  color: var(--text-light);
  border-radius: 50px;
  padding: 0.6rem 1.2rem;
  font-size: 0.95rem;
  font-weight: 500;
  text-decoration: none;
  transition: all var(--transition-speed) ease;
  box-shadow: 0 4px 8px rgba(255, 107, 107, 0.3);
}

nav a[href="logout.php"]:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 12px rgba(255, 107, 107, 0.4);
  background: #ff5252;
}

/* Responsive design pour la navigation */
@media (max-width: 768px) {
  .header-container {
    flex-direction: column;
    gap: 1rem;
    padding: 1rem;
  }
  
  header nav {
    width: 100%;
    flex-wrap: wrap;
    justify-content: center;
  }
  
  .nav-button, .admin-button {
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
  }
}

@media (max-width: 480px) {
  header nav {
    flex-direction: column;
    gap: 0.5rem;
  }
  
  .nav-button, .admin-button {
    width: 100%;
    text-align: center;
  }
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
