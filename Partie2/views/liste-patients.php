<?php include_once dirname(__FILE__) . '/includes/header.php'; ?>

<div class="container mt-5">
    <h1 class="h1 text-center">Liste des patients</h1>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="text-right mb-3">
                <a class="btn btn-outline-info text-right font-weight-bold" href="../controllers/ajout-patientCtrl.php">Ajouter un
                    patient</a>
            </div>
            <?php 
        if(count($patientsList) > 0) : ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Prénom</th>
                        <th>Nom </th>
                        <th>Date de naissance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($patientsList as $number => $patient): ?>
                    <tr>
                        <td><?= $number + 1 ?></td>
                        <td><a href="../controllers/profil-patientCtrl.php?idPatient=<?= $patient->id ?>"><?= $patient->firstname ?></a></td>
                        <td><?= $patient->lastname ?></td>
                        <td><?= $patient->birthdate ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div>
                <p>Il n'y a pas de patients, veuillez ajouter un patient</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include_once dirname(__FILE__) . '/includes/footer.php'; ?>