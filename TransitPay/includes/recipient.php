<?php
session_start();

include ("../model/Bank.php");
include ("../model/Interactions.php");
include ("../config/dbconnect.php");

$database = new Database;
$db = $database->connect();
$interact = new Interaction($db);
header('Access-Control-Allow-Origin: *');



//$interact->acc_number = $_SESSION['acc_number'];
$response = $interact->token_fetchassoc();
$rep = json_decode($response);
$_SESSION['merchant_balance'] = $rep->balance;
echo $response;