<?php
$mailFromBdd = 'licornedu80@picardie.com';
$mailToCheck = $_POST['mail'];

// vérification de la concordance des mails lus
if($mailFromBdd != $mailToCheck){
    // retour booléen Faux
     echo 1;
}else{
    // retour booléen Vrai
    echo 0;
}
