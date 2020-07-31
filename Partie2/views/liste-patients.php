<?php include_once dirname(__FILE__) . '/includes/header.php';?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <?php
            if (count($patientsList) > 0): ?>
	            <table class="table table-striped">
	                <thead>
	                    <tr>
	                        <th>#</th>
	                        <th>Prénom</th>
	                        <th>Nom</th>
	                        <th>Date de naissance</th>
	                    </tr>
	                </thead>
	                <tbody>
	                    <?php foreach ($patientsList as $number => $patient): ?>
	                    <tr>
	                        <td><?=$number + 1?></td>
	                        <td><?=$patient->firstname?></td>
	                        <td><?=$patient->lastname?></td>
	                        <td><?=$patient->birthdate?></td>
	                    </tr>
	                    <?php endforeach;?>
                    </tbody>
                </table>
            <?php else: ?>
            <div>
                <p>Il n'y a pas de patients enregistrés, veuillez ajouter un patient. <a class="btn btn-outline-primary"
                        href="">Ici</a></p>
            </div>
            <?php endif;?>
        </div>
    </div>
</div>

<?php include_once dirname(__FILE__) . '/includes/footer.php';?>