
<?php

require_once '../database/connexion.php';


$sql = "SELECT * FROM formations";

$stmt = $pdo->query($sql);

$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nom = $_POST['nom_module'];
    $coefficient = $_POST['coefficient'];
    $id_formation = $_POST['id_formation'];

    $sql = "INSERT INTO modules
            (nom_module, coefficient, id_formation)
            VALUES (?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $nom,
        $coefficient,
        $id_formation
    ]);

    header("Location: index.php");
    exit();
}

?>

<h1>Ajouter un module</h1>

<form method="POST">

    <label>Nom du module :</label>
    <input type="text" name="nom_module" required>

    <br><br>

    <label>Coefficient :</label>
    <input type="number" name="coefficient"
           step="0.01" min="0.01" required>

    <br><br>

    <label>Formation :</label>

    <select name="id_formation" required>

        <?php foreach ($formations as $f): ?>

            <option value="<?= $f['id_formation'] ?>">

                <?= htmlspecialchars($f['nom_formation']) ?>

            </option>

        <?php endforeach; ?>

    </select>

    <br><br>

    <button type="submit">Ajouter</button>

</form>
