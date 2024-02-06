<?php

require_once('./cdb.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $data = $_POST;

    try {
        // Vérifier les champs du formulaire
        $errors = array();

        if (empty($data["nom"])) {
            $errors[] = "Le champ 'Nom' est vide.";
        }

        if (empty($data["prenom"])) {
            $errors[] = "Le champ 'Prénom' est vide.";
        }

        if (empty($data["mail"])) {
            $errors[] = "Le champ 'Mail' est vide.";
        }

        if (empty($data["sujet"])) {
            $errors[] = "Le champ 'Sujet' est vide.";
        }

        if (empty($data["message"])) {
            $errors[] = "Le champ 'Message' est vide.";
        }

        // Expression régulière pour vérifier la longueur du nom et du prénom (entre 3 et 35 caractères)
        $regexLongueur = '/^.{3,35}$/';
        $regexEmail = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}/';
        $mess = '/^.{5,256}$/';

        // Contrôle des expressions régulières :
        // Vérification de la longueur du nom
        if (!preg_match($regexLongueur, $data["nom"])) {
            $errors[] = "Le nom doit contenir entre 3 et 35 caractères.";
        }

        // Vérification de la longueur du prénom
        if (!preg_match($regexLongueur, $data["prenom"])) {
            $errors[] = "Le prénom doit contenir entre 3 et 35 caractères.";
        }

        // Vérification de la validité de l'adresse email
        if (!preg_match($regexEmail, $data["mail"])) {
            $errors[] = "Adresse email invalide.";
        }

        // Vérification de la longueur du sujet
        if (!preg_match($regexLongueur, $data["sujet"])) {
            $errors[] = "Le sujet doit contenir au moins 3 caractères.";
        }

        // Vérification de la longueur du message
        if (!preg_match($mess, $data["message"])) {
            $errors[] = "Votre message doit contenir entre 5 et 256 caractères.";
        }

        // Si des erreurs sont détectées
        if (!empty($errors)) {
            // Afficher les erreurs en rouge
            echo '<div style="color: red;">';
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
            echo '</div>';

            // Ajouter un bouton de retour vers l'accueil
            echo '<button style="background-color: #808080; color: #fff; padding: 10px 20px; font-size: 16px; border-radius: 10px; margin-top: 10px;"><a href="../Accueil/1.php" style="text-decoration: none; color: #fff;">Accueil</a></button>';
            exit();
        }

        // Préparer la requête d'insertion
        $query = "INSERT INTO message_pub (nom, prenom, mail, sujet, message) VALUES (:nom, :prenom, :mail, :sujet, :message)";

        $statement = $db->prepare($query);

        // Lier les paramètres
        $statement->bindValue(':nom', $data["nom"]);
        $statement->bindValue(':prenom', $data["prenom"]);
        $statement->bindValue(':mail', $data["mail"]);
        $statement->bindValue(':sujet', $data["sujet"]);
        $statement->bindValue(':message', $data["message"]);

        // Exécuter la requête
        $statement->execute();

        // Rediriger vers une page de succès ou afficher un message de succès
        header("Location: ../Accueil/2.php");
        exit();

    } catch (PDOException $e) {
        // Gérer les erreurs de la base de données
        echo "Erreur de la base de données : " . $e->getMessage();
    }
} else {
    // Rediriger vers une page d'erreur
    header("Location: ../Accueil/1.php?msg=C'est une erreur");
    exit();
}
?>
