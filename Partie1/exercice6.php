<?php

// Création de requêtes permettant de lire les infos (tirées de phpMyAdmin).
$sqlShowsTitles = "SELECT `title`, `performer`, DATE_FORMAT(`date`,'%d/%m/%Y') AS date, `startTime` FROM `shows` ORDER by `title` ASC";

// "Query" renvoie le jeu de données associées aux requêtes.
$req = $db-> query($sqlShowsTitles);

// Création du tableau de données liées au jeu de données. 
$showsTitles = $req->fetchAll(PDO::FETCH_OBJ);

?>


<!-- Création des paragraphes de données. -->
<div class="container">
    <h1 class="text-center m-5 text-success">Liste des spectacles</h1>
    <div class="row">
        <div class="text-center col-12">
            <?php foreach ($showsTitles as $showTitle): ?>
            <p><span class="font-weight-bold"><?=$showTitle->title;?></span> par <?=$showTitle->performer;?>, le <?=$showTitle->date;?> à <?=$showTitle->startTime;?>.</p>
            <?php endforeach;?>
        </div>
    </div>
</div>