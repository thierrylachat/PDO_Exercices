<?php

	// Création du chemin absolu permettant la connexion à la database.
	require_once dirname(__FILE__).'/../utils/Database.php';

	// Création de la classe User.
	class User
	{
		
		// Déclaration des attributs de la classe.
		private $id;
		private $lastname;
		private $firstname;
		private $birthdate;
		private $address;
		private $zipcode;
		private $phone;
		private $service_id;
		private $database;
		// Penser à la database et aux clés étrangères !

		// Création d'un constructeur.
		public function __construct($userArray = [])
		{
			$this->hydrate($userArray);
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
		private function hydrate($userArray)
		{
			foreach ($userArray as $key => $value) {
				if (property_exists($this, $key)) {
					$this->$key = $value;
				}
			}
		}


		/**
        * Retourne la liste des utilisateurs.
        * @return array
        */

		public function readAll()
		{
			/* Création d'une requête permettant de lire les infos d'un utilisateur.
			   Le TIMESTAMPDIFF permet ici de récupérer l'âge à partir de la date de naissance. */
			$select_SQL = 'SELECT users.users_id, users.lastname, users.firstname, TIMESTAMPDIFF(year, users.birthdate, CURRENT_DATE) AS age, users.address, users.zipcode, users.phone, services.name AS service_name FROM users JOIN services ON users.services_id = services.services_id ORDER BY users.lastname ASC';
			
			// "Query" renvoie le jeu de données associées à la requête.
			$userStatement = $this->database->query($select_SQL);

			// Création du tableau de données liées au jeu de données.
			$user_list = [];

			// Vérification que le jeu de données a bien été créé.
			if ($userStatement instanceof PDOStatement) {
				$user_list = $userStatement->fetchAll(PDO::FETCH_OBJ);
			}

			// Retourne le résultat de la méthode readAll().
			return $user_list;
		}


		/**
        * Permet la création d'un utilisateur.
        * @return boolean
        */

		public function create()
		{
			// Création de la requête SQL de création d'un utilisateur.
			$insert_SQL = 'INSERT INTO users(lastname, firstname, birthdate, address, zipcode, phone, services_id) VALUES (:lastname, :firstname, :birthdate, :address, :zipcode, :phone, :services_id)';
			
			// Création d'une requête préparée avec prepare() pour se protéger des injections SQL.
			$userStatement = $this->database->prepare($insert_SQL);

			// Association d'une valeur à un paramètre via bindValue.
		    // Les éléments de la requête SQL provenant de l’utilisateur sont remplacés par des marqueurs nominatifs auxquels on attribue une valeur grâce à la méthode bindValue().
			$userStatement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
			$userStatement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        	$userStatement->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        	$userStatement->bindValue(':address', $this->address, PDO::PARAM_STR);
        	$userStatement->bindValue(':zipcode', $this->zipcode, PDO::PARAM_STR);
        	$userStatement->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        	$userStatement->bindValue(':services_id', $this->service_id, PDO::PARAM_INT);

			// Retourne le résultat de la méthode create().
        	return $userStatement->execute();
		}


		/**
        * Permet la création d'un filtre d'utilisateurs sur le service.
        * @return array
		*/
		
		public function readFilter()
		{
			// Création de la requête SQL de sélection des utilisateurs par service.
			$select_SQL = 'SELECT users.users_id, users.lastname, users.firstname, TIMESTAMPDIFF(year, users.birthdate, CURRENT_DATE) AS age, users.address, users.zipcode, users.phone, services.name AS service_name FROM users JOIN services ON users.services_id = services.services_id WHERE services.services_id = :services_id';
			
			// Création d'une requête préparée avec prepare() pour se protéger des injections SQL.
			$userStatement = $this->database->prepare($select_SQL);

			// Association d'une valeur à un paramètre via bindValue.
		    // Les éléments de la requête SQL provenant de l’utilisateur sont remplacés par des marqueurs nominatifs auxquels on attribue une valeur grâce à la méthode bindValue().
			$userStatement->bindValue(':services_id', $this->service_id, PDO::PARAM_INT);

			// Création du tableau de données liées au jeu de données.
			$user_list_filter = [];

			// Vérification que le jeu de données a bien été créé.
			if ($userStatement->execute()) {
				$user_list_filter = $userStatement->fetchAll(PDO::FETCH_OBJ);
			}

			// Retourne le résultat de la méthode readFilter().
			return $user_list_filter;
		}


		/**
        * Permet la suppression d'un utilisateur.
        * @return boolean
        */

		public function delete()
		{
			// Création de la requête SQL de suppression d'un utilisateur.
			$delete_SQL = 'DELETE FROM users WHERE users_id = :id';

			// Création d'une requête préparée avec prepare() pour se protéger des injections SQL.
			$deleteStatement = $this->database->prepare($delete_SQL);

			// Association d'une valeur à un paramètre via bindValue.
		    // Les éléments de la requête SQL provenant de l’utilisateur sont remplacés par des marqueurs nominatifs auxquels on attribue une valeur grâce à la méthode bindValue().
			$deleteStatement->bindValue(':id', $this->id, PDO::PARAM_INT);

			// Retourne le résultat de la méthode delete().
			return $deleteStatement->execute();
		}
	}