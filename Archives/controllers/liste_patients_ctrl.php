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

// Affichage de la liste des patients.

    // Instanciation d'un nouvel objet.
    $patient = new Patients();

    // Appel de la fonction realAll() qui affiche la liste de patients enregistrés.
    $listPatients = $patient->readAll();
    // var_dump($listPatients);

require_once dirname(__FILE__).'/../views/patients_liste.php';
?>
