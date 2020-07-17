<?php

require('models/Product.php');

switch ($_GET['show']) {

	case 'archive' :
		$archived = getAllArchived();

		include 'views/archive.php';
		break;

	default:
		header('Location:index.php?page=archive&show=archive');
		exit;

}



