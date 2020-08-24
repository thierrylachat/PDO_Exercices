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
    <title>Modification du patient</title>
</head>

<body>

    <nav class="navbar justify-content-around">
        <a href="../index.php" class="nav-link  "><img
                src="https://fotomelia.com/wp-content/uploads/edd/2015/03/logo-hospital-1560x631.png" alt=""></a>
        <a href="create_patients_ctrl.php" class="nav-link ">Ajouter un patient</a>
        <a href="liste_patients_ctrl.php" class="nav-link ">Liste des patients</a>
        <a href="create_appointment_ctrl.php" class="nav-link ">Ajouter un rendez-vous</a>
        <a href="list_appointment_ctrl.php" class="nav-link">Liste des rendez-vous</a>
    </nav>

    <form action="modify_patients_ctrl.php" method="Post" class="border col-6 rounded form">
        <div class="col-md-10 m-auto">

            <!-- Création d'un message d'alerte en cas de modification de données de profil réussie. -->
            <div class="col-12" role="alert">
                <?php if (isset($updateSuccess)): ?>
                <p>Le patient a été modifié avec succès ! :)</p>
                <?php endif; ?>
            </div>

            <!-- Affichage des messages d'erreur. -->
            <?php if (count($errors) > 0): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                <p><?= $error; ?></p>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <legend>Modifier les données du patient</legend>
            <div>
                <label for="firstname">Prénom :</label>
                <input class="form-control" type="text" name="firstname" id="firstname" value="<?= $firstname; ?>">

                <!--============== INPUT HIDDEN ====================== -->
                <input type="hidden" name="id" value="<?= $id; ?>">
                <!-- ================================================ -->
                
            </div>
            <div>
                <label for="lastname">Nom :</label>
                <input class="form-control" type="text" name="lastname" id="lastname" value="<?= $lastname; ?>">
            </div>
            <div>
                <label for="birthdate">Date de Naissance :</label>
                <input class="form-control" type="date" name="birthdate" id="birthdate" value="<?= $birthdate; ?>">
            </div>
            <div>
                <label for="phone">Téléphone :</label>
                <input class="form-control" type="text" name="phone" id="phone" value="<?= $phone; ?>">
            </div>
            <div>
                <label for="mail">Email :</label>
                <input class="form-control" type="mail" id="mail" name="mail" value="<?= $mail; ?>">
            </div>
            <input class="btn btn-secondary mt-2 mb-3" type="submit" value="Modifier le patient">
        </div>
    </form>

</body>

</html>