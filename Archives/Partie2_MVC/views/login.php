<!DOCTYPE html>
<html>
	<head>
		<title>Se connecter</title>
		<meta charset="utf-8">
	</head>
	<body>
		<?php if (isset($_SESSION['user'])): ?>
            <!-- Persistance de la valeur SESSION -->
			<p>Bienvenue <?= strip_tags($_SESSION['user']['login']); ?></p>
		<?php endif; ?>
        <a href="../index.php">Accueil</a>
		<form action="" method="POST">
			<fieldset>
				<legend>Se connecter</legend>
				<input type="text" name="login">
				<br>
				<input type="password" name="password">
			</fieldset>
			<button type="submit" name="validate">Connexion</button>
		</form>
	</body>
</html>