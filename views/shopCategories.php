<!DOCTYPE html>
<html lang="fr">
<?php require 'partials/head.php'; ?>
<body>
	<div class="container">
		<?php require 'partials/navigation.php'; ?>
		<div class="row">
			<?php require 'partials/attachment.php'; ?>
			<section class="main">
				<?php if(empty($products)): ?>
				<h4 class="mrl-1 align-center italic">Cette catégorie ne contient aucun article disponible à la vente.</h4>
				<?php else: ?>
				<div class="wrapper">
					<div class="cards">
						<div class="centered">
							<?php foreach($products as $product): ?>
							<div class="card">
								<a href="<?= 'index.php?page=shop&show=view&id=' . $product['id'] ?>">
									<img class="display" src="<?= end($product)[0] ?>" alt="<?= $product['name'] ?>">
									<div class="data">
										<div>
											<h4 class="name"><?= $product['name'] ?></h4>
											<h5 class="smoosh">Voir le produit</h5>
										</div>
										
										<h4 class="price"><?= $product['price'] ?>€</h4>
									</div>
								</a>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
				</div>
			</section>
		</div>
	</div>
</body>
<?php require 'partials/js.php'; ?>
<script src="assets/js/cards_width.js"></script>
</html>
