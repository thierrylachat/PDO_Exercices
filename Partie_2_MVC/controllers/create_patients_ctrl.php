<?php
    require_once dirname(__FILE__).'/../model/Patients.php';
    //validation des champs 
    $isSubmitted = false;
    $regexName = "/^[A-Za-zéÉ][A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ]+((-| )[A-Za-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœ]+)?$/";
    $regexDate = "/^((?:19|20)[0-9]{2})-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/";
    $regexTel = "/^(?:\+33|0033|0)[1-79]((?:([\-\/\s\.])?[0-9]){2}){4}$/";
    $firstname = $lastname = $birthdate = $phone = $mail='';
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once dirname(__FILE__) . '/../controllers/verifies.php';
    }

if ($isSubmitted && count($errors)== 0) {
    $patients = new Patients (0, $_POST['firstname'],$_POST['lastname'],$_POST['birthdate'],$_POST['phone'],$_POST['mail']);
    
    if($patients->create())
    {
        $createPatientsSuccess = true;
    }
}
    require_once dirname(__FILE__).'/../views/create_patients.php';