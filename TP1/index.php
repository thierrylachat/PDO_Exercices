<!-- Consignes de l'exercice : 
Créer un base avec une table permettant d'enregistrer un utilisateur. Un utilisateur est défini comme tel :
- Nom - 50 caractères max
- Prénom - 50 caractères max
- Date de naissance - Date
- Adresse - Texte
- Code Postal - 5 caractères max
- Numéro de téléphone - 10 caractères max
- Service - entier
Créer une table Service :
- Nom du service - 50 caractères max
- Description - 100 caractères max

Remplir la table Service avec ces informations :
Nom du service
Description
Maintenance	Les spécialistes du hardware
Web Developer Pour eux, tout est code
Web Designer Y'a que le CSS dans la vie
Référenceur	Regarde les Serps Google du matin au soir et du soir au matin


Faire une page index permettant de lister les utilisateurs en affichant ces données :
- Son nom et son prénom
- Son âge
- Son adresse complète
- Son numéro de téléphone
- Son service

Sur cette page on doit pouvoir filtrer les services via une liste déroulante et donc n'afficher que ceux choisi.  
On doit aussi pourvoir supprimer un utilisateur via un bouton.  

Faire une autre page permettant d'ajouter un utilisateur. On doit s'assurer que les données saisies par l'utilisateur sont celle attendues.  
Attention au piratage !! -->

<?php 
require_once dirname(__FILE__).'/Controllers/usersListCtrl.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="../Assets/CSS/style.css">
    <title>Management des Ressources Humaines</title>
</head>

<body>

    <nav class="navbar navbar-dark bg-dark justify-content-around font-weight-bold">

        <!-- Les actions du portail sont jouées par les méthodes appelées dans les models par les controllers. -->
        <a href="controllers/create_patients_ctrl.php" class="nav-link navbar-brand">Liste des utilisateurs</a>
        <a href="controllers/create_patients_ctrl.php" class="nav-link navbar-brand">Ajouter un utilisateur</a>
    </nav>

    <main>
        <h1 class="text-center m-5 font-weight-bold">Management des Ressources Humaines</h1>

        <div class="container text-center">
            <img class="img-fluid" src="../Assets/Images/logiciel-de-gestion-SIRH.jpg" alt="Bureau">
        </div>

        <h1 class="text-center m-5 text-secondary">Liste des utilisateurs</h1>

        <div class="container">

        <div class="row">
            <?php if(count($usersList) > 0) {
                foreach ($usersList as $user) { ?>
                <div class="card m-3" style="width: 18rem;">
                    <div class="card-header bg-dark text-light font-weight-bold"><?= $user->lastname ;?> <?= $user->firstname ;?></div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><span class="font-weight-bold">Age : </span><?= $user->age ;?></li>
                        <li class="list-group-item"><span class="font-weight-bold">Adresse : </span><?= $user->address ;?> <?= $user->zipcode ;?></li>
                        <li class="list-group-item"><span class="font-weight-bold">Numéro de téléphone : </span><?= $user->phoneNumber ?></li>
                        <li class="list-group-item"><span class="font-weight-bold">Service : </span><?= $user->name ?></li>
                        <li class="list-group-item">
                            <a class="btn btn-danger col-12 mb-2 font-weight-bold" href="deleteUserCtrl.php?id=<?= $user->id; ?>">Supprimer l'utilisateur</a>
                        </li>
                    </ul>
            </div>
            <?php } ?>
            <?php } else { ?>
                <h1 class="text-center">Il n'y a pas d'utilisateur.
                <a href="createUserCtrl.php">
                    Veuillez ajouter un utilisateur.
                </a>
            </h1>
            <?php } ?>
        </div>
        </div>
    </main>

</body>

</html>