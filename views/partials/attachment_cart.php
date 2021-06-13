<section class="attachment">
    <div class="breadcrumb">
        <h3><a class="colorize" href="index.php">home</a> <span class="spacer"></span> <a class="colorize" href="index.php?page=<?= $page ?>&show=default"><?= $page ?></a></h3>
    </div>
    <div class="expand">
        <nav>
            <ul>
                <?php foreach($links as $link): ?>
                <li class="colorize ptb-1"><a <?= ($_GET['show'] == $link) ? "class='active bold italic'" : '' ?> href="index.php?page=<?= $page ?>&show=<?= $link ?>"><h2><?= str_replace( "_", " ", $link) ?></h2></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <div class="mtb-2">
            <p class="italic">Un doute sur votre commande ? N'hésitez pas à nous contacter via notre <a class="underline colorize" href="https://www.instagram.com/warnhatred/" target="_blank">instagram</a> par message privé, nous vous répondrons dès que possible.</p>
        </div>
    </div>
</section>