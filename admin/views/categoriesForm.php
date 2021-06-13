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
					<h3>Formulaire <?= ($_GET['action'] == 'new' ? "ajout" : "édition") ?> de catégorie</h3><br>
					<form action="index.php?controller=categories&action=<?= isset($category) ||  (isset($_SESSION['old_inputs']) && $_GET['action'] == 'edit') ? 'edit&id='. $_GET['id'] : 'add' ?>" method="post" enctype="multipart/form-data">
						<div class="form-group mb-3">
							<label for="title">Nom :</label>
							<input class="form-control" type="text" name="name" id="name" value="<?= isset($_SESSION['old_inputs']) ? htmlspecialchars($_SESSION['old_inputs']['name']) : '' ?><?= isset($category) ? htmlspecialchars($category['name']) : '' ?>" />
						</div>
						<div class="form-group mb-3">
							<input type="checkbox" id="is_buyable" name="is_buyable" <?= (isset($_SESSION['old_inputs']['is_buyable']) && $_SESSION['old_inputs']['is_buyable'] != 0) ? 'checked' : '' ?><?= (isset($category) && $category['is_buyable'] != 0) ? 'checked' : '' ?> />
							<label class="form-check-label" for="is_buyable">Définir si les produits associés à cette catégorie sont achetables</label>
						</div>
						<div class="d-flex justify-content-between">
							<div>
								<input class="btn btn-outline-dark" type="submit" value="Enregistrer" />
								<a class="text-white text-decoration-none ms-2" href="index.php?controller=categories&action=list">
									<button class="btn btn-dark" type="button">Retour</button>
								</a>
							</div>
							<a class="text-white text-decoration-none ms-2" href="index.php?controller=categories&action=delete&id=<?= $category['id'] ?>">
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