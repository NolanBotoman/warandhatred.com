<?php

require('models/Link.php');
require('models/Order.php');
require('models/Product.php');
require('models/Size.php');

$links = getAttachmentLinks($_GET['page']);
$page = $_GET['page'];

switch ($_GET['show']) {

	case 'cart' :
		$products = array();

		foreach ($_SESSION['cart'] as $cart_product) {

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

	case 'remove' :
		if (isset($_GET['id'])) {

			for ($i = 0; $i <= count($_SESSION['cart']); $i++) {

				if ($_SESSION['cart'][$i]['id'] == $_GET['id'] && $_SESSION['cart'][$i]['size'] == $_GET['size']) {

					if (!empty($_POST)) {
					
						$_SESSION['cart'][$i]['amount'] -= 1;
						if ($_SESSION['cart'][$i]['amount'] <= 0) unset($_SESSION['cart'][$i]);

					} else {
						if ($_SESSION['cart'][$i]['amount'] > 1) $_SESSION['cart'][$i]['amount'] -= 1;
					}

				}
			}
		}

		header('Location:index.php?page=cart&show=cart');
		exit;


	case 'add' :
		if (isset($_GET['id'])) {

			for ($i = 0; $i <= count($_SESSION['cart']); $i++) {

				if ($_SESSION['cart'][$i]['id'] == $_GET['id'] && $_SESSION['cart'][$i]['size'] == $_GET['size']) {

					$product = getProduct($_GET['id']);

					if ($_SESSION['cart'][$i]['amount'] >= $product['amount']) {

						$_SESSION['messages'][] = buildAlert("You cannot add this item again because there is not enough stock.");

					} else {
						$_SESSION['cart'][$i]['amount'] += 1;
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
