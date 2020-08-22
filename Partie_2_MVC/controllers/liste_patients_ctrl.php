<?php 
require_once dirname(__FILE__).'/../model/Patients.php';

if (isset($_POST['patients_list'])) {
    $patient = new Patients();
    $search = filter_var($_POST['patients_list'], FILTER_SANITIZE_STRING);
    $patientList = $patient->findPatient($search);
    echo json_encode($patientList);
    exit();
}

$patient = new Patients();

$listPatients = $patient->readAll();
// var_dump($listPatients);

require_once dirname(__FILE__).'/../views/patients_liste.php';
?>
