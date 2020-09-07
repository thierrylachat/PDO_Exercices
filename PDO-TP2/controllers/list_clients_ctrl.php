<?php

require_once dirname(__FILE__).'/../models/Client.php';

// ============ lister tous les statuts ================//

// Instanciation d'un nouvel objet.
$client = new Client();

// Appel de la méthode readAll() qui affiche la liste des clients.
$client_list = $client->readAll();

// ====================================================//

require_once dirname(__FILE__).'/../views/list_clients.php';