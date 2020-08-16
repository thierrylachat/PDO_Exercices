<?php
$title = 'Hopital E2N';
include_once dirname(__FILE__) . '/views/includes/header.php'; ?>
<body>
    <div class="container">
        <div class="row">
            <div class="card col-sm-12 bg-light">
                <div class="card-header font-weight-bold bg-info text-primary text-center"><img width="300" height="150"
                        src="assets/img/logo.png" alt="maison de santé">
                    <h1>CHU Amiens</h1>
                </div>
                <h2 class="text-center mt-2">gestionnaire de patientèle</h2>
                <div class="btn mt-4 mb-4 ">
                    <a class="btn  btn-warning col-sm-6 my-4" href="controllers/ajout-patientCtrl.php"
                        title="Ajouter un patient">Ajouter un patient</a>
                    <a class="btn btn-danger col-sm-6 my-4" href="controllers/liste-patientsCtrl.php"
                        title="Liste des patients">Liste des patients</a>
                    <a class="btn btn-success col-sm-6 my-4" href="add-appointmentController.php"
                        title="Ajouter un rendez-vous">Ajouter un rendez-vous</a>
                    <a class="btn btn-info col-sm-6 my-4" href="liste-appointmentController.php"
                        title="Liste des rendez-vous">Liste des rendez-vous</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>