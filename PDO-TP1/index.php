
<?php
	require_once dirname(__FILE__).'/controllers/index_controller.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Liste des employés</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="/assets/libraries/bootstrap-4.3.1-dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/assets/libraries/font-awesome-5.5.0/css/all.css">
		<script type="text/javascript" src="/assets/js/jquery.js"></script>

	</head>
	<body>
		<div class="container">
			<div class="p-3 w-100 text-center">
				<h1>Liste des employés</h1>
			</div>
			<div class="p-3 w-100 bg-dark rounded-lg shadow d-flex justify-content-between align-items-center">
				<form action="" method="GET">
					<div class="d-flex">
						<select class="form-control" name="filter" id="filter">
							<option value="">Tous les résulats</option>
							<?php foreach ($service_list as $service) : ?>
								<option <?= (isset($_GET['filter']) && $_GET['filter'] == $service->services_id) ? 'selected' : ''; ?> value="<?= $service->services_id; ?>"><?= $service->name; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</form>
				<div>
					<a class="text-white" href="/controllers/new_user_controller.php">Nouvel utilisateur</a>
				</div>
			</div>
			<div class="mt-5 row" id="UsersList">
				<?php if (count($user_list) === 0) : ?>
					<div class="col-12">Aucun utilisateur n'est enregistré dans la base</div>
				<?php else: ?>
					<?php foreach ($user_list as $user) : ?>
						<div class="col-lg-4 col-md-6">
							<div class="my-1 card border-dark">
								<div class="card-body">
									<h5 class="card-title"><?= $user->firstname.' '.$user->lastname; ?></h5>
									<h6 class="card-subtitle mb-2 text-muted"><?= $user->service_name; ?></h6>
									<div class="text-dark"><?= $user->age; ?> ans</div>
									<div class="text-dark"><?= $user->address.' '.$user->zipcode; ?></div>
									<div class="text-dark"><?= $user->phone; ?></div>
									<div class="w-100 d-flex justify-content-end">
										<form action="" method="POST">
											<input type="hidden" name="users_id" value="<?= $user->users_id; ?>">
											<button class="btn btn-sm btn-secondary stop d-none" type="button" data-id="<?= $user->users_id; ?>">Annuler</button>
											<button class="btn btn-sm btn-danger delete" type="button" data-delete="<?= $user->users_id; ?>">Supprimer</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
		<script type="text/javascript" src="/assets/js/script.js"></script>
	</body>
</html>