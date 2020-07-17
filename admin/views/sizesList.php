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
					<h3>Liste complète des tailles</h3>
					<a href="index.php?controller=sizes&action=new">Ajouter une nouvelle taille</a><br><br>
					<ul class="list-unstyled">
						<?php foreach($sizes as $size): ?>
						<section class="pl-4 pr-5 mb-4 border-left d-inline-block">
							<li class="pb-2"><h6><kbd>Taille n°<?=  htmlspecialchars($size['id']) ?></kdb></h6></li>
							<li><h6>Taille <br><span class="font-italic"><?=  htmlspecialchars($size['size']) ?></span></h6></li>
							<li>
								<a href="index.php?controller=sizes&action=edit&id=<?= $size['id'] ?>">modifier</a>
								<a href="index.php?controller=sizes&action=delete&id=<?= $size['id'] ?>">supprimer</a>
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

