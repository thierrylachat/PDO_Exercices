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