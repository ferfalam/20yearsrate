<?php

    //CREATE TABLE `videos_catalogue`.`videos` ( `id` INT NOT NULL AUTO_INCREMENT , `title` VARCHAR(250) NOT NULL , `description` TEXT NOT NULL , `path` VARCHAR(250) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

    //CREATE TABLE `videos_catalogue`.`notes` ( `id` INT NOT NULL AUTO_INCREMENT , `voterIP` VARCHAR(25) NOT NULL , `note` INT(2) NOT NULL , `videoId` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

    function getVideos()
    {
        require('connexion.php');
        $req = $database->prepare('SELECT * FROM videos');
        $req-> execute();
        $data = $req->fetchALL(PDO::FETCH_OBJ);
        return $data;
        $req->closeCursor();
    }

    function insertNote($voterIP, $note, $videoId){
    	require('connexion.php');
    	$req = $database->prepare('INSERT INTO notes (voterIP, note, videoId) VALUES (?,?,?)');
    	$req->execute(array($voterIP, $note, $videoId));
    	$req->closeCursor();
    }

    function getVideoNotes($videoId)
    {
    	require('connexion.php');
    	$req = $database->prepare('SELECT * FROM notes WHERE videoId = ?');
    	$req->execute(array($videoId));
    	$data = $req->fetchALL(PDO::FETCH_OBJ);
        return $data;
        $req->closeCursor(); 
    }

    function getNotes()
    {
        require('connexion.php');
        $req = $database->prepare('SELECT * FROM notes');
        $req-> execute();
        $data = $req->fetchALL(PDO::FETCH_OBJ);
        return $data;
        $req->closeCursor();
    }

    function searchNotes($videoId, $voterIP)
    {
        require('connexion.php');
        $req = $database->prepare('SELECT * FROM notes WHERE videoId = ? AND voterIP = ?');
        $req-> execute(array($videoId, $voterIP));
        $data = $req->fetchALL(PDO::FETCH_OBJ);
        return $data;
        $req->closeCursor();
    }

?>