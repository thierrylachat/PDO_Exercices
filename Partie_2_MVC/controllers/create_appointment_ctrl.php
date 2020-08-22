<?php
require_once dirname(__FILE__) . '/../model/Appointment.php';
require_once dirname(__FILE__) . '/../model/Patients.php';

if (isset($_POST['search'])) {
    $patient = new Patients();
    $search = filter_var($_POST['search'], FILTER_SANITIZE_STRING);
    $patientList = $patient->findPatient($search);
    echo json_encode($patientList);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idPatients = $_POST['idPatient'];
    $dateHour = DateTime::createFromFormat('d/m/Y H:i', $_POST['dateHour']);

    if (!empty($dateHour) && !empty($idPatients)) {
        $dateInsert = $dateHour->format('Y-m-d H:i');
        $appointment = new Appointment(0, $dateInsert, $idPatients);
        if ($appointment->create()) {
            $createAppointmentSuccess = true;
        }
    }
}

require_once dirname(__FILE__) . '/../views/create_appointment.php';
