<?php 
    // Constantes de base de donnée

    $serv_db = "localhost";
    $user_db = "sulo";
    $pw_db = "666";
    $name_db = "shell_pub";

    // DSN(Data Source Name) de connexion
    $dsn = "mysql:host=". $serv_db .";dbname=". $name_db .";charset=utf8";

    // connexion à la base 
    try{
        // on instancie PDO
        $db = new PDO($dsn, $user_db, $pw_db);
        $db->exec("SET NAMES utf8");
        // Définis la valeur par défaut pour Fetch
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        //echo ("Connectés à la base");
    }
    
    catch(PDOException $e){
        die("PDO Error : ".$e->getMessage());
    }
    catch(Exception $e){
        die("Error : ".$e->getMessage());
    }
