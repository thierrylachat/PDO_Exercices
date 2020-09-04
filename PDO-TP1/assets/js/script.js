$(document).ready(function(){
	$("input[name='firstname']").keyup(function(){
		string = $(this).val();
		string = string.substr(0, 1).toUpperCase() + string.substr(1, string.length).toLowerCase();
		$(this).val(string);
	})

	$("input[name='lastname']").keyup(function(){
		string = $(this).val();
		string = string.substr(0, 1).toUpperCase() + string.substr(1, string.length).toLowerCase();
		$(this).val(string);
	})

	$("body").on('click', '.delete', function(e){
		e.preventDefault(); // empêche le rechargement de la page
		var id = $(this).attr('data-delete'); // affecte l'id du user contenu dans le data-delete du button
		$(this).attr('type', 'submit'); // change le type du button en submit
		$(this).removeClass('delete'); // retire la class delete pour ne pas repasser dans le traitement actuel
		$("button[data-id='"+id+"']").removeClass('d-none'); // retire le d-none du boutton annuler correspondant à l'id du user récupéré
	})

	$("body").on('click', '.stop', function(){
		var id = $(this).attr('data-id'); // affecte l'id du user contenu dans le data-id du button
		$(this).addClass('d-none'); // ajoute la classe d-none
		$("button[data-delete='"+id+"']").attr('type', 'button').addClass('delete'); // change le type submit en type button car on veut annuler l'opération delete
	})
})

	// ON RECUPERE DANS "element" NOTRE BALISE HTML "filter"
	let element = document.getElementById('filter');
	// ON ECOUTE L'EVENEMENT "CHANGE" SUR CET ELEMENT
    element.addEventListener('change',function(){
		// ON ATTRIBUE LA VALEUR DE NOTRE CHAMPS "filter" DANS LA VARIABLE "service"
		var service = element.value;
		// ON EFFECTUE UNE REQUETE AJAX SUR NOTRE CONTROLLER
        var request = fetch('../controllers/index_controller.php?filter='+service, {
            headers: {
                'Accept': 'application/json' // ON ATTEND EN RETOUR UN JSON (UN TABLEAU PHP TRANSFORME EN CHAINE GRACE A JSON_ENCODE)
            }
        })
        .then(function (response) { // SI TOUT VA BIEN ON RETOURNE LA PROMESSE TRANSFORMEE 
            return response.json();
		})
		.then(function (users_array) { // users_array CONTIENT UN TABLEAU JAVASCRIPT D'OBJETS (nos résultats) 
			// ON RECUPERE DANS "resultUsersList" NOTRE BALISE HTML "UsersList"
			let resultUsersList = document.getElementById('UsersList');
			let html = "";
				// SI users_array EST VITE ON ALERTE
				if (users_array.length === 0){
					html = `<div class="col-12">Aucun utilisateur n'est enregistré dans la base</div>`
				} else { // SINON, ON BOUCLE SUR LE TABLEAU ET ON GENERE UN CODE HTML CONTENANT TOUS LES RESULTATS 
					users_array.forEach (user => 
						{
						html += `<div class="col-lg-4 col-md-6">
							<div class="my-1 card border-dark">
								<div class="card-body">
									<h5 class="card-title">${user.firstname + " " +user.lastname}</h5>
									<h6 class="card-subtitle mb-2 text-muted">${user.service_name}</h6>
									<div class="text-dark">${user.age} ans</div>
									<div class="text-dark">${user.address+" "+user.zipcode}</div>
									<div class="text-dark">${user.phone}</div>
									<div class="w-100 d-flex justify-content-end">
										<form action="" method="POST">
											<input type="hidden" name="users_id" value="${user.users_id}">
											<button class="btn btn-sm btn-secondary stop d-none" type="button" data-id="${user.users_id}">Annuler</button>
											<button class="btn btn-sm btn-danger delete" type="button" data-delete="${user.users_id}">Supprimer</button>
										</form>
									</div>
								</div>
							</div>
						</div>`
						})
				}
				// ON ENVOIE LE HTML GENERE DANS resultUsersList
				resultUsersList.innerHTML = html;


        })
    }) 