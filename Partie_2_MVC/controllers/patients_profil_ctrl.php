<?php 
    require_once dirname(__FILE__).'/../model/Patients.php';
    require_once dirname(__FILE__).'/../model/Appointment.php';
    $id = (int) $_GET['id'];
    $appointment = new Appointment();
    $patient = new Patients($id);
    
    $appointmentViews = $appointment->readPatientAppointments($id);
    $patientsView = $patient->readSingle();

    require_once dirname(__FILE__).'/../views/patients_profil.php';
?>