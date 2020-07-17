<!DOCTYPE html>
<html lang="fr">
<?php require 'partials/head.php'; ?>
<body>
	<div class="container">
		<?php require 'partials/navigation.php'; ?>
		<div class="row">
			<section class="shop-bg fishing-net" onclick="window.location='index.php?page=shop&show=all';">
				<button class="highlight"><a href="index.php?page=shop&show=all"><h1 class="reservoir">SHOP</h1></a></button>
			</section>
			<section class="archive-bg fishing-net" onclick="window.location='index.php?page=archive&show=archive';">
				<button class="highlight"><a href="index.php?page=archive&show=archive"><h1 class="reservoir">ARCHIVE</h1></a></button>
			</section>
		</div>
	</div>
</body>
</html>
