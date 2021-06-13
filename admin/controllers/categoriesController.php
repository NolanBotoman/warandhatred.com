<?php 

require('models/Category.php');

switch ($_GET['action']) {
	
	case 'list' :
		$categories = getAllCategories();
		require('views/categoriesList.php');
		break;

	case 'new' :
		require('views/categoriesForm.php');
		break;

	case 'add' :
		if (empty($_POST['name'])) {

			$_SESSION['messages'][] = buildPanelMessage("Le champ nom est obligatoire !");
			
			$_SESSION['old_inputs'] = $_POST;
			header('Location:index.php?controller=categories&action=new');
			exit;

		} else {
			$_POST['is_buyable'] = (empty($_POST['is_buyable'])) ? 0 : 1;

			$resultAdd = addCategory($_POST);
			
			$_SESSION['messages'][] = $resultAdd ? buildPanelMessage("Catégorie enregistrée !") : buildPanelMessage("Erreur lors de la création de la catégorie.");
			
			header('Location:index.php?controller=categories&action=list');
			exit;
		}

	case 'edit' :
		if (!empty($_POST)) {

			if (empty($_POST['name'])) {

				$_SESSION['messages'][] = buildPanelMessage("Le champ nom est obligatoire !");
		
				$_SESSION['old_inputs'] = $_POST;
				header('Location:index.php?controller=categories&action=edit&id=' . $_GET['id']);
				exit;

			} else {
				$_POST['is_buyable'] = (empty($_POST['is_buyable'])) ? 0 : 1;

				$result = updateCategory($_GET['id'], $_POST);
				
				$_SESSION['messages'][] = $result ? buildPanelMessage("Catégorie mise à jour !") : buildPanelMessage("Erreur lors de la mise à jour de la catégorie.");
				header('Location:index.php?controller=categories&action=list');
				exit;
			}

		} else {

			if (!isset($_SESSION['old_inputs'])) {

				if (isset($_GET['id'])) {

					$category = getCategory($_GET['id']);

					if($category == false){
						header('Location:index.php?controller=categories&action=list');
						exit;
					}

				} else {
					header('Location:index.php?controller=categories&action=list');
					exit;
				}
			}

			require('views/categoriesForm.php');
		}
		break;

	case 'delete' :
		if (isset($_GET['id'])) {

		$result = deleteCategory($_GET['id']);

		} else {
			header('Location:index.php?controller=categories&action=list');
			exit;
		}

		$_SESSION['messages'][] = $result ? buildPanelMessage("Catégorie supprimée !") : buildPanelMessage("Erreur lors de la suppression de la catégorie.");
		
		header('Location:index.php?controller=categories&action=list');
		exit;

	default:
		header('Location:index.php?controller=categories&action=list');
		exit;
}