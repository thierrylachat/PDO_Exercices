<?php
    require_once dirname(__FILE__) . '/../utils/Database.php';

    class Statut{
        private $statut_id;
        private $statut;
        private $db;
    
        public function __construct($id=0,$statut=''){
            $this->statut_id = $id;
            $this->statut = $statut;
            $this->db = Database::getInstance();
        }
        public function __get($attr)
        {
            return $this->$attr;
        }
    
        public function __set($attr, $value)
        {
            $this->$attr = $value;
        }
    
        public function create(){
            $credit_sql = 'INSERT INTO `statuts`(`statut`) VALUES (:statut)';
            $creditStatement = $this->db->prepare($credit_sql);
            $creditStatement = bindValue(':statut',$this->statut, PDO::PARAM_STR);
            return $creditStatement->execute();
        }

        public function readAll(){
            $statut_sql = "SELECT `statut_id`, `statut` FROM `statuts`";
            $listStatutStatement = $this->db->query($statut_sql);
            $list=[];
            if ($listStatutStatement instanceof PDOstatement){
                $list = $listStatutStatement->fetchAll(PDO::FETCH_OBJ);
            }
            return $list;
        }
    }