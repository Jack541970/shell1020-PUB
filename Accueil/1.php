<?php


require_once("../Accueil/barre_nav.php");

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>





<!DOCTYPE html>
<html lang="fr">

<head>
<meta http-equiv="refresh" content="12"> <!-- Rafraîchit la page toutes les 5 secondes -->

    <meta charset="UTF-8">
    <title>Document</title>
    <script src="../Accueil/1.js" defer></script>
    <link rel="stylesheet" type="text/css" href="../Accueil/style.css">
</head>

<body>

    <!-- Contenu HTML -->

    <div class="banderole">
        <?php
        function texteDeroulant($texte, $vitesse = 1) {
            // Échapper le texte pour éviter les failles XSS
            $texte = htmlspecialchars($texte, ENT_QUOTES, 'UTF-8');

            // Styles CSS pour la div contenant le texte déroulant
            $style = 'text-align: center; font-size: 74px;'; // Personnalisez la taille de la police ici

            // Balise marquee avec le texte déroulant et les styles CSS
            echo '<div style="' . $style . '"><marquee behavior="scroll" direction="left" scrollamount="' . $vitesse . '">' . $texte . '</marquee></div>';
        }

        // Exemple d'utilisation
        $texte = "   ******PROMOTIONS ACTUELLES******";
        $vitesse = 10; // Vitesse de défilement (ajustez selon vos préférences)

        texteDeroulant($texte, $vitesse);
        ?>
    </div>

    <div class="wrapper">
        <div class="button-container">
            <button style="background-color: #3fed1c;">RODANGE</button>
            <button><a href="./2.php">PETANGE</a></button>
            <button><a href="./3.php">DIFFERDANGE</a></button>
            <button><a href="./4.php">NEUDORF</a></button>
            <button><a href="./5.php">MARTELANGE</a></button>
            <button><a href="./6.php">WÄMPERHAART</a></button>
        </div>
    </div>

    <div class="wrapper">
        <br>
        <br>
        <p class="pub">A ne pas manquer !</p>
        <br>
        <br>
    </div>

    <div class="wrapper">
        <?php
        require_once('./cdb.php');

        if (isset($_POST['selected_images'])) {
            $_SESSION['selected_images'] = $_POST['selected_images'];
        }

        if (isset($_SESSION['selected_images']))
            $selectedImages = $_SESSION['selected_images'];
        ?>

        <?php
        // Afficher l'image de la table pub2
        $queryPub2 = "SELECT nom, contenu FROM pub2";
        $stmtPub2 = $db->query($queryPub2);

        while ($rowPub2 = $stmtPub2->fetch(PDO::FETCH_ASSOC)) {
            $nomPub2 = $rowPub2['nom'];
            $contenuPub2 = $rowPub2['contenu'];

            echo "<div class='responsive-image-container'>";
            echo "<img class='responsive-image' src='data:image/jpeg;base64," . base64_encode($contenuPub2) . "' alt='Image pub2'>";
            echo "</div>";
        }
        ?>
    </div>

    <div>
        <!-- Formulaire de message -->
        <form class="form connexion" action="../Message/cont_regex_mesage.php" method="POST">
            <div>
                <label for="nom">Nom</label>
                <input type="text" name="nom" value="" required>
            </div>
            <div>
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" value="" required>
            </div>
            <div>
                <label for="adresse mail">E-mail</label>
                <input type="text" name="mail" value="" required>
            </div>
            <div>
                <label for="sujet">Sujet</label>
                <input type="text" name="sujet" value="" required>
            </div>
            <div>
                <label for="message">Message</label>
                <textarea name="message" id="message" cols="30" rows="5"></textarea>
                <button id="Envoye">ENVOYER</button>
            </div>
        </form>
    </div>

    <?php
    require_once("../Accueil/footer1.php");
    ?>

<?php
require_once("../Connex_inscription/deconnexion1.php");
?>





</body>

</html>



