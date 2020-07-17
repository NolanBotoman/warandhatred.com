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
					<h3>Liste complète des commandes</h3><br>
					<ul class="list-unstyled">
						<?php foreach($orders as $order): ?>
						<section class="pl-4 pr-5 mb-4 border-left d-inline-block">
							<li class="pb-2"><h6><kbd>Commande n°<?=  htmlspecialchars($order['id']) ?></kbd></h6>
							<li><h6>Commandé par <br><span class="font-italic"><?= $order['user_email'] ?></span></h6>
							<?php
							$total = 0;

							foreach ($orders_products as $order_products) {
								if ($order_products['order_id'] == $order['id']) {
									$total += ($order_products['price'] * $order_products['amount']);
								}
							}
							
							?>
							<li class="pb-1"><h6>Total de la commande <br><span class="font-italic"><?= $total ?>€</span></h6></li>
							<li><a href="index.php?controller=orders&action=view&id=<?= $order['id'] ?>">détails de la commande</a></li>
						</section>
						<?php endforeach; ?>
					</ul>
				</section>
			</div>
		</div>
	</div>
</body>
<?php require 'partials/js_assets.php'; ?>
</html>

