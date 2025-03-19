<?php
require 'config/db.php';
include 'header.php';
$animations = $pdo->query("SELECT * FROM ANIMATION")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Animations</title>
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">
</head>
<body>
    <h2>Liste Des Animations Du Moment</h2>
    <div class="animations-container">
        <?php foreach ($animations as $anim): ?>
            <div class="animation-box" onclick="window.location.href='activities.php?animation=<?php echo $anim['CODEANIM']; ?>'">
                <h3><?php echo $anim['NOMANIM']; ?></h3>
                <p><?php echo $anim['DESCRIPTANIM']; ?></p>
                <button>Voir les activités</button>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>

<?php
// Inclusion du footer
include 'footer.php';
?>
