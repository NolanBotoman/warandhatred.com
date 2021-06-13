<?php 

require('models/Order.php');
require('models/Size.php');

switch ($_GET['action']) {
	
	case 'list' :
		$orders = getAllOrders();
		$orders_products = getAllOrdersProducts();

		require('views/ordersList.php');
		break;

	case 'view' :
		if (ctype_digit($_GET['id']) && !empty(getOrder($_GET['id']))) {
			$order = getOrder($_GET['id']);
			$order_products = getOrderProducts($order['id']);
			
			$user = getOrderUser($order['id']);

			$all_status = ['En cours de préparation', 'En cours d\'expédition (2 à 4 semaines)', 'Retardée', 'Livrée', 'Annulée'];

			require('views/ordersView.php');

		}
		break;

	case 'edit' :
		if (!empty($_POST)) {
			if (empty($_POST['status'])) {
				$_SESSION['messages'][] = buildPanelMessage("Le champ status est obligatoire !");
			}

			$result = updateOrder($_GET['id'], $_POST);

			$_SESSION['messages'][] = $result ? buildPanelMessage("Commande mise à jour !") : buildPanelMessage("Erreur lors de la mise à jour de la commande.");

			header('Location:index.php?controller=orders&action=list)');
			exit;
		}
		break;


	default :
		header('Location:index.php?controller=orders&action=list');
		exit;
}