<?php

// Création de requêtes permettant de lire les infos (tirées de phpMyAdmin).
$sqlClients = "SELECT `lastName`, `firstName`, DATE_FORMAT(`birthDate`,'%d/%m/%Y') AS birthDate, `card`, CASE `card` WHEN 0 THEN 'Non' WHEN 1 THEN 'Oui' END AS `card_text`, `cardNumber` FROM `clients`";

// "Query" renvoie le jeu de données associées aux requêtes.
$req = $db-> query($sqlClients);

// Création du tableau de données liées au jeu de données. 
$clients = $req->fetchAll(PDO::FETCH_OBJ);

?>

<!-- Création des paragraphes de données. -->
<div class="container">
    <h1 class="text-center m-5 text-success">Liste des clients</h1>
    <div class="row m-auto">
        <?php foreach ($clients as $client): ?>
        <div class="card m-4" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">
                    <p class="text-danger"><span class="font-weight-bold">Nom :
                        </span><?=trim(htmlspecialchars($client->lastName));?></p>
                    <p class="text-danger"><span class="font-weight-bold">Prénom :
                        </span><?=trim(htmlspecialchars($client->firstName));?>
                    </p>
                </h5>
                <p class="card-text">
                    <p><span class="font-weight-bold">Date de naissance : </span><?=$client->birthDate;?></p>
                    <p><strong>Carte : </strong><?= $client->card_text; ?></p>
                    <?php if ($client->card): ?>
                    <p>
                        <strong>Numéro de carte :
                        </strong><?= trim(filter_var($client->cardNumber, FILTER_SANITIZE_NUMBER_INT)); ?>
                    </p>
                    <?php endif; ?>
                </p>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>