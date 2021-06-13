<!DOCTYPE html>
<html lang="fr">
<?php require 'partials/head.php'; ?>
<body>
	<div class="container">
		<?php require 'partials/navigation.php'; ?>
		<div class="row">
			<?php require 'partials/attachment_cart.php'; ?>
			<section class="main">
				<?php require 'partials/alert.php'; ?>
			<?php if(empty($products)): ?>
				<h4 class="my-auto align-center italic">Vous ne possédez actuellement aucun article dans votre panier.</h4>
			<?php else: ?>
				<div class="cart">
					<div class="view justify-content-end">
						<div class="mtb-1" style="overflow-x:auto; width: 100%">
							<table class="table stripped">
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
											<form action="index.php?page=cart&show=remove&id=<?= $product['id'] ?>&size=<?= $product['size'] ?>" method="post" enctype="multipart/form-data">
												<input type="checkbox" id="delete" name="delete" checked />
												<button for="delete" type="submit"><i class="cross"></i></button>
											</form>
										</td>
										<td class="one-line"><?= $product['name'] ?></td>
										<td><?= $product['description'] ?></td>
										<td>
											<a class="controller" href="index.php?page=cart&show=remove&id=<?= $product['id'] ?>&size=<?= $product['size'] ?>"><i class="minus"></i></a>
											<?= $product['amount'] ?>
											<a class="controller" href="index.php?page=cart&show=add&id=<?= $product['id'] ?>&size=<?= $product['size'] ?>"><i class="plus"></i></a>
										</td>
										<td><?= $product['size'] ?></td>
										<td><?= $product['price'] ?>€</td>
										<td><?= $product['amount'] * $product['price'] ?>€</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
						<div class="checkout mb-1">
							<div class="shipping">
								<h3 class="mtb-2">TOTAL <?= $total ?>€</h3>
								<hr>
								<form class="content mtb-4" action="index.php?page=cart&show=shipping" method="post" enctype="multipart/form-data">
									<p class=one-line>Delivery location</p>
									<select class="cart-select mt-c colorize" name="location" onchange="this.form.submit()">
									<?php foreach($shipping as $_shipping): ?>
									    <option value="<?= $_shipping['id'] ?>" <?= ($_shipping['fees'] == $selected_shipping) ? 'selected' : ''?>><?= $_shipping['description'] ?></option>
									<?php endforeach; ?>
									</select>
								</form>
								<div class="content mtb-4">
									<p>Shipping costs</p>
									<p class="mt-c"><?= ($selected_shipping > 0) ? '+ ' . number_format($selected_shipping, 2, ',', ' ') . '€' : 'FREE' ?></p>
								</div>
								<?php $total = ($selected_shipping > 0) ? $total + $selected_shipping : $total ?>
								<h2 class="mt-2 mb-1 m-mtb-2">TOTAL <?=  $total ?>€</h2>
							</div>
							<div class="tool m-mb-1">
								<a class="w-100" href="index.php?page=shop&show=all">
									<button class="btn m-btn">GO BACK TO SHOP</button>
								</a>
								<a class="w-100" href="index.php?page=checkout&show=checkout">
									<button class="btn m-btn ml-1">CHECKOUT</button>
								</a>
							</div>
						</div>
					</div>
			<?php endif; ?>
				</div>
			</section>
		</div>
	</div>
</body>
</html>
