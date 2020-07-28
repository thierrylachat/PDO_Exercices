<?php

// Création de requêtes permettant de lire les infos (tirées de phpMyAdmin).
$sqlCardsClientsList = "SELECT `id`, `lastName`, `firstName`, DATE_FORMAT(`birthDate`,'%d/%m/%Y') AS `birthDate`, `cardNumber` FROM `clients` WHERE `card`=1";

// "Query" renvoie le jeu de données associées aux requêtes.
$req = $db->query($sqlCardsClientsList);

// Création du tableau de données liées au jeu de données.
$cardsClientsList = $req->fetchAll(PDO::FETCH_OBJ);

?>


<!-- Création du tableau de données pour n'afficher que les clients ayant une carte de fidélité. -->
<div class="container">
    <h1 class="text-center m-5 text-success">Liste des clients avec carte de fidélité</h1>
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
                        <td><?=trim(htmlspecialchars($cardClient->lastName));?></td>
                        <td><?=trim(htmlspecialchars($cardClient->firstName));?></td>
                        <td><?=$cardClient->birthDate;?></td>
                        <td><?=$cardClient->cardNumber;?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>