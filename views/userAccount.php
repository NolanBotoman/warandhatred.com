<!DOCTYPE html>
<html lang="fr">
<?php require 'partials/head.php'; ?>
<body>
	<div class="container">
		<?php require 'partials/navigation.php'; ?>
		<div class="row">
			<?php require 'partials/attachment.php'; ?>
			<section class="main">
				<?php if(isset($_SESSION['messages'])): ?>
					<?php foreach($_SESSION['messages'] as $message): ?>
						<?= $message ?>
					<?php endforeach; ?>
				<?php endif; ?>
				<form class="form" action="index.php?page=user&show=account" method="post" enctype="multipart/form-data">
					<div class="group mtb-1">
						<label for="email"><h5 class="italic">EMAIL</h5></label>
						<input class="control mt-1"  type="text" name="email" id="email" value="<?= isset($_SESSION['old_inputs']) ? htmlspecialchars($_SESSION['old_inputs']['email']) : '' ?><?= isset($user) ? htmlspecialchars($user['email']) : '' ?>" />
					</div>
					<div class="group-line mtb-1">
						<div class="group mr-1">
							<label for="firstname"><h5 class="italic">FIRST NAME</h5></label>
							<input class="control mt-1"  type="text" name="firstname" id="firstname" value="<?= isset($_SESSION['old_inputs']) ? htmlspecialchars($_SESSION['old_inputs']['firstname']) : '' ?><?= isset($user) ? htmlspecialchars($user['firstname']) : '' ?>" />
						</div>
						<div class="group ml-1 m-mt-2">
							<label for="lastname"><h5 class="italic">LAST NAME</h5></label>
							<input class="control mt-1"  type="text" name="lastname" id="lastname" value="<?= isset($_SESSION['old_inputs']) ? htmlspecialchars($_SESSION['old_inputs']['lastname']) : '' ?><?= isset($user) ? htmlspecialchars($user['lastname']) : '' ?>" />
						</div>
					</div>
					<div class="group mtb-1">
						<label for="address"><h5 class="italic">ADDRESS</h5></label>
						<input class="control mt-1"  type="text" name="address" id="address" value="<?= isset($_SESSION['old_inputs']) ? htmlspecialchars($_SESSION['old_inputs']['address']) : '' ?><?= isset($user) ? htmlspecialchars($user['address']) : '' ?>" />
					</div>
					<div class="group-line mtb-1">
						<div class="group mr-1">
							<label for="password"><h5 class="italic">PASSWORD</h5></label>
							<input class="control mt-1"  type="password" size="24" name="password" id="password" placeholder="LEAVE BLANK SO AS NOT TO MODIFY" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['password'] : '' ?>" />
						</div>
						<div class="group ml-1 m-mt-2">
							<label for="c_password"><h5 class="italic">CONFIRM PASSWORD</h5></label>
							<input class="control mt-1"  type="password" size="24" name="c_password" id="c_password" placeholder="LEAVE BLANK SO AS NOT TO MODIFY" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['c_password'] : '' ?>" />
						</div>
					</div>
					<input class="btn btn-large mtb-1" type="submit" value="UPDATE" />
				</form>
			</section>
		</div>
	</div>
</body>
<?php require 'partials/js.php'; ?>
</html>
