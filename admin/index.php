<?php

session_start();

require('admin.php');

require('../helpers.php');
require('router.php');

if (isset($_SESSION['messages'])) {
	unset($_SESSION['messages']);	
}

if (isset($_SESSION['old_inputs'])) {
	unset($_SESSION['old_inputs']);	
}

