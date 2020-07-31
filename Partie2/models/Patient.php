<?php
// Création du chemin absolu vers la database.
require_once dirname(__FILE__).'/../utils/Database.php';

// Créer de la classe patient.

class Patient
{
    private $id;
    private $firstname;
    private $lastname;
    private $birthdate;
    private $phone;
    private $mail;
    private $db;

    // Création d'un constructeur avec des valeurs par défaut pour chaque attribut.
    public function __construct($id = 0, $firstname = '', $lastname = '', $birthdate = '', $phone = '', $mail = '')
    {
        // Hydratation des différentes propriétés.
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->birthdate = $birthdate;
        $this->phone = $phone;
        $this->mail = $mail;
        $this->db = Database::getInstance();
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
     * Permet de créer un patient dans la table patients
     * @return boolean
     */


	// Création d'une méthode pour insérer une adresse mail valide => Best Practice.
	// public function setMail($mail)
	// {
	// 	if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
	// 		$this->mail = $mail;			
	// 	}
	// }
	

	public function create()
	{
		// Création de la requête SQL de création de patients.
		$sql = 'INSERT INTO `patients` (`firstname`, `lastname`, `birthdate`, `phone`, `mail`) VALUES(:firstname,:lastname,:birthdate,:phone,:mail)';

		// Préparation de la requête.
		$patientstmt = $this->db->prepare($sql);

		// Association d'une valeur à un paramètre via bindValue.
		$patientstmt->bindValue(':firstname',$this->firstname, PDO::PARAM_STR);
		$patientstmt->bindValue(':lastname',$this->lastname, PDO::PARAM_STR);
		$patientstmt->bindValue(':birthdate',$this->birthdate, PDO::PARAM_STR);
		$patientstmt->bindValue(':phone',$this->phone, PDO::PARAM_STR);
		$patientstmt->bindValue(':mail',$this->mail, PDO::PARAM_STR);
		return $patientstmt->execute();
	}

	/**
	 * Retourne la liste des patients enregistrés. 
	 * @return array
	 */

	public function readAll()
	{
		// Création d'une requête permettant de lire les infos.
		$sql = 'SELECT `firstname`, `lastname`, `birthdate` FROM `patients`';

		// "Query" renvoie le jeu de données associées à la requête.
		$patientstmt = $this->db->query($sql);

		// Création du tableau de données liées au jeu de données.
		$patientsList = [];

		// Vérification que le jeu de données a bien été créé.
		if($patientstmt instanceof PDOStatement)
		{
			$patientsList =  $patientstmt->fetchAll(PDO::FETCH_OBJ);
		}
		return $patientsList;
	}


}
