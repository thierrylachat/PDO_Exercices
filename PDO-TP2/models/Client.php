<?php
    require_once dirname(__FILE__) . '/../utils/Database.php';

class Client{
    private $client_id;
    private $client_firstname;
    private $client_lastname;
    private $client_birthdate;
    private $client_address;
    private $client_zipcode;
    private $client_phone;
    private $client_statut_id;
    private $db;

    public function __construct($id=0,$firstname='',$lastname='',$birthdate='',$address='',$zipcode='',$phone='',$statut_id=0){
        $this->client_id = $id;
        $this->client_firstname = $firstname;
        $this->client_lastname = $lastname;
        $this->client_birthdate = $birthdate;
        $this->client_address = $address;
        $this->client_zipcode = $zipcode;
        $this->client_phone = $phone;
        $this->client_statut_id = $statut_id;
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
        $clients_sql = 'INSERT INTO `clients`(`client_firstname`, `client_lastname`,`client_birthdate`, `client_address`, `client_zipcode`, `client_phone`, `client_statut_id`) 
        VALUES (:firstname,:lastname,:birthdate,:addresse,:zipcode,:phone,:statut_id)';
        $clientStatement = $this->db->prepare($clients_sql);
        $clientStatement->bindValue(':firstname',$this->client_firstname, PDO::PARAM_STR);
        $clientStatement->bindValue(':lastname' ,$this->client_lastname, PDO::PARAM_STR);
        $clientStatement->bindValue(':birthdate' ,$this->client_birthdate, PDO::PARAM_STR);
        $clientStatement->bindValue(':addresse' ,$this->client_address, PDO::PARAM_STR);
        $clientStatement->bindValue(':zipcode' ,$this->client_zipcode, PDO::PARAM_STR);
        $clientStatement->bindValue(':phone' ,$this->client_phone, PDO::PARAM_STR);
        $clientStatement->bindValue(':statut_id',$this->client_statut_id,PDO::PARAM_INT);

        return $clientStatement->execute();
    }
    public function readAll(){
        $clients_sql = 'SELECT `client_id`,`client_firstname`, `client_lastname`, DATE_FORMAT(`client_birthdate`,"%d/%m/%y")as client_birthdate, `client_address`, `client_zipcode`, `client_phone` FROM `clients`';
        $listClientStatement = $this->db->query($clients_sql);
        $listClient = [];
        if ($listClientStatement instanceof PDOstatement){
            $listClient = $listClientStatement->fetchAll(PDO::FETCH_OBJ);
        }
        return $listClient;
    }
    public function readSingle(){
        $clientListCredit_sql = '   SELECT `client_id`, `client_firstname`, `client_lastname`, DATE_FORMAT(`client_birthdate`,"%d/%m/%y")as client_birthdate, `client_address`, `client_zipcode`, `client_phone` ,statuts.statut 
                                    FROM clients JOIN statuts ON statuts.statut_id = `client_statut_id` 
                                    WHERE `client_id` = :id';
        $clientListCreditStatement = $this->db->prepare($clientListCredit_sql);
        $clientListCreditStatement->bindValue(':id', $this->client_id, PDO::PARAM_INT);
        $users = null;
        if ($clientListCreditStatement->execute()){
            $users = $clientListCreditStatement->fetch(PDO::FETCH_OBJ);
        }
        return $users;
    }
}