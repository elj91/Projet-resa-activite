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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activités et Participants</title>
    <link rel="stylesheet" href="css/participe.css">
</head>
<body>
    <!-- Titre principal - Changement important: suppression de la balise header -->
    <h1>Activités et Participants</h1>
    
    <main>
        <!-- Affichage du message de succès ou d'erreur -->
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> Le participant a été supprimé avec succès.
            </div>
        <?php elseif (isset($_GET['error']) && $_GET['error'] == 1): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> Une erreur est survenue lors de la suppression du participant.
            </div>
        <?php endif; ?>

        <?php foreach ($activites as $key => $activite): ?>
            <div class="activity-card">
                <div class="activity-header">
                    <span>Activité : <?= htmlspecialchars($activite['CODEANIM']) ?> 
                    (<?= htmlspecialchars($activite['DATEACT']) ?>)</span>
                    <span class="participants-badge">
                        <i class="fas fa-users"></i> 
                        <?= count($activite['PARTICIPANTS']) ?> participant(s)
                    </span>
                </div>
                <div class="activity-content">
                    <div class="activity-info">
                        <div class="info-item">
                            <p><strong><i class="fas fa-user-tie"></i> Responsable :</strong> <?= htmlspecialchars($activite['NOMRESP']) ?> <?= htmlspecialchars($activite['PRENOMRESP']) ?></p>
                        </div>
                        <div class="info-item">
                            <p><strong><i class="fas fa-tag"></i> Prix :</strong> <?= htmlspecialchars($activite['PRIXACT']) ?> €</p>
                        </div>
                    </div>
                    
                    <h3><i class="fas fa-list"></i> Liste des participants</h3>
                    <?php if (!empty($activite['PARTICIPANTS'])): ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>Utilisateur</th>
                                    <th>Date d'inscription</th>
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
                                                <button type="submit">
                                                    <i class="fas fa-trash-alt"></i> Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="no-participants">
                            <i class="fas fa-info-circle"></i> Aucun participant inscrit pour cette activité.
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
