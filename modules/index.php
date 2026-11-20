
<?php

require_once '../database/connexion.php';

$sql = "SELECT
            modules.*,
            formations.nom_formation

        FROM modules

        INNER JOIN formations

        ON modules.id_formation =
           formations.id_formation";

$stmt = $pdo->query($sql);

$modules = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<h1>Liste des modules</h1>

<table border="1">

<tr>
    <th>ID</th>
    <th>Nom du module</th>
    <th>Coefficient</th>
    <th>Formation</th>
</tr>

<?php foreach ($modules as $m): ?>

<tr>

    <td><?= htmlspecialchars($m['id_module']) ?></td>

    <td><?= htmlspecialchars($m['nom_module']) ?></td>

    <td><?= htmlspecialchars($m['coefficient']) ?></td>

    <td><?= htmlspecialchars($m['nom_formation']) ?></td>

</tr>

<?php endforeach; ?>

</table>
