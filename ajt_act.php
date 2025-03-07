<?php
require 'config/db.php';
include 'header.php';



// Gérer l'ajout d'une activité
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter_activite'])) {
    $codeAnim = $_POST['codeanim'];
    $dateAct = $_POST['dateact'];
    $codeEtatAct = $_POST['codeetatact'];
    $hrrdvAct = $_POST['hrrdvact'];
    $prixAct = $_POST['prixact'];
    $hrDebutAct = $_POST['hrdebutact'];
    $hrFinAct = $_POST['hrfinact'];
    $nomResp = $_POST['nomresp'];
    $prenomResp = $_POST['prenomresp'];
    $stmt = $pdo->prepare("INSERT INTO ACTIVITE (CODEANIM, DATEACT, CODEETATACT, HRRDVACT, PRIXACT, HRDEBUTACT, HRFINACT, NOMRESP, PRENOMRESP) 
                           VALUES (:codeAnim, :dateAct, :codeEtatAct, :hrrdvAct, :prixAct, :hrDebutAct, :hrFinAct, :nomResp, :prenomResp)");
    $stmt->execute([
        'codeAnim' => $codeAnim,
        'dateAct' => $dateAct,
        'codeEtatAct' => $codeEtatAct,
        'hrrdvAct' => $hrrdvAct,
        'prixAct' => $prixAct,
        'hrDebutAct' => $hrDebutAct,
        'hrFinAct' => $hrFinAct,
        'nomResp' => $nomResp,
        'prenomResp' => $prenomResp
    ]);
    echo "<p>L'activité a été ajoutée avec succès.</p>";
}

// Récupérer la liste des animations pour la sélection lors de l'ajout d'une activité
$animations = $pdo->query("SELECT CODEANIM, NOMANIM FROM ANIMATION")->fetchAll();
$activites = $pdo->query("SELECT CODEANIM, DATEACT, NOMRESP, PRENOMRESP FROM ACTIVITE")->fetchAll();
$etatsActivite = $pdo->query("SELECT CODEETATACT, NOMETATACT FROM ETAT_ACT")->fetchAll();
$typeAnimations = $pdo->query("SELECT CODETYPEANIM, NOMTYPEANIM FROM TYPE_ANIM")->fetchAll();

// Nouvelle requête pour récupérer les difficultés uniques depuis la colonne DIFFICULTEANIM dans ANIMATION
$difficultes = $pdo->query("SELECT DISTINCT DIFFICULTEANIM FROM ANIMATION")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Gestion</title>
    <style>
        /* Global styles for the navbar */
        .navbar {
            background-color: #333; /* Dark background */
            color: #fff; /* White text */
            padding: 1rem 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-title {
            font-size: 1.5rem;
            margin: 0;
            color: #f0f0f0;
        }

        .navbar-links {
            display: flex;
            gap: 1rem;
        }

        .nav-button {
            text-decoration: none;
            color: #fff;
            background-color: #555;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            font-size: 1rem;
        }

        .nav-button:hover {
            background-color: #777;
            transform: scale(1.05);
        }

        .logout-button {
            background-color: #e63946; /* Red for logout */
        }

        .logout-button:hover {
            background-color: #d62828;
        }
    </style>
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


<!-- Formulaire pour ajouter une activité -->
<h2>Ajouter une Activité</h2>
    <form action="ajt_act.php" method="post">
        <label for="codeanim">Animation :</label>
        <select name="codeanim" id="codeanim" required>
            <?php foreach ($animations as $animation): ?>
                <option value="<?= htmlspecialchars($animation['CODEANIM']) ?>">
                    <?= htmlspecialchars($animation['NOMANIM']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="dateact">Date de l'Activité :</label>
        <input type="date" name="dateact" id="dateact" required><br>

        <label for="codeetatact">État de l'Activité :</label>
        <select name="codeetatact" id="codeetatact" required>
            <?php foreach ($etatsActivite as $etat): ?>
                <option value="<?= htmlspecialchars($etat['CODEETATACT']) ?>">
                    <?= htmlspecialchars($etat['NOMETATACT']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label for="hrrdvact">Heure de Rendez-vous :</label>
        <input type="time" name="hrrdvact" id="hrrdvact"><br>

        <label for="prixact">Prix de l'Activité :</label>
        <input type="number" name="prixact" id="prixact" step="0.01"><br>

        <label for="hrdebutact">Heure de Début :</label>
        <input type="time" name="hrdebutact" id="hrdebutact"><br>

        <label for="hrfinact">Heure de Fin :</label>
        <input type="time" name="hrfinact" id="hrfinact"><br>

        <label for="nomresp">Nom du Responsable :</label>
        <input type="text" name="nomresp" id="nomresp"><br>

        <label for="prenomresp">Prénom du Responsable :</label>
        <input type="text" name="prenomresp" id="prenomresp"><br>

        <button type="submit" name="ajouter_activite">Ajouter l'Activité</button>
    </form>
    </body>
</html>

<?php
// Inclusion du footer
include 'footer.php';
?>