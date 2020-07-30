<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Ajout de patient</title>
</head>

<body>
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <legend class="text-center text-uppercase font-weight-bold">Ajout de patient</legend>
                <form>
                    <div class="form-group">
                        <label for="lastname">Nom de famille</label>
                        <input type="text" class="form-control" id="lastname" placeholder="Dupont">
                    </div>
                    <div class="form-group">
                        <label for="firstname">Prénom</label>
                        <input type="text" class="form-control" id="firstname" placeholder="John">
                    </div>
                    <div class="form-group">
                        <label for="birthdate">Date de naissance</label>
                        <input type="date" class="form-control" id="birthdate" placeholder="22/01/58">
                    </div>
                    <div class="form-group">
                        <label for="firstname">Téléphone</label>
                        <input type="text" class="form-control" id="phone" placeholder="06.42.16.58.98">
                    </div>
                    <div class="form-group">
                        <label for="mail">Mail</label>
                        <input type="text" class="form-control" id="mail" placeholder="john.doe@gmail.com">
                    </div>
                    <button type="button" class="btn btn-success font-weight-bold">Ajouter un nouveau patient</button>
                </form>
            </div>
        </div>
    </div>




</body>

</html>