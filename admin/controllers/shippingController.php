<?php 

require('models/Shipping.php');

switch ($_GET['action']) {

	case 'list' :
		$shipping = getAllShipping();
		require('views/shippingList.php');

		break;

	case 'new' :
		require('views/shippingForm.php');

		break;

	case 'add' :
		if (!is_numeric($_POST['fees']) || empty($_POST['description'])) {

			if (!is_numeric($_POST['fees'])) {
				$_SESSION['messages'][] = buildPanelMessage("Le champ frais d'expédition doit être un nombre !");
				$_SESSION['old_inputs'] = $_POST;

			}

			if (empty($_POST['description'])) {
				$_SESSION['messages'][] = buildPanelMessage("Le champ description est requis !");
			}

			header('Location:index.php?controller=shipping&action=new');
			exit;

		} else {
			$resultAdd = addShipping($_POST);

			$_SESSION['messages'][] = $resultAdd ? buildPanelMessage("Livraison enregistrée !") : buildPanelMessage("Erreur lors de la création de la livraison.");

			header('Location:index.php?controller=shipping&action=list');
			exit;			
		}

	case 'edit' :
		if (!empty($_POST)) {
			if (!is_numeric($_POST['fees']) || empty($_POST['description'])) {

			if (!is_numeric($_POST['fees'])) {
				$_SESSION['messages'][] = buildPanelMessage("Le champ frais d'expédition doit être un nombre !");
				$_SESSION['old_inputs'] = $_POST;

			}

			if (empty($_POST['description'])) {
				$_SESSION['messages'][] = buildPanelMessage("Le champ description est requis !");
			}

			$_SESSION['old_inputs'] = $_POST;

			header('Location:index.php?controller=shipping&action=edit&id=' . $_GET['id']);
			exit;

		} else {
				$result = updateShipping($_GET['id'], $_POST);

				$_SESSION['messages'][] = $result ? buildPanelMessage("Livraison mise à jour !") : buildPanelMessage("Erreur lors de la mise à jour de la livraison.");

				header('Location:index.php?controller=shipping&action=list');
				exit;
			}

		} else {
			if (!isset($_SESSION['old_inputs'])) {
				if (isset($_GET['id'])) {

					$shipping = getShipping($_GET['id']);

					if($shipping == false){
						header('Location:index.php?controller=shipping&action=list');
						exit;
					}

				} else {
					header('Location:index.php?controller=shipping&action=list');
					exit;
				}
			}

			require('views/shippingForm.php');
		}

		break;

	case 'delete' :
		if (isset($_GET['id'])) {
			$result = deleteShipping($_GET['id']);

		} else {
			header('Location:index.php?controller=shipping&action=list');
			exit;
		}

		$_SESSION['messages'][] = $result ? buildPanelMessage("Livraison supprimée !") : buildPanelMessage("Erreur lors de la suppression de la livraison.");

		header('Location:index.php?controller=shipping&action=list');
		exit;

	default:
		header('Location:index.php?controller=shipping&action=list');
		exit;

}