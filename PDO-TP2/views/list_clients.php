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
    <h1 class="text-center">Liste de nos clients</h1>
    <div class="row justify-content-center mt-5 mb-5">
        <?php if(count($client_list)> 0) {?>
            <?php foreach ($client_list as $clients) { ?>
            <div class="card bg-dark" style="width: 18rem;">
                <img class="card-img-top" src="https://www.w3schools.com/howto/img_avatar.png" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= $clients->client_firstname.' '.$clients->client_lastname; ?></h5>
                    <p class="card-text">
                        Date de naissance : <br />
                        <?= $clients->client_birthdate;?><br />
                        Adresse Postale : <br />
                        <?= $clients->client_address;?><br />
                        Code postal : <br />
                        <?= $clients->client_zipcode;?><br />
                        Téléphone : <br />
                        <?= $clients->client_phone;?><br />
                    </p>
                    <a href="profile_client_ctrl.php?id=<?=$clients->client_id?>" class="btn btn-primary">Voir Le
                        profil</a>
                </div>
            </div>
            <?php } ?>
        <?php } ?>
    </div>
    
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
</body>
</html>