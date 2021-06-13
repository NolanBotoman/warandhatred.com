<?php

require('models/Link.php');
require('models/Order.php');
require('models/Product.php');
require('models/Size.php');
require('models/Shipping.php');

$links = getAttachmentLinks($_GET['page']);
$page = $_GET['page'];

switch ($_GET['show']) {

	case 'cart' :
		$shipping = getAllShipping();

		if (!isset($_SESSION['cart']['shipping'])) {
			$selected_shipping = $shipping[0]['fees'];
		} else {
			$selected_shipping = $_SESSION['cart']['shipping']['fees'];
		}

		$products = array();

		foreach ($_SESSION['cart']['products'] as $cart_product) {

			$product = getProduct($cart_product['id']);

			if($product == false) {
				unset($_SESSION['cart']);

				header('Location:index.php?page=cart&show=cart');
				exit;
			}

			$product['amount'] = $cart_product['amount'];
			$product['size'] = getSize($cart_product['size']);

			if (strlen($product['description']) > 100) {
				$description = str_split($product['description'], 97);
				$product['description'] = $description[0] . "...";
			}

			array_push($products, $product);

		}

		require('views/cartCart.php');
		break;

	case 'shipping' :
		if (isset($_POST)) {

			if (!empty($_POST)) {
				$shipping = getShipping($_POST['location']);
				if ($shipping) {
					$_SESSION['cart']['shipping'] = $shipping;
				}
			}
		}

		header('Location:index.php?page=cart&show=cart');
		exit;

	case 'remove' :
		if (isset($_GET['id'])) {

			for ($i = 0; $i <= count($_SESSION['cart']['products']); $i++) {

				if ($_SESSION['cart']['products'][$i]['id'] == $_GET['id'] && getSize($_SESSION['cart']['products'][$i]['size']) == $_GET['size']) {

					if (!empty($_POST)) {

						$_SESSION['cart']['products'][$i]['amount'] -= 1;
						if ($_SESSION['cart']['products'][$i]['amount'] <= 0) unset($_SESSION['cart']['products'][$i]);

					} else {
						if ($_SESSION['cart']['products'][$i]['amount'] > 1) $_SESSION['cart']['products'][$i]['amount'] -= 1;
					}

				}
			}
		}

		header('Location:index.php?page=cart&show=cart');
		exit;


	case 'add' :
		if (isset($_GET['id'])) {

			for ($i = 0; $i <= count($_SESSION['cart']['products']); $i++) {

				if ($_SESSION['cart']['products'][$i]['id'] == $_GET['id'] && getSize($_SESSION['cart']['products'][$i]['size']) == $_GET['size']) {

					$product = getProduct($_GET['id']);

					if ($_SESSION['cart']['products'][$i]['amount'] >= $product['amount']) {

						$_SESSION['messages'][] = buildAlert("Couldn't add a new item to the cart cause it reached the stock limit.");

					} else {
						$_SESSION['cart']['products'][$i]['amount'] += 1;
					}

				}
			}
		}

		header('Location:index.php?page=cart&show=cart');
		exit;

	default:
		header('Location:index.php?page=cart&show=cart');
		exit;

}
