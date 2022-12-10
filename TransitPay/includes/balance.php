<?php
session_start();

include ("../model/Bank.php");
include ("../model/Interactions.php");
include ("../config/dbconnect.php");

$database = new Database;
$db = $database->connect();
$interact = new Interaction($db);
header('Access-Control-Allow-Origin: *');



$interact->email = $_SESSION['email'];
$response = $interact->api_fetchassoc();
echo $response;