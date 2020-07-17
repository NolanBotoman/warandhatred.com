<!DOCTYPE html>
<html lang="fr">
<?php require 'partials/head.php'; ?>
<body>
	<div class="container">
		<?php require 'partials/navigation.php'; ?>
		<div class="row">
			<?php require 'partials/attachment_cart.php'; ?>
			<section class="main">
				<?php if(isset($_SESSION['messages'])): ?>
					<?php foreach($_SESSION['messages'] as $message): ?>
						<?= $message ?>
					<?php endforeach; ?>
				<?php endif; ?>
				<?php if(empty($products)): ?>
					<h4 class="mrl-1 align-center italic">Vous ne possédez actuellement aucun article enregistré dans votre panier.<br>Pour découvrir les produits War&Hatred <a class="underline colorize" href="index.php?page=shop&show=all">clique ici</a>.</h4>
				<?php else: ?>
				<div class="alert green">
					<p class="italic">Frais de livraison offert à partir de 50€ d'achat</p>
				</div>
				<div class="wrapper cart">
					<div class="view">
						<div style="overflow-x:auto;">
							<table class="table stripped mtb-3 m-mt-1">
								<thead>
									<tr>
										<td></td>
										<td><h4 class="italic">ARTICLE</h4></td>
										<td><h4 class="italic">DESCRIPTION</h4></td>
										<td><h4 class="italic">AMOUNT</h4></td>
										<td><h4 class="italic">SIZE</h4></td>
										<td><h4 class="italic">PRICE</h4></td>
										<td><h4 class="italic">TOTAL</h4></td>
									</tr>
								</thead>
								<tbody>
									<?php

									$total = 0;
									foreach($products as $product): 
									$total += ($product['amount'] * $product['price']);

									?>
									<tr>
										<td>
											<form action="index.php?page=cart&show=remove&id=<?= $product['id'] ?>&size=<?= $product['size']['id'] ?>" method="post" enctype="multipart/form-data">
												<input type="checkbox" id="delete" name="delete" checked />
												<button for="delete" type="submit"><i class="cross"></i></button>
											</form>
										</td>
										<td class="one-line"><?= $product['name'] ?></td>
										<td><?= $product['description'] ?></td>
										<td>
											<a class="controller" href="index.php?page=cart&show=remove&id=<?= $product['id'] ?>&size=<?= $product['size']['id'] ?>"><i class="minus"></i></a>
											<?= $product['amount'] ?>
											<a class="controller" href="index.php?page=cart&show=add&id=<?= $product['id'] ?>&size=<?= $product['size']['id'] ?>"><i class="plus"></i></a>
										</td>
										<td><?= $product['size']['size'] ?></td>
										<td><?= $product['price'] ?>€</td>
										<td><?= $product['amount'] * $product['price'] ?>€</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
						<div class="checkout mb-1">
							<div class="shipping m-mtb-1">
								<h3 class="mtb-2">TOTAL <?= $total ?>€</h3>
								<hr>
								<div class="content mtb-4">
									<p>Shipping costs</p>
									<?php $shipping = ($total > 50) ? '0' : '5' ?>
									<p><?= ($shipping > 0) ? '+ ' . number_format($shipping, 2, ',', ' ') . '€' : 'FREE' ?></p>
								</div>
								<?php $total = ($shipping > 0) ? $total + $shipping : $total ?>
								<h2 class="mt-2 mb-1">TOTAL <?=  $total ?>€</h2>
							</div>
							<div class="tool">
								<a href="index.php?page=shop&show=all"><button class="btn m-btn">GO BACK TO SHOP</button></a>
								<form action="index.php?page=checkout&show=checkout" method="post" enctype="multipart/form-data">
									<input type="checkbox" id="cart" name="cart" checked />
									<input type="number" id="bill" name="bill" value="<?= $total ?>" />
									<input class="btn m-btn m-mt-2" for="cart" type="submit" value="CHECK OUT" />
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
			</section>
		</div>
	</div>
</body>
<?php require 'partials/js.php'; ?>
</html>
