<?php
require 'config/db.php'; // Inclure la connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['noinscrip'])) {
    // Récupérer le numéro d'inscription à supprimer
    $noinscrip = $_POST['noinscrip'];

    // Préparer la requête pour supprimer l'inscription
    $sql = "DELETE FROM INSCRIPTION WHERE NOINSCRIP = :noinscrip";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':noinscrip', $noinscrip, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Rediriger vers la page avec un message de succès
        header("Location: afficher_participant.php?success=1");
        exit();
    } else {
        // Rediriger avec un message d'erreur si la suppression échoue
        header("Location: afficher_participant.php?error=1");
        exit();
    }
} else {
    // Si la requête n'est pas une POST ou que le paramètre noinscrip n'est pas défini
    header("Location: afficher_participant.php");
    exit();
}
