<?php
    require_once dirname(__FILE__) . '/../config/params.php';

    class Database
    {
        // Le mot clé "static" permet à une méthode de s'exécuter sans avoir à instancier une classe.
        public static function getInstance()
        {
            // Création d'une chaîne de connexion Data Source Name.
            $dsn = 'mysql:host='.HOST.';dbname='.DATABASE.';charset=utf8';

            try{
                return new PDO($dsn, USER, PWD, ERR);
            }
		    // Levée de l'exception.
		    catch(PDOException $e){
	      		// Appel du message.
	      		die('Echec lors de la connexion à la base de données : '.$e->getMessage());
            }
        }
    }
    var_dump(Database::getInstance());
?>