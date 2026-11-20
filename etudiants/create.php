
<?php

require_once '../database/connexion.php';


$sql = "SELECT * FROM formations";

$stmt = $pdo->query($sql);

$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $id_formation = $_POST['id_formation'];

    $sql = "INSERT INTO etudiants
            (nom, prenom, email, id_formation)
            VALUES (?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $nom,
        $prenom,
        $email,
        $id_formation
    ]);

    header("Location: index.php");
    exit();
}

?>

<h1>Ajouter un étudiant</h1>

<form method="POST">

    <label>Nom :</label>
    <input type="text" name="nom" required>

    <br><br>

    <label>Prénom :</label>
    <input type="text" name="prenom" required>

    <br><br>

    <label>Email :</label>
    <input type="email" name="email" required>

    <br><br>

    <label>Formation :</label>

    <select name="id_formation" required>

        <option value="">Choisir une formation</option>

        <?php foreach ($formations as $f): ?>

            <option value="<?= $f['id_formation'] ?>">

                <?= htmlspecialchars($f['nom_formation']) ?>

            </option>

        <?php endforeach; ?>

    </select>

    <br><br>

    <button type="submit">Ajouter</button>

</form>
