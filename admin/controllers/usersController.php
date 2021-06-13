<?php 

require('models/User.php');

switch ($_GET['action']) {
	
	case 'list' : 
		$users = getAllUsers();
		require('views/usersList.php');
		break;

	case 'new' :
		require('views/usersForm.php');
		break;

	case 'add' :
		if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['password'])) {

			if (empty($_POST['firstname'])) {
				$_SESSION['messages'][] = buildPanelMessage("Le champ prénom est obligatoire !");
			}

			if (empty($_POST['lastname'])) {
				$_SESSION['messages'][] = buildPanelMessage("Le champ nom est obligatoire !");
			}

			if (empty($_POST['email'])) {
				$_SESSION['messages'][] = buildPanelMessage("Le champ email est obligatoire !");
			}

			if (empty($_POST['password'])) {
				$_SESSION['messages'][] = buildPanelMessage("Le champ mot de passe est obligatoire !");
			}
			
			$_SESSION['old_inputs'] = $_POST;
			header('Location:index.php?controller=users&action=new');
			exit;

		} else {
			$_POST['is_admin'] = (empty($_POST['is_admin'])) ? null : 1;

			$resultAdd = addUser($_POST);
			
			$_SESSION['messages'][] = $resultAdd ? buildPanelMessage("Utilisateur enregistré !") : buildPanelMessage("Erreur lors de la création de l'utilisateur.");
			
			header('Location:index.php?controller=users&action=list');
			exit;
		}

	case 'edit' :
		if (!empty($_POST)) {

			if (empty($_POST['email'])) {

				if (empty($_POST['email'])) {
					$_SESSION['messages'][] = buildPanelMessage("Le champ email est obligatoire !");
				}
				
				$_SESSION['old_inputs'] = $_POST;
				header('Location:index.php?controller=users&action=edit&id=' . $_GET['id']);
				exit;

			} else {

				$_POST['is_admin'] = (empty($_POST['is_admin'])) ? null : 1;
				
				$result = updateUser($_GET['id'], $_POST);
				$_SESSION['messages'][] = $result ? buildPanelMessage("Utilisateur mis à jour !") : buildPanelMessage("Erreur lors de la mise à jour de l'utilisateur.");

				header('Location:index.php?controller=users&action=list');
				exit;
			}
		} else {

			if (!isset($_SESSION['old_inputs'])) {

				if (isset($_GET['id']) ){

					$user = getUser($_GET['id']);

					if ($user == false) {
						header('Location:index.php?controller=users&action=list');
						exit;
					}

				} else {
					header('Location:index.php?controller=users&action=list');
					exit;
				}
			}
			
			require('views/usersForm.php');
		}
		break;

	case 'delete' :
		if(isset($_GET['id'])){

			$result = deleteUser($_GET['id']);

		} else {
			header('Location:index.php?controller=users&action=list');
			exit;
		}

		$_SESSION['messages'][] = $result ? buildPanelMessage("Utilisateur supprimé !") : buildPanelMessage("Erreur lors de la suppression de l'utilisateur.");
		
		header('Location:index.php?controller=users&action=list');
		exit;

	case 'takeover' :
		if(!empty($_POST)){

			$user = getUser($_POST['id']);

			if ($user == false) {
				header('Location:index.php?controller=users&action=list');
				exit;
			}

			unset($_SESSION['user']);

			$_SESSION['user']['id'] = $user['id'];
			if ($user['is_admin']) $_SESSION['user']['admin'] = 1;

			header('Location:/');
			exit;

		} else {
			header('Location:index.php?controller=users&action=list');
			exit;
		}

	default:
		header('Location:index.php?controller=users&action=list');
		exit;
}