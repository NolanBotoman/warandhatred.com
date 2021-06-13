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
					<div class="d-flex flex-wrap">
						<div class="me-lg-4">
							<h3>Utilisateurs</h3>
							<a href="index.php?controller=users&action=new">Ajouter un nouvelle utilisateur</a><br><br>
						</div>
						<form class="d-flex align-items-center" action="index.php?controller=users&action=takeover" method="post" enctype="multipart/form-data">
							<div class="d-flex flex-wrap">
								<select class="form-select w-sm-auto" name="id">
									<option value=""></option>
								<?php foreach($users as $user): ?>
						  			<option value="<?= $user['id'] ?>"><?= $user['email'] ?></option>
						  		<?php endforeach; ?>
								</select>
								<input class="btn btn-secondary ms-lg-3 mb-2 mb-lg-0 text-light w-sm-100" type="submit" value="Se connecter en tant que cet utilisateur" />
							</div>
						</form>
					</div>
					<div class="d-grid g-wrapper-6 gap-4">
					<?php foreach($users as $user): ?>
						<div>
							<p class="pb-2"><kbd>Utilisateur n°<?=  htmlspecialchars($user['id']) ?></kbd></p>
							<p>Email associé au compte <br><span class="fw-light"><?=  htmlspecialchars($user['email']) ?></span></p>
							<p><a href="index.php?controller=users&action=edit&id=<?= $user['id'] ?>">modifier</a></p>
						</div>
					<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

