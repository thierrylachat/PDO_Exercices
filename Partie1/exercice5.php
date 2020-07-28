<?php

// Création de requêtes permettant de lire les infos (tirées de phpMyAdmin).
$sqlMClientsList = "SELECT `lastName`, `firstName` FROM `clients` WHERE `lastname` LIKE 'M%' ORDER BY `lastname` ASC";

// "Query" renvoie le jeu de données associées aux requêtes.
$req = $db->query($sqlMClientsList);

// Création du tableau de données liées au jeu de données.
$MClientsList = $req->fetchAll(PDO::FETCH_OBJ);

?>


<!-- Création des paragraphes de données pour afficher uniquement le nom et le prénom de tous les clients dont le nom commence par la lettre "M" par ordre alphabétique. -->
<div class="container">
    <h1 class="text-center m-5 text-success">Liste des clients dont le nom commence par "M".</h1>
    <div class="row m-auto">
        <?php foreach ($MClientsList as $MClient): ?>
        <div class="card m-4" style="width: 18rem;">
            <div class="card-body">
                <p><span class="font-weight-bold">Nom : </span><?=trim(htmlspecialchars($MClient->lastName));?></p>
                <p><span class="font-weight-bold">Prénom : </span><?=trim(htmlspecialchars($MClient->firstName));?></p>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>