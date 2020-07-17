<!DOCTYPE html>
<html lang="fr">
<?php require 'partials/head.php'; ?>
<body>
	<div class="container">
		<?php require 'partials/navigation.php'; ?>
		<div class="row">
			<?php require 'partials/attachment_checkout.php'; ?>
			<section class="main">
				<?php if(isset($_SESSION['messages'])): ?>
					<?php foreach($_SESSION['messages'] as $message): ?>
						<?= $message ?>
					<?php endforeach; ?>
				<?php endif; ?>
				<form class="form" method="post">
				    <div id="errors"></div>
				    <div class="group mtb-1">
				    	<input class="control mt-1" id="cardholder-name" type="text" placeholder="Card Owner">
					</div>
					<div class="group mtb-1">
				   	 	<div class="control mt-1" id="card-element"></div>
					</div>
				    <button class="btn btn-large" id="card-button" type="button" data-secret="<?= $intent['client_secret'] ?>">Proceed Checkout</button>
				    <p class="italic muted">Nos paiements sont sécurisés et effectués via Stripe, pour plus d'informations concernant la politique de protection des données <a class="colorize underline" href="https://stripe.com/docs/security/stripe" target="_blank">cliquez ici</a></p>
				</form>			
				<form action="index.php?page=checkout&show=checkout" method="post" id="submit">
					<input id="result" name="result" value="" />
				</form>
			</section>
		</div>
	</div>
</body>
<script src="https://js.stripe.com/v3/"></script>
<script src="assets/js/stripe_internal.js"></script>
</html>
