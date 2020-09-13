<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Hospital E2N</title>
</head>

<body>
    <nav class="navbar justify-content-around">
        <!-- Création d'un lien sous forme d'image. -->
        <a href="index.php" class="nav-link  navbar-brand"><img src="https://fotomelia.com/wp-content/uploads/edd/2015/03/logo-hospital-1560x631.png" alt=""></a>
        <!-- Les actions du portail sont jouées par les méthodes appelées dans les models par les controllers. -->        
        <a href="controllers/create_patients_ctrl.php" class="nav-link navbar-brand">Ajouter un patient</a>
        <a href="controllers/liste_patients_ctrl.php" class="nav-link navbar-brand">Liste des patients</a>
    </nav>
    <main>
        <div class="container">
            <h1 class="text-center">Bienvenue sur le gestionnaire de patients Hospital E2N</h1>
        </div>
    </main>
</body>

</html>