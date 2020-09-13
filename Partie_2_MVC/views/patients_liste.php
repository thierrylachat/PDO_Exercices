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
    <title>Liste des patients</title>
</head>

<body>
    <nav class="navbar justify-content-around">
        <a href="../index.php" class="nav-link">
            <img src="https://fotomelia.com/wp-content/uploads/edd/2015/03/logo-hospital-1560x631.png" alt="">
        </a>
        <a href="create_patients_ctrl.php" class="nav-link ">Ajouter un patient</a>
        <a href="liste_patients_ctrl.php" class="nav-link ">Liste des patients</a>
        <a href="create_appointment_ctrl.php" class="nav-link ">Ajouter un rendez-vous</a>
        <a href="list_appointment_ctrl.php" class="nav-link">Liste des rendez-vous</a>
        <a href="create_appointment_patient_ctrl.php" class="nav-link">Ajouter un patient avec rendez-vous</a>

        <!-- Création de la barre de recherche. -->
        <form action="liste_patients_ctrl.php" method="POST">
            <div class="row justify-content-end">
                <input type="search" class="form-control rounded-pill mr-3 " name="patients_list" id="patients_list"
                    placeholder="Rechercher..." style="width:250px;">
                <input type="hidden" name="idPatient" id="idPatient">
            </div>
        </form>
    </nav>

    <div id="result" style="position:absolute;left:0;right:0;"></div>

    <div id="patients">
        <div class="container row m-auto " id="list">
            <?php if (count($listPatients) > 0) { 
            foreach ($listPatients as $number => $patient) { ?>
            <div class="card mt-4 ml-4 " style="width: 18rem;background-color: rgba(74, 122, 233, 0.6) !important;">
                <img class="card-img-top"
                    src="https://www.petitesaffiches.fr/annuaire/images/avocats_default_avatar.png"
                    alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Patient numéro : <?= $number + 1; ?></h5>
                    <p class="card-text">Prénom : <?= $patient->firstname; ?></p>
                    <p class="card-text">Nom : <?= $patient->lastname; ?></p>
                    <p class="card-text">Date de Naissance : <?= $patient->birthdate_format; ?></p>
                    <a class="btn btn-primary col-12 mb-2" href="patients_profil_ctrl.php?id=<?= $patient->id; ?>">Voir
                        le profil</a>
                    <a class="btn btn-danger col-12 mb-2"
                        href="delete_patients_ctrl.php?id=<?= $patient->id; ?>">Supprimer le patient</a>
                </div>
            </div>
            <?php } ?>
            <div class="bg-dark mt-3 mb-3 col-md-12 w-100 form-control text-light">
                <div class="row m-auto justify-content-between mt-2 mb-2">
                    <?php for ($i=0; $i < $pageNumer ; $i++) { ?>
                    <a class="text-center btn btn-secondary" href="?page=<?=$i +1 ;?>"
                        style="width:40px;"><?= $i +1 ; ?></a>
                    <?php } ?>
                </div>
            </div>
            <?php } else { ?>
            <h1 class="text-center">Aucun patient n'as été trouvé.
                <a href="create_patients_ctrl.php">
                    Veuillez ajouter un patient.
                </a>
            </h1>
            <?php } ?>
        </div>
    </div>
</body>

<!-- A REVOIR. -->

<script>
    let sp = document.getElementById('patients_list');
    let list = document.getElementById('result');
    sp.addEventListener('keyup', function () {
        let search = this.value;
        if (search.length >= 2) {
            //on vide le champ 
            list.innerHTML = '';
            document.querySelector('#result').classList.remove('d-none');
            document.querySelector('#list').classList.add('d-none');
            let data = new FormData();
            data.append('patients_list', search);
            //on recherche a partir de deux caractere  et on renvoie la 
            //page controllers/create_appointment_ctrl.php ============
            var req = fetch('../controllers/liste_patients_ctrl.php', {
                headers: {
                    'Accept': 'application/json',
                    // 'Content-Type': 'application/json'
                },
                method: 'POST',
                body: data
            });
            // si le traitement s'est bien passé 
            req.then(function (response) {
                    return response.json();
                })
                //traitement du php qui est retourner 
                .then(function (data) {
                    //ceci est une fonction flecher => === function()
                    let ul = '<div class="container row m-auto">';
                    data.forEach(patient => {
                        ul +=
                            `<div class="card mt-4 ml-4" style="width: 18rem;background-color: rgba(75, 127, 23, 0.6) !important;">
                        <div class="card-body">
                            <img class="card-img-top" src="https://www.petitesaffiches.fr/annuaire/images/avocats_default_avatar.png" alt="Card image cap">
                            <h5 class="card-title">Patient numéro :${patient.id} </h5>
                            <p class="card-text">Prénom : ${patient.firstname}</p>
                            <p class="card-text">Nom : ${patient.lastname}</p>
                            <p class="card-text">Date de Naissance : <?= $patient->birthdate_format; ?></p>
                            <a class="btn btn-primary col-12 mb-2" href="patients_profil_ctrl.php?id=${patient.id}">Voirle profil</a>
                            <a class="btn btn-danger col-12 mb-2" href="delete_patients_ctrl.php?id=${patient.id}">Supprimer le patients</a>
                        </div>
                    </div>`;
                    })
                    list.innerHTML = ul;
                })
        } else {
            document.querySelector('#list').classList.remove('d-none');
            document.querySelector('#result').classList.add('d-none');
        }
    })
    document.body.addEventListener('click', function (e) {
        let target = e.target;
        if (target.classList.contains('choice')) {
            // alert(target.textContent);
            sp.value = target.textContent;
            document.getElementById('idPatient').value = target.dataset.id;

            list.innerHTML = '';
        }
    })
</script>

</html>