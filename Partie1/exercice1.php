<?php

// Création de requêtes permettant de lire les infos (tirées de phpMyAdmin).
$sqlClientsList = "SELECT `id`, `lastName`, `firstName`, DATE_FORMAT(`birthDate`,'%d/%m/%Y') AS birthDate FROM `clients`";

// "Query" renvoie le jeu de données associées aux requêtes.
$req = $db-> query($sqlClientsList);

// Création du tableau de données liées au jeu de données. 
$clientsList = $req->fetchAll(PDO::FETCH_OBJ);

?>


<!-- Création du tableau de données. -->
<div class="container">
    <h1 class="text-center m-4 text-success">Clients du Colyseum</h1>
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
                    <?php foreach ($clientsList as $client): ?>
                    <tr>
                        <td><?=$client->id;?></td>
                        <td><?=trim(htmlspecialchars($client->lastName));?></td>
                        <td><?=trim(htmlspecialchars($client->firstName));?></td>
                        <td><?=$client->birthDate;?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>