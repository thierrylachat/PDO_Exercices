<?php
	require_once dirname(__FILE__).'/../utils/Database.php';

	/**
	 * class for manage services
	 */
	class Service
	{
		
		private $id;
		private $name;
		private $description;
		private $database;

		function __construct($serviceArray = [])
		{
			$this->hydrate($serviceArray);
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

		private function hydrate($serviceArray)
		{
			foreach ($serviceArray as $key => $value) {
				if (property_exists($this, $key)) {
					$this->$key = $value;
				}
			}
		}

		public function readNames()
		{
			$select_SQL = 'SELECT `services_id`, `name` FROM `services`';
			$serviceStatement = $this->database->query($select_SQL);

			$service_list = [];

			if ($serviceStatement instanceof PDOStatement) {
				$service_list = $serviceStatement->fetchAll(PDO::FETCH_OBJ);
			}

			return $service_list;
		}
	}