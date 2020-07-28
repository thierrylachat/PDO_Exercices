<?php
	$login = null;
	$password = null;

	try{
		if (empty($login) || empty($password)) {
			// Créer une nouvelle exception personnalisée.
			throw new Exception("L'une des variables est manquante");
		}
	}
	catch(Exception $e){
		echo $e->getMessage();
	}
?>