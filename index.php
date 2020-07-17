<?php

session_start();

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = array();

require ('helpers.php');

if(isset($_GET['page']) && isset($_GET['show'])) {

    switch ($_GET['page']) {

        case 'shop':
            require 'controllers/shopController.php';
            break;

        case 'archive':
            require 'controllers/archiveController.php';
            break;

        // case 'misc':
        //     require 'controllers/miscController.php';
        //     break;

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

        default:
            require 'controllers/homeController.php';
            break;
    }

} else {
    require 'controllers/homeController.php';
}

if (isset($_SESSION['messages'])) {
    unset($_SESSION['messages']);   
}

if (isset($_SESSION['old_inputs'])) {
    unset($_SESSION['old_inputs']); 
}