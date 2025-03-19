<?php
require 'config/db.php';
include 'header.php';
if (isset($_GET['animation'])) {
    $animationCode = $_GET['animation'];
    $activites = $pdo->prepare("SELECT * FROM ACTIVITE WHERE CODEANIM = ?");
    $activites->execute([$animationCode]);
    $activites = $activites->fetchAll();
} else {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activités</title>
    <link rel="stylesheet" href="css/styles1.css?v=<?php echo time(); ?>">
</head>
<body>
    <h2>Activités Disponibles</h2>
    <div class="activities-container">
        <?php if (count($activites) > 0): ?>
            <?php foreach ($activites as $activite): ?>
                <div class="activity-box">
                    <h3><?php echo htmlspecialchars($activite['NOMRESP']); ?></h3>
                    <p><strong>Heure de début :</strong> <?php echo htmlspecialchars($activite['HRDEBUTACT']); ?></p>
                    <p><strong>Heure de fin :</strong> <?php echo htmlspecialchars($activite['HRFINACT']); ?></p>
                    <p><strong>Prix :</strong> <?php echo htmlspecialchars($activite['PRIXACT']); ?>€</p>
                    <form method="post" action="register_activity.php">
                        <input type="hidden" name="activity_code" value="<?php echo htmlspecialchars($activite['CODEANIM']); ?>">
                        <input type="hidden" name="activity_date" value="<?php echo htmlspecialchars($activite['DATEACT']); ?>">
                        <button type="submit">S'inscrire</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-activities">Aucune activité disponible pour cette animation.</div>
        <?php endif; ?>
    </div>
</body>
</html>
<?php include 'footer.php'; ?>
