<?php
	// chemin absolu
	// !!! a utiliser pour cloud projet
	require_once dirname(__FILE__).'/../utils/Database.php';
	/**
	 * Créer un utilisateur
	 */
	class User
	{
		private $id_users;
		private $login;
		private $password;
		private $db;

		function __construct($id_users = 0, $login = '', $password = '')
		{
			$this->db = Database::getInstance();
			$this->id_users = $id_users;
	    	$this->login = $login;
	    	$this->password = $password;
		}

		function __get($attr)
		{
			return $this->$attr;
		}

		public function create()
		{
			$sql = 'INSERT INTO `users`(`login`, `password`) VALUES (:login, :password)';
			$userStatment = $this->db->prepare($sql);
			$userStatment->bindValue(':login', $this->login, PDO::PARAM_STR);
			$userStatment->bindValue(':password', $this->password, PDO::PARAM_STR);
			return $userStatment->execute();
		}

		public function readAll()
		{
			
		}

		public function readSingle()
		{
			// :nomDeVariable pour les données en attentes
			$sql = 'SELECT `id_users`, `login`, `password` FROM `users` WHERE `login` = :login OR `id_users` = :id_users';
			$userStatment = $this->db->prepare($sql);
			$userStatment->bindValue(':login', $this->login, PDO::PARAM_STR);
			$userStatment->bindValue(':id_users', $this->id_users, PDO::PARAM_STR);
			$userInfo = null;
			if ($userStatment->execute()){
				$userInfo = $userStatment->fetch(PDO::FETCH_OBJ);
			}
			return $userInfo;
		}

		public function update()
		{
			
		}

		public function delete()
		{
			
		}
	}