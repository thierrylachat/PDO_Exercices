<?php
require_once dirname(__FILE__) . '/../models/Patient.php';



$id = (int) $_GET['idPatient'];

// Instanciation d'un nouvel objet.
$patient = new Patient($id);

// Appel de la fonction delete() qui supprime un patient.
$patient->delete();

$patientsList = $patient->readAll();

// Redirection vers la bonne page à faire mouahhhhh !!!!!

require_once dirname(__FILE__) . '/../views/liste-patients.php';