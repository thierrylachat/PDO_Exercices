<?php 
require_once dirname(__FILE__).'/../model/Appointment.php';
require_once dirname(__FILE__).'/../model/Patients.php';


if (empty($_GET['id']) && empty($_POST['id']))
{
    header('location:list_appointment_ctrl.php');
    exit();
}
if (!empty($_GET['id'])) 
{
    $id = (int) $_GET['id'];
    $appointment = new Appointment($id);
    $appointmentInfos = $appointment->readSingle();
    $idPatients = $appointmentInfos->idPatients;
    $firstname = $appointmentInfos->firstname;
    $lastname = $appointmentInfos->lastname;
    $dateHour = $appointmentInfos->dateHour_fr;
    
}

if (isset($_POST['search']))
{
    $patient = new Patients();
    $search = filter_var($_POST['search'],FILTER_SANITIZE_STRING);
    $patientList = $patient->findPatient($search);
    echo json_encode($patientList);
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $id = (int) $_POST['id'];
    $idPatients = (int) $_POST['idPatient'];
    $dateHour_modify = DateTime::createFromFormat('d/m/Y H:i',$_POST['dateHour']);
    if(!empty($dateHour_modify) && !empty($idPatients))
    {
        $dateInsert = $dateHour_modify->format('Y-m-d H:i');
        $appointment = new Appointment($id,$dateInsert,$idPatients);
        if($appointment->update())
        {
            $modifyAppointmentSuccess = true;
        }   
    }
}
require_once dirname(__FILE__).'/../views/modify_appointment.php';
?>