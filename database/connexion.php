<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    try {
        $database = new PDO("mysql:host=$servername;dbname=videos_catalogue;charset=utf8", $username, $password);
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    } catch (PDOException $e) {
            //throw $th;
    }
    
?>