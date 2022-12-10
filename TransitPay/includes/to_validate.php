<?php
session_start();

include ("../model/Bank.php");
include ("../model/Interactions.php");
include ("../config/dbconnect.php");

$database = new Database;
$db = $database->connect();
$interact = new Interaction($db);
header('Access-Control-Allow-Origin: *');

$amount_to_pay = $_POST['amount_to_pay'];

if(isset($amount_to_pay)){
$interact->email = $_SESSION['email'];
$interact->amount = $amount_to_pay;

$all = $interact->api_fetchassoc();
$all_decoded = json_decode($all);
$sender_acc_nu = $all_decoded->bank_account_number;

$response = $interact->token_fetchassoc();
$all_response = json_decode($response);
$recipient_acc_nu = $all_response->bank_account_number;

$interact->requester_id = $sender_acc_nu;
$interact->recipient_id = $recipient_acc_nu;
$bala = $all_decoded->balance;
$balan = intval($bala);
$interact->balance = $balan;
$interact->type = "Payment Via API";
$interact->status = "Completed";
if($amount_to_pay < $balan){
$one = $interact->transfer();

switch ($one){
    case true:
    header('X_PHP_Response_Code: 201', true, 201);
    $response = "true"; 
    break;
    case false:
    $response = "false";
    break;
    default:
    $response = "false";
    
}}else{
    
    $response = "not_enough";
}
}
echo $response;