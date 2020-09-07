<?php 
require_once dirname(__FILE__).'/../models/Client.php';
require_once dirname(__FILE__).'/../models/Credit.php';


//=============SI RIEN DANS LE GET, ON REDIRIGE SUR LA LISTE ==================//
if(!isset($_GET['id']) || empty($_GET['id'])){
    header('location:list_clients_ctrl.php');
}

// ============= SI L'ID EXISTE ON RECUPERE LES INFOS DU CLIENT ==================//
if (isset($_GET['id']))
{
    $id = (int) $_GET['id'];
    $credit = new Client($id);
    $clientProfile = $credit->readSingle();


// ================= ON RECUPERE LES CREDITS DU CLIENT==========//
    $credit_list = new Credit();
    $credit_list->credit_client_id = $id;
    $client_list = $credit_list->readAll();
// ====================================================//
}

require_once dirname(__FILE__).'/../views/profile_client.php';