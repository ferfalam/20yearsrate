<?php
    function insertVideo($title, $description, $path, $image)
    {
        require('connexion.php');
        $req = $database->prepare('INSERT INTO videos (title, description, path, image) VALUES (?,?,?,?)');
        $req->execute(array($title, $description, $path, $image));
        $req->closeCursor();
    }

    function getVideos()
    {
        require('connexion.php');
        $req = $database->prepare('SELECT * FROM videos');
        $req->execute();
        $data = $req->fetchALL(PDO::FETCH_OBJ);
        return $data;
        $req->closeCursor();
    }

    function getVideo($id)
    {
        require('connexion.php');
        $req = $database->prepare('SELECT * FROM videos WHERE id = ?');
        $req->execute(array($id));
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

    function getVideoNotesAVG($videoId)
    {
        require('connexion.php');
        $req = $database->prepare('SELECT AVG(note) AS rate FROM notes WHERE videoId = ?');
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