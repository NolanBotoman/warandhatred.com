<?php

require('models/User.php');
require('models/Order.php');
require('models/Product.php');
require('models/Size.php');
require('models/Shipping.php');


if (!isset($_SESSION['user']['id'])) {
	$_SESSION['messages'][] = buildAlert("<a href='index.php?page=login&show=sign_in&from=lastref'>You need to be connected to register your order. Click this message to login into your account or create a new one</a>");

    header('Location:index.php?page=cart&show=cart');
    exit;
}

$user = getUser($_SESSION['user']['id']);

if (checkValidAddress($user)) {

	$_SESSION['messages'][] = buildAlert("We're sorry but before ordering please specify at least a valid address, city and it country.");

    header('Location:index.php?page=cart&show=cart');
    exit;
}

$page = $_GET['page'];

$shipping = $_SESSION['cart']['shipping']['fees'];

$ordertotal = $shipping;

foreach($_SESSION['cart']['products'] as $cart_product) {
	$product = getProduct($cart_product['id']);
	$ordertotal += ($cart_product['amount'] * $product['price']);
}

switch ($_GET['show']) {

	case 'checkout' :
		if (empty($_SESSION['cart']['products'])) {
			
			header('Location:index.php?page=cart&show=cart');
				exit;
		}

		require('views/checkoutCheckout.php');
		break;

	case 'processed' :
		if (!empty($_POST)) {

			if (empty($_SESSION['cart']['products'])) {
				$_SESSION['messages'][] = buildAlert("You cannot order an empty cart.");

				header('Location:index.php?page=cart&show=cart');
					exit;
			}

			if (!isset($_POST['order']) || empty($_POST['order']) 
				&& !isset($_POST['status']) || empty($_POST['status'])) {

				$error = "Nous sommes désolé mais une erreur s'est produite lors de la vérification de votre commande avec nos services. Veuillez réessayer, si l'erreur persiste veuillez nous contacter via notre instagram <span class='colorize underline'>@warnhatred</span>.";
			} else if ($_POST['status'] != "COMPLETED") {
				$error = "Nous sommes désolé mais une erreur s'est produite lors de la tentative d'acceptation de paiement. Veuillez réessayer, si l'erreur persiste veuillez nous contacter via notre instagram <span class='colorize underline'>@warnhatred</span>.";
			} else if ($_POST['order'] != ($ordertotal + $shipping)) {
				$error = "Nous sommes désolé mais une erreur s'est produite lors de la vérification de votre commande avec les informations de paiement Paypal. Veuillez réessayer, si l'erreur persiste veuillez nous contacter via notre instagram <span class='colorize underline'>@warnhatred</span>.";
			} else {
				$result = addOrder($_SESSION['cart']['products'], $_SESSION['user']['id'], ($ordertotal -= $shipping), $shipping);

				if (!$result['answer']) {
					// $error = $result['answer'];
					$error = "Nous sommes désolé mais une erreur s'est produite lors de la création de votre commande suite à la validation de votre paiement, nous vous prions de nous contacter via notre instagram <span class='colorize underline'>@warnhatred</span>.";
				} else {
					unset($_SESSION['messages']);
				}
			}
				
			require('views/checkoutProcessed.php');
			break;

		} else {
			header('Location:index.php?page=checkout&show=checkout');
			exit;
		}

	default:
		header('Location:index.php');
		exit;

}
