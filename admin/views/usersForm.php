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
					<h3>Formulaire <?= ($_GET['action'] == 'new' ? "ajout" : "édition") ?> de l'utilisateur</h3><br>
					<form action="index.php?controller=users&action=<?= isset($user) ||  (isset($_SESSION['old_inputs']) && $_GET['action'] == 'edit') ? 'edit&id='. $_GET['id'] : 'add' ?>" method="post" enctype="multipart/form-data">
						<div class="form-group mb-3">
							<label for="email">Email :</label>
							<input class="form-control"  type="text" name="email" id="email" value="<?= isset($_SESSION['old_inputs']) ? htmlspecialchars($_SESSION['old_inputs']['email']) : '' ?><?= isset($user) ? htmlspecialchars($user['email']) : '' ?>" />
						</div>
						<div class="form-group mb-3">
							<label for="firstname">Prénom :</label>
							<input class="form-control"  type="text" name="firstname" id="firstname" value="<?= isset($_SESSION['old_inputs']) ? htmlspecialchars($_SESSION['old_inputs']['firstname']) : '' ?><?= isset($user) ? htmlspecialchars($user['firstname']) : '' ?>" />
						</div>
						<div class="form-group mb-3">
							<label for="lastname">Nom :</label>
							<input class="form-control"  type="text" name="lastname" id="lastname" value="<?= isset($_SESSION['old_inputs']) ? htmlspecialchars($_SESSION['old_inputs']['lastname']) : '' ?><?= isset($user) ? htmlspecialchars($user['lastname']) : '' ?>" />
						</div>
						<div class="form-group mb-3">
							<label for="password">Mot de passe :</label>
							<input class="form-control"  type="password" size="24" name="password" id="password" placeholder="<?= ($_GET['action'] == 'edit' ? "Laisser vide pour ne pas modifier" : "") ?>" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['password'] : '' ?><?= (isset($user) && $_GET['action'] == 'new') ? $user['password'] : '' ?>" />
						</div>
						<div class="form-group mb-3">
							<label for="address">Adresse :</label>
							<input class="form-control"  type="text" name="address" id="address" value="<?= isset($_SESSION['old_inputs']) ? htmlspecialchars($_SESSION['old_inputs']['address']) : '' ?><?= isset($user) ? htmlspecialchars($user['address']) : '' ?>" />
						</div>
						<div class="form-group mb-3">
							<label for="city">Ville :</label>
							<input class="form-control"  type="text" name="city" id="city" value="<?= isset($_SESSION['old_inputs']) ? htmlspecialchars($_SESSION['old_inputs']['city']) : '' ?><?= isset($user) ? htmlspecialchars($user['city']) : '' ?>" />
						</div>
						<div class="form-group mb-3">
							<label for="country">Pays :</label>
							<input class="form-control"  type="text" name="country" id="country" value="<?= isset($_SESSION['old_inputs']) ? htmlspecialchars($_SESSION['old_inputs']['country']) : '' ?><?= isset($user) ? htmlspecialchars($user['country']) : '' ?>" />
						</div>
						<div class="form-group mb-3">
							<input  type="checkbox" id="is_admin" name="is_admin" <?= (isset($_SESSION['old_inputs']['is_admin']) && $_SESSION['old_inputs']['is_admin'] != 0) ? 'checked' : '' ?><?= (isset($user) && $user['is_admin'] != 0) ? 'checked' : '' ?> />
							<label class="form-check-label" for="is_admin">Donner les privilèges d'administration à l'utilisateur</label>
						</div>
						<div class="d-flex justify-content-between">
							<div>
								<input class="btn btn-outline-dark" type="submit" value="Enregistrer" />
								<a class="text-white text-decoration-none ms-2" href="index.php?controller=users&action=list">
									<button class="btn btn-dark" type="button">Retour</button>
								</a>
							</div>
							<a class="text-white text-decoration-none ms-2" href="index.php?controller=users&action=delete&id=<?= $user['id'] ?>">
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