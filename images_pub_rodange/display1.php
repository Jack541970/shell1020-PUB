<?php
require_once('./cdb.php'); // Incluez cdb.php pour établir la connexion à la base de données

// Le reste du code pour récupérer et afficher le fichier reste inchangé
$id = $_GET['id']; // Assurez-vous de vérifier et valider cette valeur en production pour éviter les failles de sécurité
$query = "SELECT nom, contenu FROM pub1 WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Récupérer le nom et le contenu du fichier
    $nom = $row['nom'];
    $contenu = $row['contenu'];

    // Définir l'en-tête Content-Type en fonction du type de fichier
    if (strpos($nom, '.xlsx')) {
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    } elseif (strpos($nom, '.docx')) {
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    } elseif (strpos($nom, '.pdf')) {
        header('Content-Type: application/pdf');   
    } elseif (strpos($nom, '.jpg') || strpos($nom, '.jpeg')) {
        header('Content-Type: image/jpeg');
    } elseif (strpos($nom, '.png')) {
        header('Content-Type: image/png');
    } else {
        // Gérer d'autres types de fichiers si nécessaire
        header('Content-Type: application/octet-stream');
    }
    

    // Définir l'en-tête Content-Disposition pour afficher le nom du fichier
    header('Content-Disposition: inline; filename="' . $nom . '"');
    
    // Afficher le contenu du fichier dans le navigateur
    echo $contenu;
} else {
    echo "Fichier non trouvé.";
}
?>