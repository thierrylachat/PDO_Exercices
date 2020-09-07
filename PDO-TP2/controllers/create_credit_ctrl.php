<?php 
require_once dirname(__FILE__).'/../models/Credit.php';
require_once dirname(__FILE__).'/../models/Client.php';
// ============ lister tous les status ================//
$client = new Client();
$client_list = $client->readAll();
// ====================================================//
$errors = [];
$isSubmited = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && count($errors) == 0) 
{
    $isSubmited = true;
    if (empty($_POST['organisme'])) 
    {
        $errors['organisme'] = "Veuillez renseigner un organisle de credit";
    }else
    {
        $organisme = trim(trim(htmlspecialchars($_POST['organisme'])));
    }
    if (empty($_POST['amound'])) 
    {
        $errors['amound'] = "Veuillez renseigner un montant a attribuer";
    }else 
    {
        $amoud = trim(trim(htmlspecialchars($_POST['amound'])));
    }
    if (empty($_POST['client'])) {
        $errors['client'] = "Veuillez renseigner un Clients";
    }else 
    {
        $client_id = (int) $_POST['client'];
}
}
// =====================================================//
if ($isSubmited && count($errors) == 0) 
{
    $credit = new Credit(0,$organisme,$amoud,$client_id);
    if($credit->create())
    {
        $createSuccess = true;
    }
}
require_once dirname(__FILE__).'/../views/create_credit.php';