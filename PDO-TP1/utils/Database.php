<?php

	// Création du chemin absolu vers les constantes de connexion.
	require_once dirname(__FILE__).'/../config/config.php';
	/**
	 * object PDO
	 */
	class Database
	{
		private static $pdo = null;

		 // Le mot clé "static" permet à une méthode de s'exécuter sans avoir à instancier une classe.
		public static function getPDO()
		{
			$dsn = 'mysql:host='.HOST.';dbname='.DATABASE.';charset=utf8'; // Ajout les informations de la base de données.
        	$option = ERR; // Définition du type d'erreurs à retourner.

        	if (is_null(self::$pdo)) {
	        	try {
	        		self::$pdo = new PDO($dsn, USER, PASSWORD, $option);
	        	}
	        	catch (PDOException $e) {
	        		die('Le lien vers la base de donnée a échoué '.$e->getMessage());
	        	}
	        }

	        return self::$pdo;
		}
	}