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
    <link rel="stylesheet" href="../node_modules/jquery-datetimepicker/build/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Prise de rendez-vous</title>
</head>

<body>
    <nav class="navbar justify-content-around">
        <a href="../index.php" class="nav-link  "><img
                src="https://fotomelia.com/wp-content/uploads/edd/2015/03/logo-hospital-1560x631.png" alt=""></a>
        <a href="create_patients_ctrl.php" class="nav-link ">Ajouter un patient</a>
        <a href="liste_patients_ctrl.php" class="nav-link ">Liste Patients</a>
        <a href="create_appointment_ctrl.php" class="nav-link ">Prise de rendez-vous</a>
        <a href="list_appointment_ctrl.php" class="nav-link">Liste des rendez-vous</a>
        <a href="create_appointment_patient_ctrl.php" class="nav-link">Ajouter un patient avec Rendez-vous</a>
    </nav>
    <div class="d-flex align-items-center">
        <form action="" method="POST" class="border col-6 rounded form">
            <div class="col-12" role="alert">
                <?php if (isset($createAppointmentSuccess)): ?>
                <p>Le rendez-vous a été ajouté avec succès ! :)</p>
                <?php endif; ?>
            </div>
            <div class="col-md-10 m-auto">
                <legend>Prise de rendez-vous</legend>
                <div style="position:relative;">
                    <label for="patient">Patient :</label>
                    <input class="form-control" type="search" id="patient" placeholder="Nom du patient">
                    <!-- ========= INPUT HIDDEN ===================== -->
                    <input type="hidden" name="idPatient" id="idPatient">
                    <div id="result" style="position:absolute;left:0;right:0;"></div>
                </div>
                <div>
                    <label for="datetimepicker">Date du rendez-vous :</label>
                    <input id="datetimepicker" name="dateHour" type="text" class="form-control">
                </div>
                <input class="btn btn-secondary mt-2 mb-3" type="submit" value="Prise de rendez-vous">
            </div>
        </form>
    </div>
    <script src="../node_modules/jquery/dist/jquery.js"></script>
    <script src="../node_modules/jquery-datetimepicker/jquery.datetimepicker.js"></script>
    <script src="../assets/js/moment.js"></script>
    <script>
        // on utilise la librairie moment 
        $.datetimepicker.setDateFormatter('moment');
        // on format le datepiker en francais 
        jQuery.datetimepicker.setLocale('fr');
        // on formate le masque pour le format de date 
        jQuery('#datetimepicker').datetimepicker({
            mask: true,
            minDate: moment().format(),
            format: 'DD/MM/YYYY HH:mm'
        });
    </script>
    <script>
        let sp = document.getElementById('patient');
        let list = document.getElementById('result');

        sp.addEventListener('keyup', function () {
            let search = this.value;
            if (search.length >= 2) {
                //on vide le champ 
                list.innerHTML = '';
                let data = new FormData();
                data.append('search',search);
                //on recherche a partir de deux caractere  et on renvoie la 
                //page controllers/create_appointment_ctrl.php ============
                var req = fetch('../controllers/create_appointment_ctrl.php', {
                    headers: {
                        'Accept': 'application/json',
                        // 'Content-Type': 'application/json'
                    },
                    method:'POST',
                    body: data
                });
                // si le traitement s'est bien passé 
                req.then(function (response) {
                    return response.json();
                })
                //traitement du php qui est retourner 
                .then(function (data) {
                    //ceci est une fonction flecher => === function()
                    let ul = '<ul class="list-group">';
                    data.forEach(patient => 
                    {
                        //ul+li vous avez compris  = <ul>
                                                        //<li>liste 1</li>
                                                //  </ul>
                        ul += `<li class="list-group-item text-dark choice" data-id="${patient.id}" >${patient.firstname} ${patient.lastname}</li>`;
                    })
                    list.innerHTML = ul;
                })
            }
        })
        document.body.addEventListener('click',function(e){
            let target = e.target;
            if (target.classList.contains('choice')) {
                // alert(target.textContent);
                sp.value = target.textContent;
                document.getElementById('idPatient').value = target.dataset.id;

                list.innerHTML = '';
            }
        })
    </script>
</body>

</html>