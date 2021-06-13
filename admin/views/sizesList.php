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
					<h3>Tailles</h3>
					<a href="index.php?controller=sizes&action=new">Ajouter une nouvelle taille</a><br><br>
					<div class="d-grid g-wrapper-6 gap-4">
						<?php foreach($sizes as $size): ?>
						<div>
							<p class="pb-2"><kbd>Taille n°<?=  htmlspecialchars($size['id']) ?></kdb></p>
							<p class="h6">Taille <br><span class="fw-light"><?=  htmlspecialchars($size['size']) ?></span></p>
							<p><a href="index.php?controller=sizes&action=edit&id=<?= $size['id'] ?>">modifier</a></p>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

