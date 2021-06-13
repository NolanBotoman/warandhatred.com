<?php

require('admin/models/Admin.php');

$maintenance = getMaintenanceMode();

if ($maintenance && $_GET['page'] != 'maintenance' && $_GET['page'] != 'login' && !isset($_SESSION['user']['admin'])) {
	header('Location: /index.php?page=maintenance&show=maintenance');
	exit;
} 

if ((!$maintenance && $_GET['page'] == 'maintenance') || (isset($_SESSION['user']['admin']) && $_GET['page'] == 'maintenance')) {
	if ($_SESSION['user']['admin']) {
		$_SESSION['messages'] = "Attention, le site est actuellement en mode maintenance.";
	}

	header('Location: /index.php');
	exit;
}