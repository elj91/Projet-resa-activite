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
    <title>Activités</title>
    <link rel="stylesheet" href="css/styles1.css">
</head>
<body>
    <h2>Activités Disponibles</h2>
    <div class="activities-container">
        <?php foreach ($activites as $activite): ?>
            <div class="activity-box">
                <h3>Activité : <?php echo $activite['NOMRESP']; ?></h3>
                <p>Heure de début : <?php echo $activite['HRDEBUTACT']; ?></p>
                <p>Heure de fin : <?php echo $activite['HRFINACT']; ?></p>
                <p>Prix : <?php echo $activite['PRIXACT']; ?>€</p>
                <form method="post" action="register_activity.php">
                    <input type="hidden" name="activity_code" value="<?php echo $activite['CODEANIM']; ?>">
                    <input type="hidden" name="activity_date" value="<?php echo $activite['DATEACT']; ?>">
                    <button type="submit">S'inscrire</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
<?php
// Inclusion du footer
include 'footer.php';
?>
