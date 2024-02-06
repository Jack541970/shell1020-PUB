<?php
session_start();
?>

<?php

// Déconnexion automatique
if (isset($_SESSION['user'])) {
    $inactivityTimeout = 10; // 15 S

    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactivityTimeout)) {
        session_unset();
        session_destroy();
        header("Location: ../Accueil/1.php");
        exit;
    }

    $_SESSION['last_activity'] = time();
} else {
    header("Location: ../Accueil/1.php");
    exit;
}
?>












