<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="../Assets/CSS/style.css">
    <title>Agence bancaire</title>
</head>

<body>

    <nav class="navbar navbar-dark bg-dark justify-content-around font-weight-bold">

        <!-- Les actions du portail sont jouées par les méthodes appelées dans les models par les controllers. -->
        <a href="Controllers/createClientCtrl.php.php" class="nav-link navbar-brand">Ajout d'un client</a>
        <a href="Controllers/clientsListCtrl.php" class="nav-link navbar-brand">Liste des clients</a>
        <a href="Controllers/addCreditCtrl.php" class="nav-link navbar-brand">Ajout d'un crédit</a>
        <a href="Controllers/clientProfileCtrl.php" class="nav-link navbar-brand">Lecture d'un profil client</a>
    </nav>

    <main>
    
        <h1 class="text-center m-5 font-weight-bold">Agence bancaire</h1>

        <div class="container text-center">
            <img class="img-fluid" src="../Assets/Images/Mise-au-point-du-nouveau-concept-dagences.jpg" alt="Bureau">
        </div>

    </main>

</body>

</html>