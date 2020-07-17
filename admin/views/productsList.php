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
					<h3>Liste complète des produits</h3>
					<a href="index.php?controller=products&action=new">Ajouter un nouveau produit</a><br><br>
					<ul class="list-unstyled">
						<?php foreach($products as $product): ?>
						<section class="pl-4 pr-5 mb-4 border-left d-inline-block">
							<li class="pb-2"><h6><kbd>Produit n°<?=  htmlspecialchars($product['id']) ?></kbd></h6></li>
							<li><h6>Nom de l'article <br><span class="font-italic"><?=  htmlspecialchars($product['name']) ?></span></h6></li>
							<?php
							$sizes_sizes = array();

							foreach ($products_sizes as $product_sizes) {
								if ($product_sizes['product_id'] == $product['id']) {
									foreach ($sizes as $size) {
										if ($size['id'] == $product_sizes['size_id']) {
											array_push($sizes_sizes, $size['size']);
										}
									}
								}
							}

							?>
							<li>
								<h6>Tailles(s) disponible(s) <br><span class="font-italic"><?=  htmlspecialchars(implode(", ", $sizes_sizes)) ?></span></h6>
							</li>
							<?php
							$categories_names = array();

							foreach ($products_categories as $product_categories) {
								if ($product_categories['product_id'] == $product['id']) {
									foreach ($categories as $category) {
										if ($category['id'] == $product_categories['category_id']) {
											array_push($categories_names, $category['name']);
										}
									}
								}
							}

							if (empty($categories_names)) array_push($categories_names, 'Aucune');
							?>
							<li>
								<h6>Catégorie(s) associée(s) <br><span class="font-italic"><?=  htmlspecialchars(implode(", ", $categories_names)) ?></span></h6>
							</li>
							<li>
								<a href="index.php?controller=products&action=edit&id=<?= $product['id'] ?>">modifier</a> 
								<a href="index.php?controller=products&action=delete&id=<?= $product['id'] ?>">supprimer</a>
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

