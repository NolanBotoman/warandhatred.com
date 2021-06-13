<?php

require('models/Product.php');
require('models/Category.php');
$page = $_GET['page'];
$links = array();

$categories = getAllCategories();
array_push($links, "all");
foreach ($categories as $category) array_push($links, strtolower($category['name']));
			
switch ($_GET['show']) {

	case 'view' :
		if (!empty($_POST)) {

			$product = getProduct($_GET['id']);

			if ($product['amount'] > 0) {

				for ($i = 0; ; $i++) {

					if ($_SESSION['cart']['products'][$i]['amount'] >= $product['amount']) {
						
						$_SESSION['messages'][] = buildAlert("This product is no longer available for shipping (out of stock).");

						header('Location:index.php?page=shop&show=view&id=' . $_GET['id']);
						exit;

					}

					if ($_GET['id'] == $_SESSION['cart']['products'][$i]['id'] && $_SESSION['cart']['products'][$i]['size'] == $_POST['size']) {

						$_SESSION['cart']['products'][$i]['amount'] += 1;

						$_SESSION['messages'][] = buildAlert("You successfully added this product to your cart.");

						header('Location:index.php?page=shop&show=view&id=' . $_GET['id']);
						exit;

					} else if ($i >= count($_SESSION['cart']) && $_SESSION['cart']['products'][$i][$_GET['id']] == null) {

						$new_product = array();
						$new_product['amount'] = 1;
						$new_product['size'] = $_POST['size'];
						$new_product['id'] = $_GET['id'];

						array_push($_SESSION['cart']['products'], $new_product);
						$_SESSION['messages'][] = buildAlert("You successfully added this product to your cart.");

						header('Location:index.php?page=shop&show=view&id=' . $_GET['id']);
						exit;

					}

				}

				$_SESSION['messages'][] = buildAlert("You successfully added this product to your cart.");

			} 

			$_SESSION['messages'][] = buildAlert("This product ran out of stock and is no longer available for sale.");

			header('Location:index.php?page=shop&show=view&id=' . $_GET['id']);
			exit;

		} else {
			if (isset($_GET['id'])) {

				$product = getProduct($_GET['id']);
				$sizes = getProductSizes($product['id']);

				if($product == false){
					header('Location:index.php?page=shop&show=all');
					exit;
				}

			} else {
				header('Location:index.php?page=shop&show=all');
				exit;
			}
		}

		require('views/shopView.php');
		break;

	case 'all' :
		$products = getAllProducts();
		
		require('views/shopCategories.php');
		break;

	default:
		for ($i = 0; ; $i++) {

			if (strtolower($categories[$i]['name']) == $_GET['show']) {
				$products = getAllProductsByCategory($categories[$i]['id']);

				require('views/shopCategories.php');
				break;
			}
			if (count($categories) == $i) {
				header('Location:index.php?page=shop&show=all');
				exit;
			}
			
		}	
}
