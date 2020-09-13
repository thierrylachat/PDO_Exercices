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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Liste des rendez-vous </title>
</head>

<body>
    <nav class="navbar justify-content-around">
        <a href="../index.php" class="nav-link  "><img
                src="https://fotomelia.com/wp-content/uploads/edd/2015/03/logo-hospital-1560x631.png" alt=""></a>
        <a href="create_patients_ctrl.php" class="nav-link ">Ajouter un patient</a>
        <a href="liste_patients_ctrl.php" class="nav-link ">Liste Patients</a>
        <a href="create_appointment_ctrl.php" class="nav-link ">Ajouter un rendez-vous</a>
        <a href="list_appointment_ctrl.php" class="nav-link">Liste des rendez-vous</a>
        <a href="create_appointment_patient_ctrl.php" class="nav-link">Ajouter un patient avec Rendez-vous</a>
    </nav>
    <div class="d-flex align-items-center ">
        <div id="patients">
            <div class="ml-5 container row m-auto">
                <?php if (count($listAppointment) > 0) { 
        foreach ($listAppointment as $appointment) { ?>
                <div class="card mt-4 ml-4" style="width: 18rem;background-color: rgba(74, 122, 233, 0.6) !important;">
                    <div class="card-body text-center">
                        <p class="card-text">Date du rendez-vous : <br> <?= $appointment->dateHour_fr; ?></p>
                        <p class="card-text"> Patient : <br><?= $appointment->lastname; ?>
                            <?= $appointment->firstname; ?></p>
                        <a class="btn btn-primary col-12 mb-2" href="modify_appointment_ctrl.php?id=<?= $appointment->identifiant_app; ?>">Modifier le rendez-vous</a>
                        <a class="btn btn-danger col-12 mb-2" href="delete_appointment_ctrl.php?id=<?= $appointment->identifiant_app; ?>">Supprimer le rendez-vous</a>
                    </div>
                </div>
                <?php } ?>
                <?php } else { ?>
                <h1 class="text-center">Aucun rendez-vous n'as été trouver
                    <a href="create_appointment_ctrl.php">
                        Veuillez ajouter un rendez-vous
                    </a>
                </h1>
                <?php } ?>
            </div>
        </div>
    </div>

</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
    integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
</script>

</html>