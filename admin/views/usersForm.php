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
					<h3>Formulaire <?= ($_GET['action'] == 'new' ? "ajout" : "édition") ?> de l'utilisateur</h3><br>
					<form action="index.php?controller=users&action=<?= isset($user) ||  (isset($_SESSION['old_inputs']) && $_GET['action'] == 'edit') ? 'edit&id='. $_GET['id'] : 'add' ?>" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="email">Email :</label>
							<input class="form-control"  type="text" name="email" id="email" value="<?= isset($_SESSION['old_inputs']) ? htmlspecialchars($_SESSION['old_inputs']['email']) : '' ?><?= isset($user) ? htmlspecialchars($user['email']) : '' ?>" />
						</div>
						<div class="form-group">
							<label for="firstname">Prénom :</label>
							<input class="form-control"  type="text" name="firstname" id="firstname" value="<?= isset($_SESSION['old_inputs']) ? htmlspecialchars($_SESSION['old_inputs']['firstname']) : '' ?><?= isset($user) ? htmlspecialchars($user['firstname']) : '' ?>" />
						</div>
						<div class="form-group">
							<label for="lastname">Nom :</label>
							<input class="form-control"  type="text" name="lastname" id="lastname" value="<?= isset($_SESSION['old_inputs']) ? htmlspecialchars($_SESSION['old_inputs']['lastname']) : '' ?><?= isset($user) ? htmlspecialchars($user['lastname']) : '' ?>" />
						</div>
						<div class="form-group">
							<label for="password">Mot de passe :</label>
							<input class="form-control"  type="password" size="24" name="password" id="password" placeholder="<?= ($_GET['action'] == 'edit' ? "Laisser vide pour ne pas modifier" : "") ?>" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['password'] : '' ?><?= (isset($user) && $_GET['action'] == 'new') ? $user['password'] : '' ?>" />
						</div>
						<div class="form-group">
							<label for="address">Adresse :</label>
							<input class="form-control"  type="text" name="address" id="address" value="<?= isset($_SESSION['old_inputs']) ? htmlspecialchars($_SESSION['old_inputs']['address']) : '' ?><?= isset($user) ? htmlspecialchars($user['address']) : '' ?>" />
						</div>
						<div class="form-group">
							<input  type="checkbox" id="is_admin" name="is_admin" <?= (isset($_SESSION['old_inputs']['is_admin']) && $_SESSION['old_inputs']['is_admin'] != null) ? 'checked' : '' ?><?= (isset($user) && $user['is_admin'] != null) ? 'checked' : '' ?> />
							<label class="form-check-label" for="is_admin">Donner les privilèges d'administration à l'utilisateur</label>
						</div>

						<input class="btn btn-outline-dark" type="submit" value="Enregistrer" />
						<a class="text-white text-decoration-none" href="index.php?controller=users&action=list">
							<button class="btn btn-dark" type="button">Retour</button>
						</a>
					</form>
				</section>
			</div>
		</div>
	</div>
</body>
<?php require 'partials/js_assets.php'; ?>
</html>