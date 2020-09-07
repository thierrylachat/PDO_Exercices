<?php 
require_once dirname(__FILE__).'/../models/Client.php';
// ============ lister tous les status ================//
$client = new Client();
$client_list = $client->readAll();
// ====================================================//
require_once dirname(__FILE__).'/../views/list_clients.php';