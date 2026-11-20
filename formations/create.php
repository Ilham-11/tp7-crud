
<?php

require_once '../database/connexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Récupération des données
    $nom = $_POST['nom_formation'];
    $description = $_POST['description'];
    $duree = $_POST['duree'];

    // Préparation de la requête
    $sql = "INSERT INTO formations
            (nom_formation, description, duree)
            VALUES (?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    
    $stmt->execute([
        $nom,
        $description,
        $duree
    ]);

    // Redirection
    header("Location: index.php");
    exit();
}

?>

<h1>Ajouter une formation</h1>

<form method="POST">

    <label>Nom :</label>
    <input type="text" name="nom_formation" required>

    <br><br>

    <label>Description :</label>
    <textarea name="description"></textarea>

    <br><br>

    <label>Durée :</label>
    <input type="number" name="duree" min="1" required>

    <br><br>

    <button type="submit">Ajouter</button>

</form>
