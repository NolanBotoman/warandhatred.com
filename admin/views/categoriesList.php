<!DOCTYPE html>
<?php require 'partials/head_assets.php'; ?>
<body class="index-body">
	<div class="container-fluid">
		<div class="row">
			<?php require ('partials/navigation.php'); ?>
			<div class="col-9 py-3">
				<?php if(isset($_SESSION['messages'])): ?>
					<?php foreach($_SESSION['messages'] as $message): ?>
						<?= $message ?><br>
					<?php endforeach; ?>
				<?php endif; ?>

				<section class="ml-2">
					<h3>Liste complète des catégories</h3>
					<a href="index.php?controller=categories&action=new">Ajouter une nouvelle catégorie</a><br><br>
					<ul class="list-unstyled">
						<?php foreach($categories as $category): ?>
						<section class="pl-4 pr-5 mb-4 border-left d-inline-block">
							<li class="pb-2"><h6><kbd>Catégorie n°<?=  htmlspecialchars($category['id']) ?></kdb></h6></li>
							<li><h6>Nom de la catégorie <br><span class="font-italic"><?=  htmlspecialchars($category['name']) ?></span></h6></li>
							<li>
								<a href="index.php?controller=categories&action=edit&id=<?= $category['id'] ?>">modifier</a>
								<a href="index.php?controller=categories&action=delete&id=<?= $category['id'] ?>">supprimer</a>
							</li>
						</section>
						<?php endforeach; ?>
					</ul>
				</section>
			</div>
		</div>
	</div>
</body>
<?php require 'partials/js_assets.php'; ?>
</html>

