<!DOCTYPE html>
<html lang="fr">
<?php require 'partials/head.php'; ?>
<body>
	<div class="container">
		<?php require 'partials/navigation.php'; ?>
		<div class="row">
			<div class="main">
			<?php if(empty($archived)): ?>
				<h4 class="my-auto align-center italic">
					Aucune archive n'a été trouvé sur le site. Clique <a href="index.php" class="colorize underline">ici</a> pour retourner à l'accueil.<br>Tu peux aussi consulter les archives tumblr à partir <a href="https://warhatred.tumblr.com/" class="colorize underline" target="_blank">de ce lien</a>
				</h4>
			<?php else: ?>
				<div class="gallery">
                    <div class="box">
                <?php foreach($archived as $archive): ?>
                    <?php for ($i = 0; $i < count(end($archive)); $i++): ?>
                        <div class="jacket">
                            <img src="<?= end($archive)[$i] ?>" alt="<?= $archive['name'] . ' ' . $i?>">
                        </div>
                    <?php endfor; ?>
                <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
			</div>
		</div>
	</div>
</body>
<?php require 'partials/gallery.php'; ?>
</html>
