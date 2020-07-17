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
					<h3>Commande complète n°<?= $order['id'] ?></h3>
					<br>
					<h5>Informations utilisateur :</h5>
					<ul>
						<li><h6>Email utilisé lors de la commande : <span class="font-italic"><?= htmlspecialchars($order['user_email']) ?></span></h6></li>
						<li><h6>Adresse de livraison : <span class="font-italic"><?= htmlspecialchars($order['user_address']) ?></span></h6></li>
					</ul>
					<br>
					<h5>Récapitulatif commande :</h5>
					<table class="table table-striped">
						<thead>
							<tr>
								<td>Nom</td>
								<td>Quantité</td>
								<td>Prix Unitaire</td>
								<td>Total</td>
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
								<td><?= $order_product['price'] ?>€</td>
								<td><?= ($order_product['amount'] * $order_product['price']) ?>€</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
						<caption>
							Total de la commande (HT & sans frais de livraison) : <?= $total ?>€
						</caption>
					</table>
						<h5 class="muted">Total TTC : <?= $order['order_bill'] ?>€</h5>
				</section>
			</div>
		</div>
	</div>
</body>
<?php require 'partials/js_assets.php'; ?>
</html>

