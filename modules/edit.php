
<?php

require_once '../database/connexion.php';

$id = $_GET['id'];

// Récupérer le module
$sql = "SELECT * FROM modules
        WHERE id_module = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$module = $stmt->fetch(PDO::FETCH_ASSOC);

// Récupérer les formations
$sql = "SELECT * FROM formations";

$formations = $pdo->query($sql)
                  ->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nom = $_POST['nom_module'];
    $coefficient = $_POST['coefficient'];
    $id_formation = $_POST['id_formation'];

    $sql = "UPDATE modules
            SET nom_module = ?,
                coefficient = ?,
                id_formation = ?
            WHERE id_module = ?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $nom,
        $coefficient,
        $id_formation,
        $id
    ]);

    header("Location: index.php");
    exit();
}

?>

<h1>Modifier un module</h1>

<form method="POST">

    <label>Nom du module :</label>

    <input type="text" name="nom_module"
           value="<?= htmlspecialchars($module['nom_module']) ?>">

    <br><br>

    <label>Coefficient :</label>

    <input type="number" name="coefficient"
           step="0.01"
           value="<?= htmlspecialchars($module['coefficient']) ?>">

    <br><br>

    <label>Formation :</label>

    <select name="id_formation">

        <?php foreach ($formations as $f): ?>

            <option value="<?= $f['id_formation'] ?>"
                <?= ($f['id_formation'] == $module['id_formation'])
                    ? 'selected' : '' ?>>

                <?= htmlspecialchars($f['nom_formation']) ?>

            </option>

        <?php endforeach; ?>

    </select>

    <br><br>

    <button type="submit">Modifier</button>

</form>
