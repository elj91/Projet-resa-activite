<?php
require 'config/db.php';
include 'header.php';


// Récupérer la liste des animations pour la sélection lors de l'ajout d'une activité
$animations = $pdo->query("SELECT CODEANIM, NOMANIM FROM ANIMATION")->fetchAll();
$activites = $pdo->query("SELECT CODEANIM, DATEACT, NOMRESP, PRENOMRESP FROM ACTIVITE")->fetchAll();
$etatsActivite = $pdo->query("SELECT CODEETATACT, NOMETATACT FROM ETAT_ACT")->fetchAll();
$typeAnimations = $pdo->query("SELECT CODETYPEANIM, NOMTYPEANIM FROM TYPE_ANIM")->fetchAll();

// Nouvelle requête pour récupérer les difficultés uniques depuis la colonne DIFFICULTEANIM dans ANIMATION
$difficultes = $pdo->query("SELECT DISTINCT DIFFICULTEANIM FROM ANIMATION")->fetchAll();


// Gérer la suppression d'une activité
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer_activite'])) {
    list($codeAnim, $dateAct) = explode('|', $_POST['activite']);
    $stmt = $pdo->prepare("DELETE FROM ACTIVITE WHERE CODEANIM = :codeAnim AND DATEACT = :dateAct");
    $stmt->execute(['codeAnim' => $codeAnim, 'dateAct' => $dateAct]);
    echo "<p>L'activité a été supprimée avec succès.</p>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Activités</title>
    <link rel="stylesheet" href="css/gestion.css">
</head>
<body>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Gestion</title>
</head>
<body>
    <header class="navbar">
        <div class="navbar-container">
            <h1 class="navbar-title">Gestion</h1>
            <nav class="navbar-links">
                <a href="suppression.php" class="nav-button">Supprimer Activité</a>
                <?php if ($userType === 'ad' || $userType === 'en'): ?>
                    <a href="ajt_act.php" class="nav-button">Ajouter Activité</a>
                    <a href="ajt_anim.php" class="nav-button">Ajouter Animation</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
</body>
</html>


    <!-- Formulaire pour supprimer une activité -->
    <h2>Supprimer une Activité</h2>
    <form action="suppression.php" method="post">
        <label for="activite">Sélectionnez une activité à supprimer :</label>
        <select name="activite" id="activite" required>
            <?php foreach ($activites as $activite): ?>
                <option value="<?= htmlspecialchars($activite['CODEANIM']) . '|' . htmlspecialchars($activite['DATEACT']) ?>">
                    <?= htmlspecialchars($activite['NOMRESP']) . ' ' . htmlspecialchars($activite['PRENOMRESP']) . ' - ' . htmlspecialchars($activite['DATEACT']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <button type="submit" name="supprimer_activite">Supprimer l'Activité</button>
    </form>
    </body>
</html>

<?php
// Inclusion du footer
include 'footer.php';
?>
