<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/favicon-16x16.png">
    <link rel="manifest" href="../assets/img/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Information personnel de <?=$_GET['id'];?></title>
</head>
<body>
    <nav class="navbar justify-content-around">
        <a href="../index.php" class="nav-link  "><img src="https://fotomelia.com/wp-content/uploads/edd/2015/03/logo-hospital-1560x631.png" alt=""></a>
        <a href="create_patients_ctrl.php" class="nav-link ">Ajouter un patient</a>
        <a href="liste_patients_ctrl.php" class="nav-link ">Liste Patients</a>
        <a href="create_appointment_ctrl.php" class="nav-link ">Ajouter un rendez-vous</a>
        <a href="list_appointment_ctrl.php" class="nav-link">Liste des rendez-vous</a>
        <a href="create_appointment_patient_ctrl.php" class="nav-link">Ajouter un patient avec Rendez-vous</a>
    </nav>
    <div class="card col-md-6 m-auto mt-5" style="width: 30rem;background-color: rgba(74, 122, 233, 0.6) !important;">
        <p>Nom : <?=$patientsView->firstname;?></p>
        <p>Prénom : <?=$patientsView->lastname;?></p>
        <p>Date de naissance : <?=$patientsView->birthdate_format;?></p>
        <p>Téléphone : <?=$patientsView->phone;?></p>
        <p>Email : <?=$patientsView->mail;?></p>
        <?php if (count($appointmentViews) > 0) {
    foreach ($appointmentViews as $appointment) {?>
                <p>Rendez-vous le :<?=$appointment->dateHour;?></p>
            <?php }?>
        <?php } else {?>
            <p>Aucun rendez-vous de prévue pour le moment </p>
        <?php }?>
        <a class="btn btn-secondary m-auto col-6 mb-2" href="modify_patients_ctrl.php?id=<?=$patientsView->id;?>">Modifier les Infos du patients</a>
        </div>
</body>
</html>