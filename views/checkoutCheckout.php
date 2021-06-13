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
						<p class="mtb-1">Pour valider votre commande veuillez cliquer et suivre les instructions de paiement sur l'intégration Paypal. N'hésitez pas à nous contacter en cas de question.</p>
						<div class="table format bg-white p-1">
							<div id="paypal-checkout"></div>
							<p class="ml-1">Nos paiements sont sécurisés et effectués via Paypal, pour plus d'informations concernant leur politique de protection des données <a class="colorize underline" href="https://www.paypal.com/fr/webapps/mpp/ua/privacy-full" target="_blank">cliquez ici</a>.</p>
						</div>
						<form id="orderHandler" method="post" action="/index.php?page=checkout&show=processed">
							<input id="order" type="hidden" name="order" value="<?= $ordertotal ?>">
							<input id="status" type="hidden" name="status">
						</form>
					</div>
				</div>
			</section>
		</div>
	</div>
</body>
<?php require 'partials/paypal.php'; ?>
</html>
