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
    <title>Messages</title>
  </head>



  <!-- _________________________Accidents zone1_______________________________ -->
  <br>
  <br>
  <h1 class="titre_marge-gauche">Lecture des</h1>
  <h1 class="titre_marge-gauche">MESSAGES</h1>

  <br>

  <h1 class="ligne-rouge"></h1>
  <br>
  <br>

<body>
  <h2>Messages reçus</h2>

  <form action="delete_files1.php" method="post">
  <?php
require_once('./cdb.php');

$query = "SELECT id, nom, prenom, mail, sujet, message , date_upload FROM message_pub";  // Ajout du prénom et du mail dans la requête
$stmt = $db->query($query);

echo '<ol>';
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $id = $row['id'];
    $nom = $row['nom'];
    $prenom = $row['prenom'];
    $mail = $row['mail'];
    $sujet = $row['sujet'];
    $texte = $row['message'];
    $date_upload = $row['date_upload'];

    echo '<li><input type="checkbox" name="filesToDelete[]" value="' . $id . '"> 
        - Nom: ' . $nom . '
        - Prénom: ' . $prenom . '
        - Mail: ' . $mail . '
        - Date ' . $date_upload . '
        <div style="margin-left: 21px;">Sujet: ' . $sujet . '</div>
        <div style="margin-left: 20px;">Texte: ' . $texte . '</div>
        <br>
      </li>';
}
echo '</ol>';
?>

  <br>
  <input type="submit" name="submit" value="Supprimer les fichiers sélectionnés">
</form>
</body>


<br>
<h1 class="ligne-rouge"></h1>
<br>
<br>

</html>