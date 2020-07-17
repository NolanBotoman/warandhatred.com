<?php

if (!isset($_SESSION['user']['id'])) {
	$_SESSION['messages'][] = buildAlert("<a href='index.php?page=login&show=sign_in&from=lastref'>You need to be connected to register your order. Click this message to login into your account or create a new one</a>");

    header('Location:index.php?page=cart&show=cart');
    exit;
}

require('models/Order.php');
require('models/Product.php');
require('models/Size.php');

$page = $_GET['page'];

switch ($_GET['show']) {

	case 'checkout' :
		if (!empty($_POST)) {

			if (isset($_POST['bill']) && !empty($_POST['bill'])) {

				if (empty($_SESSION['cart'])) {
					$_SESSION['messages'][] = buildAlert("You cannot order an empty cart.");

					header('Location:index.php?page=cart&show=cart');
					exit;
				}

				$ordertotal = 0;
				foreach($_SESSION['cart'] as $cart_product) {
					$product = getProduct($cart_product['id']);
					$ordertotal += ($cart_product['amount'] * $product['price']);
				}

				// SHIPPING COSTS TEMP
				$shipping = ($ordertotal > 50) ? '0' : '5';
				$ordertotal += $shipping;

				if ($_POST['bill'] != $ordertotal) {
					$_SESSION['messages'][] = buildAlert("We're sorry but an error as occured while trying to create a payment intent.");
						
					header('Location:index.php?page=cart&show=cart');
					exit;
				}

				require_once('vendor/autoload.php');
				

				\Stripe\Stripe::setApiKey('SECRET_KEY');

				$intent = \Stripe\PaymentIntent::create([
			        'amount' => $_POST['bill']*100,
			        'currency' => 'eur',
			    ]);

			   	require('views/checkoutCheckout.php');
				break;

			} else if (!empty($_POST['result'])) {

				$ordertotal = 0;
				foreach($_SESSION['cart'] as $cart_product) {
					$product = getProduct($cart_product['id']);
					$ordertotal += ($cart_product['amount'] * $product['price']);
				}

				// SHIPPING COSTS TEMP
				$shipping = ($ordertotal > 50) ? '0' : '5';
				$ordertotal += $shipping;

				$result = addOrder($_SESSION['cart'], $_SESSION['user']['id'], $ordertotal);

				if($result['answer']) {
					unset($_SESSION['cart']);
				}

				require('views/checkoutSuccess.php');
				break;

			}

			header('Location:index.php?page=cart&show=checkout');
			exit;

		}
		
		header('Location:index.php?page=cart&show=cart');
		exit;

	default:
		header('Location:index.php');
		exit;

}
