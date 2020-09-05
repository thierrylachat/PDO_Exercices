<?php

	// Création du chemin absolu permettant la connexion à la database.
	require_once dirname(__FILE__).'/../utils/Database.php';

	// Création de la classe Service.
	class Service
	{
		
		// Déclaration des attributs de la classe.
		private $id;
		private $name;
		private $description;
		private $database;
		// Penser à la database et aux clés étrangères !

		// Création d'un constructeur.
		function __construct($serviceArray = [])
		{
			$this->hydrate($serviceArray);
	        $this->database = Database::getPDO();
		}

		// Méthodes permettant d'accéder à des propriétés privées.
		public function __get($attr)
	    {
	        return $this->$attr;
	    }

	    public function __set($attr, $value)
	    {
	        $this->$attr = $value;
	    }

		// Création d'une méthode pour réaliser l'hydratation des propriétés.
		private function hydrate($serviceArray)
		{
			foreach ($serviceArray as $key => $value) {
				if (property_exists($this, $key)) {
					$this->$key = $value;
				}
			}
		}


		/**
        * Retourne la liste des services dans le filtre.
        * @return array
        */
	
		public function readNames()
		{
			// Création de la requête SQL d'affichage d'informations des services.
			$select_SQL = 'SELECT `services_id`, `name` FROM `services`';

			// "Query" renvoie le jeu de données associées à la requête.
			$serviceStatement = $this->database->query($select_SQL);

			// Création du tableau de données liées au jeu de données.
			$service_list = [];

			// Vérification que le jeu de données a bien été créé.
			if ($serviceStatement instanceof PDOStatement) {
				$service_list = $serviceStatement->fetchAll(PDO::FETCH_OBJ);
			}

			// Retourne le résultat de la méthode readNames().
			return $service_list;
		}
	}