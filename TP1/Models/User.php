<?php

    // Création du chemin absolu permettant la connexion à la database.
    require_once dirname(__FILE__).'/../Utils/Database.php';

    // Création de la classe User.

    class User
    {
        // Déclaration des attributs de la classe.
        private $db;
        private $id;
        private $lastname;
        private $firstname;
        private $birthdate;
        private $address;
        private $zipcode;
        private $phoneNumber;
        private $service; 
        // Penser aux clés étrangères !


        // Création d'un constructeur avec des valeurs par défaut pour chaque attribut.
        public function __construct($_id = 0, $_lastname = '', $_firstname = '', $_birthdate = '', $_address = '', $_zipcode = '', $_phoneNumber = '', $_service = 0)
        {
            // Hydratation des différentes propriétés.
            // Penser à la database !
            $this->db = Database::getInstance();
            $this->id = $_id;
            $this->lastname = $_lastname;
            $this->firstname = $_firstname;
            $this->birthdate = $_birthdate;
            $this->address = $_address;
            $this->zipcode = $_zipcode;
            $this->phoneNumber = $_phoneNumber;
            $this->service = $_service;
        }

        
        // Méthodes permettant d'accéder à des propriétés privées.
        public function __get($attr)
        {
            return $this->$attr;
        }

        public function __set($attr, $value)
        {
            $this->$attr = $value;
        }


         /**
         * Retourne la liste des utilisateurs.
         * @return array
         */
        
        public function readAll()
        {
        
            // Création d'une requête permettant de lire les infos d'un utilisateur.
            // Le TIMESTAMPDIFF permet ici de récupérer l'âge à partir de la date de naissance.
            $usersList_sql = 'SELECT u.`id`, u.`lastname`, u.`firstname`, TIMESTAMPDIFF(year, u.`birthdate`, CURRENT_DATE) AS `age`, u.`address`, u.`zipcode`, u.`phoneNumber`, s.`name` FROM `users` AS u JOIN `services` AS s ON u.`service` = s.`id`'; 

            // "Query" renvoie le jeu de données associées à la requête.
            $usersListStatement = $this->db->query($usersList_sql);

            // Création du tableau de données liées au jeu de données.
            $usersList = [];

            // Vérification que le jeu de données a bien été créé.
            if ($usersListStatement instanceof PDOstatement ) {
                $usersList = $usersListStatement->fetchAll(PDO::FETCH_OBJ);
            }

            // Retourne le résultat de la fonction readAll().
            return $usersList;
        }      
    }