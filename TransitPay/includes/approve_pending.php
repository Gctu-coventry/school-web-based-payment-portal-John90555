<?php
session_start();

include ("../model/Interactions.php");
include ("../config/dbconnect.php");
include ("../model/CheckOut.php");

$database = new Database;
$db = $database->connect();
$checkout = new CheckOut($db);
$interact = new Interaction($db);
header('Access-Control-Allow-Origin: *');

if(isset($_POST['id'])){
    $sales_id = $_POST['id'];
    $interact->sales_id = $sales_id;
            $approve = $interact->approveRequest();
                
                //$interact->session_id = $_SESSION['user_id'];
                
                        $response = 'true';
}else{
    $response = 'false';
}
echo $response;
