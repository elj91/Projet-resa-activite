<?php
session_start();
require 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
   
    $stmt = $pdo->prepare("SELECT * FROM COMPTE WHERE USER = ? AND MDP = ?");
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch();
    if ($user) {
        $_SESSION['user'] = $user;
        header("Location: index.php");
        exit();
    } else {
        $error = "Identifiants invalides";
    }
}


$pageTitle = "Connexion - VVA";
?>


<link rel="stylesheet" href="css/login.css">

<div class="auth-container">
    <form method="post" class="login">
        <h2>Connexion</h2>
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
        <?php if (isset($error)): ?>
            <p><?= $error ?></p>
        <?php endif; ?>
        <div class="auth-footer">
            Vous n'avez pas de compte ? 
            <a href="inscription.php">
                <button type="button">Créer un compte</button>
            </a>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>
