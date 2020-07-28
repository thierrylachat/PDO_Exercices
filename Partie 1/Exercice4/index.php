<?php

// Récupération du fichier param.php.
require_once 'param.php';

// Création d'une chaîne de connexion Data Source Name.
$dsn = 'mysql:dbname=colyseum;host=localhost;charset=utf8';

// Création d'une classe PDO.
$db = new PDO($dsn, USER, PWD);

// Création de requêtes permettant de lire les infos (tirées de phpMyAdmin).
$sqlCardsClientsList = "SELECT `id`, `lastName`, `firstName`, `birthDate`, `cardNumber` FROM `clients` WHERE `card`=1";

// "Query" renvoie le jeu de données associées aux requêtes.
$req = $db-> query($sqlCardsClientsList);

// Création du tableau de données liées au jeu de données. 
$cardsClientsList = $req->fetchAll(PDO::FETCH_OBJ);

// Affichage des données. 
// var_dump($cardsClientsList);

?>


<!doctype html>

<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>PDO - Partie 1 - Lire les données</title>
</head>

<body>
    <!-- Création du tableau de données. -->
    <div class="container">
        <h1 class="text-center m-4 text-success">Liste des clients avec carte de fidélité</h1>
        <div class="row">
            <div class="col-12">
                <table class="table table-striped text-center">
                <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Date de naissance</th>
                            <th>Carte de fidélité</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cardsClientsList as $cardClient): ?>
                        <tr>
                            <td><?=$cardClient->id;?></td>
                            <td><?=$cardClient->lastName;?></td>
                            <td><?=$cardClient->firstName;?></td>
                            <td><?=$cardClient->birthDate;?></td>
                            <td><?=$cardClient->cardNumber;?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>