<?php
// Vérification et démarrage de la session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Inclusion de la gestion de la base de données
require_once('./cdb.php');

// Initialisation de la variable pour stocker les messages d'erreur
$errors = [];

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $data = $_POST;

    // _________________________ regex inscription_______________________________

    try {
        // Vérification des données obligatoires
        if (
            isset($data["nom"]) && isset($data["prenom"]) &&
            isset($data["mail"]) && isset($data["mdp"]) && isset($data["cmdp"])
        ) {
            // Expression régulière pour vérifier la longueur du mot de passe (au moins 8 caractères)
            $regexLongueur = '/^.{2,15}$/';
            $regexEmail = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
            $regexPass = '/^(?=.*[A-Z])(?=.*[!@#$%^&*])/';


            // Vérification de la longueur du nom
            if (!preg_match($regexLongueur, $data["nom"])) {
                $errors[] = "Le nom doit contenir entre 2 et 15 caractères.";
            }

            // Vérification de la longueur du prénom
            if (!preg_match($regexLongueur, $data["prenom"])) {
                $errors[] = "Le prénom doit contenir entre 2 et 15 caractères.";
            }

            // Vérification de la validité de l'adresse email
            if (!preg_match($regexEmail, $data["mail"])) {
                $errors[] = "L'adresse email n'est pas valide.";
            }

            // Vérification du mot de passe
            if (!preg_match($regexPass, $data["mdp"])) {
                $errors[] = "Le mot de passe doit contenir au moins une lettre, un chiffre et un caractère spécial.";
            }

            // Vérification de la confirmation du mot de passe
            if ($data["mdp"] !== $data["cmdp"]) {
                $errors[] = "Les mots de passe ne correspondent pas.";
            }

            // Vérification de l'adresse email avec filter_var
            if (!filter_var($data["mail"], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "L'adresse email n'est pas valide.";
            }
        } else {
            $errors[] = "Erreur : des champs obligatoires sont manquants.";
        }

        // S'il y a des erreurs, elles seront affichées plus tard dans le HTML
        if (empty($errors)) {
            // Hachage des mots de passe
            $data['mdp'] = password_hash($data['mdp'], PASSWORD_DEFAULT);
            $data['cmdp'] = password_hash($data['cmdp'], PASSWORD_DEFAULT);

            // Préparer la requête d'insertion
            $query = "INSERT INTO users (" . implode(", ", array_keys($data)) . ") VALUES (:" . implode(", :", array_keys($data)) . ")";

            $statement = $db->prepare($query);

            // Lier les paramètres
            foreach ($data as $key => $value) {
                $statement->bindValue(':' . $key, $value);
            }

            // Exécuter la requête
            $statement->execute();

            // Rediriger vers une page de succès ou afficher un message de succès
            header("Location: ../Accueil/1.php");
            exit();
        }
    } catch (PDOException $e) {
        // Gérer les erreurs de la base de données
        $errors[] = "Erreur de la base de données : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../Accueil/1.js" defer></script>
    <link rel="stylesheet" href="../Accueil/style.css">
    <style>
        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Affichage des erreurs -->
    <?php
    if (!empty($errors)) {
        echo '<div class="error-message">';
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        echo '</div>';
    }
    ?>
    <img id="logo" src="../Resources PGM/Images /logo.png" alt="Le logo">
      <P class="societe">SNFROL s.à.r.l. / SHOP CENTER</P>
      
      <nav>
  <ul class="navlist">
            <!-- Utilisez la classe "accueil-button" pour le style du bouton Accueil -->
            <li><a href="../Accueil/1.php" class="accueil-button">Accueil</a></li>
            <!-- Ajoutez d'autres éléments de la barre de navigation ici si nécessaire -->
        </ul>
 
  </nav>

    <!-- Form inscription -->
    <form class="form" action="inscription.php" method="POST">
        <div>
            <label for="nom">Nom</label>
            <input type="text" name="nom" value="" required>
        </div>

        <div>
            <label for="prenom">Prenom</label>
            <input type="text" name="prenom" value="" required>
        </div>

        <div>
            <label for="adresse mail">Mail</label>
            <input type="text" name="mail" value="" required>
        </div>

        <div>
            <label for="mdp">Password</label>
            <input type="password" name="mdp" value="" required>
        </div>

        <div>
            <label for="cmdp">Confirm Password</label>
            <input type="password" name="cmdp" value="" required>
        </div>

        <div>
            <label for="role">Sélectionnez un rôle :</label>
            <select id="role" name="role">
                <option value="1">Employés 1</option>
                <option value="2">Gerants 2</option>
                <option value="3">Administrateur 3</option>
            </select>
        </div>

        <div>
            <button id="Envoye">ENVOYER</button>
        </div>
    </form>
</body>

</html>
