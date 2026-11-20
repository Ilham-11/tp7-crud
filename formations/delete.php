
<?php

require_once '../database/connexion.php';

// Récupérer l'identifiant
$id = $_GET['id'];

// Préparer la requête
$sql = "DELETE FROM formations
        WHERE id_formation = ?";

// Exécuter
$stmt = $pdo->prepare($sql);

$stmt->execute([$id]);

// Retourner à la liste
header("Location: index.php");
exit();

?>
