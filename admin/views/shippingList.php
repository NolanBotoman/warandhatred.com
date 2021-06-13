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
					<h3>Livraisons</h3>
					<a href="index.php?controller=shipping&action=new">Ajouter une nouvelle livraison</a><br><br>
					<div class="d-grid g-wrapper-6 gap-4">
					<?php foreach($shipping as $_shipping): ?>
						<div>
							<p class="pb-2"><kbd>Livraison n°<?=  htmlspecialchars($_shipping['id']) ?></kdb></p>
							<p class="h6">Description <br><span class="fw-light"><?=  htmlspecialchars($_shipping['description']) ?></span></p>
							<p class="h6">Frais d'expédition <br><span class="fw-light"><?=  htmlspecialchars($_shipping['fees']) ?>€</span></p>
							<p><a href="index.php?controller=shipping&action=edit&id=<?= $_shipping['id'] ?>">modifier</a></p>
						</div>
					<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>



