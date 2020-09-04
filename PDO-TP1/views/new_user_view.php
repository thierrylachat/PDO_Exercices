<!DOCTYPE html>
<html>
<head>
	<title>Ajouter un employé</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="/exercices_la_manu/mvc-tp1/assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="/exercices_la_manu/mvc-tp1/assets/libraries/bootstrap-4.3.1-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/exercices_la_manu/mvc-tp1/assets/libraries/font-awesome-5.5.0/css/all.css">
	<script type="text/javascript" src="/exercices_la_manu/mvc-tp1/assets/js/jquery.js"></script>
	<script type="text/javascript" src="/exercices_la_manu/mvc-tp1/assets/js/script.js"></script>
</head>
<body>
	<div class="container">
		<div class="p-3 w-100 text-center">
			<h1>Enregistrer un employé</h1>
		</div>
		<?php if ($createSuccess) : ?>
			<div class="alert alert-success" role="alert">
				Votre employé est enregistré avec succès !
			</div>
		<?php endif; ?>
		<div class="px-3">
			<a class="text-secondary" href="/exercices_la_manu/mvc-tp1/"><i class="mr-2 fas fa-arrow-left"></i>Retour</a>
		</div>
		<div class="p-3 w-100">
			<form action="" method="POST">
				<fieldset class="p-3 border border-dark">
					<legend class="px-2">Informations de l'employé</legend>
					<div class="w-100 d-flex">
						<div class="mr-3 w-100">
							<div class="w-100 input-customized border <?= isset($errors['firstname']) ? 'border-danger' : 'border-secondary'; ?> rounded-lg">
								<label class="px-1 small text-dark">Prénom</label>
								<input class="p-3 w-100 border-0 rounded-lg" type="text" name="firstname" maxlenght="50" value="<?= isset($firstname) ? $firstname : ''; ?>">
							</div>
							<?php if (isset($errors['firstname'])): ?>
								<div class="small text-danger"><?= $errors['firstname']; ?></div>
							<?php endif; ?>
						</div>
						<div class="ml-3 w-100">
							<div class="w-100 input-customized border <?= isset($errors['lastname']) ? 'border-danger' : 'border-secondary'; ?> rounded-lg">
								<label class="px-1 small text-dark">Nom de famille</label>
								<input class="p-3 w-100 border-0 rounded-lg" type="text" name="lastname" maxlenght="50" value="<?= isset($lastname) ? $lastname : ''; ?>">
							</div>
							<?php if (isset($errors['lastname'])): ?>
								<div class="small text-danger"><?= $errors['lastname']; ?></div>
							<?php endif; ?>
						</div>
					</div>
					<div class="mt-4 w-100 d-flex">
						<div class="mr-3 w-100">
							<div class="w-100 input-customized border <?= isset($errors['birthdate']) ? 'border-danger' : 'border-secondary'; ?> rounded-lg">
								<label class="px-1 small text-dark">Date de naissance</label>
								<input class="p-3 w-100 border-0 rounded-lg" type="date" name="birthdate" value="<?= isset($birthdate) ? $birthdate : ''; ?>">
							</div>
							<?php if (isset($errors['birthdate'])): ?>
								<div class="small text-danger"><?= $errors['birthdate']; ?></div>
							<?php endif; ?>
						</div>
						<div class="ml-3 w-100"></div>
					</div>
					<div class="mt-4 w-100">
						<div class="w-100 input-customized border <?= isset($errors['address']) ? 'border-danger' : 'border-secondary'; ?> rounded-lg">
							<label class="px-1 small text-dark">Adresse</label>
							<input class="p-3 w-100 border-0 rounded-lg" type="text" name="address" maxlength="100" placeholder="Adresse (numéro + rue)" value="<?= isset($address) ? $address : ''; ?>">
						</div>
						<?php if (isset($errors['address'])): ?>
							<div class="small text-danger"><?= $errors['address']; ?></div>
						<?php endif; ?>
					</div>
					<div class="mt-4 w-100 d-flex">
						<div class="mr-3 w-100">
							<div class="w-100 input-customized border <?= isset($errors['zipcode']) ? 'border-danger' : 'border-secondary'; ?> rounded-lg">
								<label class="px-1 small text-dark">Code postal</label>
								<input class="p-3 w-100 border-0 rounded-lg" type="text" name="zipcode" maxlength="5" value="<?= isset($zipcode) ? $zipcode : ''; ?>">
							</div>
							<?php if (isset($errors['zipcode'])): ?>
								<div class="small text-danger"><?= $errors['zipcode']; ?></div>
							<?php endif; ?>
						</div>
						<div class="ml-3 w-100">
							<div class="w-100 input-customized border <?= isset($errors['city']) ? 'border-danger' : 'border-secondary'; ?> rounded-lg">
								<label class="px-1 small text-dark">Ville</label>
								<input class="p-3 w-100 border-0 rounded-lg" type="text" name="city" maxlength="50" value="<?= isset($city) ? $city : ''; ?>">
							</div>
							<?php if (isset($errors['city'])): ?>
								<div class="small text-danger"><?= $errors['city']; ?></div>
							<?php endif; ?>
						</div>
					</div>
					<div class="mt-4 w-100 d-flex">
						<div class="mr-3 w-100">
							<div class="w-100 input-customized border <?= isset($errors['phone']) ? 'border-danger' : 'border-secondary'; ?> rounded-lg">
								<label class="px-1 small text-dark">Numéro de téléphone</label>
								<input class="p-3 w-100 border-0 rounded-lg" type="text" name="phone" maxlength="20" value="<?= isset($phone) ? $phone : ''; ?>">
							</div>
							<?php if (isset($errors['phone'])): ?>
								<div class="small text-danger"><?= $errors['phone']; ?></div>
							<?php endif; ?>
						</div>
						<div class="ml-3 w-100">
							<div class="w-100 input-customized border <?= isset($errors['service']) ? 'border-danger' : 'border-secondary'; ?> rounded-lg">
								<label class="px-1 small text-dark">Service</label>
								<select class="p-3 w-100 border-0 rounded-lg" name="service">
									<?php foreach ($service_list as $service) : ?>
										<option value="<?= $service->services_id; ?>"><?= $service->name; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<?php if (isset($errors['service'])): ?>
								<div class="small text-danger"><?= $errors['service']; ?></div>
							<?php endif; ?>
						</div>
					</div>
					<div class="mt-4 w-100 d-flex justify-content-center">
						<button class="btn btn-primary" type="submit">Enregistrer</button>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</body>
</html>