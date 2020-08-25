<?php

    // Création du chemin absolu permettant la connexion à la database.
    require_once dirname(__FILE__).'/../utils/Databases.php';

    // Création de la classe Appointment.

    class Appointment
    {
        private $id;
        private $dateHour;
        private $idPatients;
        private $db;

        // Création d'un constructeur avec des valeurs par défaut pour chaque attribut.
        public function __construct($_id= 0, $_dateHour= '', $_idPatients= 0)
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
        // Création d'une méthode pour insérer une adresse mail valide => Best Practice.
        // public function setMail($mail)
        // {
        //     if(filter_var($mail, FILTER_VALIDATE_EMAIL))
        //     {
        //         $this->mail = $mail;            
        //     }
        // }

        public function create()
		{
			$insertPatients = 'INSERT INTO `appointments`(`id`,`dateHour`, `idPatients`) VALUES ( :id, :dateHour, :idPatients )';
            $patientsStatement = $this->db->prepare($insertPatients);
            $patientsStatement->bindValue(':id', $this->id,PDO::PARAM_INT);
			$patientsStatement->bindValue(':dateHour', $this->dateHour,PDO::PARAM_STR);
            $patientsStatement->bindValue(':idPatients', $this->idPatients,PDO::PARAM_INT);
            // return var_dump($patientsStatement);
            return $patientsStatement->execute();
            
		}
        /**
         * retour liste des patients enregistré
         * @return array
         */
		public function readAll()
		{
            $listPatients_sql = "SELECT `appointments`.`id` AS identifiant_app,date_format(`dateHour`,'%d/%m/%Y %H:%i') AS dateHour_fr,`idPatients`,`firstname`,`lastname` FROM `appointments` JOIN `patients` ON `patients`.`id` = `appointments`.`idPatients` ORDER BY `dateHour` ASC";
            $listAppointment_stmt = $this->db->query($listPatients_sql);
            $listAppointment = [];
            if ($listAppointment_stmt instanceof PDOstatement ) {
                $listAppointment = $listAppointment_stmt->fetchAll(PDO::FETCH_OBJ);
            }
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