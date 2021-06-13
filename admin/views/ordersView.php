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
					<form action="index.php?controller=orders&action=edit&id=<?= $order['id'] ?>" method="post" enctype="multipart/form-data">
						<h3 class="mb-4">Commande n°<?= $order['id'] ?></h3>
						<div class="mb-4">
							<h5 class="mb-3">Utilisateur</h5>
							<p class="h6"><kbd>Email</kbd></p>
							<p class="h6"><?= htmlspecialchars($order['user_email']) ?>
							<p class="h6"><kbd>Adresse de livraison</kbd></p>
							<p class="h6"><?= htmlspecialchars($order['user_address']) ?></p>
							<p class="h6"><kbd>Commandé le</kbd></p>
							<p class="h6"><?= htmlspecialchars($order['order_date']) ?></p>
						</div>
						<div class="mb-4">
							<label class="h5 mb-3" for="status">Statut</label>
							<select class="form-control" name="status" id="status">
								<?php foreach($all_status as $status): ?>
									<option value="<?= $status; ?>" <?= ($order['status'] == $status) ? "selected" : "" ?>><?= $status; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="mb-4">
							<h5 class="mb-3">Récapitulatif</h5>
							<table class="table table-striped">
								<thead>
									<tr>
										<td>Nom</td>
										<td>Quantité</td>
										<td>Taille</td>
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
										<td><?= getSize($order_product['size']) ?></td>
										<td><?= $order_product['price'] ?>€</td>
										<td><?= ($order_product['amount'] * $order_product['price']) ?>€</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
							<h5 class="muted mt-4">Frais de livraison : <span class="fw-light"><?= ($order['shipping_fees'] == 0) ? 'Aucuns' : $order['shipping_fees'] . '€' ?></span></h5>
							<h5 class="muted mb-3">Total (Livraison non comprise) : <span class="fw-light"><?= $order['order_bill'] ?>€</span></h5>
							<input class="btn btn-outline-dark" type="submit" value="Enregistrer" />
							<a class="text-white text-decoration-none ms-2" href="index.php?controller=orders&action=list">
								<button class="btn btn-dark" type="button">Retour</button>
							</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

