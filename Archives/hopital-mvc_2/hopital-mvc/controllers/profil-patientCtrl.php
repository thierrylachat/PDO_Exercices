<?php
// patient non sélectionné, on rédirige vers liste-patients
if(empty($_GET['idPatient']))
{
    header('Location: liste-patientsCtrl.php' );
    exit();
}

require_once dirname(__FILE__) . '/../models/Patient.php';

$id = (int) $_GET['idPatient'];
$patient = new Patient($id);

$patientInfo = $patient->readSingle();
require_once dirname(__FILE__) . '/../views/profil-patient.php';