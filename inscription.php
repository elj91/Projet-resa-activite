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
            $_SESSION['user'] = ['username' => $username];
            header("Location: login.php");
            exit();
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
    <title>Inscription</title>
    <style>
        /* Style global */
        body {
            font-family: Arial, sans-serif;
            background-image: url('fond.jpg'); /* Image de fond */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Style du conteneur principal */
        form {
            background-color: rgba(255, 255, 255, 0.8); /* Fond blanc avec transparence */
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

    </style>
</head>
<body>
    <form method="post">
        <h2>Inscription</h2>
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">S'inscrire</button>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
    </form>
</body>
</html>


<?php
// Inclusion du footer
include 'footer.php';
?>