<?php 

require('models/Order.php');

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

			require('views/ordersView.php');

		}
		break;

	default :
		header('Location:index.php?controller=orders&action=list');
		exit;
}