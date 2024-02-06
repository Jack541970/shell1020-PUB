<?php


require_once('./cdb.php');

// Démarrer la session avant tout autre code
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['mail']) && isset($_POST['mdp'])) {

        // Vérification de l'email
        if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            echo '<div style="text-align: center; margin-top: 20px;"><span style="color: red;">Entrer une adresse e-mail correcte</span></div>';
        } else {

            $sql = "SELECT * FROM users WHERE mail = :mail";
            $req = $db->prepare($sql);
            $req->bindParam(":mail", $_POST['mail']);
            $req->execute();

            $usr = $req->fetch();

            // password_verify permet de vérifier le hachage, il vérifie l'empreinte du mot de passe haché
            if ($usr && password_verify($_POST['mdp'], $usr['mdp'])) {
                $_SESSION['user'] = $usr;

                // Rediriger vers une autre page après une connexion réussie
                header("Location: ../Accueil/1.php");
                exit();
            } else {
                echo '<div style="text-align: center; margin-top: 20px;"><span style="color: red;">Mot de passe incorrect</span></div>';
            }
        }
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
    
    
    
    
</head>

<body>
    
    <img id="logo" src="../Resources PGM/Images /logo.png" alt="Le logo">
  <P class="societe">SNFROL s.à.r.l. / SHOP CENTER</P>


  
  <nav>

  <ul class="navlist">
            <!-- Utilisez la classe "accueil-button" pour le style du bouton Accueil -->
            <li><a href="../Accueil/1.php" class="accueil-button">Accueil</a></li>
            <!-- Ajoutez d'autres éléments de la barre de navigation ici si nécessaire -->
        </ul>
 
  </nav>

    <form class="form" action="connex_users.php" method="post">
        <div>
            <label for="mail">E-mail</label>
            <input type="text" name="mail" value="" required>
        </div>

        <div>
            <label for="mdp">Mot de passe</label>
            <input type="password" name="mdp" id="mdp" placeholder="" required>
        </div>

        <div>
            <button id="Envoye" type="submit">ENVOYER</button>
        </div>
    </form>

</body>

</html>
