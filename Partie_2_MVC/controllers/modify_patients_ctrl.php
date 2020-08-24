<?php 
require_once dirname(__FILE__).'/../model/Patients.php';

// Redirection vers la liste des patients en cas d'absence d'ID.
if (empty($_GET['id']) && empty($_POST['id']))
{
    header('location:liste_patients_ctrl.php');
    exit();
}

// Récupération de l'ID en GET quand la page de profil est affichée (voir l'affichage de l'url avec l'ID au survol du bouton "Modifier les informations du patient").
if (!empty($_GET['id'])) 
{
    // Conversion des éléments en entier pour éviter l'injection de SQL.
    $id = (int) $_GET['id'];

    // Instanciation d'un nouvel objet.
    $patient = new Patients($id);

    // Appel de la fonction readSingle() du model qui va permettre de lire les infos d'un patient.
    $patientInfos = $patient->readSingle();

    // Création de variables.
    $firstname = $patientInfos->firstname;
    $lastname = $patientInfos->lastname;
    $birthdate = $patientInfos->birthdate;
    $phone = $patientInfos->phone;
    $mail = $patientInfos->mail;
}

// Validation des données utilisateurs.
$isSubmitted = false;
$regexName = "/^[A-Za-zéÉ][A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ]+((-| )[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ]+)?$/";
$regexDate = "/^((?:19|20)[0-9]{2})-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";
$regexTel = "/^(?:\+33|0033|0)[1-79]((?:([\-\/\s\.])?[0-9]){2}){4}$/";
$errors = [];

// Soumission du formulaire.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isSubmitted = true;

    // Vérification du champ prénom.
    $firstname = trim(filter_input(INPUT_POST,'firstname',FILTER_SANITIZE_STRING));
    // Retrait des espaces vides avant et après + nettoyage en fonction du type.
    if (empty($firstname)) { // Vérification du remplissage du champ.
        $errors['firstname'] = 'Veuillez renseigner le prénom';
    } elseif (!preg_match($regexName, $firstname)) { // Comparatif avec la regex correspondante.
        $errors['firstname'] = 'Votre prénom contient des caractères non autorisés !';
    }

    // Vérification du champ nom.
    $lastname = trim(filter_input(INPUT_POST,'lastname',FILTER_SANITIZE_STRING));
    if (empty($lastname)) {
        $errors['lastname'] = 'Veuillez renseigner le nom';
    } elseif (!preg_match($regexName, $lastname)) {
        $errors['lastname'] = 'Votre nom contient des caractères non autorisés !';
    }
    
    // Vérification du champ date d'anniversaire.
    $birthdate = trim(htmlspecialchars($_POST['birthdate']));
    if (empty($birthdate)) {
        $errors['birthdate'] = 'Veuillez renseigner votre date de naissance';
    } elseif (!preg_match($regexDate, $birthdate)) {
        $errors['birthdate'] = 'Le format valide est aaaa-mm-jj !';
    }
    
     // Vérification du champ mail.
    $mail = trim(htmlspecialchars($_POST['mail']));
    if (empty($mail)) {
        $errors['mail'] = 'Veuillez renseigner votre email';
    } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $errors['mail'] = 'L\' email  n\'est pas valide!';
    }
    
    // Vérification du champ mobile.
    $phone = trim(htmlspecialchars($_POST['phone']));
    if (empty($phone)) {
        $errors['phone'] = 'Veuillez renseigner votre téléphone';
    } elseif (!preg_match($regexTel, $phone)) {
        $errors['phone'] = 'Le format du téléphone n\'est pas valide!';
    }

    // Récupération de l'ID du POST via l'input caché.
    $id = (int) $_POST['id'];
}

// Soumission du formulaire et vérification de l'absence d'erreurs.
if ($isSubmitted && count($errors)== 0) 
{   
    // Instanciation d'un nouvel objet.
    $patient = new Patients ($id, $firstname, $lastname, $birthdate, $phone, $mail);

    // Appel de la fonction update() du model qui va permettre de mettre à jour le profil d'un patient avec affichage d'un message de succès.
    if ($patient->update()) 
    {
        $updateSuccess = true;
    }
}

require_once dirname(__FILE__).'/../views/modify_patients.php';
?>
