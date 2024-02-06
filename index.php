<?php
ob_start(); // Débute la mise en mémoire tampon
// Votre code PHP ici
header('Location: Accueil/1.php');
exit;
ob_end_flush(); // Vide la mémoire tampon et envoie le contenu au navigateur