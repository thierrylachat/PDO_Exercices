<?php
    class Database
    {
        // static permet d'executer la fonction sans instance de class
        public static function getInstance()
        {
            try{
		    	$db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
		    }
		    // lève l'exception
		    catch(PDOException $e){
	      		// appel du message
	      		die('Il y a un problème de connexion à la base de données : '.$e->getMessage());
            }
            
            return $db;
        }
    }