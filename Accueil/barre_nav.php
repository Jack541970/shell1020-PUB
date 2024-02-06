

<!DOCTYPE html>
<html lang="fr">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Accueil/style.css">
  <script src="../Accueil/1.js" defer></script>
</head>

<body>

  <header>
    <!-- _________________________menu déroulant burger_______________________________ -->
    <div id="pop" class="menupop">
      <li class="nav-link">
        <a class="lac" href="../Connex_inscription/connex_users.php">> Connexion </a>
      </li>

      <li class="nav-link">
        <a href="../Connex_inscription/deconnexion.php">> Déconnexion </a>
      </li>

      

      <?php
session_start();
?>

      <?php
      if (isset($_SESSION['user'])) {
          $role = intval($_SESSION['user']['role']);

          if ($role === 1 || $role === 2 || $role === 3) {
              echo '<li class=""><p style="color: teal;"><span style="">CONNECTE</span></p></li>';
              // Ajoutez ici les éléments spécifiques au rôle 1, 2 et 3
          }

          if ($role === 2 || $role === 3) {
              echo '<li class=""><p style="color: #ed1c24;"><span style="text-decoration: underline;">GERANTS</span></p></li>';
              echo '<li class="nav-link"><a href="../images_pub_rodange\add_files.php">> Ajouter un flyer pub </a></li>';
          }

          if ($role === 3) {
              echo '<li class=""><p style="color: #ed1c24;"><span style="text-decoration: underline;">ADMINISTRATEUR</span></p></li>';
              echo '<li class="nav-link"><a href="../images_pub_rodange\add_supp_files.php">> Ajou / Supp flyer pub </a></li>';
              echo '<li class="nav-link"><a href="../connex_inscription/inscription.php">> Inscription </a></li>';
              echo '<li class="nav-link"><a href="../message\read_supp_messages.php">> Messages reçus </a></li>';
          }
      }
      ?>
    </div>

    <img id="logo" src="../Resources PGM/Images/logo.png" alt="Le logo">
    <p class="societe">SNFROL s.à.r.l.</p>
    <p class="societe">SHOP CENTER</p>
    <nav>
      <ul class="navlist">
        <li>
          <a href="../Accueil/1.php" style="text-decoration: underline;">Accueil</a>
        </li>
        <li>
          <p style="margin-right: 100px;">Tel : 661 20 30 54</p>
        </li>
      </ul>
      <a id="burger" href="#">
        <div class="menu-wrapper">
          <div class="burger-icon">
            <div class="line"></div>
            <div class="line un"></div>
            <div class="line deux"></div>
          </div>
        </div>
      </a>
      
    </nav>
    
  </header>

</body>

