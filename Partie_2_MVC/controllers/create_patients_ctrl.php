<?php
    require_once dirname(__FILE__).'/../model/Patients.php';
    
    // Validation des données utilisateurs.
    $isSubmitted = false;
    $regexName = "/^[A-Za-zéÉ][A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ]+((-| )[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ]+)?$/";
    $regexDate = "/^((?:19|20)[0-9]{2})-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";
    $regexTel = "/^(?:\+33|0033|0)[1-79]((?:([\-\/\s\.])?[0-9]){2}){4}$/";
    $firstname = $lastname = $birthdate = $phone = $mail='';
    $errors = [];

    // Soumission du formulaire.
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Best Pratice : appel du fichier verifies qui contient les vérifications du formulaire pour éviter de répéter le code.
        require_once dirname(__FILE__) . '/../controllers/verifies.php';
    }

// Soumission du formulaire et vérification de l'absence d'erreurs.
if ($isSubmitted && count($errors)== 0) {

    // Instanciation d'un nouvel objet.
    $patients = new Patients (0, $_POST['firstname'],$_POST['lastname'],$_POST['birthdate'],$_POST['phone'],$_POST['mail']);
    
    // Appel de la fonction create() du model qui va permettre de créer un nouveau patient.
    if($patients->create())
    {
        // Affichage du message de succès de création de nouveau patient. 
        $createPatientsSuccess = true;
    }
}
    require_once dirname(__FILE__).'/../views/create_patients.php';