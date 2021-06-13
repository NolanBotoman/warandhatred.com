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
					<h3>Produits</h3>
					<a href="index.php?controller=products&action=new">Ajouter un nouveau produit</a><br><br>
					<div class="d-grid g-wrapper-6 gap-4">
					<?php foreach($products as $product): ?>
						<div>
							<p class="pb-2"><kbd>Produit n°<?=  htmlspecialchars($product['id']) ?></kbd></p>
							<p class="h6">Nom de l'article <br><span class="fw-light"><?=  htmlspecialchars($product['name']) ?></span></p>
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
							<p class="h6">Tailles(s) disponible(s) <br><span class="fw-light"><?=  htmlspecialchars(implode(", ", $sizes_sizes)) ?></span></p>
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
							<p class="h6">Catégorie(s) associée(s) <br><span class="fw-light"><?=  htmlspecialchars(implode(", ", $categories_names)) ?></span></p>
							<p><a href="index.php?controller=products&action=edit&id=<?= $product['id'] ?>">modifier</a> </p>
						</div>
					<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

