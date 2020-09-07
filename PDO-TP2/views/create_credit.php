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
    <h1 class="text-center mt-4">Créer un crédit</h1>
<div class="row justify-content-center" style="padding:10%;">
    <form action="" method="POST" class="col-md-6">
    <?php if(isset($createSuccess)) { ?>
        <div class="alert alert-success text-center">Votre crédit a bien été édité</div>
    <?php } ?>
    <?php if (count($errors) > 0) { ?>
        <?php foreach ($errors as $error) { ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php } ?>
    <?php } ?>
    <div class="form-group">
        <label for="organisme">Maison de credit : <i class="mdi mdi-abugida-devanagari:"></i></label>
        <input type="text" class="form-control" id="organisme" name="organisme" placeholder="Cetelem">
    </div>
    <div class="form-group">
        <label for="amound">Montant du credit :</label>
        <div class="input-group">
            <input type="text" class="form-control" id="amound" name="amound" placeholder="1000">
            <div class="input-group-append">
                <div class="input-group-text">€</div>
            </div>
            
        </div>
    </div>
    <div class="form-group">
        <label for="client">Client :</label>
        <select class="form-control" name="client" id="client">
            <option value="">Choisir un client</option>
            <?php foreach ($client_list as $client) { ?>
                <option value="<?=$client->client_id?>"><?=$client->client_firstname.' '.$client->client_lastname?></option>
            <?php } ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Créer ce crédit </button>
    </form>
</div>
<footer class="row p-3 mr-4 border m-auto justify-content-around mt-5">
        <p>
            Le credit du bled<br/>
            36 Av. des Champs-Élysées<br/>
            75000 Paris CEDEX 12<br/>
        </p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.378581301063!2d2.305869815570055!3d48.87005910783921!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66fc45b6fc7bf%3A0x83c587f7f4e0c0fc!2s36%20Av.%20des%20Champs-%C3%89lys%C3%A9es%2C%2075008%20Paris!5e0!3m2!1sfr!2sfr!4v1599202239533!5m2!1sfr!2sfr" width="600" height="100" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </footer>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>