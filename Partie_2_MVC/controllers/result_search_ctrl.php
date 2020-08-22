<?php
    require_once dirname(__FILE__).'/../model/Patients.php';

    if ($_POST['patients_list'] != "") {
        $patient = new Patients();
        $search = filter_var($_POST['patients_list'], FILTER_SANITIZE_STRING);
        $patientList = $patient->findPatient($search);
        echo json_encode($patientList);
        
    }
    else {
        var_dump($_SERVER);
        $patient = new Patients();
        $search = filter_var($_POST['patients_list'], FILTER_SANITIZE_STRING);
        $listPatients = $patient->readAll();
        echo json_encode($listPatients);
        
    }