<?php include_once dirname(__FILE__) . '/includes/header.php'; ?>
<div class="container d-flex align-items-center justify-content-center bg-dark">
    <?php if(isset($createSuccess)): ?>
        <div class="alert alert-success" role="alert">
        <p>Patient ajouté !</p>
        </div>
    <?php endif; ?>
    <div class="p-3 rounded-lg shadow">
        <form action="" method="post">
            <fieldset class="p-3 border">
                <legend>Nouveau patient</legend>
                <div class="w-100 d-sm-flex">
                    <div class="mr-2 w-100">
                        <label for="lastname">Nom de famille</label>
                        <input class="form-control" id="lastname" type="text" name="lastname">
                    </div>
                    <div class="mt-sm-0 mt-3 ml-2 w-100">
                        <label for="firstname">Prénom</label>
                        <input class="form-control" id="firstname" type="text" name="firstname">
                    </div>
                </div>
                <div class="mt-3 w-100">
                    <label for="birthdate">Date de naissance</label>
                    <input class="form-control" id="birthdate" type="date" name="birthdate" autocomplete="off">
                </div>
                <div class="mt-3 w-100">
                    <label for="mail">Adresse email</label>
                    <input class="form-control" id="mail" type="email" name="mail">
                </div>
                <div class="mt-3 w-100">
                    <label for="phone">Numéro de téléphone</label>
                    <input class="form-control" id="phone" type="tel" name="phone">
                </div>
                <div class="mt-3 w-100 d-flex justify-content-center">
                    <button class="btn btn-info" type="submit" name="subscribe">Enregistrer</button>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<?php include_once dirname(__FILE__) . '/includes/footer.php'; ?>