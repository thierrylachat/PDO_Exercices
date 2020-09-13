<?php
require_once dirname(__FILE__) . '/../model/Appointment.php';
require_once dirname(__FILE__) . '/../model/Patients.php';
$isSubmitted = false;
$regexName = "/^[A-Za-zéÉ][A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ]+((-| )[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ]+)?$/";
$regexDate = "/^((?:19|20)[0-9]{2})-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";
$regexTel = "/^(?:\+33|0033|0)[1-79]((?:([\-\/\s\.])?[0-9]){2}){4}$/";
$firstname = $lastname = $birthdate = $phone = $mail = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once dirname(__FILE__) . '/../controllers/verifies.php';
    $dateHour = DateTime::createFromFormat('d/m/Y H:i', $_POST['dateHour']);
}
var_dump($errors);
if ($isSubmitted && count($errors) == 0) {
    $dateInsert = $dateHour->format('Y-m-d H:i');
    $patients = new Patients(0, $_POST['firstname'], $_POST['lastname'], $_POST['birthdate'], $_POST['phone'], $_POST['mail']);
    $idPatients = $patients->create();
    var_dump($idPatients);
    if ($idPatients) {
        echo 'ouiiiiiii ahahahaha ouiiiiii';
        if (!empty($dateHour) && !empty($idPatients)) {
            $appointment = new Appointment(0, $dateInsert, $idPatients);
            if ($appointment->create()) {
                echo 'ok';
            }
        }
    }
}

require_once dirname(__FILE__) . '/../views/create_appointment_patient.php';

// public function create()
// {
//     $sql = "INSERT INTO `city` (`city_name`,`city_zipcode`) VALUES (:city,:zipcode)";
//     $country_stmt = $this->db->prepare($sql);
//     $country_stmt->bindValue(':city', $this->cityName, PDO::PARAM_STR);
//     $country_stmt->bindValue(':zipcode', $this->cityZipcode, PDO::PARAM_STR);
//     $city = null;
//     if($country_stmt->execute()){
//         $id = $this->db->lastInsertId();
//         $this->id = $id;
//         $city = $this;
//     }
//         return $city;
// }
