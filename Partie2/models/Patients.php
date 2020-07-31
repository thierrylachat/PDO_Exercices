<?php
	// Création du chemin absolu vers la database
    require_once dirname(__FILE__).'/../assets/Database.php';
    
	/* Créer d'un patient. */

	class Patients
	{
		private $patients_id;
		private $lastname;
		private $firstname;
		private $birthdate;
		private $phone;
		private $mail;

		// function __construct($patients_id = 0, $lastname = '', $password = '')
		// {
		// 	$this->db = Database::getInstance();
			// $this->id_users = $id_users;
	    	// $this->login = $login;
	    	// $this->password = $password;
		}