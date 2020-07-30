<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<ul>
		<li> <a href="controllers/login_ctrl.php">Se connecter</a> </li>
		<li> <a href="controllers/create_user_ctrl.php">S'inscrire</a> </li>
		<?php if (isset($_SESSION['user'])): ?>
			<li> <a href="controllers/profil_user_ctrl.php">Voir le profil</a> </li>
		<?php endif; ?>
	</ul>
</body>
</html>