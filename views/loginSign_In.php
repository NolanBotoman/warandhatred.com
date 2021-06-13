<!DOCTYPE html>
<html lang="fr">
<?php require 'partials/head.php'; ?>
<body>
	<div class="container">
		<?php require 'partials/navigation.php'; ?>
		<div class="row">
			<?php require 'partials/attachment.php'; ?>
			<section class="main">
				<?php require 'partials/alert.php'; ?>
				<form class="form" action="index.php?page=login&show=sign_in" method="post" enctype="multipart/form-data">
					<div class="group mtb-1">
						<label for="email"><h5 class="italic">EMAIL</h5></label>
						<input class="control mt-1"  type="text" name="email" id="email" value="<?= isset($_SESSION['old_inputs']) ? htmlspecialchars($_SESSION['old_inputs']['email']) : '' ?>" />
					</div>
					<div class="group mtb-1">
						<label for="password"><h5 class="italic">PASSWORD</h5></label>
						<input class="control mt-1"  type="password" size="24" name="password" id="password" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['password'] : '' ?>" />
					</div>

					<input class="btn btn-large mtb-1" type="submit" value="SIGN IN" />
				</form>
			</section>
		</div>
	</div>
</body>
</html>
