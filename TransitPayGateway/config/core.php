<?php
use D_Env\DotEnv;

(new DotEnv(__DIR__ . '/.env'))->load();

$tkey = getenv('SECRET_KEY');
// show error reporting
error_reporting(E_ALL);
 
// set your default time-zone
date_default_timezone_set('Africa/Accra');
 
// variables used for jwt
$key = $tkey;
$issued_at = time();
$expiration_time = $issued_at + (60 * 60); // valid for 1 hour
$issuer = "http://localhost/Mypay/Bank.php";


?>