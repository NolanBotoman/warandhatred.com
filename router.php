<?php

if(isset($_GET['page']) && isset($_GET['show'])) {

    switch ($_GET['page']) {

        case 'shop':
            require 'controllers/shopController.php';
            break;

        case 'archive':
            require 'controllers/archiveController.php';
            break;

        case 'cart':
            require 'controllers/cartController.php';
            break;

        case 'user':
            require 'controllers/userController.php';
            break;
        
        case 'login':
            require 'controllers/loginController.php';
            break;

        case 'checkout':
            require 'controllers/checkoutController.php';
            break;

        case 'maintenance':
            require 'controllers/maintenanceController.php';
            break;
        default:
            require 'controllers/homeController.php';
            break;
    }

} else {
    require 'controllers/homeController.php';
}