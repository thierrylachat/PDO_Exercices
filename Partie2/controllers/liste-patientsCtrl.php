<?php require_once dirname(__FILE__) . '/../models/Patient.php'; 

$patient = new Patient();

$patientsList = $patient->readAll();

require_once dirname(__FILE__) . '/../views/liste-patients.php'; ?>