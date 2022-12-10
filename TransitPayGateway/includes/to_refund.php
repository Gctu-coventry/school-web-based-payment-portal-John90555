<?php
session_start();

include ("../model/Bank.php");
include ("../model/Interactions.php");
include ("../config/dbconnect.php");

$database = new Database;
$db = $database->connect();
$interact = new Interaction($db);
header('Access-Control-Allow-Origin: *');

$int_p_id = $_POST['int_p_id'];

if(isset($int_p_id)){
$interact->email = $_SESSION['email'];
$interact->amount = $int_p_id;

$all = $interact->api_fetchassoc();
$all_decoded = json_decode($all);
$sender_acc_nu = $all_decoded->bank_account_number;
$sender_email = $all_decoded->email;

$response = $interact->token_fetchassoc();
$all_response = json_decode($response);
$recipient_acc_nu = $all_response->bank_account_number;
$recipient_email = $all_response->email;

$interact->requester_id = $recipient_acc_nu;
$interact->recipient_id =  $sender_acc_nu;
$bala = $all_decoded->balance;
$balan = intval($bala);
$interact->balance = $balan;
$interact->type = "Refund";
$interact->status = "Pending";

    
    $one = $interact->transfer3();
    
switch ($one){
    case true:
        $interact->email = $sender_email;
        $interact->amount = $int_p_id;
        $interact->notify();

    header('X_PHP_Response_Code: 201', true, 201);
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