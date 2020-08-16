<?php
	require_once dirname(__FILE__).'/../models/User.php';

	if (isset($_POST['login']) && isset($_POST['password'])) {
		// regex avant envoi
		// crypt le mot de passe
		$passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT);
		$user = new User(0, $_POST['login'], $passwordHash);

		if($user->create()){
			$userCreateSuccess = true;
		}
	}

	require_once dirname(__FILE__).'/../views/create_user.php';