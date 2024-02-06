<?php
require_once('./cdb.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["filesToManage"])) {
        $selectedFiles = $_POST["filesToManage"];

        // Si le bouton de suppression est cliqué
        if (isset($_POST["delete"])) {
            foreach ($selectedFiles as $fileId) {
                // Implémentez votre logique pour supprimer le fichier avec l'ID $fileId
                $queryDelete = "DELETE FROM pub5 WHERE id = ?";
                $stmtDelete = $db->prepare($queryDelete);

                if ($stmtDelete->execute([$fileId])) {
                    echo "Fichier avec l'ID $fileId supprimé avec succès de pub1.<br>";
                } else {
                    echo "Erreur lors de la suppression du fichier avec l'ID $fileId de pub1.<br>";
                }
            }
        }

        // Si le bouton de copie est cliqué
        if (isset($_POST["copy"])) {
            foreach ($selectedFiles as $fileId) {
                // Récupérez les données du fichier avec l'ID $fileId depuis pub1
                $querySelect = "SELECT nom, contenu FROM pub5 WHERE id = ?";
                $stmtSelect = $db->prepare($querySelect);

                if ($stmtSelect->execute([$fileId])) {
                    $file = $stmtSelect->fetch(PDO::FETCH_ASSOC);

                    if ($file !== false) {
                        // Supprimez le fichier existant dans pub2
                        $queryDeletePub2 = "DELETE FROM pub6";
                        $stmtDeletePub2 = $db->prepare($queryDeletePub2);
                        $stmtDeletePub2->execute();

                        // Insérez les données dans la table pub2
                        $queryInsert = "INSERT INTO pub6 (nom, contenu) VALUES (?, ?)";
                        $stmtInsert = $db->prepare($queryInsert);

                        if ($stmtInsert->execute([$file['nom'], $file['contenu']])) {
                            echo "Fichier " . $file['nom'] . " copié avec succès vers pub2.<br>";
                        } else {
                            echo "Erreur lors de la copie du fichier " . $file['nom'] . " vers pub2.<br>";
                        }
                    } else {
                        echo "Aucun fichier trouvé avec l'ID spécifié dans pub1.<br>";
                    }
                } else {
                    echo "Erreur lors de la récupération des données du fichier depuis pub1.<br>";
                }
            }
        }
    }
}
?>

<br>
<br>

<a href="add_supp_files.php">Retour vers la page de telechargement</a>
