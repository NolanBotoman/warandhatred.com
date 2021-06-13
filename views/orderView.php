<!DOCTYPE html>
<html lang="fr">
<?php require 'partials/head.php'; ?>
<body>
	<div class="container">
		<?php require 'partials/navigation.php'; ?>
		<div class="row">
			<?php require 'partials/attachment.php'; ?>
			<section class="main">
				<div class="order">
					<h4 class="mtb-1">Récapitulatif de la commande n°<?= $order['id'] ?></h4>
					<h6 class="mb-1">Nous vous remercions de nous avoir fait confiance. Votre colis War&Hatred est en cours de de traitement, vous pouvez consulter son status depuis cette page.</h6>
					<h6 class="mtb-2">Status de votre commande : <span class="lowercase underline"><?= $order['status'] ?></span>.</h6>
					<h6 class="mb-1">Frais d'expédition : <span class="lowercase underline"><?= $order['shipping_fees'] ?>€</span>.</h6>
					<div style="overflow-x:auto;">
						<table class="table stripped mb-2">
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
							foreach($order_products as $order_product): 
								?>
								<tr>
									<td><?= $order_product['name'] ?></td>
									<td><?= $order_product['amount'] ?></td>
									<td><?= getSize($order_product['size']) ?></td>
									<td><?= $order_product['price'] ?>€</td>
									<td><?= ($order_product['amount'] * $order_product['price']) ?>€</td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<div class="controller">
						<div class="tool mtb-1"> 
							<h3 class="mtb-4 italic">Total (avec frais d'expédition) : <?= $order['order_bill'] += $order['shipping_fees'] ?>€</h3>
							<a href="index.php?page=user&show=orders"><button class="btn m-mt-2">GO BACK</button></a>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</body>
</html>
