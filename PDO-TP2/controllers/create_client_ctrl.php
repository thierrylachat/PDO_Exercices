<?php 
require_once dirname(__FILE__).'/../models/Client.php';
require_once dirname(__FILE__).'/../models/Statut.php';
require_once dirname(__FILE__).'/../utils/regex.php';

// =============INITIALISATION DE TOUTES LES VARIABLES ===============//
$isSubmitted = false;
$client_id = 0;
$lastname = '';
$firstname = '';
$birthdate = '';
$address = '';
$zipcode = '';
$phone= '';
$statut_id = 0;
$errors = [];
// ====================================================//

// =============VERIFICATION DES CHAMPS DU FORMULAIRE===============//
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isSubmitted = true;

    // Vérification du champ nom.
    $firstname = trim(filter_input(INPUT_POST,'firstname',FILTER_SANITIZE_STRING));
    if (empty($firstname)) {
        $errors['firstname'] = 'Veuillez renseigner le nom';
    } 
    elseif (!preg_match($regexName, $firstname)) {
        $errors['firstname'] = 'Votre nom contient des caractères non autorisés !';
    }

    // Vérification du champ prénom.
    $lastname = trim(filter_input(INPUT_POST,'lastname',FILTER_SANITIZE_STRING));//enlève les espaces vides avant et après + nettoyage en fonction du type 
    if (empty($lastname)) {//verifie si le champ est vide
        $errors['lastname'] = 'Veuillez renseigner le prénom';
    } elseif (!preg_match($regexName, $lastname)) {//comparatif avec la regex correspondante
        $errors['lastname'] = 'Votre prénom contient des caractères non autorisés !';
    }

    // Vérification du champ date d'anniversaire.
    $birthdate = trim(htmlspecialchars($_POST['birthdate']));
    if (empty($birthdate)) {
        $errors['birthdate'] = 'Veuillez renseigner votre date de naissance';
    } elseif (!preg_match($regexDate, $birthdate)) {
        $errors['birthdate'] = 'Le format valide est aaaa-mm-jj !';
    }

    // Vérification du champ mobile.
    $phone = trim(htmlspecialchars($_POST['phone']));
    if (empty($phone)) {
        $errors['phone'] = 'Veuillez renseigner votre téléphone';
    } elseif (!preg_match($regexTel, $phone)) {
        $errors['phone'] = 'Le format du téléphone n\'est pas valide!';
    }

    // Vérification du champ addresse.
    $address = trim(htmlspecialchars($_POST['address']));
    if (empty($address)) {
        $errors['address'] = 'Veuillez renseigner votre adresse';
    } elseif (!preg_match($regexAddress, $address)) {
        $errors['address'] = 'Le format de l\'adresse n\'est pas valide!';
    }

    // Vérification du champ zipcode.
    $zipcode = trim(htmlspecialchars($_POST['zipcode']));
    if (empty($zipcode)) {
        $errors['zipcode'] = 'Veuillez renseigner votre code postal';
    } elseif (!preg_match($regexZipcode, $zipcode)) {
        $errors['zipcode'] = 'Le format du code postal n\'est pas valide!';
    }

    $statut_id = trim(filter_input(INPUT_POST,'statut_id',FILTER_SANITIZE_NUMBER_INT));
    if (empty($statut_id)) {
        $errors['statut_id'] = 'Veuillez renseigner votre statut';
    }
}


// ============ CREATION DU CLIENT ========================//

// Soumission du formulaire et vérification de l'absence d'erreurs.
if($isSubmitted && count($errors) == 0)
{
    // Instanciation d'un nouvel objet Client.
    $client = new Client($client_id, $firstname, $lastname, $birthdate, $address, $zipcode, $phone, $statut_id);
    
    // Affichage d'un message de succès en cas de création d'un nouvel client réussie.
    if($client->create())
    {
        $createSuccess = true;
    }
}
// =====================================================//

// ============ LISTE DES STATUTS ================//

// Instanciation d'un nouvel objet Statut.
$statut = new Statut();

// Appel de la méthode readAll() qui affiche la liste des statuts.
$statut_list = $statut->readAll();
// ====================================================//


require_once dirname(__FILE__).'/../views/create_client.php';