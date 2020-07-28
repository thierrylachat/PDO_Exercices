<?php

// Création de requêtes permettant de lire les infos (tirées de phpMyAdmin).
$sqlTwentyFirstClients = "SELECT `id`, `lastName`, `firstName`, DATE_FORMAT(`birthDate`,'%d/%m/%Y') AS `birthDate` FROM `clients` LIMIT 20";

// "Query" renvoie le jeu de données associées aux requêtes.
$req = $db-> query($sqlTwentyFirstClients);

// Création du tableau de données liées au jeu de données. 
$twentyFirstClients = $req->fetchAll(PDO::FETCH_OBJ);

?>


<!-- Création du tableau de données pour afficher les 20 premiers clients. -->
<div class="container">
    <h1 class="text-center m-5 text-success">Liste des 20 premiers clients</h1>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de naissance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($twentyFirstClients as $twentyFirstClient): ?>
                    <tr>
                        <td><?=$twentyFirstClient->id;?></td>
                        <td><?= trim(htmlspecialchars($twentyFirstClient->lastName));?></td>
                        <td><?= trim(htmlspecialchars($twentyFirstClient->firstName));?></td>
                        <td><?=$twentyFirstClient->birthDate;?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>