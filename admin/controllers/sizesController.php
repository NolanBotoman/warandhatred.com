<?php 

require('models/Size.php');

switch ($_GET['action']) {
	
	case 'list' :
		$sizes = getAllSizes();
		require('views/sizesList.php');
		break;

	case 'new' :
		require('views/sizesForm.php');
		break;

	case 'add' :
		if (empty($_POST['size'])) {

			$_SESSION['messages'][] = buildPanelMessage("Le champ taille est obligatoire !");
			
			$_SESSION['old_inputs'] = $_POST;
			header('Location:index.php?controller=sizes&action=new');
			exit;

		} else {
			$resultAdd = addSize($_POST);
			
			$_SESSION['messages'][] = $resultAdd ? buildPanelMessage("Taille enregistrée !") : buildPanelMessage("Erreur lors de la création de la taille.");
			
			header('Location:index.php?controller=sizes&action=list');
			exit;
		}

	case 'edit' :
		if (!empty($_POST)) {

			if (empty($_POST['size'])) {

				$_SESSION['messages'][] = buildPanelMessage("Le champ taille est obligatoire !");
		
				$_SESSION['old_inputs'] = $_POST;
				header('Location:index.php?controller=sizes&action=edit&id=' . $_GET['id']);
				exit;

			} else {
				$result = updateSize($_GET['id'], $_POST);
				$_SESSION['messages'][] = $result ? buildPanelMessage("Taille mise à jour !") : buildPanelMessage("Erreur lors de la mise à jour de la taille.");
				header('Location:index.php?controller=sizes&action=list');
				exit;
			}

		} else {

			if (!isset($_SESSION['old_inputs'])) {

				if (isset($_GET['id'])) {

					$size = getSize($_GET['id']);

					if($size == false){
						header('Location:index.php?controller=sizes&action=list');
						exit;
					}

				} else {
					header('Location:index.php?controller=sizes&action=list');
					exit;
				}
			}

			require('views/sizesForm.php');
		}
		break;

	case 'delete' :
		if (isset($_GET['id'])) {

		$result = deleteSize($_GET['id']);

		} else {
			header('Location:index.php?controller=sizes&action=list');
			exit;
		}

		$_SESSION['messages'][] = $result ? buildPanelMessage("Taille supprimée !") : buildPanelMessage("Erreur lors de la suppression de la taille.");
		
		header('Location:index.php?controller=sizes&action=list');
		exit;

	default:
		header('Location:index.php?controller=sizes&action=list');
		exit;
}