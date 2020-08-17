<?php

// Non sélection du patient, redirection vers la liste des patients.
if(empty($_GET['idPatient']))
{
    header('Location: liste-patientsCtrl.php' );
    exit();
}

require_once dirname(__FILE__) . '/../models/Patient.php';

// Conversion des éléments en entier pour éviter l'injection de SQL.
$id = (int) $_GET['idPatient'];

// Instanciation d'un nouvel objet.
$patient = new Patient($id);

// Appel de la fonction readSingle() pour afficher les données du patient.
$patientInfo = $patient->readSingle();

require_once dirname(__FILE__) . '/../views/profil-patient.php';