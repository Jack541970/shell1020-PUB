<?php
session_start();
?>
 <?php 

     session_start(); 
    unset($_SESSION['user']);
    //enleve du tableau la clé et tout dedant qui sapelle user
    header("Location: ../Accueil/1.php");
    //exit();
?>














