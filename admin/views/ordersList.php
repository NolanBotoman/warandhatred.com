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
					<h3>Commandes</h3>
					<div class="d-grid g-wrapper-6 gap-4">
					<?php foreach($orders as $order): ?>
						<div>
							<p class="h6 mt-3"><kbd>Commande n°<?=  htmlspecialchars($order['id']) ?></kbd</p>
							<p class="h6">Commandé par <br><span class="fw-light"><?= $order['user_email'] ?></span></p>
							<p class="h6"><h6>Frais de livraison <br><span class="fw-light"><?= ($order['shipping_fees'] == 0) ? 'Aucuns' : $order['shipping_fees'] . '€' ?></span></p>
							<p class="h6"><h6>Total de la commande <br><span class="fw-light"><?= $order['order_bill'] ?>€</span></p>
							<p class="h6 text-white fw-lighter"><span class="px-1 <? switch($order['status']) { case 'Livrée': echo("bg-success"); break; case 'Annulée': echo("bg-danger"); break; case 'En cours de préparation': echo("bg-warning"); break;default: echo("bg-primary"); break;} ?>"><?=  htmlspecialchars($order['status']) ?></span></p>
							<p><a href="index.php?controller=orders&action=view&id=<?= $order['id'] ?>">détails</a></p>
						</div>
					<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

