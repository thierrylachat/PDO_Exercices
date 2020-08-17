<?php
require_once dirname(__FILE__) . '/../models/Patient.php';

// Instanciation d'un nouvel objet.
$patient = new Patient();

// Appel de la fonction realAll() qui affiche la liste de patients enregistrés.
$patientsList = $patient->readAll();

require_once dirname(__FILE__) . '/../views/liste-patients.php';