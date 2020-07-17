<header>
  	<nav>
        <input type="checkbox" id="sidebar" name="sidebar">
	  	<ul class="nav">
	  		<li class="normalize"><a href="index.php"><h3 class="colorize reservoir">WAR&HATRED</h3></a></li>
	  		<li><a href="index.php"><img class="brand" src="assets/images/logo.png" alt="" /></a></li>
    		<ul class="normalize">
    			<!-- <li><a href="#"><i class="search"></i></a></li> -->
    			<li><a href="index.php?page=cart&show=cart"><i class="cart"></i></a></li>
                <?= (isset($_SESSION['user']['id'])) ? "<li><a href='index.php?page=user&show=disconnect'><i class='user-alt-slash'></i></a></li>" : "<li><a href='index.php?page=user&show=account'><i class='user'></i></a></li>" ?>
    			<li><label for="sidebar"><i class="bars"></i></label></li>
    		</ul>
	  	</ul>
        <ul class="container sidebar">
            <div class="column">
                <ul>
                    <li><a href="index.php?page=shop&show=all"><h1 class="colorize">SHOP</h1></a></li>
                    <li><a href="index.php?page=archive&show=archive"><h1 class="colorize">ARCHIVE</h1></a></li>
                    <li><a href="index.php?page=user&show=account"><h1 class="colorize">ACCOUNT</h1></a></li>
                    <li><a href="index.php?page=cart&show=cart"><h1 class="colorize">CART</h1></a></li>
                </ul>
                <?php if (isset($_SESSION['user']['id'])): ?>
                <ul>
                    <li class="mtb-2"></li>
                    <li><a href='index.php?page=user&show=disconnect'><h1 class="smoosh">LOGOUT</h1></a></li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user']['admin'])): ?>
                    <li><a href='admin/index.php'><h1 class="smoosh">ADMIN PANEL</h1></a></li>
                </ul>
                <?php endif; ?>
            </div>
        </ul>
	</nav>
</header>