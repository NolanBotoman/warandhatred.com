<!DOCTYPE html>
<html lang="fr">
<?php require 'partials/head.php'; ?>
<body>
	<div class="container">
		<?php require 'partials/navigation.php'; ?>
		<div class="row">
			<?php require 'partials/attachment.php'; ?>
			<section class="main">
				<?php if(empty($orders)): ?>
				<h4 class="my-auto align-center italic">Il semblerait que vous n'ayez passé aucune commande.</h4>
				<?php else: ?>
				<div class="order">
					<div style="overflow-x:auto;">
						<table class="table stripped hoverable mtb-1">
							<thead>
								<tr>
									<td></td>
									<td><h4 class="italic">ID</h4></td>
									<td><h4 class="italic">ORDER DATE</h4></td>
									<td><h4 class="italic">SHIPPING ADDRESS</h4></td>
									<td><h4 class="italic">TOTAL</h4></td>
								</tr>
							</thead>
							<tbody>
								<?php foreach($orders as $order): ?>
								<tr class="pointer" onclick="window.location='index.php?page=user&show=orders&view=<?= $order['id'] ?>';">
									<a href="index.php?page=user&show=orders&view=<?= $order['id'] ?>"><td><i class="goto"></i></a></button></td>
									<td><?= $order['id'] ?></td>
									<td><?= $order['order_date'] ?></td>
									<td><?= $order['user_address'] ?></td>
									<td><?= $order['order_bill'] += $order['shipping_fees'] ?>€</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
				<?php endif; ?>
			</section>
		</div>
	</div>
</body>
</html>
