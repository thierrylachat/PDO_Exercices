<?php 
require_once dirname(__FILE__).'/../Models/User.php';


// Affichage de la liste des utilisateurs.

    // Instanciation d'un nouvel objet.
    $user = new User();

    // Appel de la fonction realAll() qui affiche la liste des utilisateurs enregistrés.
    $usersList = $user->readAll();
    // var_dump($usersList);

require_once dirname(__FILE__).'/../index.php';
?>
