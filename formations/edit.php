
<?php

require_once '../database/connexion.php';


$id = $_GET['id'];

// Récupérer les informations de la formation
$sql = "SELECT * FROM formations
        WHERE id_formation = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$formation = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si le formulaire est envoyé
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nom = $_POST['nom_formation'];
    $description = $_POST['description'];
    $duree = $_POST['duree'];

    // Modifier les données
    $sql = "UPDATE formations
            SET nom_formation = ?,
                description = ?,
                duree = ?
            WHERE id_formation = ?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $nom,
        $description,
        $duree,
        $id
    ]);

    header("Location: index.php");
    exit();
}

?>

<h1>Modifier une formation</h1>

<form method="POST">

    <label>Nom :</label>

    <input type="text"
           name="nom_formation"
           value="<?= htmlspecialchars($formation['nom_formation']) ?>"
           required>

    <br><br>

    <label>Description :</label>

    <textarea name="description"><?= htmlspecialchars($formation['description']) ?></textarea>

    <br><br>

    <label>Durée :</label>

    <input type="number"
           name="duree"
           value="<?= htmlspecialchars($formation['duree']) ?>"
           required>

    <br><br>

    <button type="submit">Modifier</button>

</form>
