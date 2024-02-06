<?php

require_once('./cdb.php');
// Vérifie si le formulaire a été soumis
if(isset($_POST["submit"])) {
    // Vérifie si le fichier a été téléchargé sans erreurs
    if(isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        // Récupère le contenu du fichier téléchargé
        $file_content = file_get_contents($_FILES["file"]["tmp_name"]);

        // Connexion à la base de données (utilisez votre propre code de connexion ici)
        //$db = new PDO("mysql:host=localhost;dbname=shell;charset=utf8", "sulo", "666");

        // Préparez la requête d'insertion
        $query = "INSERT INTO pub5 (nom, contenu) VALUES (:nom, :contenu)";

        // Utilisez une déclaration préparée pour éviter les injections SQL
        $stmt = $db->prepare($query);

        // Associez les valeurs aux paramètres
        $nom = $_FILES["file"]["name"];
        $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindParam(":contenu", $file_content, PDO::PARAM_LOB);

        // Exécutez la requête
        if ($stmt->execute()) {
            echo "Le fichier a été téléchargé et enregistré dans la base de données avec succès.";
        } else {
            echo "Une erreur s'est produite lors de l'enregistrement du fichier dans la base de données.";
        }
    } else {
        echo "Erreur lors du téléchargement du fichier.";
    }
}

?>
<br>
<br>
<html>

  <a href="add_supp_files.php">Retour vers la page de telechargement</a>

  </html>