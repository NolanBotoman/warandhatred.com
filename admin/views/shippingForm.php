<!DOCTYPE html>
<html>
<?php require 'partials/head.php'; ?>
<body>
	<div class="container-fluid p-0">
		<div class="row gx-0">
			<?php require 'partials/navigation.php'; ?>
			<div class="col-lg-9">
				<?php require 'partials/alert.php'; ?>
				<div class="p-4">
					<h3>Formulaire <?= ($_GET['action'] == 'new' ? "ajout" : "édition") ?> de livraison</h3><br>
					<form action="index.php?controller=shipping&action=<?= isset($shipping) ||  (isset($_SESSION['old_inputs']) && $_GET['action'] == 'edit') ? 'edit&id='. $_GET['id'] : 'add' ?>" method="post" enctype="multipart/form-data">
						<div class="form-group mb-3">
							<label for="description">Description</label>
							<input class="form-control" type="text" name="description" id="description" value="<?= isset($_SESSION['old_inputs']) ? htmlspecialchars($_SESSION['old_inputs']['description']) : '' ?><?= isset($shipping) ? htmlspecialchars($shipping['description']) : '' ?>" />
						</div>
						<div class="form-group mb-3">
							<label for="fees">Frais d'expédition</label>
							<input class="form-control" type="number" step="0.01" name="fees" id="fees" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['fees'] : '' ?><?= isset($shipping) ? $shipping['fees'] : '' ?>" />
						</div>
						<div class="d-flex justify-content-between">
							<div>
								<input class="btn btn-outline-dark" type="submit" value="Enregistrer" />
								<a class="text-white text-decoration-none ms-2" href="index.php?controller=shipping&action=list">
									<button class="btn btn-dark" type="button">Retour</button>
								</a>
							</div>
							<a class="text-white text-decoration-none ms-2" href="index.php?controller=shipping&action=delete&id=<?= $shipping['id'] ?>">
								<button class="btn btn-danger" type="button">Supprimer</button>
							</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>