<?php 
require_once dirname(__FILE__).'/../models/Credit.php';
require_once dirname(__FILE__).'/../models/Client.php';

// ============ lister tous les status ================//

// Instanciation d'un nouvel objet Client.
$client = new Client();

// Appel de la méthode readAll() qui affiche la liste des clients.
$client_list = $client->readAll();

// ====================================================//

// Initialisation de variables.
$errors = [];
$isSubmited = false;

// Soumission du formulaire et vérification de l'absence d'erreurs.
if ($_SERVER['REQUEST_METHOD'] == 'POST' && count($errors) == 0) 
{
    $isSubmited = true;
    if (empty($_POST['organisme'])) 
    {
        $errors['organisme'] = "Veuillez renseigner un organisme de credit";
    }else
    {
        $organisme = trim(trim(htmlspecialchars($_POST['organisme'])));
    }
    if (empty($_POST['amound'])) 
    {
        $errors['amound'] = "Veuillez renseigner un montant à attribuer";
    }else 
    {
        $amoud = trim(trim(htmlspecialchars($_POST['amound'])));
    }
    if (empty($_POST['client'])) {
        $errors['client'] = "Veuillez renseigner un client";
    }else 
    {
        $client_id = (int) $_POST['client'];
}
}
// =====================================================//

// Soumission du formulaire et vérification de l'absence d'erreurs.
if ($isSubmited && count($errors) == 0) 
{
    // Instanciation d'un nouvel objet Crédit.
    $credit = new Credit(0,$organisme,$amoud,$client_id);

    // Affichage d'un message de succès en cas de création d'un nouveau crédit réussie.
    if($credit->create())
    {
        $createSuccess = true;
    }
}

require_once dirname(__FILE__).'/../views/create_credit.php';