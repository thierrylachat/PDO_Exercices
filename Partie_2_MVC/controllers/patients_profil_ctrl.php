<?php 
    require_once dirname(__FILE__).'/../model/Patients.php';
    require_once dirname(__FILE__).'/../model/Appointment.php';

    // Conversion des éléments en entier pour éviter l'injection de SQL.
    $id = (int) $_GET['id'];

    // A REVOIR.
    $appointment = new Appointment();

    // Instanciation d'un nouvel objet.
    $patient = new Patients($id);
    
    $appointmentViews = $appointment->readPatientAppointments($id);

    // Appel de la fonction readSingle() pour afficher les données du patient.
    $patientsView = $patient->readSingle();

    require_once dirname(__FILE__).'/../views/patients_profil.php';
?>