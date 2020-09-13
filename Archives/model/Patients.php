<?php

    // Création du chemin absolu permettant la connexion à la database.
    require_once dirname(__FILE__).'/../utils/Databases.php';

    // Création de la classe patient.

    class Patients
    {
        private $id;
        private $lastname;
        private $firstname;
        private $birthdate;
        private $phone;
        private $mail;
        private $db;

        // Création d'un constructeur avec des valeurs par défaut pour chaque attribut.
        public function __construct($_id = 0, $_firstname = '', $_lastname = '', $_birthdate = '', $_phone = '', $_mail = '')
        {
            // Hydratation des différentes propriétés.
            $this->db = Databases::getInstance();
            $this->id = $_id;
            $this->lastname = $_lastname;
            $this->firstname = $_firstname;
            $this->birthdate = $_birthdate;
            $this->phone = $_phone;
            $this->mail = $_mail;
        }

        // Création d'une méthode magique getter qui permettra de créer dynamiquement un getter pour chaque attribut existant.
        // Méthode permettant de faire des échos de propriétés privées.
        public function __get($attr)
        {
            return $this->$attr;
        }

        public function __set($attr, $value)
        {
            $this->$attr = $value;
        }

        // Création d'une méthode pour insérer une adresse mail valide => Best Practice.
        // public function setMail($mail)
        // {
        //     if(filter_var($mail, FILTER_VALIDATE_EMAIL))
        //     {
        //         $this->mail = $mail;            
        //     }
        // }

        /**
        * Permet de créer un patient dans la table patients.
        * @return boolean
        */

        public function create()
		{
            // Création de la requête SQL de création de patients.
			$insertPatients = 'INSERT INTO `patients`(`id`,`lastname`, `firstname`,`birthdate`,`phone`,`mail`) VALUES ( :id, :lastname, :firstname, :birthdate, :phone, :mail )';
            
            // Création d'une requête préparée avec prepare() pour se protéger des injections SQL.
            $patientsStatement = $this->db->prepare($insertPatients);

            // Association d'une valeur à un paramètre via bindValue.
		    // Les éléments de la requête SQL provenant de l’utilisateur sont remplacés par des marqueurs nominatifs auxquels on attribue une valeur grâce à la méthode bindValue().
            $patientsStatement->bindValue(':id', $this->id,PDO::PARAM_INT);
			$patientsStatement->bindValue(':lastname', $this->lastname,PDO::PARAM_STR);
            $patientsStatement->bindValue(':firstname', $this->firstname,PDO::PARAM_STR);
            $patientsStatement->bindvalue(':birthdate',$this->birthdate,PDO::PARAM_STR);
            $patientsStatement->bindvalue(':phone',$this->phone,PDO::PARAM_STR);
            $patientsStatement->bindvalue(':mail',$this->mail,PDO::PARAM_STR);
            
            // Exécution de la fonction.
            return $patientsStatement->execute();
        }

        public function findPatient($text)
        {
            $sql = 'SELECT `id`,`firstname`,`lastname` FROM `patients` WHERE `firstname`LIKE :firstname OR `lastname`LIKE :lastname';
            $searchPatients = $this->db->prepare($sql);
            $searchPatients->bindValue(':lastname',$text.'%',PDO::PARAM_STR);
            $searchPatients->bindValue(':firstname',$text.'%',PDO::PARAM_STR);
            $patientsView = [];
            if ($searchPatients->execute()){
				$patientsView = $searchPatients->fetchAll(PDO::FETCH_OBJ);
			}
            return $patientsView;
        }

        /**
         * Retourne la liste des patients enregistrés.
         * @return array
         */

		public function readAll()
		{
            // Création d'une requête permettant de lire les infos.
            $listPatients_sql = 'SELECT `id`,`lastname`, `firstname`, DATE_FORMAT(`birthdate`,"%d/%m/%Y") AS birthdate_format FROM `patients`';
            
            // "Query" renvoie le jeu de données associées à la requête.
            $patientsStatement = $this->db->query($listPatients_sql);

            // Création du tableau de données liées au jeu de données.
            $listPatients = [];

            // Vérification que le jeu de données a bien été créé.
            if ($patientsStatement instanceof PDOstatement ) {
                $listPatients = $patientsStatement->fetchAll(PDO::FETCH_OBJ);
            }

            // Retourne le résultat de la fonction readAll().
            return $listPatients;
		}

        /**
	    * Retourne la liste des informations des profils des patients.
	    * @return array
        */
        
		public function readSingle()
		{
			// :nomDeVariable pour les données en attente.
		    // Création d'une requête permettant de lire les infos d'un patient avec l'ID (unique).
			$sql_viewPatients = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`,"%d/%m/%Y") AS birthdate_format,`birthdate`,`phone`,`mail` FROM `patients` WHERE `id` = :id ';
            
            // Création d'une requête préparée avec prepare() pour se protéger des injections SQL.
            $patientsStatement = $this->db->prepare($sql_viewPatients);

            // Les éléments de la requête SQL provenant de l’utilisateur sont remplacés par des marqueurs nominatifs auxquels on attribue une valeur grâce à la méthode bindValue().
            $patientsStatement->bindValue(':id', $this->id,PDO::PARAM_INT);
            
            // Si l'id du patient existe, exécution de la méthode pour créer le tableau qui affiche les données du patient.
            $patientsView = null;
			if ($patientsStatement->execute()){
				$patientsView = $patientsStatement->fetch(PDO::FETCH_OBJ);
            }
            
            // Retourne le résultat de la fonction readSingle().
			return $patientsView;
		}

        /**
	    * Retourne la liste des informations des profils des patients.
	    * @return boolean
        */

		public function update()
		{
            // Création d'une requête SQL de mise à jour du profil du patient avec l'ID (unique).
            $sql = 'UPDATE `patients` SET `lastname`=:lastname,`firstname`=:firstname,`birthdate`=:birthdate,`phone`=:phone,`mail`=:mail WHERE `id`=:id';

            // Création d'une requête préparée avec prepare() pour se protéger des injections SQL.
            $patientsStatement = $this->db->prepare($sql);

            // Les éléments de la requête SQL provenant de l’utilisateur sont remplacés par des marqueurs nominatifs auxquels on attribue une valeur grâce à la méthode bindValue().
            $patientsStatement->bindValue(':id', $this->id,PDO::PARAM_INT);
			$patientsStatement->bindValue(':lastname', $this->lastname,PDO::PARAM_STR);
            $patientsStatement->bindValue(':firstname', $this->firstname,PDO::PARAM_STR);
            $patientsStatement->bindvalue(':birthdate',$this->birthdate,PDO::PARAM_STR);
            $patientsStatement->bindvalue(':phone',$this->phone,PDO::PARAM_STR);
            $patientsStatement->bindvalue(':mail',$this->mail,PDO::PARAM_STR);

            // Retourne le résultat de la fonction update().
            return $patientsStatement->execute();
		}

        /**
	    * Supprime un patient.
	    * @return boolean
        */

		public function delete()
		{
            // Création d'une requête SQL de suppression du patient avec l'ID (unique).
            $sql = 'DELETE FROM `patients` WHERE `id`=:id';
            $patientsDelete = $this->db->prepare($sql);
            $patientsDelete->bindValue(':id', $this->id,PDO::PARAM_INT);
            return $patientsDelete->execute();
        }

    }