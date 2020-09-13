<?php
require_once dirname(__FILE__) . '/../model/Appointment.php';
if (empty($_GET['id']) && empty($_POST['id'])) {
    header('location : list_appointment_ctrl.php');
    exit();
}
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $appointment = new Appointment($id);
    $appointmentInfos = $appointment->readSingle();
    $fullName = $appointmentInfos->lastname.' '.$appointmentInfos->firstname;
    $dateHour = $appointmentInfos->dateHour_fr;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (int) $_POST['id'];
    $fullName = $_POST['fullName'];
    $dateHour = $_POST['dateHour'];
    $appointment = new Appointment($id);
    if ($appointment->delete()) {
        $deleteSuccess = true;
        header('refresh:5;list_appointment_ctrl.php');
    }
}
require_once dirname(__FILE__).'/../views/delete_appointment.php';
?>