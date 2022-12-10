<?php
session_start();

include ("../model/Bank.php");
include ("../model/Interactions.php");
include ("../config/dbconnect.php");

$database = new Database;
$db = $database->connect();
$interact = new Interaction($db);
header('Access-Control-Allow-Origin: *');

$acc_number = $_POST['account_number'];
$password = $_POST['password'];
$_SESSION['email'] = $acc_number;

if(isset($acc_number) && isset($password)){
$interact->acc_number = $acc_number;
$_SESSION['acc_number'] = $acc_number;
$interact->password = $password;
$one = $interact->api_check_login();

switch ($one){
    case true:
        //$interact->sendOtp();
    $response = "true"; 
    break;
    case false:
    $response = "false";
    break;
    default:
    $response = "false";
    
}
}
echo $response;