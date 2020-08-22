<?php
require_once dirname(__FILE__).'/../config/config.php';
class Databases
{
    // static permet d'executer la fonction sans instance de class
    public static function getInstance()
    {
        try {
            $db = new PDO('mysql:host='.HOST.';dbname='.DB_NAME.';charset=utf8', USER, PASSWORD);
            $option = ERR;
        }
        // lève l'exception
        catch (PDOException $e) {
            // appel du message
            die('Il y a un problème de connexion à la base de données : ' . $e->getMessage());
        }
        return $db;
    }
}
?>