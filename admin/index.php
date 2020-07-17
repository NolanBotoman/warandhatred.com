<?php

session_start();

require ('../helpers.php');

if (!isset($_SESSION['user']['id']) && isset($_SESSION['user']['admin'])) {
    header('Location:../index.php');
    exit;
}

if(isset($_GET['controller']) && isset($_GET['action'])) {

	switch ($_GET['controller']) {
		case 'products' :
            require 'controllers/productsController.php';
            break;

        case 'categories' :
        	require 'controllers/categoriesController.php';
            break;

        case 'sizes' :
            require 'controllers/sizesController.php';
            break;

        case 'orders' :
            require 'controllers/ordersController.php';
            break;

        case 'users' :
            require 'controllers/usersController.php';
            break;
            
        default :
            header('Location:index.php');
            exit;
	}
    
} else {
	require 'controllers/indexController.php';
}

if (isset($_SESSION['messages'])) {
	unset($_SESSION['messages']);	
}

if (isset($_SESSION['old_inputs'])) {
	unset($_SESSION['old_inputs']);	
}
