<?php

    // Création du chemin absolu permettant la connexion à la database.
    require_once dirname(__FILE__) . '/../utils/Database.php';

    // Création de la classe Statut.
    class Statut{

        // Déclaration des attributs de la classe.
        private $statut_id;
        private $statut;
        private $db;
    
        // Création d'un constructeur.
        public function __construct($id=0,$statut=''){
            $this->statut_id = $id;
            $this->statut = $statut;
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
        * Permet la création d'un statut.
        * @return boolean
        */

        public function create(){

            // Création de la requête SQL de création d'un statut.
            $credit_sql = 'INSERT INTO `statuts`(`statut`) VALUES (:statut)';
            
            // Création d'une requête préparée avec prepare() pour se protéger des injections SQL.
            $creditStatement = $this->db->prepare($credit_sql);
            
            // Association d'une valeur à un paramètre via bindValue.
		    // Les éléments de la requête SQL provenant de l’utilisateur sont remplacés par des marqueurs nominatifs auxquels on attribue une valeur grâce à la méthode bindValue().
            $creditStatement = bindValue(':statut',$this->statut, PDO::PARAM_STR);
            
            // Retourne le résultat de la méthode create().
            return $creditStatement->execute();
        }


         /**
        * Retourne la liste des statuts.
        * @return array
        */

        public function readAll(){

            // Création d'une requête permettant de lire les statuts.
            $statut_sql = "SELECT `statut_id`, `statut` FROM `statuts`";

            // "Query" renvoie le jeu de données associées à la requête.
            $listStatutStatement = $this->db->query($statut_sql);

            // Création du tableau de données liées au jeu de données.
            $list=[];

            // Vérification que le jeu de données a bien été créé.
            if ($listStatutStatement instanceof PDOstatement){
                $list = $listStatutStatement->fetchAll(PDO::FETCH_OBJ);
            }

            // Retourne le résultat de la méthode readAll().
            return $list;
        }
    }