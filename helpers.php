<?php
function dbConnect()
{
    try{
        $db = new PDO('mysql:host=localhost;dbname=warhatred;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception $exception)
    {
        die('Erreur : ' . $exception->getMessage());
    }

    return $db;
}

function buildPanelMessage($message)
{
    return "<div class='alert alert-danger alert-dismissible fade show'>" . $message . "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
}

function buildAlert($message)
{
    return "<div class='alert'>" . $message . "<span class='close' onclick='this.parentElement.remove();'>&times;</span></div>";
}

function buildLinkAlert($message, $arg)
{
    return "<div class='alert'>" . $message . "<span class='close' onclick='this.parentElement.remove();'>&times;</span></div>"; 
}

function checkEmailHost($email)
{
    $email = explode("@", $_POST['email'] . ".");
    
    return checkdnsrr($email[1], "MX");
}

function encryptSecret($string) {
    return password_hash($string, PASSWORD_BCRYPT, array('cost'=>12));
}

function verifySecret($string, $secret) {
    return password_verify($string ,$secret);
}
