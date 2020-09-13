<?php
        $isSubmitted = true;

        // Vérification du champ prénom.
        $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING)); //enlève les espaces vides avant et après + nettoyage en fonction du type
        if (empty($firstname)) { //verifie si le champ est vide
            $errors['firstname'] = 'Veuillez renseigner le prénom';
        } elseif (!preg_match($regexName, $firstname)) { //comparatif avec la regex correspondante
            $errors['firstname'] = 'Votre prénom contient des caractères non autorisés !';
        }
        
        // Vérification du champ nom.
        $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
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
?>