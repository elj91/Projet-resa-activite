<?php
require 'config/db.php';
include 'header.php';

// Requête pour récupérer les activités et les participants
$sql = "
    SELECT 
        a.CODEANIM,
        a.DATEACT,
        a.PRIXACT,
        a.NOMRESP,
        a.PRENOMRESP,
        i.USER,
        i.DATEINSCRIP,
        i.NOINSCRIP
    FROM ACTIVITE a
    LEFT JOIN INSCRIPTION i ON a.CODEANIM = i.CODEANIM AND a.DATEACT = i.DATEACT
    ORDER BY a.CODEANIM, a.DATEACT, i.USER
";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Organiser les données par activité
$activites = [];
foreach ($results as $row) {
    $key = $row['CODEANIM'] . '|' . $row['DATEACT'];

    if (!isset($activites[$key])) {
        $activites[$key] = [
            'CODEANIM' => $row['CODEANIM'],
            'DATEACT' => $row['DATEACT'],
            'PRIXACT' => $row['PRIXACT'],
            'NOMRESP' => $row['NOMRESP'],
            'PRENOMRESP' => $row['PRENOMRESP'],
            'PARTICIPANTS' => [],
        ];
    }

    if (!empty($row['USER'])) {
        $activites[$key]['PARTICIPANTS'][] = [
            'USER' => $row['USER'],
            'DATEINSCRIP' => $row['DATEINSCRIP'],
            'NOINSCRIP' => $row['NOINSCRIP'],
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Afficher les Participants</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
         body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f8fa;
        }

        header {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 15px 0;
        }

        main {
            max-width: 1200px;
            margin: 30px auto;
            padding: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .activity-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }

        .activity-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            font-size: 1.2em;
            font-weight: bold;
        }

        .activity-content {
            padding: 20px;
        }

        .activity-content p {
            margin: 10px 0;
            font-size: 16px;
            color: #333;
        }

        h3 {
            color: #007bff;
            font-size: 1.1em;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #007bff;
            color: white;
            font-size: 16px;
        }

        table td {
            font-size: 15px;
            color: #333;
        }

        table tbody tr:hover {
            background-color: #f7f8fa;
        }

        .no-participants {
            font-style: italic;
            color: #888;
            margin-top: 20px;
        }

        form {
            display: inline-block;
        }

        button {
            background-color: #e74c3c; /* Rouge plus doux */
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            display: inline-block;
            text-align: center;
        }

        button:hover {
            background-color: #c0392b; /* Rouge plus foncé pour le survol */
            transform: scale(1.05); /* Légère augmentation de taille au survol */
        }

        button:focus {
            outline: none;
        }

        button:active {
            background-color: #bd2d28; /* Couleur active plus foncée */
            transform: scale(1); /* Réinitialise la taille après le clic */
        }

        button {
            font-weight: bold;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Activités et Participants</h1>
    </header>
    <main>
        <!-- Affichage du message de succès ou d'erreur -->
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div style="background-color: #28a745; color: white; padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 20px;">
                Le participant a été supprimé avec succès.
            </div>
        <?php elseif (isset($_GET['error']) && $_GET['error'] == 1): ?>
            <div style="background-color: #dc3545; color: white; padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 20px;">
                Une erreur est survenue lors de la suppression du participant.
            </div>
        <?php endif; ?>

        <?php foreach ($activites as $key => $activite): ?>
            <div class="activity-card">
                <div class="activity-header">
                    Activité : <?= htmlspecialchars($activite['CODEANIM']) ?> 
                    (<?= htmlspecialchars($activite['DATEACT']) ?>)
                </div>
                <div class="activity-content">
                    <p><strong>Responsable :</strong> <?= htmlspecialchars($activite['NOMRESP']) ?> <?= htmlspecialchars($activite['PRENOMRESP']) ?></p>
                    <p><strong>Prix :</strong> <?= htmlspecialchars($activite['PRIXACT']) ?> €</p>
                    
                    <h3>Participants :</h3>
                    <?php if (!empty($activite['PARTICIPANTS'])): ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Utilisateur</th>
                                    <th>Date d'Inscription</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($activite['PARTICIPANTS'] as $participant): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($participant['USER']) ?></td>
                                        <td><?= htmlspecialchars($participant['DATEINSCRIP']) ?></td>
                                        <td>
                                            <form method="POST" action="supprimer_participant.php">
                                                <input type="hidden" name="noinscrip" value="<?= htmlspecialchars($participant['NOINSCRIP']) ?>">
                                                <input type="hidden" name="user" value="<?= htmlspecialchars($participant['USER']) ?>">
                                                <input type="hidden" name="codeanim" value="<?= htmlspecialchars($activite['CODEANIM']) ?>">
                                                <input type="hidden" name="dateact" value="<?= htmlspecialchars($activite['DATEACT']) ?>">
                                                <button type="submit">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="no-participants">Aucun participant inscrit pour cette activité.</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </main>
</body>
</html>
