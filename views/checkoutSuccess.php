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
				<?php if($result['answer']): ?>
					<h4 class="mrl-1 align-center italic"><a href='index.php?page=user&show=orders'>Your payment has been received, War&Hatred thanks you for your confidence. Your order is in preparation click here to access your order(s) summary. (Order ID n°"<?= $result['order_id'] ?>")</a></h4>
				<?php else: ?>
					<h4 class="mrl-1 align-center italic"><a href='https://www.instagram.com/warnhatred/'>We're sorry but an error occured while trying to register your order after received your payment. Please contact us at <span class="colorize underline">@warnhatred</span> on instagram to open a support ticket.</h4>
				<?php endif; ?>
			</section>
		</div>
	</div>
</body>
<?php require 'partials/js.php'; ?>
</html>
