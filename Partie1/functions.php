<?php

    // Création d'une instance PDO et définition du mode d'erreur.
    function getDataBase($dsn, $user, $password = '', $option = [])
    {
        try {
            // Récupération du DSN dans le fichier param.php.
            // $dsn = 'mysql:host=localhost;dbname=colyseum;charset=utf8;';
            $db = new PDO($dsn, $user, $password, $option);
            return $db;
        }
        // Levée de l'exception.
        catch (PDOException $e) {
            // Appel du message.
            die('Echec lors de la connexion à la base de données : ' . $e->getMessage());
        }
    }
?>
