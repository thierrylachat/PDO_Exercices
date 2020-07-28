<?php

// Création de requêtes permettant de lire les infos (tirées de phpMyAdmin).
$sqlMClientsList = "SELECT `lastName`, `firstName` FROM `clients` WHERE `lastname` LIKE 'M%' ORDER BY `lastname` ASC";

// "Query" renvoie le jeu de données associées aux requêtes.
$req = $db-> query($sqlMClientsList);

// Création du tableau de données liées au jeu de données. 
$MClientsList = $req->fetchAll(PDO::FETCH_OBJ);

?>


<!-- Création du tableau de données. -->
<div class="container">
    <h1 class="text-center m-4 text-success">Liste des clients dont le nom par "M".</h1>
    <div class="row">
        <div class="text-center col-12">
            <?php foreach ($MClientsList as $MClient): ?>
            <p><span class="font-weight-bold">Nom : </span><?=$MClient->lastName;?></p>
            <p><span class="font-weight-bold">Prénom : </span><?=$MClient->firstName;?></p>
            <?php endforeach;?>
        </div>
    </div>
</div>