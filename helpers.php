<?php
function dbConnect()
{
    return DB::getDatabaseInstance();
}

class DB {
    private static $instance = null;

    public static function getDatabaseInstance() {
        if (is_null(self::$instance)) {
            try {
               self::$instance = new PDO('mysql:host=;dbname=;charset=utf8', '', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
            catch (Exception $exception)
            {
                die('Erreur : ' . $exception->getMessage());
            }
        }

        return self::$instance;
    }
}

function dd($array) {
    if (empty($array)) die();
    
    die(var_dump($array));
}

function buildPanelMessage($message)
{
    return "<div class='alert rounded-0 border-0 alert-danger alert-dismissible fade show' role='alert'>" . $message . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
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