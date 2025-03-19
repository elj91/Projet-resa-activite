<?php
session_start();
require 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification si l'utilisateur existe déjà
    $stmt = $pdo->prepare("SELECT * FROM COMPTE WHERE USER = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {
        $error = "Ce nom d'utilisateur est déjà pris.";
    } else {
        // Inscription de l'utilisateur
        $stmt = $pdo->prepare("INSERT INTO COMPTE (USER, MDP) VALUES (?, ?)");
        if ($stmt->execute([$username, $password])) {
            $success = "Compte créé avec succès ! Vous pouvez maintenant vous connecter.";
            // Option 1: Redirection automatique
            // $_SESSION['user'] = ['USER' => $username, 'TYPEPROFIL' => 'VA'];
            // header("Location: login.php");
            // exit();
        } else {
            $error = "Erreur lors de l'inscription. Veuillez réessayer.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - VVA</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="auth-container">
        <form method="post" class="signup">
            <h2>Inscription</h2>
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">S'inscrire</button>
            <?php if (isset($error)): ?>
                <p><?= $error ?></p>
            <?php elseif (isset($success)): ?>
                <p class="success"><?= $success ?></p>
            <?php endif; ?>
            <div class="auth-footer">
                Vous avez déjà un compte ? 
                <a href="login.php">
                    <button type="button">Se connecter</button>
                </a>
            </div>
        </form>
    </div>
    
    <?php include 'footer.php'; ?>
</body>
</html>
