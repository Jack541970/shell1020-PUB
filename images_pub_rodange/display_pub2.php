<?php
require_once('./cdb.php');

$query = "SELECT id, nom, contenu FROM pub2";
$stmt = $db->query($query);

echo "<h1>Images de la table pub2</h1>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $id = $row['id'];
    $nom = $row['nom'];
    $contenu = $row['contenu'];

    echo "<p>ID de l'image # $id</p>";
    echo "<img src='data:image/jpeg;base64," . base64_encode($contenu) . "' alt='Image' width='300' height='300'>";
    echo "<br>";
}
?>
