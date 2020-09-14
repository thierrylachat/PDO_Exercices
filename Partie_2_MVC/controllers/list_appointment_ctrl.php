<?php 
require_once dirname(__FILE__).'/../model/Appointment.php';

// Instanciation d'un nouvel objet.
$appointment = new Appointment();

// Appel de la méthode realAll().
$listAppointment = $appointment->readAll();
// var_dump($listAppointment);

require_once dirname(__FILE__).'/../views/list_appointment.php';
?>