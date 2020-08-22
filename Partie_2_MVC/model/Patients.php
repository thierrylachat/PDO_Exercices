<?php
    require_once dirname(__FILE__).'/../utils/Databases.php';
    class Patients
    {
        private $id;
        private $lastname;
        private $firstname;
        private $birthdate;
        private $phone;
        private $mail;
        private $db;

        public function __construct($_id=0,$_lastname='',$_firstname='',$_birthdate='',$_phone='',$_mail='')
        {
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

        public function create()
		{
			$insertPatients = 'INSERT INTO `patients`(`id`,`lastname`, `firstname`,`birthdate`,`phone`,`mail`) VALUES ( :id, :lastname, :firstname, :birthdate, :phone, :mail )';
            $patientsStatement = $this->db->prepare($insertPatients);
            $patientsStatement->bindValue(':id', $this->id,PDO::PARAM_INT);
			$patientsStatement->bindValue(':lastname', $this->lastname,PDO::PARAM_STR);
            $patientsStatement->bindValue(':firstname', $this->firstname,PDO::PARAM_STR);
            $patientsStatement->bindvalue(':birthdate',$this->birthdate,PDO::PARAM_STR);
            $patientsStatement->bindvalue(':phone',$this->phone,PDO::PARAM_STR);
            $patientsStatement->bindvalue(':mail',$this->mail,PDO::PARAM_STR);
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
         * retour liste des patients enregistré
         * @return array
         */
		public function readAll()
		{
            $listPatients_sql = 'SELECT `id`,`lastname`, `firstname`,DATE_FORMAT(`birthdate`,"%d/%m/%Y") AS birthdate_format FROM `patients`';
            $patientsStatement = $this->db->query($listPatients_sql);
            $listPatients = [];
            if ($patientsStatement instanceof PDOstatement ) {
                $listPatients = $patientsStatement->fetchAll(PDO::FETCH_OBJ);
            }
            return $listPatients;
		}

		public function readSingle()
		{
			// :nomDeVariable pour les données en attentes
			$sql_viewPatients = 'SELECT `id`, `lastname`, `firstname`,DATE_FORMAT(`birthdate`,"%d/%m/%Y") AS birthdate_format,`birthdate`,`phone`,`mail` FROM `patients` WHERE `id` = :id ';
            $patientsStatement = $this->db->prepare($sql_viewPatients);
            $patientsStatement->bindValue(':id', $this->id,PDO::PARAM_INT);
			$patientsView = null;
			if ($patientsStatement->execute()){
				$patientsView = $patientsStatement->fetch(PDO::FETCH_OBJ);
			}
			return $patientsView;
		}

		public function update()
		{
            $sql = 'UPDATE `patients` SET `lastname`=:lastname,`firstname`=:firstname,`birthdate`=:birthdate,`phone`=:phone,`mail`=:mail WHERE `id`=:id';
            $patientsStatement = $this->db->prepare($sql);
            $patientsStatement->bindValue(':id', $this->id,PDO::PARAM_INT);
			$patientsStatement->bindValue(':lastname', $this->lastname,PDO::PARAM_STR);
            $patientsStatement->bindValue(':firstname', $this->firstname,PDO::PARAM_STR);
            $patientsStatement->bindvalue(':birthdate',$this->birthdate,PDO::PARAM_STR);
            $patientsStatement->bindvalue(':phone',$this->phone,PDO::PARAM_STR);
            $patientsStatement->bindvalue(':mail',$this->mail,PDO::PARAM_STR);

            return $patientsStatement->execute();
		}

		public function delete()
		{
            $sql = 'DELETE FROM `patients` WHERE `id`=:id';
            $patientsDelete = $this->db->prepare($sql);
            $patientsDelete->bindValue(':id', $this->id,PDO::PARAM_INT);
            return $patientsDelete->execute();
        }
    }