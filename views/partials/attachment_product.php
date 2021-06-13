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