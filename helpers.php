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
    switch ($arg) {
        case "account_orders":
            return "<div class='alert'>" . $message . "<a class='underline colorize' href=
            'index.php?page=account&show=orders'>Click here to access your previous orders</a><span class='close' onclick='this.parentElement.remove();'>&times;</span></div>";
            break;

        case "login_signin":    
            return "<div class='alert'>" . $message . "<a class='underline colorize' href=
            'index.php?page=login&show=signin&from=lastref'>Click here to connect</a><span class='close' onclick='this.parentElement.remove();'>&times;</span></div>";
            break;

        default:
            return "<div class='alert'>" . $message . "<span class='close' onclick='this.parentElement.remove();'>&times;</span></div>";
            break;
    }
    
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