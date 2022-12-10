<?php
session_start();

include ("../model/Bank.php");
include ("../model/Interactions.php");
include ("../config/dbconnect.php");

$database = new Database;
$db = $database->connect();
$interact = new Interaction($db);
header('Access-Control-Allow-Origin: *');

$one = $_POST['one'];
$two = $_POST['two'];
$three = $_POST['three'];
$four = $_POST['four'];
$five = $_POST['five'];
$six = $_POST['six'];

if(isset($one) && isset($two) && isset($three) && isset($four) && isset($five) && isset($six)){
    
    $full_otp = $one.$two.$three.$four.$five.$six;;
    $full_otp1 = intval($full_otp);
    $interact->otp = $full_otp1;
    $one = $interact->check_otp();
    switch ($one){
        case true:
            
        $response = "atrue"; 
        break;
        case false:
        $response = "afalse";
        break;
        
        
    }
}
else{
    $response = 'empty';
}
echo $response;