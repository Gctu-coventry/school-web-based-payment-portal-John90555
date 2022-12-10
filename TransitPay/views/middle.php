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
  if (isset($_SESSION['token']) && isset($_SESSION['amount'])) {
    unset($_SESSION['shopping_cart']);
    $bank->my_api_key = $_SESSION['token'];
 
    $che = $bank->check_api_key();
    


    switch ($che) {
      case true:
        $v = $valid->vali();
        switch ($v) {
          case 'false':
            header('X_PHP_Response_Code: 200', true, 200);
            echo "<script>window.location.replace('http://localhost/LifeLineBank/views/check_out.php?already','blank').focus()</script>";

            break;
          case 'true':
            header('X_PHP_Response_Code: 401', true, 401);
            echo "You are unauthorized to use this endpoint";
            break;
          case 'notgenerated':
            header('X_PHP_Response_Code: 200', true, 200);
            
            $J_W_T = $bank->generate_jwt();
           
            $_SESSION['jwt'] = $J_W_T;
            echo "<script>window.location.replace('http://localhost/LifeLineBank/views/check_out.php?gen','blank').focus()</script>";
            //$bank->check_status();
            break;
            default:
            echo 'Not';

        }
        break;

      case false:
        echo "You are unauthorized to use this endpoint exp";
      default:
      echo 'Not';
    }
  }
  


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Middle</title>
</head>
<body>
  
</body>
</html>