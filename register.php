<?php
require 'config/db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];

    // Insertion dans la base de données
    $stmt = $pdo->prepare("INSERT INTO COMPTE (USER, MDP, NOMCOMPTE, PRENOMCOMPTE, ADRMAILCOMPTE) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$username, $password, $nom, $prenom, $email])) {
        header("Location: login.php");
        exit();
    } else {
        $error = "Erreur lors de l'inscription";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h2>Inscription</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">S'inscrire</button>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
    </form>
</body>
</html>
