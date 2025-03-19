
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

// Gérer l'ajout d'une animation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter_animation'])) {
    $codeAnim = $_POST['codeanim'];
    $codeTypeAnim = $_POST['codetypeanim'];
    $nomAnim = $_POST['nomanim'];
    $dureeAnim = $_POST['dureeanimm'];
    $limiteAge = $_POST['limiteage'];
    $tarifAnim = $_POST['tarifanim'];
    $nbrePlaceAnim = $_POST['nbreplaceanim'];
    $descriptAnim = $_POST['descriptanim'];
    $difficulteAnim = $_POST['difficulteanim'];
    $stmt = $pdo->prepare("INSERT INTO ANIMATION (CODEANIM, CODETYPEANIM, NOMANIM, DUREEANIM, LIMITEAGE, TARIFANIM, NBREPLACEANIM, DESCRIPTANIM, DIFFICULTEANIM) 
                           VALUES (:codeAnim, :codeTypeAnim, :nomAnim, :dureeAnim, :limiteAge, :tarifAnim, :nbrePlaceAnim, :descriptAnim, :difficulteAnim)");
    $stmt->execute([
        'codeAnim' => $codeAnim,
        'codeTypeAnim' => $codeTypeAnim,
        'nomAnim' => $nomAnim,
        'dureeAnim' => $dureeAnim,
        'limiteAge' => $limiteAge,
        'tarifAnim' => $tarifAnim,
        'nbrePlaceAnim' => $nbrePlaceAnim,
        'descriptAnim' => $descriptAnim,
        'difficulteAnim' => $difficulteAnim
    ]);
    echo "<p>L'animation a été ajoutée avec succès.</p>";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Gestion</title>
    <link rel="stylesheet" href="css/gestion.css">
</head>
<body>
    <header class="navbar">
        <div class="navbar-container">
            <h1 class="navbar-title">Gestion</h1>
            <nav class="navbar-links">
                <a href="suppression.php" class="nav-button">Supprimer Activité</a>
                <?php if ($userType === 'ad'|| $userType === 'en'): ?>
                    <a href="ajt_act.php" class="nav-button">Ajouter Activité</a>
                    <a href="ajt_anim.php" class="nav-button">Ajouter Animation</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
</body>
</html>




<!-- Formulaire pour ajouter une animation -->
<h2>Ajouter une Animation</h2>
<form action="ajt_anim.php" method="post">
    <label for="codeanim">Code de l'Animation :</label>
    <input type="text" name="codeanim" id="codeanim" required><br> <!-- Nouveau champ pour CODEANIM -->

    <label for="codetypeanim">Type d'Animation :</label>
    <select name="codetypeanim" id="codetypeanim" required>
        <?php foreach ($typeAnimations as $type): ?>
            <option value="<?= htmlspecialchars($type['CODETYPEANIM']) ?>">
                <?= htmlspecialchars($type['NOMTYPEANIM']) ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <label for="nomanim">Nom de l'Animation :</label>
    <input type="text" name="nomanim" id="nomanim" required><br>

    <label for="dureeanimm">Durée de l'Animation (en heures) :</label>
    <input type="number" name="dureeanimm" id="dureeanimm" step="0.5"><br>

    <label for="limiteage">Limite d'âge :</label>
    <input type="number" name="limiteage" id="limiteage"><br>

    <label for="tarifanim">Tarif de l'Animation :</label>
    <input type="number" name="tarifanim" id="tarifanim" step="0.01"><br>

    <label for="nbreplaceanim">Nombre de Places :</label>
    <input type="number" name="nbreplaceanim" id="nbreplaceanim"><br>

    <label for="descriptanim">Description de l'Animation :</label>
    <textarea name="descriptanim" id="descriptanim"></textarea><br>

    <label for="difficulteanim">Difficulté :</label>
    <select name="difficulteanim" id="difficulteanim">
        <?php foreach ($difficultes as $difficulte): ?>
            <option value="<?= htmlspecialchars($difficulte['DIFFICULTEANIM']) ?>">
                <?= htmlspecialchars($difficulte['DIFFICULTEANIM']) ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <button type="submit" name="ajouter_animation">Ajouter l'Animation</button>
</form>
</body>
</html>

<?php
// Inclusion du footer
include 'footer.php';
?>
