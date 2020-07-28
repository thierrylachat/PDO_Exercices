<?php

// Création d'un objet PDO.
function getDataBase($dsn, $user, $password = '', $option = [])
{
    try {
        // Récupération du DSN dans le fichier param.php
        // $dsn = 'mysql:host=localhost;dbname=colyseum;charset=utf8;';
        $db = new PDO($dsn, $user, $password, $option);
        return $db;
    }
    // Levage de l'exception.
     catch (PDOException $e) {
        // Appel du message.
        die('Il y a un problème de connexion à la base de données : ' . $e->getMessage());
    }
}
