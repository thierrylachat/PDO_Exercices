<?php
require_once dirname(__FILE__) . '/../utils/Database.php';
class Patient
{
    private $id;
    private $firstname;
    private $lastname;
    private $birthdate;
    private $phone;
    private $mail;
    private $db;

    public function __construct($id = 0, $firstname = '', $lastname = '', $birthdate = '', $phone = '', $mail = '')
    {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->birthdate = $birthdate;
        $this->phone = $phone;
        $this->mail = $mail;
        $this->db = Database::getInstance();
    }
    /**
     * méthode magique getter qui permettra de créer dynamiquement un getter pour chaque attribut existant.
     */
    public function __get($attr)
    {
        return $this->$attr;
    }

    public function __set($attr, $value)
    {
        $this->$attr = $value;
    }
    // public function setMail($mail)
    // {
    //     if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
    //         $this->mail = $mail;
    //     }
    // }
    /**
     * Permet de créer un patient dans la table patients
     * @return boolean
     */
    public function create()
    {
        $sql = 'INSERT INTO `patients` (`firstname`, `lastname`, `birthdate`, `phone`, `mail`) VALUES (:firstname,:lastname,:birthdate,:phone,:mail)';
        $patientstmt = $this->db->prepare($sql);

        $patientstmt->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $patientstmt->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $patientstmt->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $patientstmt->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $patientstmt->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        return $patientstmt->execute();
    }
}
