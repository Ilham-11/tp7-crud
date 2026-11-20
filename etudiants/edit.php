
<?php

require_once '../database/connexion.php';

$id = $_GET['id'];

// Récupérer l'étudiant
$sql = "SELECT * FROM etudiants
        WHERE id_etudiant = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$etudiant = $stmt->fetch(PDO::FETCH_ASSOC);

// Récupérer les formations
$sql = "SELECT * FROM formations";

$formations = $pdo->query($sql)
                  ->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $id_formation = $_POST['id_formation'];

    $sql = "UPDATE etudiants
            SET nom = ?,
                prenom = ?,
                email = ?,
                id_formation = ?
            WHERE id_etudiant = ?";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $nom,
        $prenom,
        $email,
        $id_formation,
        $id
    ]);

    header("Location: index.php");
    exit();
}

?>

<h1>Modifier un étudiant</h1>

<form method="POST">

    <label>Nom :</label>
    <input type="text" name="nom"
           value="<?= htmlspecialchars($etudiant['nom']) ?>">

    <br><br>

    <label>Prénom :</label>
    <input type="text" name="prenom"
           value="<?= htmlspecialchars($etudiant['prenom']) ?>">

    <br><br>

    <label>Email :</label>
    <input type="email" name="email"
           value="<?= htmlspecialchars($etudiant['email']) ?>">

    <br><br>

    <label>Formation :</label>

    <select name="id_formation">

        <?php foreach ($formations as $f): ?>

            <option value="<?= $f['id_formation'] ?>"
                <?= ($f['id_formation'] == $etudiant['id_formation'])
                    ? 'selected' : '' ?>>

                <?= htmlspecialchars($f['nom_formation']) ?>

            </option>

        <?php endforeach; ?>

    </select>

    <br><br>

    <button type="submit">Modifier</button>

</form>
