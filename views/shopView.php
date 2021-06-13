<!DOCTYPE html>
<html lang="fr">
<?php require 'partials/head.php'; ?>
<body>
	<div class="container">
		<?php require 'partials/navigation.php'; ?>
		<div class="row">
			<?php require 'partials/attachment_product.php'; ?>
			<section class="main">
				<?php require 'partials/alert.php'; ?>
				<?php if ($product['amount'] <= 0): ?>
				<div class="alert red">
					<p class="italic">SOLD OUT </p>
				</div>
				<?php endif; ?>
				<div class="gallery">
					<div class="box ">
					<?php for ($i = 0; $i < count(end($product)); $i++): ?>
						<div class="jacket">
							<img class="display" src="<?= end($product)[$i] ?>" alt="<?= $product['name'] . ' ' . $i ?>">
						</div>
					<?php endfor; ?>
					</div>
				</div>
			</section>
		</div>
	</div>
</body>
<?php require 'partials/gallery.php'; ?>
</html>
