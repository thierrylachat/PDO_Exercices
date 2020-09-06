<?php
	require_once dirname(__FILE__).'/../models/User.php';
	require_once dirname(__FILE__).'/../models/Service.php';

	// Instanciation de nouveaux objets.
	$user = new User;
	$service = new Service;

	// Appel de la méthode readNames() qui affiche les services dans le menu déroulant.
	$service_list = $service->readNames();

	// Suppression d'un utilisateur.
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// Nettoyage de la donnée.
		$users_id = trim(filter_input(INPUT_POST, 'users_id', FILTER_SANITIZE_NUMBER_INT));
		// Réhydratation de l'attribut id de notre objet user avec une autre valeur.
		$user->id = $users_id; 
		// Appel de la fonction delete().
		$user->delete();
	}

	// Sélection des utilisateurs par service via le menu déroulant.
	if(!empty($_GET['filter']) && ctype_digit($_GET['filter'])){
		// Nettoyage de la donnée.
		$service_id = trim(filter_input(INPUT_GET, 'filter', FILTER_SANITIZE_NUMBER_INT));
		// Réhydratation de l'attribut id de notre objet user avec une autre valeur.
		$user->service_id = $service_id;
		// Appel de la méthode readFilter().
		$user_list = $user->readFilter();
	} else {
		// Appel de la méthode readAll().
		$user_list = $user->readAll();
	}
	
	// SI "filter" GET (REQUETE AJAX) ALORS ON JSON_ENCODE. 
	if(isset($_GET['filter']))
		echo json_encode($user_list);
?>