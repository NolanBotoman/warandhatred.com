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
					<h3>Options d'administration</h3>
					<div class="d-grid g-wrapper-3 gap-4">
					<?php foreach($modes as $mode): ?>
						<form action="index.php?controller=admin&action=edit" method="post">
							<p class="pb-2 mt-3 text-capitalize h6"><kbd><?= htmlspecialchars($mode['name']) ?></kdb></p>
							<input onChange="this.form.submit()" type="checkbox" name="status" <?= ($mode['status']) ? "checked" : "" ; ?>>
							<input type="hidden" name="name" value="<?= htmlspecialchars($mode['name']) ?>">
							<label for="scales">Souhaitez-vous activer le mode <?= htmlspecialchars($mode['name']) ?> ?</label>
						</form>
					<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

