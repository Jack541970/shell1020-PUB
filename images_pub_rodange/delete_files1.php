<?php
require_once('./cdb.php');

if (isset($_POST["submit"]) && isset($_POST["filesToDelete"])) {
  $filesToDelete = $_POST["filesToDelete"];

  foreach ($filesToDelete as $fileId) {
    // Supprimez le fichier correspondant dans la base de données en utilisant l'ID
    $query = "DELETE FROM pub1 WHERE id = :fileId";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':fileId', $fileId, PDO::PARAM_INT);
    if ($stmt->execute()) {
      echo "Le fichier avec l'ID $fileId a été supprimé avec succès.<br>";
    } else {
      echo "Une erreur s'est produite lors de la suppression du fichier avec l'ID $fileId.<br>";
    }
  }
}

// Redirigez l'utilisateur vers la page précédente ou une autre page après la suppression
// header("Location: previous_page.php"); // Décommentez cette ligne et changez l'URL si nécessaire
?>

<br>
<br>
<html>

<a href="add_supp_files.php">Retour vers la page de telechargement</a>

  </html>