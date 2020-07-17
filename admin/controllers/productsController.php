<?php 

require('models/Product.php');
require('models/Category.php');
require('models/Size.php');

switch ($_GET['action']) {
	
	case 'list' :
		$products = getAllProducts();

		$products_categories = getAllProductsCategories();
		$categories = getAllCategories();

		$products_sizes = getAllProductsSizes();
		$sizes = getAllSizes();

		require('views/productsList.php');
		break;

	case 'new' :
		$categories = getAllCategories();
		$sizes = getAllSizes();

		require('views/productsForm.php');
		break;

	case 'add' :
		foreach($_FILES['images']['name'] as $image) if(empty($image)) $_FILES['images'] = "";

		if (empty($_POST['name']) || empty($_POST['description']) || empty($_POST['price']) || empty($_POST['amount']) && !is_numeric($_POST['amount']) || empty($_FILES['images'])) {

			if (empty($_POST['name'])) {
				$_SESSION['messages'][] = buildPanelMessage("Le champ nom est obligatoire !");
			}

			if (empty($_POST['description'])) {
				$_SESSION['messages'][] = buildPanelMessage("Le champ description est obligatoire !");
			}

			if (empty($_POST['price'])) {
				$_SESSION['messages'][] = buildPanelMessage("Le champ prix est obligatoire !");
			}

			if (empty($_POST['amount']) && !is_numeric($_POST['amount'])) {
				$_SESSION['messages'][] = buildPanelMessage("Le champ quantité est obligatoire !");
			}

			if (empty($_FILES['images'])) {
				$_SESSION['messages'][] = buildPanelMessage("Vous n'avez pas sélectionné d'image(s) !");
			} 
			
			$_SESSION['old_inputs'] = $_POST;
			header('Location:index.php?controller=products&action=new');
			exit;

		} else if (strlen($_POST['description']) > 255) {

			$_SESSION['messages'][] = buildPanelMessage("Le champ description contient trop de caractères !");
			$_SESSION['old_inputs'] = $_POST;
			header('Location:index.php?controller=products&action=new');
			exit;

		} else {

			foreach ($_FILES['images']['size'] as $size) {
				if ($size > 524288) {
		 			$_SESSION['messages'][] = buildPanelMessage("Vous ne pouvez pas télécharger des images dépassant 500 Ko.");
					$_SESSION['old_inputs'] = $_POST;
					header('Location:index.php?controller=products&action=new');
					exit;
				}
	 		}

			foreach (array_keys($_POST['categories_id'], null) as $key) unset($_POST['categories_id'][$key]);
			foreach (array_keys($_POST['sizes_id'], null) as $key) unset($_POST['sizes_id'][$key]);

			$_POST['is_hidden'] = (empty($_POST['is_hidden'])) ? null : 1;
			$_POST['is_archived'] = (empty($_POST['is_archived'])) ? null : 1;

			$resultAdd = addProduct($_POST);
			
			$_SESSION['messages'][] = $resultAdd ? buildPanelMessage("Produit enregistré !") : buildPanelMessage("Erreur lors de la création du produit.");
			
			header('Location:index.php?controller=products&action=list');
			exit;
		}

	case 'edit' :
		if (!empty($_POST)) {

			foreach($_FILES['images']['name'] as $image) if(empty($image)) $_FILES['images'] = "";

			if (empty($_POST['name']) || empty($_POST['description']) || empty($_POST['price']) || empty($_POST['amount']) && !is_numeric($_POST['amount']) || empty($_POST['sizes_id'])) {

				if (empty($_POST['name'])) {
					$_SESSION['messages'][] = buildPanelMessage("Le champ nom est obligatoire !");
				}

				if (empty($_POST['description'])) {
					$_SESSION['messages'][] = buildPanelMessage("Le champ description est obligatoire !");
				}

				if (empty($_POST['price'])) {
					$_SESSION['messages'][] = buildPanelMessage("Le champ prix est obligatoire !");
				}

				if (empty($_POST['sizes_id'])) {
					$_SESSION['messages'][] = buildPanelMessage("Le champ taille est obligatoire !");
				}


				if (empty($_POST['amount'])) {
					$_SESSION['messages'][] = buildPanelMessage("Le champ quantité est obligatoire !");
				}

				$_SESSION['old_inputs'] = $_POST;
				header('Location:index.php?controller=products&action=edit&id=' . $_GET['id']);
				exit;

			} else {

				foreach ($_FILES['images']['size'] as $size) {
					if ($size > 524288) {
			 			$_SESSION['messages'][] = buildPanelMessage("Vous ne pouvez pas télécharger des images dépassant 500 Ko.");
						$_SESSION['old_inputs'] = $_POST;
						header('Location:index.php?controller=products&action=edit&id=' . $_GET['id']);
						exit;
					}
	 			}

				foreach (array_keys($_POST['categories_id'], null) as $key) unset($_POST['categories_id'][$key]);
				foreach (array_keys($_POST['sizes_id'], null) as $key) unset($_POST['sizes_id'][$key]);

				if ($_POST['categories_id'] == "") $_POST['categories_id'] = null;

				$_POST['is_hidden'] = (empty($_POST['is_hidden'])) ? null : 1;

				$_POST['is_archived'] = (empty($_POST['is_archived'])) ? null : 1;

				$result = updateProduct($_GET['id'], $_POST);
				$_SESSION['messages'][] = $result ? buildPanelMessage("Produit mis à jour !") : buildPanelMessage("Erreur lors de la mise à jour du produit.");

				header('Location:index.php?controller=products&action=list');
				exit;
			}

		} else {

			if (!isset($_SESSION['old_inputs'])) {

				if (isset($_GET['id'])) {

					$product = getProduct($_GET['id']);

					if($product == false){
						header('Location:index.php?controller=products&action=list');
						exit;
					}

				} else {
					header('Location:index.php?controller=products&action=list');
					exit;
				}
			}

			$categories = getAllCategories();
			$sizes = getAllSizes();

			$products_categories = getAllProductsCategories();
			$products_sizes = getAllProductsSizes();

			require('views/productsForm.php');
		}
		break;

	case 'delete' :
		if(isset($_GET['id'])){

			$result = deleteProduct($_GET['id']);

		} else {
			header('Location:index.php?controller=products&action=list');
			exit;
		}

		$_SESSION['messages'][] = $result ? buildPanelMessage("Produit supprimé !") : buildPanelMessage("Erreur lors de la suppression du produit.");
		
		header('Location:index.php?controller=products&action=list');
		exit;

	default:
		header('Location:index.php?controller=products&action=list');
		exit;
}