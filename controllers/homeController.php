<?php

if (isset($_SESSION['news'])) {
	include 'views/home.php';
} else {
	$_SESSION['news'] = true;
	include 'views/news.php';
}


