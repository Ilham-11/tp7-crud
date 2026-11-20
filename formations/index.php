
<?php

require_once '../database/connexion.php';

$sql = "SELECT * FROM formations";

$stmt = $pdo->query($sql);


$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des formations</title>
</head>

<body>

<h1>Liste des formations</h1>

<a href="create.php">Ajouter une formation</a>

<table border="1">

<tr>
    <th>ID</th>
    <th>Nom</th>
    <th>Description</th>
    <th>Durée</th>
    <th>Actions</th>
</tr>

<?php foreach ($formations as $f): ?>

<tr>

    <td><?= htmlspecialchars($f['id_formation']) ?></td>

    <td><?= htmlspecialchars($f['nom_formation']) ?></td>

    <td><?= htmlspecialchars($f['description']) ?></td>

    <td><?= htmlspecialchars($f['duree']) ?></td>

    <td>
        <a href="edit.php?id=<?= $f['id_formation'] ?>">
            Modifier
        </a>

        <a href="delete.php?id=<?= $f['id_formation'] ?>">
            Supprimer
        </a>
    </td>

</tr>

<?php endforeach; ?>

</table>

</body>
</html>
