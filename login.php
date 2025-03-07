<?php
session_start();
require 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification des identifiants
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
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <style>
        /* Style global */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url('fond.jpg');
            background-size: cover; /* L'image couvrira toute la page */
            background-position: center; /* L'image sera centrée */
            background-repeat: no-repeat; /* L'image ne se répétera pas */


        }

        /* Style du conteneur principal */
        form {
            background: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        /* Style du titre */
        h2 {
            margin-bottom: 20px;
            color: #333333;
            font-size: 24px;
        }

        /* Style des champs d'entrée */
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #dddddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        /* Style des boutons */
        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Style des messages d'erreur */
        p {
            color: #ff0000;
            font-size: 14px;
        }

        /* Style du lien d'inscription */
        p a {
            color: #007BFF;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }

        /* Bouton pour créer un compte */
        p a button {
            background-color: #007BFF;
            width: auto;
            padding: 10px 20px;
        }

        p a button:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
    <form method="post">
        <h2>Connexion</h2>
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
        <p>Vous n'avez pas de compte ? <a href="inscription.php"><button type="button">Créer un compte</button></a></p>
    </form>
</body>
</html>
