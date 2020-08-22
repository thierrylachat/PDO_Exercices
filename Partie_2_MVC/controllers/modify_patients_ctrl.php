<?php 
require_once dirname(__FILE__).'/../model/Patients.php';
if (empty($_GET['id']) && empty($_POST['id']))
{
    header('location:liste_patients_ctrl.php');
    exit();
}

if (!empty($_GET['id'])) 
{
    $id = (int) $_GET['id'];
    $patient = new Patients($id);
    $patientInfos = $patient->readSingle();
    $firstname = $patientInfos->firstname;
    $lastname = $patientInfos->lastname;
    $birthdate = $patientInfos->birthdate;
    $phone = $patientInfos->phone;
    $mail = $patientInfos->mail;
}


    //validation des champs 
    $isSubmitted = false;
    $regexName = "/^[A-Za-zéÉ][A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ]+((-| )[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ]+)?$/";
    $regexDate = "/^((?:19|20)[0-9]{2})-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";
    $regexTel = "/^(?:\+33|0033|0)[1-79]((?:([\-\/\s\.])?[0-9]){2}){4}$/";
    $errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isSubmitted = true;
     //verif champ prénom
    $firstname = trim(filter_input(INPUT_POST,'firstname',FILTER_SANITIZE_STRING));//enlève les espaces vides avant et après + nettoyage en fonction du type 
    if (empty($firstname)) {//verifie si le champ est vide
        $errors['firstname'] = 'Veuillez renseigner le prénom';
    } elseif (!preg_match($regexName, $firstname)) {//comparatif avec la regex correspondante
        $errors['firstname'] = 'Votre prénom contient des caractères non autorisés !';
    }
     //verif champ nom
    $lastname = trim(filter_input(INPUT_POST,'lastname',FILTER_SANITIZE_STRING));
    if (empty($lastname)) {
        $errors['lastname'] = 'Veuillez renseigner le nom';
    } elseif (!preg_match($regexName, $lastname)) {
        $errors['lastname'] = 'Votre nom contient des caractères non autorisés !';
    }
     //verif champ date d'anniversaire
    $birthdate = trim(htmlspecialchars($_POST['birthdate']));
    if (empty($birthdate)) {
        $errors['birthdate'] = 'Veuillez renseigner votre date de naissance';
    } elseif (!preg_match($regexDate, $birthdate)) {
        $errors['birthdate'] = 'Le format valide est aaaa-mm-jj !';
    }
    //verif champ mail
    $mail = trim(htmlspecialchars($_POST['mail']));
    if (empty($mail)) {
        $errors['mail'] = 'Veuillez renseigner votre email';
    } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $errors['mail'] = 'L\' email  n\'est pas valide!';
    }
     //verif champ mobile
    $phone = trim(htmlspecialchars($_POST['phone']));
    if (empty($phone)) {
        $errors['phone'] = 'Veuillez renseigner votre téléphone';
    } elseif (!preg_match($regexTel, $phone)) {
        $errors['phone'] = 'Le format du téléphone n\'est pas valide!';
    }
    $id = (int) $_POST['id'];
}

if ($isSubmitted && count($errors)== 0) 
{
    $patient = new Patients ($id,$firstname,$lastname,$birthdate,$phone,$mail);
    if ($patient->update()) 
    {
        $updateSuccess = true;
    }
}
require_once dirname(__FILE__).'/../views/modify_patients.php';
?>
