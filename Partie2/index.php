<?php
$title = 'Hopital E2N';
include_once dirname(__FILE__) . '/views/includes/header.php'; ?>

<body>
    <div class="container">
        <div class="row">
            <div class="card col-sm-12 bg-light">
                <div class="card-header font-weight-bold bg-info text-primary text-center"><img class="img-fluid" width="750" height="350"
                        src="assets/img/hospital.jpg" alt="personnel d'hôpital">
                    <h1 class="font-weight-bold m-auto text-uppercase">CHU Amiens</h1>
                </div>
                <h2 class="text-center mt-2 font-italic">Gestionnaire de patientèle</h2>
                <div class="btn mt-2 mb-4">
                <!-- Les actions du portail sont jouées par les méthodes inclues dans les controllers. -->
                    <a class="btn btn-danger col-sm-6 my-4 font-weight-bold text-uppercase" href="controllers/ajout-patientCtrl.php"
                        title="Ajouter un patient">Ajouter un patient</a>
                    <a class="btn btn-danger col-sm-6 my-4 font-weight-bold text-uppercase" href="controllers/liste-patientsCtrl.php"
                        title="Liste des patients">Liste des patients</a>
                <!-- Lien vers les controleurs suivants seront à MAJ. -->
                    <a class="btn btn-danger col-sm-6 my-4 font-weight-bold text-uppercase" href="add-appointmentController.php"
                        title="Ajouter un rendez-vous">Ajouter un rendez-vous</a>
                    <a class="btn btn-danger col-sm-6 my-4 font-weight-bold text-uppercase" href="liste-appointmentController.php"
                        title="Liste des rendez-vous">Liste des rendez-vous</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
include_once dirname(__FILE__) . '/views/includes/footer.php'; ?>