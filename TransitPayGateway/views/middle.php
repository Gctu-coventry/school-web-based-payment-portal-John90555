<?php
session_start();
header("Access-Control-Allow-Origin: *");
include("../config/dbconnect.php");
include("../model/Bank.php");
include("../model/validateJWT.php");
$database = new Database;
$db = $database->connect();
$bank = new Bank($db);
$valid = new Validate($db);

  $headers = apache_request_headers();
  
    $bank->my_api_key = $_SESSION['api_key'];
    //$_SESSION['api_key'] = $_POST['api_key'];
 
    $che = $bank->check_api_key();
    //$_SESSION['amount'] = $_POST['total'];
    


    switch ($che) {
      case true:
        //$v = $valid->vali();
        //switch ($v) {
          //case 'false':
            // header('X_PHP_Response_Code: 200', true, 200);
           echo "<script>window.location.replace('http://localhost/Mypay/views/check_out.php?already','blank').focus()</script>";
            //$response = "true";
            //break;
          //case 'true':
            // header('X_PHP_Response_Code: 401', true, 401);
            // echo "You are unauthorized to use this endpoint";
            //$response = "true";
            //break;
          //case 'notgenerated':
            // header('X_PHP_Response_Code: 200', true, 200);
            
            //$J_W_T = $bank->generate_jwt();
           
            //$_SESSION['jwt'] = $J_W_T;
            //echo "<script>window.location.replace('http://localhost/LifeLineBank/views/check_out.php?gen','blank').focus()</script>";
            //$bank->check_status();
            //$response = "true";
            //break;
            //default:
            //echo 'Not';
          //  $response = "false";

        //}
        break;

      case false:
        echo "You are unauthorized to use this endpoint";
        $response = "false";
      default:
      //echo 'Not';
      $response = "false";

    }
  
  

//echo $response;
?>