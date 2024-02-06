<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="../Accueil/1.js" defer></script>
  <link rel="stylesheet" type="text/css" href="../Accueil/style.css">
  <link rel="stylesheet" href="./Accueil\style.css">



  <?php
  require_once("../Accueil/barre_nav.php");
  require_once('./cdb.php');
  ?>

  <head>
    <title>Télécharger et enregistrer dans la base de données DIVERS</title>
  </head>
  
  <div>
<article class="wrapper">
          <div class="button-container">
              <button><a href="../images_pub_rodange/add_files.php">RODANGE</a></button>
              <button><a href="../images_pub_petange/add_files.php">PETANGE</a></button>
              <button><a href="../images_pub_differdange/add_files.php">DIFFERDANGE</a></button>
              <button><a href="../images_pub_neudorf/add_files.php">NEUDORF</a></button>
              <button style="background-color: #3fed1c;">MARTELANGE</a></button>
              <button><a href="../images_pub_wamperhaart/add_files.php">WÄMPERHAART</a></button>
          </div>
</div>


  <!-- _________________________Divers zone1_______________________________ -->
  <br>
  <br>
  <h1 class="titre_marge-gauche titre_marge-droite">Formulaire de téléchargement des fichiers</h1>
  <h1 class="titre_marge-gauche titre_marge-droite">PROMOTION</h1>  <br>
  <h1 class="ligne-rouge"></h1>
  <br>
  <br>
  <form action="download1.php" method="post" enctype="multipart/form-data">
    <label for="file">Sélectionnez un Flyer :</label>
    <input type="file" name="file" id="file">
    <input type="submit" name="submit" value="Télécharger et enregistrer">
  </form>

  <br>

<body>
  <h2>Tous les Flyers Pub</h2>

  






  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des fichiers</title>
    <style>
        .ligne-rouge {
            color: red;
        }
    </style>
</head>
<body>

<form action="manage_files.php" method="post">
    <ul>
        <?php
        require_once('./cdb.php');
        
        $query = "SELECT id, nom FROM pub9";
        $stmt = $db->query($query);
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $nom = $row['nom'];
            echo '<li><input type="checkbox" name="filesToManage[]" value="' . $id . '"> <a href="display1.php?id=' . $id . '">' . $nom . '</a></li>';
        }
        ?>
    </ul>
    <br>
    
    <input type="submit" name="copy" value= "Copier le Flyer sélectionné vers HOME PAGE"style="color: green;">



</form>






<!-- <a href="display_pub2.php">Afficher les images de la table pub2</a> -->

<h1 class="ligne-rouge">
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        include 'manage_files.php'; // Inclure le fichier de gestion pour afficher les messages
    }
    ?>
</h1>

<h2>Flyer actuel sur la Home Page</h2>



<?php
require_once('./cdb.php');

if (isset($_POST['selected_images'])) {
    $_SESSION['selected_images'] = $_POST['selected_images'];
}

if (isset($_SESSION['selected_images'])) {
    $selectedImages = $_SESSION['selected_images'];
}
?>
</div>

<div class="">
    <?php
    // Afficher l'image de la table pub2
    $queryPub2 = "SELECT nom, contenu FROM pub10";
    $stmtPub2 = $db->query($queryPub2);

    while ($rowPub2 = $stmtPub2->fetch(PDO::FETCH_ASSOC)) {
        $nomPub2 = $rowPub2['nom'];
        $contenuPub2 = $rowPub2['contenu'];

        echo "<div class='responsive-image-container'>";
        echo "<p>Nom de l'image : $nomPub2</p>";
        echo "<img class='responsive-image' src='data:image/jpeg;base64," . base64_encode($contenuPub2) . "' alt='Image pub2' style='width: 50%; height: auto; margin: 0 auto;'>";
        echo "</div>";
    }
    ?>
</div>


</body>
</html>



















