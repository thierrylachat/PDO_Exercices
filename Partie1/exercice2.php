<?php

// Création de requêtes permettant de lire les infos (tirées de phpMyAdmin).
$sqlShowTypes = "SELECT `id`, `type` FROM `showtypes`";

// "Query" renvoie le jeu de données associées aux requêtes.
$req = $db->query($sqlShowTypes);

// Création du tableau de données liées au jeu de données.
$showTypes = $req->fetchAll(PDO::FETCH_OBJ);

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


<!-- Création du tableau de données pour afficher tous les types de spectacles possibles. -->
<div class="container">
    <h1 class="text-center m-4 text-success">Types de spectacles</h1>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($showTypes as $showType): ?>
                    <tr>
                        <td><?=$showType->id;?></td>
                        <td><?=trim(htmlspecialchars($showType->type));?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>