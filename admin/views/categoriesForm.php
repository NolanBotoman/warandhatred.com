<!DOCTYPE html>
<?php require 'partials/head_assets.php'; ?>
<body class="index-body">
	<div class="container-fluid">
		<div class="row">
			<?php require ('partials/navigation.php'); ?>
			<div class="col-9 py-3">
				<?php if(isset($_SESSION['messages'])): ?>
					<?php foreach($_SESSION['messages'] as $message): ?>
						<?= $message ?>
					<?php endforeach; ?>
				<?php endif; ?>
				<section class="ml-2">
					<h3>Formulaire <?= ($_GET['action'] == 'new' ? "ajout" : "édition") ?> de catégorie</h3><br>
					<form action="index.php?controller=categories&action=<?= isset($category) ||  (isset($_SESSION['old_inputs']) && $_GET['action'] == 'edit') ? 'edit&id='. $_GET['id'] : 'add' ?>" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="title">Nom :</label>
							<input class="form-control" type="text" name="name" id="name" value="<?= isset($_SESSION['old_inputs']) ? htmlspecialchars($_SESSION['old_inputs']['name']) : '' ?><?= isset($category) ? htmlspecialchars($category['name']) : '' ?>" />
						</div>
						<input class="btn btn-outline-dark" type="submit" value="Enregistrer" />
						<button class="btn btn-dark"><a class="text-white text-decoration-none" href="index.php?controller=categories&action=list">Retour</a></button>
					</form>
					
				</section>
			</div>
		</div>
	</div>
</body>
<?php require 'partials/js_assets.php'; ?>
</html>