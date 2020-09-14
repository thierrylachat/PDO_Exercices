<?php

    // Création du chemin absolu permettant la connexion à la database.
    require_once dirname(__FILE__).'/../utils/Databases.php';

    // Création de la classe Appointment.

    class Appointment
    {
        // Définition des attributs.
        private $id;
        private $dateHour;
        private $idPatients;
        private $db;

        // Création d'un constructeur avec des valeurs par défaut pour chaque attribut.
        public function __construct($_id = 0, $_dateHour = '', $_idPatients = 0)
        {
            // Hydratation des différentes propriétés.
            $this->db = Databases::getInstance();
            $this->id = $_id;
            $this->dateHour = $_dateHour;
            $this->idPatients = $_idPatients;
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


        /**
        * Permet de créer un rdv dans la table appointment.
        * @return boolean
        */

        public function create()
		{
            // Création de la requête SQL de création de patients.
			$insertPatients = 'INSERT INTO `appointments`(`id`,`dateHour`, `idPatients`) VALUES ( :id, :dateHour, :idPatients )';
            
            // Création d'une requête préparée avec prepare() pour se protéger des injections SQL.
            $patientsStatement = $this->db->prepare($insertPatients);
            
            // Association d'une valeur à un paramètre via bindValue.
		    // Les éléments de la requête SQL provenant de l’utilisateur sont remplacés par des marqueurs nominatifs auxquels on attribue une valeur grâce à la méthode bindValue().
            $patientsStatement->bindValue(':id', $this->id,PDO::PARAM_INT);
			$patientsStatement->bindValue(':dateHour', $this->dateHour,PDO::PARAM_STR);
            $patientsStatement->bindValue(':idPatients', $this->idPatients,PDO::PARAM_INT);
            // return var_dump($patientsStatement);

            // // Retourne le résultat de la méthode create().
            return $patientsStatement->execute();
        }
        

        /**
         * retour la liste des rendez-vous.
         * @return array
         */

		public function readAll()
		{
            // Création d'une requête permettant de lire les infos.
            $listPatients_sql = "SELECT `appointments`.`id` AS identifiant_app,date_format(`dateHour`,'%d/%m/%Y %H:%i') AS dateHour_fr,`idPatients`,`firstname`,`lastname` FROM `appointments` JOIN `patients` ON `patients`.`id` = `appointments`.`idPatients` ORDER BY `dateHour` ASC";
            
            // "Query" renvoie le jeu de données associées à la requête.
            $listAppointment_stmt = $this->db->query($listPatients_sql);
            
             // Création du tableau de données liées au jeu de données.
            $listAppointment = [];
            
            // Vérification que le jeu de données a bien été créé et affichage du tableau d'objets avec FetchAll.
            if ($listAppointment_stmt instanceof PDOstatement ) {
                $listAppointment = $listAppointment_stmt->fetchAll(PDO::FETCH_OBJ);
            }

            // Retourne le résultat de la méthode readAll().
            return $listAppointment;
        }
        
        

		public function readSingle()
		{
			// :nomDeVariable pour les données en attentes
            $listAppointment_sql = "SELECT `appointments`.`id` AS identifiant_app,date_format(`dateHour`,'%d/%m/%Y %H:%i') AS dateHour_fr,`idPatients`,`firstname`,`lastname` FROM `appointments` JOIN `patients` ON `patients`.`id` = `appointments`.`id` WHERE `appointments`.`id`=:id";
            $appointmentStatement = $this->db->prepare($listAppointment_sql);
            $appointmentStatement->bindValue(':id', $this->id,PDO::PARAM_INT);
			$appointmentView = null;
			if ($appointmentStatement->execute()){
				$appointmentView = $appointmentStatement->fetch(PDO::FETCH_OBJ);
			}
			return $appointmentView;
        }
        

		public function update()
		{
            $sql = 'UPDATE `appointments` SET `dateHour`=:dateHour,`idPatients`=:idPatients WHERE `id`=:id';
            $appointmentStatement = $this->db->prepare($sql);
            $appointmentStatement->bindValue(':id', $this->id,PDO::PARAM_INT);
			$appointmentStatement->bindValue(':dateHour', $this->dateHour,PDO::PARAM_STR);
            $appointmentStatement->bindValue(':idPatients', $this->idPatients,PDO::PARAM_INT);
            return $appointmentStatement->execute();
        }
        
        public function readPatientAppointments($idPatients)
        {
            $sql = 'SELECT `id`,`dateHour`FROM `appointments`WHERE idPatients=:idPatients';
            $appointmentStatement = $this->db->prepare($sql);
            $appointmentStatement->bindValue(':idPatients', $idPatients,PDO::PARAM_INT);
            $appointmentViews = [];
            if ($appointmentStatement->execute()) {
                $appointmentViews= $appointmentStatement->fetchAll(PDO::FETCH_OBJ);
            }
            return $appointmentViews;
        }

		public function delete()
		{
            $sql = 'DELETE FROM `appointments` WHERE `id`=:id';
            $appointmentStatement = $this->db->prepare($sql);
            $appointmentStatement->bindValue(':id', $this->id ,PDO::PARAM_INT);
            return $appointmentStatement->execute();
        }
        public function deleteAppointment($idPatient)
        {
            $sql = 'DELETE FROM `appointments` WHERE `idPatients`=:id';
            $patientsDelete = $this->db->prepare($sql);
            $patientsDelete->bindValue(':id', $idPatient,PDO::PARAM_INT);
            return $patientsDelete->execute();
        }
    }