<?php

require('helpers.php');
session_start();

require('maintenance.php');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
    $_SESSION['cart']['products'] = array();
}

require('router.php');

if (isset($_SESSION['messages'])) {
    unset($_SESSION['messages']);   
}

if (isset($_SESSION['old_inputs'])) {
    unset($_SESSION['old_inputs']); 
}