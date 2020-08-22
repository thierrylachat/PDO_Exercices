<!DOCTYPE html>
<html lang="en">
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
    <title>Creation d'un patient en ( MVC )</title>
</head>
<body>
<nav class="navbar justify-content-around">
        <a href="../index.php" class="nav-link "><img src="https://fotomelia.com/wp-content/uploads/edd/2015/03/logo-hospital-1560x631.png" alt=""></a>
        <a href="create_patients_ctrl.php" class="nav-link">Ajouter un patient</a>
        <a href="liste_patients_ctrl.php" class="nav-link">Liste Patients</a>
        <a href="create_appointment_ctrl.php" class="nav-link">Ajouter un rendez-vous</a>
        <a href="list_appointment_ctrl.php" class="nav-link">Liste des rendez-vous</a>
    </nav>
<div class="d-flex align-items-center">
    
        <?php if (isset($deletePatientsSuccess)): ?>
            <div class="col-12" role="alert">
                <p>Le patients a été supprimé avec succès ! :)</p>
            </div>
        <?php else : ?>
            <h2 class="text-center text-dark">Etes vous sûr de vouloir supprimer le patient <?= $fullName; ?> et ses rendez-vous ? </h2>
        <?php endif; ?>
    <form action="delete_patients_ctrl.php" method="POST">
            <input type="hidden" name="fullName" value="<?= $fullName; ?>">
            <input type="hidden" name="id" value="<?= $id; ?>">
            <a class="btn btn-infos" href="liste_patients_ctrl.php">Annuler</a>
            <button class="btn btn-danger" type="submit">Supprimer</button>
    </form>
</div>

</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</html>