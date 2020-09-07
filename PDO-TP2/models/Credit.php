<?php

    // Création du chemin absolu permettant la connexion à la database.
    require_once dirname(__FILE__) . '/../utils/Database.php';

    // Création de la classe Credit.
    class Credit{

        // Déclaration des attributs de la classe.
        private $credit_id;
        private $credit_organisation;
        private $credit_amount;
        private $credit_client_id;
        private $db;
    
        // Création d'un constructeur.
        public function __construct($id=0,$organisme='',$amound='',$client_id=0){
            $this->credit_id = $id;
            $this->credit_organisation = $organisme;
            $this->credit_amount = $amound;
            $this->credit_client_id = $client_id;
            $this->db = Database::getInstance();
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
        * Permet la création d'un crédit.
        * @return boolean
        */
    
        public function create(){

            // Création de la requête SQL de création d'un crédit.
            $credit_sql = 'INSERT INTO `credits`(`credit_organisation`, `credit_amount`, `credit_client_id`) 
            VALUES (:organisation,:amount,:credit_client_id)';

            // Création d'une requête préparée avec prepare() pour se protéger des injections SQL.
            $creditStatement = $this->db->prepare($credit_sql);

            // Association d'une valeur à un paramètre via bindValue.
		    // Les éléments de la requête SQL provenant de l’utilisateur sont remplacés par des marqueurs nominatifs auxquels on attribue une valeur grâce à la méthode bindValue().
            $creditStatement->bindValue(':organisation',$this->credit_organisation, PDO::PARAM_STR);
            $creditStatement->bindValue(':amount' ,$this->credit_amount, PDO::PARAM_STR);
            $creditStatement->bindValue(':credit_client_id' ,$this->credit_client_id, PDO::PARAM_STR);

            // Retourne le résultat de la méthode create().
            return $creditStatement->execute();
        }


        /**
        * Retourne la liste des crédits d'un client.
        * @return array
        */

        public function readAll(){

            // Création d'une requête permettant de lire les crédits d'un client donné.
            $clientListCredit_sql = 'SELECT `credit_id`,`credit_organisation`, `credit_amount` FROM `credits` WHERE  `credit_client_id` = :id';

            // Création d'une requête préparée avec prepare() pour se protéger des injections SQL.
            $clientListCreditStatement = $this->db->prepare($clientListCredit_sql);
            
            // Association d'une valeur à un paramètre via bindValue.
            // Les éléments de la requête SQL provenant de l’utilisateur sont remplacés par des marqueurs nominatifs auxquels on attribue une valeur grâce à la méthode bindValue().
            $clientListCreditStatement->bindValue(':id', $this->credit_client_id, PDO::PARAM_INT);
            
            // Création du tableau de données liées au jeu de données.
            $users = [];

            // Vérification que le jeu de données a bien été créé.
            if ($clientListCreditStatement->execute()){
                $users = $clientListCreditStatement->fetchAll(PDO::FETCH_OBJ);
            }

            // Retourne le résultat de la méthode readAll().
            return $users;
        }
    }