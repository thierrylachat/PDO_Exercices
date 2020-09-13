<?php 
require_once dirname(__FILE__).'/../model/Patients.php';

// A REVOIR. 

if (isset($_POST['patients_list'])) {

    // Instanciation d'un nouvel objet.
    $patient = new Patients();

    // Nettoyage de la donnée.
    $search = filter_var($_POST['patients_list'], FILTER_SANITIZE_STRING);

    $patientList = $patient->findPatient($search);
    echo json_encode($patientList);
    exit();
}

// A REVOIR. 

$page = ctype_digit($_GET['page']) ? (int) $_GET['page'] : 1;
// var_dump($page);
$perPage = 6;

// Affichage de la liste des patients.

    // Instanciation d'un nouvel objet.
    $patient = new Patients();

    // Appel de la fonction realAll() qui affiche la liste de patients enregistrés.
    $listPatients = $patient->readAll($page,$perPage);
    
// var_dump($listPatients);
$patientTotal = $patient->countPatients();
$pageNumer = ceil($patientTotal/$perPage); 

require_once dirname(__FILE__).'/../views/patients_liste.php';
?>