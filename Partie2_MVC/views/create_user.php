<!DOCTYPE html>
<html>
	<head>
		<title>Créer un utilisateur</title>
		<meta charset="utf-8">
	</head>
	<body>
		<?php if (isset($userCreateSuccess)): ?>
			<p>L'utilisateur a été enregistré avec succès ! :)</p>
		<?php endif; ?>
		<a href="../index.php">Accueil</a>
		<form action="" method="POST">
			<fieldset>
				<legend>Créer un compte</legend>
				<input type="text" name="login">
				<br>
				<input type="password" name="password">
			</fieldset>
			<button type="submit" name="validate">Créer</button>
		</form>
	</body>
</html>