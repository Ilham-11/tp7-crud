
<?php

require_once '../database/connexion.php';

$sql = "SELECT
            etudiants.*,
            formations.nom_formation

        FROM etudiants

        INNER JOIN formations

        ON etudiants.id_formation =
           formations.id_formation";

$stmt = $pdo->query($sql);

$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<h1>Liste des étudiants</h1>

<table border="1">

<tr>
    <th>ID</th>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Email</th>
    <th>Formation</th>
</tr>

<?php foreach ($etudiants as $e): ?>

<tr>

    <td><?= htmlspecialchars($e['id_etudiant']) ?></td>

    <td><?= htmlspecialchars($e['nom']) ?></td>

    <td><?= htmlspecialchars($e['prenom']) ?></td>

    <td><?= htmlspecialchars($e['email']) ?></td>

    <td><?= htmlspecialchars($e['nom_formation']) ?></td>

</tr>

<?php endforeach; ?>

</table>
