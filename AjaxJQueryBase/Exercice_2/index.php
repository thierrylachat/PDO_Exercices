<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
</head>
<body>
    
<h1></h1>
-----------------
    <h2></h2>

    <script>
let mail = "brienne-fontaine@mail.fr";

    var ajaxRequest = fetch('mapageajax.php', {
        headers: {
            //'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        method:'POST',
        body: "mail=" + mail
    });

    // si la requête passe, on retourne le mail sous forme de texte 
    ajaxRequest.then(function(response) {
        return response.text();
    })
    // retour de l'info traitée par le JS de mapageajax.php
    .then(function(checkedMailMapageajax) {
        console.log(checkedMailMapageajax);
    })
    
    </script>
        

</body>
</html>