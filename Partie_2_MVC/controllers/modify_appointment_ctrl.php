<?php 
require_once dirname(__FILE__).'/../model/Appointment.php';
require_once dirname(__FILE__).'/../model/Patients.php';

// Redirection vers la liste des rdv si absence d'id.
if (empty($_GET['id']) && empty($_POST['id']))
{
    header('location:list_appointment_ctrl.php');
    exit();
}

// Récupération de l'ID en GET quand la page de profil est affichée.
if (!empty($_GET['id'])) 
{
    // Conversion des éléments en entier pour éviter l'injection de SQL.
    $id = (int) $_GET['id'];
    // var_dump($id);

    // Instanciation d'un nouvel objet.
    $appointment = new Appointment($id);
    var_dump($appointment);

    // Appel de la fonction readSingle() du model qui va permettre de lire les infos d'un rdv.
    $appointmentInfos = $appointment->readSingle();
    // var_dump($appointmentInfos);

    // Création de variables.
    $idPatients = $appointmentInfos->idPatients;
    $firstname = $appointmentInfos->firstname;
    $lastname = $appointmentInfos->lastname;
    $dateHour = $appointmentInfos->dateHour_fr;
    // A REVOIR...
}

// A REVOIR.
if (isset($_POST['search']))
{
    $patient = new Patients();
    $search = filter_var($_POST['search'],FILTER_SANITIZE_STRING);
    $patientList = $patient->findPatient($search);
    echo json_encode($patientList);
    exit();
}

// Si le le formulaire est soumis en post.
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    // Conversion des éléments en entier pour éviter l'injection de SQL.
    $id = (int) $_POST['id'];
    $idPatients = (int) $_POST['idPatient'];

    // Utilisation de la librairie moment.js.
    $dateHour_modify = DateTime::createFromFormat('d/m/Y H:i',$_POST['dateHour']);
    
    // Si les champs sont remplis.
    if(!empty($dateHour_modify) && !empty($idPatients))
    {
        // Conversion de la date au format US pour insertion en BDD.
        $dateInsert = $dateHour_modify->format('Y-m-d H:i');
        
        // Instanciation d'un nouvel objet.
        $appointment = new Appointment($id,$dateInsert,$idPatients);
        
        // Si la fonction update() du model s'est bien exécutée. 
        if($appointment->update())
        {
            // Affichage du message de succès de MAJ d'un rdv. 
            $modifyAppointmentSuccess = true;
        }   
    }
}
require_once dirname(__FILE__).'/../views/modify_appointment.php';
?>