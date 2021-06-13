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
					<h3>Catégories</h3>
					<a href="index.php?controller=categories&action=new">Ajouter une nouvelle catégorie</a><br><br>
					<div class="d-grid g-wrapper-6 gap-4">
					<?php foreach($categories as $category): ?>
						<div>
							<p class="pb-2"><kbd>Catégorie n°<?=  htmlspecialchars($category['id']) ?></kdb></p>
							<p class="h6">Nom de la catégorie <br><span class="fw-light"><?=  htmlspecialchars($category['name']) ?></span></p>
							<p><a href="index.php?controller=categories&action=edit&id=<?= $category['id'] ?>">modifier</a></p>
						</div>
					<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

