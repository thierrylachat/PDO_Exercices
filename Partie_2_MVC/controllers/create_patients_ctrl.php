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
         
        // Vérification du champ date de naissance.
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
    }
    
    // Soumission du formulaire et vérification de l'absence d'erreurs.
    if($isSubmitted && count($errors) == 0){
    
        // Instanciation d'un nouvel objet.
        $patient = new Patients(0, $firstname, $lastname, $birthdate, $phone, $mail);
    
        // Appel de la fonction create() du model qui va permettre de créer un nouveau patient.
        if($patient->create())
        {
            // Affichage du message de succès de création de nouveau patient. 
            $createPatientsSuccess = true;
        }
    }

    require_once dirname(__FILE__).'/../views/create_patients.php';