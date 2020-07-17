<!DOCTYPE html>
<html lang="fr">
<?php require 'partials/head.php'; ?>
<body>
	<div class="container">
		<?php require 'partials/navigation.php'; ?>
		<div class="row">
			<section class="attachment">
				<div class="breadcrumb">
					<h3><a class="colorize" href="index.php">home</a> <span class="spacer"></span> <a class="colorize" href="index.php?page=<?= $page ?>&show=default"><?= $page ?></a></h3>
				</div>
			    <nav>
			    	<h2 class="shop-heading ptb-1"><?= $product['name'] ?></h2></li>
					<p><?= $product['description'] ?></p>
					<form action="index.php?page=shop&show=view&id=<?= $product['id'] ?>" method="post" enctype="multipart/form-data">
					<div class="shop-heading pt-1 pb-2">
						<div class="size">
							<label for="size">Size</label>
							<select name="size" id="size">
								<?php foreach($sizes as $size): ?>
								<option value="<?= $size['id'] ?>"><?= $size['size'] ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<h1><?= $product['price'] ?>€</h1></div>
					</nav>
					<div>
						<input type="checkbox" id="shop" name="shop" checked />
						<input class="btn" for="shop" type="submit" value="ADD TO CART" />
					</div>
					</form>
			    </nav>
			</section>
			<section class="main">
				<?php if(isset($_SESSION['messages'])): ?>
					<?php foreach($_SESSION['messages'] as $message): ?>
						<?= $message ?>
					<?php endforeach; ?>
				<?php endif; ?>
				<?php if ($product['amount'] <= 0): ?>
				<div class="alert red">
					<p class="italic">SOLD OUT </p>
				</div>
				<?php endif; ?>
				<div class="wrapper cards cards-center">
					<?php for ($i = 0; $i < count(end($product)); $i++): ?>
						<div class="card-large">
							<img class="display" src="<?= end($product)[$i] ?>" alt="<?= $product['name'] . ' ' . $i ?>">
						</div>
					<?php endfor; ?>
				</div>
			</section>
		</div>
	</div>
</body>
<?php require 'partials/js.php'; ?>
</html>
