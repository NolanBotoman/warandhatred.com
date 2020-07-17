<!DOCTYPE html>
<?php require 'partials/head_assets.php'; ?>
<body class="index-body">
	<div class="container-fluid">
		<div class="row">
			<?php require ('partials/navigation.php'); ?>
			<div class="col-9 py-3">
				<?php if(isset($_SESSION['messages'])): ?>
					<?php foreach($_SESSION['messages'] as $message): ?>
						<?= $message ?><br>
					<?php endforeach; ?>
				<?php endif; ?>

				<section class="ml-2">
					<h3>Liste complète des utilisateurs</h3>
					<a href="index.php?controller=users&action=new">Ajouter un nouvelle utilisateur</a><br><br>
					<ul class="list-unstyled">
						<?php foreach($users as $user): ?>
						<section class="pl-4 pr-5 mb-4 border-left d-inline-block">
							<li class="pb-2"><h6><kbd>Utilisateur n°<?=  htmlspecialchars($user['id']) ?></kbd></h6></li>
							<li><h6>Email associé au compte <br><span class="font-italic"><?=  htmlspecialchars($user['email']) ?></span></h6></li>
							<li>
								<a href="index.php?controller=users&action=edit&id=<?= $user['id'] ?>">modifier</a> 
								<a href="index.php?controller=users&action=delete&id=<?= $user['id'] ?>">supprimer</a>
							</li>
						</section>
						<?php endforeach; ?>
					</ul>
				</section>
			</div>
		</div>
	</div>
</body>
<?php require 'partials/js_assets.php'; ?>
</html>

