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
<h1 class="text-center mt-4">Enregister un nouveau client</h1>

<div class="row justify-content-center" style="padding:10%;">
    <form action="" method="POST" class="col-md-6">
    <?php if(isset($createSuccess)) { ?>
        <div class="alert alert-success text-center">Votre client a bien été enregistré</div>
    <?php } ?>
    <?php if (count($errors) > 0) { ?>
        <?php foreach ($errors as $error) { ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php } ?>
    <?php } ?>
    <div class="form-group">
        <label for="lastname">Nom <i class="mdi mdi-abugida-devanagari:"></i></label>
        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Dupond" value="<?= isset($_POST['lastname']) ? $_POST['lastname'] : ''; ?>">
    </div>
    <div class="form-group">
        <label for="firstname">Prenom :</label>
        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Jean" value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : ''; ?>">
    </div>
    <div class="form-group">
        <label for="birthdate">Date de naissance :</label>
        <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?= isset($_POST['birthdate']) ? $_POST['birthdate'] : ''; ?>">
    </div>
    <div class="form-group">
        <label for="address">Adresse :</label>
        <input type="text" class="form-control" id="address" name="address" placeholder="45 RUE DES FLANDRES" value="<?= isset($_POST['address']) ? $_POST['address'] : ''; ?>">
    </div>
    <div class="form-group">
        <label for="zipcode">Code postal</label>
        <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="75000" value="<?= isset($_POST['zipcode']) ? $_POST['zipcode'] : ''; ?>">
    </div>
    <div class="form-group">
        <label for="phone">Téléphone :</label>
        <input type="text" class="form-control" id="phone" name="phone" placeholder="0110203040" value="<?= isset($_POST['phone']) ? $_POST['phone'] : ''; ?>">
    </div>
    <div class="form-group">
        <label for="statut_id">Statut Marital</label>
        <select class="form-control" name="statut_id" id="statut_id">
            <option value="">Selectionnez votre statut</option>
            <?php foreach($statut_list as $statut) {  ?>
                <option value="<?= $statut->statut_id;?>" <?= (isset($_POST['statut_id']) && $_POST['statut_id']==$statut->statut_id) ? 'selected' : '' ?>><?= $statut->statut; ?></option>
            <?php } ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer en client</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>