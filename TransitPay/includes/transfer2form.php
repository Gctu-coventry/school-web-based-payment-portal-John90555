<?php
session_start();

include ("../model/Bank.php");
include ("../model/Interactions.php");
include ("../config/dbconnect.php");

$database = new Database;
$db = $database->connect();
$interact = new Interaction($db);
header('Access-Control-Allow-Origin: *');

$amount = $_POST['amount'];
$recipient_id = $_POST['bank_account'];
$reference = $_POST['reference'];
$requester_id = $_POST['requester_id'];
$balance = $_POST['balance'];
if(isset($amount)){
$interact->amount = $amount;
$interact->recipient_id = $recipient_id;
$interact->reference = $reference;
$interact->requester_id  = $requester_id ;
$interact->balance = (int)$balance;
$one = $interact->transfer2();

//$response =[$interact->amount,$recipient_id,$reference,$requester_id];
/*switch ($one){
    case "true";
    $res = "true";
    return $res;
    break;
    case "false";
    $res = "false";
    return $res;
    break;
}*/
switch ($one){
    case true:
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