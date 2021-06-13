<?php

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

        case 'shipping' :
            require 'controllers/shippingController.php';
            break;

        case 'admin' :
            require 'controllers/adminController.php';
            break;
            
        default :
            header('Location:index.php');
            exit;
	}
    
} else {
	require 'controllers/indexController.php';
}