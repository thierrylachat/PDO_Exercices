<?php
	require_once dirname(__FILE__).'/../models/User.php';
	require_once dirname(__FILE__).'/../models/Service.php';

	$user = new User;
	$service = new Service;

	$service_list = $service->readNames();

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$users_id = trim(filter_input(INPUT_POST, 'users_id', FILTER_SANITIZE_NUMBER_INT));
		$user->id = $users_id; // réhydrate l'attribut id de notre objet user avec une autre valeur
		$user->delete();
	}

	if (!empty($_GET['filter']) && ctype_digit($_GET['filter'])) {
		$service_id = trim(filter_input(INPUT_GET, 'filter', FILTER_SANITIZE_NUMBER_INT));
		$user->service_id = $service_id;
		$user_list = $user->readFilter();
	}
	else{
		$user_list = $user->readAll();
	}
?>