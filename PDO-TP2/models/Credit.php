<?php
    require_once dirname(__FILE__) . '/../utils/Database.php';

    class Credit{
        private $credit_id;
        private $credit_organisation;
        private $credit_amount;
        private $credit_client_id;
        private $db;
    
        public function __construct($id=0,$organisme='',$amound='',$client_id=0){
            $this->credit_id = $id;
            $this->credit_organisation = $organisme;
            $this->credit_amount = $amound;
            $this->credit_client_id = $client_id;
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
            $credit_sql = 'INSERT INTO `credits`(`credit_organisation`, `credit_amount`, `credit_client_id`) 
            VALUES (:organisation,:amount,:credit_client_id)';
            $creditStatement = $this->db->prepare($credit_sql);
            $creditStatement->bindValue(':organisation',$this->credit_organisation, PDO::PARAM_STR);
            $creditStatement->bindValue(':amount' ,$this->credit_amount, PDO::PARAM_STR);
            $creditStatement->bindValue(':credit_client_id' ,$this->credit_client_id, PDO::PARAM_STR);
            return $creditStatement->execute();
        }
        public function readAll(){
            $clientListCredit_sql = 'SELECT `credit_id`,`credit_organisation`, `credit_amount` FROM `credits` WHERE  `credit_client_id` = :id';
            $clientListCreditStatement = $this->db->prepare($clientListCredit_sql);
            $clientListCreditStatement->bindValue(':id', $this->credit_client_id, PDO::PARAM_INT);
            $users = [];
            if ($clientListCreditStatement->execute()){
                $users = $clientListCreditStatement->fetchAll(PDO::FETCH_OBJ);
            }
            return $users;
        }
    }