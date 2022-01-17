<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    try {
        $database = new PDO("mysql:host=$servername;charset=utf8", $username, $password);
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

        $dbReq = $database->prepare('CREATE DATABASE IF NOT EXISTS videos_catalogue');
        $dbReq-> execute();

        $videosTableReq = $database->prepare('CREATE TABLE IF NOT EXISTS `videos_catalogue`.`videos` ( `id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(250) NOT NULL , `description` TEXT NOT NULL , `path` VARCHAR(250) NOT NULL , `image` VARCHAR(250) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;');
        $videosTableReq-> execute();

        $notesTableReq = $database->prepare('CREATE TABLE IF NOT EXISTS `videos_catalogue`.`notes` ( `id` INT NOT NULL AUTO_INCREMENT , `voterIP` VARCHAR(25) NOT NULL , `note` INT(2) NOT NULL , `videoId` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB');
        $notesTableReq-> execute();


        $database = new PDO("mysql:host=$servername;dbname=videos_catalogue;charset=utf8", $username, $password);
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    } catch (PDOException $e) {
            throw $e;
    }

    //CREATE TABLE `videos_catalogue`.`videos` ( `id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(250) NOT NULL , `description` TEXT NOT NULL , `path` VARCHAR(250) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

    //CREATE TABLE `videos_catalogue`.`notes` ( `id` INT NOT NULL AUTO_INCREMENT , `voterIP` VARCHAR(25) NOT NULL , `note` INT(2) NOT NULL , `videoId` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;  
?>