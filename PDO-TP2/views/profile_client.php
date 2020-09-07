<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO-TP2</title>
</head>

<body class="bg-dark text-white">
    <?php include (dirname(__FILE__).'/../includes/menu.html')?>
    <h1 class="text-center mt-5">Profil de
        <?= $clientProfile->client_firstname.' '.$clientProfile->client_lastname?></h1>
    <div class="row justify-content-center mt-5 bg-dark text-white">
    <img class="img-fluid col-md-3 mb-3" src="https://www.w3schools.com/howto/img_avatar.png" alt="">
        <div class=" col-md-6 text-center">
            <p>Date de Naissance : <?= $clientProfile->client_birthdate?></p>
            <p>Adresse : <?= $clientProfile->client_address.' '.$clientProfile->client_zipcode?></p>
            <p>Téléphone : <?= $clientProfile->client_phone?></p>
            <p>Statut Marital : <?= $clientProfile->statut?></p>
            <h2>Liste des credits :</h2>
            <div class="row">
                <table class="table table-bordered table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Maison de credit :</th>
                            <th scope="col">Somme enpruntée :</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(count($client_list) > 0) {?>
                        <?php foreach ($client_list as $credit) { ?>
                            <tr>
                                <td><?= $credit->credit_organisation; ?></td>
                                <td><?= $credit->credit_amount; ?> €</td>
                            </tr>
                        <?php } ?>
                    <?php }  else {  ?>
                        <p>Aucun credit ne correspont a ce client</p>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

</html>