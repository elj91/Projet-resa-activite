<?php
require 'config/db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie si l'utilisateur est connecté
    if (!isset($_SESSION['user'])) {
        echo "Vous devez être connecté pour vous inscrire.";
        exit();
    }

    // Récupère les informations
    $activityCode = $_POST['activity_code'];
    $activityDate = $_POST['activity_date'];
    $user = $_SESSION['user']['USER']; // Récupère l'identifiant de l'utilisateur

    // Récupérer les dates de séjour de l'utilisateur
    $stmt = $pdo->prepare("SELECT DATEDEBSEJOUR, DATEFINSEJOUR, DATENAISCOMPTE FROM COMPTE WHERE USER = ?");
    $stmt->execute([$user]);
    $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$userDetails) {
        echo "Utilisateur introuvable.";
        exit();
    }

    $startDate = $userDetails['DATEDEBSEJOUR'];
    $endDate = $userDetails['DATEFINSEJOUR'];
    $birthDate = $userDetails['DATENAISCOMPTE'];

    // Vérification si la date de l'activité est comprise dans les dates de séjour
    if ($startDate && $endDate) {
        if ($activityDate < $startDate || $activityDate > $endDate) {
            echo "
            <div style='
                background-color: #fdecea;
                color: #c0392b;
                padding: 15px;
                border: 1px solid #f5b7b1;
                border-radius: 8px;
                text-align: center;
                font-family: Arial, sans-serif;
                margin: 20px auto;
                width: 60%;
            '>
                <strong>Attention :</strong><br>
                La date de l'activité ne correspond pas à vos dates de séjour. Veuillez vérifier et réessayer.
            </div>";
            exit();
        }
    } else {
        echo "Vos dates de séjour ne sont pas définies. Veuillez vérifier votre compte.";
        exit();
    }

    // Vérification de l'âge minimum pour participer à l'animation
    $stmt = $pdo->prepare("SELECT LIMITEAGE, NBREPLACEANIM FROM ANIMATION WHERE CODEANIM = ?");
    $stmt->execute([$activityCode]);
    $activityDetails = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$activityDetails) {
        echo "Activité introuvable.";
        exit();
    }

    $ageLimit = $activityDetails['LIMITEAGE'];
    $remainingPlaces = $activityDetails['NBREPLACEANIM'];

    $currentDate = new DateTime();
    $birthDate = new DateTime($birthDate);
    $age = $currentDate->diff($birthDate)->y;

    if ($age < $ageLimit) {
        echo "
        <div style='
            background-color: #fdecea;
            color: #c0392b;
            padding: 15px;
            border: 1px solid #f5b7b1;
            border-radius: 8px;
            text-align: center;
            font-family: Arial, sans-serif;
            margin: 20px auto;
            width: 60%;
        '>
            <strong>Attention :</strong><br>
            Vous n'avez pas l'âge requis pour participer à cette activité. Age minimum requis : {$ageLimit} ans.
        </div>";
        exit();
    }

    // Vérification des places disponibles
    if ($remainingPlaces <= 0) {
        echo "
        <div style='
            background-color: #fdecea;
            color: #c0392b;
            padding: 15px;
            border: 1px solid #f5b7b1;
            border-radius: 8px;
            text-align: center;
            font-family: Arial, sans-serif;
            margin: 20px auto;
            width: 60%;
        '>
            <strong>Attention :</strong><br>
            Il n'y a plus de places disponibles pour cette activité.
        </div>";
        exit();
    }

    // Insertion de l'inscription dans la base de données
    $stmt = $pdo->prepare("INSERT INTO INSCRIPTION (USER, CODEANIM, DATEACT, DATEINSCRIP) VALUES (?, ?, ?, NOW())");
    if ($stmt->execute([$user, $activityCode, $activityDate])) {
        // Mise à jour du nombre de places disponibles
        $stmt = $pdo->prepare("UPDATE ANIMATION SET NBREPLACEANIM = NBREPLACEANIM - 1 WHERE CODEANIM = ?");
        $stmt->execute([$activityCode]);

        echo "
        <div style='
            background-color: #e9f7ef;
            color: #1d8348;
            padding: 15px;
            border: 1px solid #d4efdf;
            border-radius: 8px;
            text-align: center;
            font-family: Arial, sans-serif;
            margin: 20px auto;
            width: 60%;
        '>
            <strong>Félicitations !</strong><br>
            Votre inscription à l'activité a été enregistrée avec succès.
        </div>";
    } else {
        echo "Erreur lors de l'inscription.";
    }
}
?>
