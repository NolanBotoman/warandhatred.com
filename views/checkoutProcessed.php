<!DOCTYPE html>
<html lang="fr">
<?php require 'partials/head.php'; ?>
<body>
	<div class="container">
		<?php require 'partials/navigation.php'; ?>
		<div class="row">
			<?php require 'partials/attachment_checkout.php'; ?>
			<section class="main">
				<?php require 'partials/alert.php'; ?>
				<div class="wrap my-auto">
					<div class="view">
						<h1 class="flex-title reservoir"><div>WAR</div><div>&HATRED</div></h1>
						<?php if($result['answer'] && $error == null): ?>
						<p class="mtb-1">Votre commande War&Hatred (n°<?= $result['order_id'] ?>) a bien été reçue. Nous commencerons à la préparer et à l'expédier au plus vite, n'hésitez pas à faire part de vos impressions sur notre page <a class="underline colorize" href="https://www.instagram.com/warnhatred/" target="_blank">instagram</a></p>
						<div class="table format bg-white p-1">
							<p><a href='index.php?page=user&show=orders'>Vous pouvez dès à présent consulter l'état de votre commande et son avancement depuis votre <span class="colorize underline">compte utilisateur</span>. Nos colis sont habituellement expédiés entre 1 à 3 semaines.</a></p>
						</div>
						<div class="mt-2">
							<a href="index.php">
								<button class="btn m-btn">GO BACK TO HOME</button>
							</a>
						</div>
						<?php else: ?>
						<p class="mtb-1">Il semblerait que quelque chose se soit mal passée, veuillez nous excuser pour le désagrément.</p>
						<div class="table format bg-white p-1">
							<p><a href='https://www.instagram.com/warnhatred/'><?= $error ?></a></p>
						</div>
						<div class="mt-2">
							<a href="index.php">
								<button class="btn m-btn">GO BACK TO HOME</button>
							</a>
							<a href="index.php?page=checkout&show=checkout">
								<button class="btn m-btn ml-1">RETRY</button>
							</a>
						</div>
						<?php endif; ?>
					</div>
				</div>				
			</section>
		</div>
	</div>
</body>
</html>