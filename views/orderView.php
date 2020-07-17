<!DOCTYPE html>
<html lang="fr">
<?php require 'partials/head.php'; ?>
<body>
	<div class="container">
		<?php require 'partials/navigation.php'; ?>
		<div class="row">
			<?php require 'partials/attachment.php'; ?>
			<section class="main">
				<div class="wrapper order">
					<h4 class="mtb-1">Récapitulatif de la commande n°<?= $order['id'] ?></h4>
					<h6 class="mb-1">Nous vous remercions de nous avoir fait confiance et si ce n'est pas déjà le cas recevrez votre colis W&H sous peu dès que nous l'aurons prit en charge (un email de confirmation vous sera envoyé pour vous en informer).</h6>
					<div style="overflow-x:auto;">
						<table class="table stripped mtb-1">
							<thead>
								<tr>
									<td><h4 class="italic">ARTICLE</h4></td>
									<td><h4 class="italic">AMOUNT</h4></td>
									<td><h4 class="italic">SIZE</h4></td>
									<td><h4 class="italic">PRICE</h4></td>
									<td><h4 class="italic">TOTAL</h4></td>
								</tr>
							</thead>
							<tbody>
								<?php

								$total = 0;
								foreach($order_products as $order_product): 
								$total += ($order_product['amount'] * $order_product['price']);

								?>
								<tr>
									<td><?= $order_product['name'] ?></td>
									<td><?= $order_product['amount'] ?></td>
									<td><?= $order_product['size'] ?>€</td>
									<td><?= $order_product['price'] ?>€</td>
									<td><?= ($order_product['amount'] * $order_product['price']) ?>€</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<div class="controller">
						<div class="tool mtb-1"> 
							<h5 class="mtb-4 italic">Total (HT & sans frais de livraison) : <?= $total ?>€</h5>
							<a href="index.php?page=user&show=orders"><button class="btn m-mt-2">GO BACK</button></a>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</body>
<?php require 'partials/js.php'; ?>
</html>
