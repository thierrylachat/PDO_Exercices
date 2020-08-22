<?php 
require_once dirname(__FILE__).'/../model/Appointment.php';


$appointment = new Appointment();

$listAppointment = $appointment->readAll();
// var_dump($listAppointment);




require_once dirname(__FILE__).'/../views/list_appointment.php';
?>