<?php
// Création du chemin absolu permettant la connexion à la database.
require_once dirname(__FILE__).'/../utils/Database.php';

// Création de la classe patient.

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
	// Normalement dans la partie Controllers pour moi car réalise un contrôle...
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

		// Création d'une requête préparée avec prepare() pour se protéger des injections SQL.
		$patientstmt = $this->db->prepare($sql);

		// Association d'une valeur à un paramètre via bindValue.
		// Les éléments de la requête SQL provenant de l’utilisateur sont remplacés par des marqueurs nominatifs auxquels on attribue une valeur grâce à la méthode bindValue().
		$patientstmt->bindValue(':firstname',$this->firstname, PDO::PARAM_STR);
		$patientstmt->bindValue(':lastname',$this->lastname, PDO::PARAM_STR);
		$patientstmt->bindValue(':birthdate',$this->birthdate, PDO::PARAM_STR);
		$patientstmt->bindValue(':phone',$this->phone, PDO::PARAM_STR);
		$patientstmt->bindValue(':mail',$this->mail, PDO::PARAM_STR);

		// Exécution de la fonction.
		return $patientstmt->execute();
	}


	/** 
	 * Permet de supprimer un patient.
	 */

	public function delete()
	{
		// Création de la requête SQL de suppression de patient.
		$sql = 'DELETE FROM `patients` WHERE `id` = :id';

		// Création d'une requête préparée avec prepare() pour se protéger des injections SQL.
		$patientstmt = $this->db->prepare($sql);

		// Association d'une valeur à un paramètre via bindValue.
		// Les éléments de la requête SQL provenant de l’utilisateur sont remplacés par des marqueurs nominatifs auxquels on attribue une valeur grâce à la méthode bindValue().
		$patientstmt->bindValue(':id', $this->id, PDO::PARAM_INT);

		// Exécution de la fonction.
		return $patientstmt->execute();
	}

	/** 
	 * Permet de mettre à jour les données d'un profil patient.
	 */

	public function update(){

		// Création de la requête SQL de mise à jour des données du patient.
		$sql = 'UPDATE `patients` SET `lastname`= :lastname, `firstname`= :firstname, `birthdate`= :birthdate , `phone`= :phone, `mail`= :mail WHERE `id` = :id';

		// Création d'une requête préparée avec prepare() pour se protéger des injections SQL.
		$patientstmt = $this->db->prepare($sql);

		// Association d'une valeur à un paramètre via bindValue.
		// Les éléments de la requête SQL provenant de l’utilisateur sont remplacés par des marqueurs nominatifs auxquels on attribue une valeur grâce à la méthode bindValue().
		$patientstmt->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
		$patientstmt->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $patientstmt->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $patientstmt->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $patientstmt->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $patientstmt->bindValue(':id', $this->id, PDO::PARAM_INT);

		// Exécution de la fonction.
		// La méthode rowCount permet de retourner le nombre de lignes affectées avec un insert, delete et update.
		return $patientstmt->execute();

	}

	/**
	 * Retourne la liste des patients enregistrés. 
	 * @return array
	 */

	public function readAll()
	{
		// Création d'une requête permettant de lire les infos.
		$sql = 'SELECT `id`,`firstname`, `lastname`, DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdate` FROM `patients`';

		// "Query" renvoie le jeu de données associées à la requête.
		$patientstmt = $this->db->query($sql);

		// Création du tableau de données liées au jeu de données.
		$patientsList = [];

		// Vérification que le jeu de données a bien été créé.
		if($patientstmt instanceof PDOStatement)
		{
			$patientsList =  $patientstmt->fetchAll(PDO::FETCH_OBJ);
		}

		// Retourne le résultat de la fonction readAll().
		return $patientsList;
	}

	/**
	 * Retourne la liste des informations des profils des patients.
	 * @return array
	 */

	public function readSingle()
    {
        // :nomDeVariable pour les données en attente.
		// Création d'une requête permettant de lire les infos d'un patient avec l'ID (unique).
		$sql_viewPatients = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdate`,`phone`,`mail` FROM `patients` WHERE `id` = :id';
		
		// Création d'une requête préparée avec prepare() pour se protéger des injections SQL.
		$patientsStatement = $this->db->prepare($sql_viewPatients);

		// Les éléments de la requête SQL provenant de l’utilisateur sont remplacés par des marqueurs nominatifs auxquels on attribue une valeur grâce à la méthode bindValue().
		$patientsStatement->bindValue(':id', $this->id, PDO::PARAM_INT);

		// Si l'id du patient existe, exécution de la méthode pour créer le tableau qui affiche les données du patient.
        $patientsView = null;
        if ($patientsStatement->execute()){
            $patientsView = $patientsStatement->fetch(PDO::FETCH_OBJ);
		}
		
		// Retourne le résultat de la fonction readSingle().
        return $patientsView;
    }

}
