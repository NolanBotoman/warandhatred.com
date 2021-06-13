<?php 

require('models/Admin.php');

switch ($_GET['action']) {
	
	case 'admin' : 
		$modes = getAllAdmin();

		require('views/admin.php');
		break;

	case 'edit' :
		if (!empty($_POST)) {
			$_POST['status'] = (empty($_POST['status'])) ? 0 : 1;

			switch($_POST['name']) {

				case 'maintenance':
					$result = switchMaintenance($_POST['status']);
					break;
			}

			header('Location:index.php?controller=admin&action=admin');
			exit;
		} else {
			header('Location:index.php?controller=admin&action=admin');
			exit;
		}

		break;

	default:
		header('Location:index.php?controller=admin&action=admin');
		exit;
}