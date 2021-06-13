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
				<h4 class="my-auto align-center italic">
					Aucun article n'a été trouvé dans cette catégorie.
				</h4>
				<?php else: ?>
				<div class="cards">
				<?php foreach($products as $product): ?>
					<div class="card">
						<a href="<?= 'index.php?page=shop&show=view&id=' . $product['id'] ?>">
							<img class="display solid-net" src="<?= end($product)[0] ?>" alt="<?= $product['name'] ?>">
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
				<?php endif; ?>
			</section>
		</div>
	</div>
</body>
</html>
