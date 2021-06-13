<?php

if (!isset($_SESSION['user']['admin'])) {
    header('Location:../index.php');
    exit;
}