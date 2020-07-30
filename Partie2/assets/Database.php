<?php
    class Database
    {
        // Le mot clé "static" permet à une méthode de s'exécuter sans avoir à instancier une classe.
        public static function getInstance()
        {
            try{
                $db = new PDO(DSN, USER, PWD, ERR);
            }
		    // Levée de l'exception.
		    catch(PDOException $e){
	      		// Appel du message.
	      		die('Echec lors de la connexion à la base de données : '.$e->getMessage());
            }
            return $db;
        }
    }
    var_dump($db);
    var_dump(Database::getInstance());
?>