<?php

require('models/Link.php');
require('models/User.php');

$links = getAttachmentLinks($_GET['page']);
$page = $_GET['page'];

switch ($_GET['show']) {

	case 'sign_in' :
		if (!empty($_POST)) {
			if (!isset($_SESSION['user']['id'])) {
				if (empty($_POST['email']) || empty($_POST['password'])) {

						if (empty($_POST['email'])) {
							$_SESSION['messages'][] = buildAlert("Please enter a valid email address.");
						}

						if (empty($_POST['password'])) {
						$_SESSION['messages'][] = buildAlert("Please enter a valid password.");
					}
					
					$_SESSION['old_inputs'] = $_POST;
					header('Location:index.php?page=login&show=sign_in');
					exit;

				} else {
					$user_by_email = getUserByEmail($_POST['email']);

					if ($user_by_email != null && verifySecret($_POST['password'], $user_by_email['password'])) {

						$_SESSION['user']['id'] = $user_by_email['id'];
						if ($user_by_email['is_admin']) $_SESSION['user']['admin'] = 1;
						$_SESSION['messages'][] = buildAlert("You have successfully logged in.");

						header('Location:index.php');
						exit;

					} else {
						$_SESSION['messages'][] = buildAlert("Error logging into your account. Please verify your login informations.");

						$_SESSION['old_inputs'] = $_POST;
						header('Location:index.php?page=login&show=sign_in');
						exit;

					}	
				}
			} else {
				$_SESSION['messages'][] = buildAlert("You're already connected.");

				header ("Location: $_SERVER[HTTP_REFERER]" );
				exit;
			}

		} else {
			require('views/loginSign_In.php');
		}
		break;

	case 'sign_up' :
		if (!empty($_POST)) {
				if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['address']) || empty($_POST['c_password']) || empty($_POST['password'])) {

					if (empty($_POST['email'])) {
						$_SESSION['messages'][] = buildAlert("Please enter an email address.");
					}

					if (empty($_POST['firstname'])) {
						$_SESSION['messages'][] = buildAlert("Please enter a first name.");
					}

					if (empty($_POST['lastname'])) {
						$_SESSION['messages'][] = buildAlert("Please enter a last name.");
					}

					if (empty($_POST['address'])) {
						$_SESSION['messages'][] = buildAlert("Please enter an address.");
					}

					if (empty($_POST['password'])) {
						$_SESSION['messages'][] = buildAlert("Please enter a password.");
					}

					if (empty($_POST['c_password'])) {
						$_SESSION['messages'][] = buildAlert("You did not enter a confirmation password.");
					}
					
					$_SESSION['old_inputs'] = $_POST;
					header('Location:index.php?page=login&show=sign_up');
					exit;

				} else if ($_POST['password'] != $_POST['c_password']) {

					$_SESSION['messages'][] = buildAlert("Entered passwords do not match.");
					
					$_SESSION['old_inputs'] = $_POST;
					header('Location:index.php?page=login&show=sign_up');
					exit;

				} else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || !checkEmailHost($_POST['email'])) {

					$_SESSION['messages'][] = buildAlert("Please enter an existing email address.");
					
					$_SESSION['old_inputs'] = $_POST;
					header('Location:index.php?page=login&show=sign_up');
					exit;

				} else {
					$user_by_email = getUserByEmail($_POST['email']);

					if ($user_by_email == null) {

						$result = createUser($_POST);

						$user_by_email = getUserByEmail($_POST['email']);
						$_SESSION['user']['id'] = $user_by_email['id'];
						
						$_SESSION['messages'][] = $result ? buildAlert("You successfully created a new account and logged into it.") : buildAlert("Error while trying to create a new account.");

						header('Location:index.php');
						exit;

					} else {
						$_SESSION['messages'][] = buildAlert("Error while trying to create a new account. This email address is already taken.");

						$_SESSION['old_inputs'] = $_POST;
						header('Location:index.php?page=login&show=sign_up');
						exit;

					}	
				}

			} else {
				require('views/loginSign_Up.php');
			}
			break;

	default:
		header('Location:index.php?page=login&show=sign_in');
		exit;

}
