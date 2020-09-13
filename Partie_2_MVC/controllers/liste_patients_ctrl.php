<?php 
require_once dirname(__FILE__).'/../model/Patients.php';

if (isset($_POST['patients_list'])) {
    $patient = new Patients();
    $search = filter_var($_POST['patients_list'], FILTER_SANITIZE_STRING);
    $patientList = $patient->findPatient($search);
    echo json_encode($patientList);
    exit();
}

$page = ctype_digit($_GET['page']) ? (int) $_GET['page'] : 1;
// var_dump($page);
$perPage = 6;
$patient = new Patients();

$listPatients = $patient->readAll($page,$perPage);
// var_dump($listPatients);
$patientTotal = $patient->countPatients();
$pageNumer = ceil($patientTotal/$perPage); 

require_once dirname(__FILE__).'/../views/patients_liste.php';
?>
