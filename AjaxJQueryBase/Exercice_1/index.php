<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  
  <title>Ajax</title>
        
  


</head>
<body>
    <h1></h1>
-----------------
    <h2></h2>
    <script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>

    <script>

        $(document).ready(function() {
            $.ajax({
                url: 'mapageajax.php',
                type: 'POST',
                data: {
                    "id":1,
                    "categorie":"Mac"
                },
            })
            .done(function(monretourajax) {
                datas = $.parseJSON(monretourajax);
                console.log(datas);  
                $("h1").html(datas[0].id);
                $("h2").html(datas[0].categorie);
                     
            })
        })


    </script>
        


</body>
</html>