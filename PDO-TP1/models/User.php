<?php
	require_once dirname(__FILE__).'/../utils/Database.php';

	/**
	 * class for manage users
	 */
	class User
	{
		
		private $id;
		private $lastname;
		private $firstname;
		private $birthdate;
		private $address;
		private $zipcode;
		private $phone;
		private $service_id;
		private $database;

		public function __construct($userArray = [])
		{
			$this->hydrate($userArray);
	        $this->database = Database::getPDO();
		}
		
		public function __get($attr)
	    {
	        return $this->$attr;
	    }
		
	    public function __set($attr, $value)
	    {
	        $this->$attr = $value;
	    }

		private function hydrate($userArray)
		{
			foreach ($userArray as $key => $value) {
				if (property_exists($this, $key)) {
					$this->$key = $value;
				}
			}
		}

		public function readAll()
		{
			$select_SQL = 'SELECT users.users_id, users.lastname, users.firstname, TIMESTAMPDIFF(year, users.birthdate, CURRENT_DATE) AS age, users.address, users.zipcode, users.phone, services.name AS service_name FROM users JOIN services ON users.services_id = services.services_id ORDER BY users.lastname ASC';
			$userStatement = $this->database->query($select_SQL);

			$user_list = [];

			if ($userStatement instanceof PDOStatement) {
				$user_list = $userStatement->fetchAll(PDO::FETCH_OBJ);
			}

			return $user_list;
		}

		public function create()
		{
			$insert_SQL = 'INSERT INTO users(lastname, firstname, birthdate, address, zipcode, phone, services_id) VALUES (:lastname, :firstname, :birthdate, :address, :zipcode, :phone, :services_id)';
			$userStatement = $this->database->prepare($insert_SQL);

			$userStatement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
			$userStatement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        	$userStatement->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        	$userStatement->bindValue(':address', $this->address, PDO::PARAM_STR);
        	$userStatement->bindValue(':zipcode', $this->zipcode, PDO::PARAM_INT);
        	$userStatement->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        	$userStatement->bindValue(':services_id', $this->service_id, PDO::PARAM_INT);

        	return $userStatement->execute();
		}

		public function readFilter()
		{
			$select_SQL = 'SELECT users.users_id, users.lastname, users.firstname, TIMESTAMPDIFF(year, users.birthdate, CURRENT_DATE) AS age, users.address, users.zipcode, users.phone, services.name AS service_name FROM users JOIN services ON users.services_id = services.services_id WHERE services.services_id = :services_id';
			$userStatement = $this->database->prepare($select_SQL);

			$userStatement->bindValue(':services_id', $this->service_id, PDO::PARAM_INT);

			$user_list_filter = [];

			if ($userStatement->execute()) {
				$user_list_filter = $userStatement->fetchAll(PDO::FETCH_OBJ);
			}

			return $user_list_filter;
		}

		public function delete()
		{
			$delete_SQL = 'DELETE FROM users WHERE users_id = :id';
			$deleteStatement = $this->database->prepare($delete_SQL);

			$deleteStatement->bindValue(':id', $this->id, PDO::PARAM_INT);

			return $deleteStatement->execute();
		}
	}