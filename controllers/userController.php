<?php

require('models/Link.php');
require('models/User.php');
require('models/Order.php');

$links = getAttachmentLinks($_GET['page']);
$page = $_GET['page'];

if (!isset($_SESSION['user']['id'])) {

	header('Location:index.php?page=login&show=sign_in');
	exit;

}

switch ($_GET['show']) {

	case 'orders' :
		if (isset($_GET['view']) && ctype_digit($_GET['view'])) {

			$order = getOrder($_GET['view']);

			if ($order == null) {

				header('Location:index.php?page=user&show=orders');
				exit;

			}

			$order_products = getOrderProducts($order['id']);
			
			$user = getOrderUser($order['id']);
			require('views/orderView.php');
			break;

		} else {
			$orders = getAllOrdersByUser($_SESSION['user']['id']);

			require('views/userOrders.php');
			break;
		}
		
	case 'disconnect' :
		unset($_SESSION['user']);
		header ("Location: $_SERVER[HTTP_REFERER]" );
		exit;

	default:
		if (!empty($_POST)) {

			if (empty($_POST['email']) || empty($_POST['address'])) {

				if (empty($_POST['email'])) {
					$_SESSION['messages'][] = buildAlert("Please enter a valid email address.");
				}

				if (empty($_POST['address'])) {
					$_SESSION['messages'][] = buildAlert("Please enter a valid address.");
				}
				
				$_SESSION['old_inputs'] = $_POST;
				header('Location:index.php?page=user&show=account');
				exit;

			} else if ($_POST['password'] != $_POST['c_password']) {

				$_SESSION['messages'][] = buildAlert("Entered passwords do not match.");
				
				$_SESSION['old_inputs'] = $_POST;
				header('Location:index.php?page=login&show=sign_up');
				exit;

			} else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || !checkEmailHost($_POST['email'])) {

				$_SESSION['messages'][] = buildAlert("Please enter an existing email address.");
				
				$_SESSION['old_inputs'] = $_POST;
				header('Location:index.php?page=login&show=sign_up');
				exit;

			} else {
				
				$result = updateUser($_SESSION['user']['id'], $_POST);
				$_SESSION['messages'][] = $result ? buildAlert("Your account has been updated.") : buildAlert("Error when updating your account.");

				header('Location:index.php?page=user&show=account');
				exit;
			}
		} else {
			$user = getUser($_SESSION['user']['id']);
			require('views/userAccount.php');
		}
		break;

}
