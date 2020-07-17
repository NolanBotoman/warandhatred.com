<!DOCTYPE html>
<html lang="fr">
<?php require 'partials/head.php'; ?>
<body>
	<div class="container">
		<?php require 'partials/navigation.php'; ?>
		<div class="row">
			<div class="main fishing-net">
				<?php if(empty($archived)): ?>
					<h4 class="mrl-1 align-center italic">Aucune archive n'a été trouvé sur le site. Clique <a href="index.php" class="colorize underline">ici</a> pour retourner à l'accueil</h4>
				<?php else: ?>
				<div class="wrapper archive">

				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</body>
</html>
