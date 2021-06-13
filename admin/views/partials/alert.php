<?php if(isset($_SESSION['messages'])): ?>
	<?php foreach($_SESSION['messages'] as $message): ?>
		<?= $message ?>
	<?php endforeach; ?>
<?php endif; ?>