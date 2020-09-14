<?php
require_once dirname(__FILE__) . '/../model/Appointment.php';
require_once dirname(__FILE__) . '/../model/Patients.php';

// A REVOIR.
if (isset($_POST['search'])) {
    $patient = new Patients();
    $search = filter_var($_POST['search'], FILTER_SANITIZE_STRING);
    $patientList = $patient->findPatient($search);
    echo json_encode($patientList);
    exit();
}

// Si le le formulaire est soumis en post.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Définition de variables.
    $idPatients = $_POST['idPatient'];

    // Utilisation de la librairie moment.js.
    $dateHour = DateTime::createFromFormat('d/m/Y H:i', $_POST['dateHour']);

    // Si les champs sont remplis.
    if (!empty($dateHour) && !empty($idPatients)) {

        // Conversion de la date au format US pour insertion en BDD.
        $dateInsert = $dateHour->format('Y-m-d H:i');

        // Instanciation d'un nouvel objet.
        $appointment = new Appointment(0, $dateInsert, $idPatients);

        // Si la fonction create() du model s'est bien exécutée. 
        if ($appointment->create()) {

            // Affichage du message de succès de création d'un nouveau rdv. 
            $createAppointmentSuccess = true;
        }
    }
}

require_once dirname(__FILE__) . '/../views/create_appointment.php';
