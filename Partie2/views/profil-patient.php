<?php include_once dirname(__FILE__) . '/includes/header.php'; ?>
<div class="container mt-5">
    <h1>Profil </h1>
    <?php if(!$patientInfo): ?>
        <div class="card">
            <p class="card-title">Le patient recherché n'existe pas !</p>
            <a href="../controllers/liste-patientsCtrl.php">Retour à la liste des patients</a>
        </div>
    <?php else : ?>
        <div class="card">
            <div class="card-body">
                <p>Nom : <?= $patientInfo->lastname ?></p>
                <p>Prénom : <?= $patientInfo->firstname ?></p>
                <p>Date de naissance : <?= $patientInfo->birthdate ?></p>
                <p>Téléphone : <?= $patientInfo->phone ?></p>
                <p>Email : <?= $patientInfo->mail ?></p>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php include_once dirname(__FILE__) . '/includes/footer.php'; ?>