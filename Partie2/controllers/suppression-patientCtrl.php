<?php
require_once dirname(__FILE__) . '/../models/Patient.php';

// Conversion des éléments en entier pour éviter l'injection de SQL.
$id = (int) $_GET['idPatient'];

// Instanciation d'un nouvel objet.
$patient = new Patient($id);

// Appel de la fonction delete() qui supprime un patient.
$patient->delete();

// Appel de la fonction readAll() pour récupérer la liste des patients.
$patientsList = $patient->readAll();

require_once dirname(__FILE__) . '/../views/liste-patients.php';