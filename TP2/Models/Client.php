<?php

    // Création du chemin absolu permettant la connexion à la database.
    require_once dirname(__FILE__).'/../utils/Database.php';
    
    // Création de la classe Client.

    class Client 
    {
        // Déclaration des attributes de la classe.
        private $db; // Ne pas oublier l'attribut database.
        private $id;
        private $lastname;
        private $firstname;
        private $birthdate;
        private $address;
        private $zipcode;
        private $city;
        private $phoneNumber;
        private $id_status;


        // Création d'un constructeur avec des valeurs par défaut pour chaque attribut.
        public function __construct($_id = 0, $_lastname = '', $_firstname = '', $_birthdate = '', $_address = '', $_zipcode = '', $_city = '', $_phoneNumber = '', $_id_status = 0)
        {
            // Hydratation des différents propriétés. Penser à la database !
            $this->db = Database::getInstance();
            $this->id = $_id;
            $this->lastname = $_lastname;
            $this->firstname = $_firstname;
            $this->birthdate = $_birthdate;
            $this->address = $_address;
            $this->zipcode = $_zipcode;
            $this->city = $_city;
            $this->phoneNumber = $_phoneNumber;
            $this->id_status = $_id_status;

        } 

        // Création de méthodes permettant d'accéder à des propriétés privées.
            
        public function __get($attr)
        {
            return $this->$attr;
        }

        public function __set($attr, $value)
        {
            $this->$attr = $value;
        }

        /**
        * Retourne la liste des clients
        * @return array
        */

        public function readAll()
        {
        // Création d'une requête permettant de récupérer la liste des clients.
        $userList_sql = 'SELECT c.`id`, c.`lastname`, c.`firstname`, c.`birthdate`, c.`address`, c.`zipcode`, c.`city`, c.`phoneNumber`, c.`id_status` FROM `clients` AS c JOIN `status` AS s ON c.`id_status` = s.`id`';
        
        // "Query" renvoie le jeu de données associées à la requête.
        $userListStatement = $this->db->query($userList_sql);
        
        // Création du tableau de données liées au jeu de données.
        $usersList = [];

        // Vérification que le jeu de données a bien été créé.
        if($userListStatement instanceof PDOstatement) {
            $userList = $userListStatement->fetchAll(PDO::FETCH_OBJ);
        }

        // Retourne le résultat de la fonction readAll().
        return $usersList;
        }
    }