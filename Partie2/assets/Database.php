<?php
    class Database
    {
        // Le mot clé "static" permet d'exécuter à une méthode de s'éxécuter sans avoir à instancier une class.
        public static function getInstance()
        {
            try{
		    	$db = new PDO(DSN, USER, PWD);
		    }
		    // Levée de l'exception.
		    catch(PDOException $e){
	      		// Appel du message
	      		die('Echec lors de la connexion à la base de données : '.$e->getMessage());
            }
            
            return $db;
        }
    }
    var_dump(Database::getInstance());
?>