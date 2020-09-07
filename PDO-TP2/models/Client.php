<?php
    // Création du chemin absolu permettant la connexion à la database.
    require_once dirname(__FILE__) . '/../utils/Database.php';

// Création de la classe Client.
class Client{

    // Déclaration des attributs de la classe.
    private $client_id;
    private $client_firstname;
    private $client_lastname;
    private $client_birthdate;
    private $client_address;
    private $client_zipcode;
    private $client_phone;
    private $client_statut_id;
    private $db;

    // Création d'un constructeur.
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
    * Permet la création d'un client.
    * @return boolean
    */

    public function create(){

        // Création de la requête SQL de création d'un client.
        $clients_sql = 'INSERT INTO `clients`(`client_firstname`, `client_lastname`,`client_birthdate`, `client_address`, `client_zipcode`, `client_phone`, `client_statut_id`) 
        VALUES (:firstname,:lastname,:birthdate,:addresse,:zipcode,:phone,:statut_id)';

        // Création d'une requête préparée avec prepare() pour se protéger des injections SQL.
        $clientStatement = $this->db->prepare($clients_sql);

        // Association d'une valeur à un paramètre via bindValue.
		// Les éléments de la requête SQL provenant de l’utilisateur sont remplacés par des marqueurs nominatifs auxquels on attribue une valeur grâce à la méthode bindValue().
        $clientStatement->bindValue(':firstname',$this->client_firstname, PDO::PARAM_STR);
        $clientStatement->bindValue(':lastname' ,$this->client_lastname, PDO::PARAM_STR);
        $clientStatement->bindValue(':birthdate' ,$this->client_birthdate, PDO::PARAM_STR);
        $clientStatement->bindValue(':addresse' ,$this->client_address, PDO::PARAM_STR);
        $clientStatement->bindValue(':zipcode' ,$this->client_zipcode, PDO::PARAM_STR);
        $clientStatement->bindValue(':phone' ,$this->client_phone, PDO::PARAM_STR);
        $clientStatement->bindValue(':statut_id',$this->client_statut_id,PDO::PARAM_INT);

        // Retourne le résultat de la méthode create().
        return $clientStatement->execute();
    }
    
    /**
    * Retourne la liste des clients.
    * @return array
    */

    public function readAll(){

        // Création d'une requête permettant de lire les infos des clients.
        $clients_sql = 'SELECT `client_id`,`client_firstname`, `client_lastname`, DATE_FORMAT(`client_birthdate`,"%d/%m/%y") as client_birthdate, `client_address`, `client_zipcode`, `client_phone` FROM `clients`';
        
        // "Query" renvoie le jeu de données associées à la requête.
        $listClientStatement = $this->db->query($clients_sql);
        
        // Création du tableau de données liées au jeu de données.
        $listClient = [];

        // Vérification que le jeu de données a bien été créé.
        if ($listClientStatement instanceof PDOstatement){
            $listClient = $listClientStatement->fetchAll(PDO::FETCH_OBJ);
        }

        // Retourne le résultat de la méthode readAll().
        return $listClient;
    }


    /**
    * Retourne le détail d'un client.
    * @return boolean
    */

    public function readSingle(){

        // Création d'une requête permettant de lire les infos d'un client.
        $clientListCredit_sql = '   SELECT `client_id`, `client_firstname`, `client_lastname`, DATE_FORMAT(`client_birthdate`,"%d/%m/%y") as client_birthdate, `client_address`, `client_zipcode`, `client_phone` ,statuts.statut 
                                    FROM clients JOIN statuts ON statuts.statut_id = `client_statut_id` 
                                    WHERE `client_id` = :id';
        
        // Création d'une requête préparée avec prepare() pour se protéger des injections SQL.
        $clientListCreditStatement = $this->db->prepare($clientListCredit_sql);

        // Association d'une valeur à un paramètre via bindValue.
        // Les éléments de la requête SQL provenant de l’utilisateur sont remplacés par des marqueurs nominatifs auxquels on attribue une valeur grâce à la méthode bindValue().
        $clientListCreditStatement->bindValue(':id', $this->client_id, PDO::PARAM_INT);
        
        // Initialisation de la variable user.
        $users = null;

        // Vérification que le jeu de données a bien été créé et affichage des données avec fetch car un seul profil client scanné.
        if ($clientListCreditStatement->execute()){
            $users = $clientListCreditStatement->fetch(PDO::FETCH_OBJ);
        }

        // Retourne le résultat de la méthode readSingle().
        return $users;
    }
}