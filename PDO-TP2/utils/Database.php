<?php

    // Création du chemin absolu vers les constantes de connexion.
    require_once dirname(__FILE__).'/../config/config.php';
    
    // Création d'un objet Database.
    class Database {

        public static function getInstance()
        {
            // Création d'une chaîne de connexion Data Source Name.
            $dsn = 'mysql:host='.HOST.';dbname='.DB_NAME.';charset=utf8'; 
            
            try {
                // Création d'une classe PDO.
                $pdo = new PDO($dsn, USER, PASSWORD, ERR);
                return $pdo;
            
            // Levée de l'exception.
            } catch (PDOException $e) {
                // Appel du message.
                die('Il y a un problème de connexion à la base de données' . $e->getMessage());
            }
        }
    }