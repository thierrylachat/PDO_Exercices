<?php

// Création du chemin absolu vers les constantes de connexion.
require_once dirname(__FILE__).'/../config/config.php';

class Databases
{
    // Le mot clé "static" permet à une méthode de s'exécuter sans avoir à instancier une classe.
    public static function getInstance()
    {
        try {
            $db = new PDO('mysql:host='.HOST.';dbname='.DB_NAME.';charset=utf8', USER, PASSWORD);
            $option = ERR;
        }

        // Levée de l'exception.
        catch (PDOException $e) {
            // Appel du message.
            die('Il y a un problème de connexion à la base de données : ' . $e->getMessage());
        }
        
        return $db;
    }
}
?>