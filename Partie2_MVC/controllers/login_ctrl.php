<?php
    session_start();
	require_once dirname(__FILE__).'/../models/User.php';

	if (isset($_POST['login']) && isset($_POST['password'])) {
		// regex avant envoi	
		$user = new User(0, $_POST['login'], $_POST['password']);
        // vérifie que la requête est execute et qu'elle renvoie une valeur
		if($user->readSingle()){
            // récupère les infos fetch
            $userInfo = $user->readSingle();
            // password_verify compare un password en clair avec son hashage
            if (password_verify($_POST['password'], $userInfo->password))
            {
                // créé la session utilisateur
                $_SESSION['user']['auth'] = true;
                $_SESSION['user']['id_users'] = $userInfo->id_users;
                $_SESSION['user']['login'] = $userInfo->login;
            }
            else{
                echo 'Login ou password incorrecte';
            }
        }
        else{
            var_dump('erreur');
        }
	}

	require_once dirname(__FILE__).'/../views/login.php';