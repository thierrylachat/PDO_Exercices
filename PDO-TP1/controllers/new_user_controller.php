<?php
	require_once dirname(__FILE__).'/../models/User.php';
	require_once dirname(__FILE__).'/../models/Service.php';

	// Instanciation d'un nouvel objet.
	$service = new Service;

	// Remarque : il est possible de mettre toutes les vérifications dans un fichier à part, notamment s'il existe plusieurs formulaires sur le site.
	
	// Initialisation de variables.
	$isSubmitted = false;
	$createSuccess = false;
	$lastname = null;
	$firstname = null;
	$birthdate = null;
	$address = null;
	$city = null;
	$zipcode = null;
	$service_id = null;
	$errors = [];

	// Soumission du formulaire.
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$isSubmitted = true;

		// Vérification du champ prénom.
		$firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
		// Retrait des espaces vides avant et après + nettoyage en fonction du type.
		if (empty($firstname)){ // Vérification du remplissage du champ.
        	$errors['firstname'] = 'Veuillez renseigner un prénom.';
    	} // Comparatif avec la regex correspondante.
    	elseif (!preg_match('/^[a-zéèîïêëç]+((?:\-|\s)[a-zéèéîïêëç]+)?$/i', $firstname)) {
        	$errors['firstname'] = 'Le format attendu n\'est pas respecté';
    	}

		// Vérification du champ nom.
    	$lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
    	if (empty($lastname)){
        	$errors['lastname'] = 'Veuillez renseigner un nom.';
    	}
    	elseif (!preg_match('/^[a-zéèîïêëç]+((?:\-|\s)[a-zéèéîïêëç]+)?$/i', $lastname)) {
        	$errors['lastname'] = 'Le format attendu n\'est pas respecté';
    	}

		// Vérification du champ date de naissance.
    	$birthdate = trim(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING));
    	if (!empty($birthdate)) {   		
    		$today = strtotime("NOW");
    		$convertBirthdate = strtotime($birthdate);
    		if (!preg_match('/^((?:19|20)[0-9]{2})-((?:0[1-9])|(?:1[0-2]))-((?:0[1-9])|(?:1[0-9])|(?:2[0-9])|(?:3[01]))$/', $birthdate)) {
    			$errors['birthdate'] = 'Veuillez renseigner une date correcte';
    		}
    		elseif ($convertBirthdate > $today) {
    			$errors['birthdate'] = 'La date ne peut pas être supérieure à la date du jour';
    		}
    	}
    	else{
    		$errors['birthdate'] = 'Veuillez renseigner une date de naissance';
    	}

		// Vérification du champ adresse.
    	$address = trim(filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING));
    	if (empty($address)) {
    		$errors['address'] = 'Veuillez renseigner une adresse';
    	}
    	elseif (!preg_match('/^([0-9]{0,4})(\s)*([a-zA-Z\séèîïêëçà]{2,100})$/i', $address)) {
        	$errors['address'] = 'Le format attendu n\'est pas respecté';
    	}

		// Vérification du champ code postal.
    	$zipcode = trim(filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_NUMBER_INT));
    	if (empty($zipcode)) {
    		$errors['zipcode'] = 'Veuillez renseigner un code postal';
    	}
    	elseif (!preg_match('/^(([0-8][0-9])|(9[0-5]))[0-9]{3}$/i', $zipcode)) {
    		$errors['zipcode'] = 'Le format attendu n\'est pas respecté';
    	}

		// Vérification du champ ville.
    	$city = trim(filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING));
    	if (empty($city)) {
    		$errors['city'] = 'Veuillez renseigner une ville';
    	}
    	elseif (!preg_match('/^[a-zéèîïêëçà]+((?:\-|\s|\')[a-zéèéîïêëçà]+)?$/i', $city)) {
    		$errors['city'] = 'Le format attendu n\'est pas respecté';
    	}

		// Vérification du champ téléphone.
    	$phone = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT));
    	if (empty($phone)) {
    		$errors['phone'] = 'Veuillez renseigner un numéro de téléphone';
    	}
    	elseif (!preg_match('/^(?:\+33|0033|0)[1-79]((?:([\-\/\s\.])?[0-9]){2}){4}/i', $phone)) {
    		$errors['phone'] = 'Le format attendu n\'est pas respecté';
    	}

		// Vérification du champ service.
    	$service_id = trim(filter_input(INPUT_POST, 'service', FILTER_SANITIZE_NUMBER_INT));
    	if (empty($service_id)) {
    		$errors['service'] = 'Veuillez choisir un service';
    	}
    	elseif (!ctype_digit($service_id)) {
    		$errors['service'] = 'Le service n\'est pas reconnu';
    	}
	}

	// Soumission du formulaire et vérification de l'absence d'erreurs.
	if($isSubmitted && count($errors) == 0){

		// Formatage des données du téléphone et de l'adresse.
		$phone = str_replace('+33', '0', $phone);
    	$phone = str_replace(' ', '', $phone);
    	$phone = str_replace('.', '', $phone);
    	$phone = str_replace('-', '', $phone);

		$address = $address.' - '.$city;
		
		// Création du tableau permettant d'hydrater la classe User.
    	$userArray = array('lastname' => $lastname, 'firstname' => $firstname, 'birthdate' => $birthdate, 'address' => $address, 'zipcode' => $zipcode, 'phone' => $phone, 'service_id' => $service_id);

		// Instanciation d'un nouvel objet User.
    	$user = new User($userArray);

		// Affichage d'un message de succès en cas de création d'un nouvel utilisateur réussie.
    	if ($user->create()) {
    		$createSuccess = true;
    	}
	}

	// Appel de la méthode readNames() qui affiche les services dans le menu déroulant.
	$service_list = $service->readNames();

	require_once dirname(__FILE__).'/../views/new_user_view.php';