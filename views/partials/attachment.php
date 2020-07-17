<section class="attachment">
	<div class="breadcrumb">
		<h3><a class="colorize" href="index.php">home</a> <span class="spacer"></span> <a class="colorize" href="index.php?page=<?= $page ?>&show=default"><?= $page ?></a></h3>
	</div>
    <nav>
    	<ul>
    		<?php foreach($links as $link): ?>
			<li class="colorize ptb-1 m-mt-2"><a <?= ($_GET['show'] == $link) ? "class='active bold italic'" : '' ?> href="index.php?page=<?= $page ?>&show=<?= $link ?>"><h2><?= str_replace( "_", " ", $link) ?></h2></a></li>
			<?php endforeach; ?>
    	</ul>
    </nav>
</section>