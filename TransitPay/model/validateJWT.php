<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/html; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once "../vendor/autoload.php";
include_once '../vendor/firebase/php-jwt/src/BeforeValidException.php';
include_once '../vendor/firebase/php-jwt/src/ExpiredException.php';
include_once '../vendor/firebase/php-jwt/src/SignatureInvalidException.php';
include_once '../vendor/firebase/php-jwt/src/JWT.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class Validate{
    private $con;

    public $my_api_key;
    public function __construct($db){   
        $this->con=$db;
    }
    public function vali(){
        $tkey ='SECRET_KEY';
// show error reporting
error_reporting(E_ALL);
 
// set your default time-zone
date_default_timezone_set('Africa/Accra');
 
// variables used for jwt
$key = $tkey;
$issued_at = time();
$expiration_time = $issued_at + (60 * 60); // valid for 1 hour
$issuer = "http://localhost/LifeLineBank/Bank.php";
// get posted data
//$data = json_decode(file_get_contents("php://input"));
 $data = json_decode($this->my_api_key);
// get jwt
$jwt=isset($data->jwt) ? $data->jwt : "";
 
// decode jwt here
// if jwt is not empty
if($jwt){

    // if decode succeed, show user details
    try {
        // decode jwt
        //$decoded = JWT::decode($jwt, $key, array('HS256'));
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
 
        // set response code
        //http_response_code(200);
 
        // show user details
        echo json_encode(array(
            "message" => "Access granted.",
            "data" => $decoded
        ));
        $return = 'true';
 
    }
    // if decode fails, it means jwt is invalid
catch (Exception $e){
 
    // set response code
    //http_response_code(401);
 
    // tell the user access denied  & show error message
    echo json_encode(array(
        "message" => "Access denied.",
        "error" => $e->getMessage()
        //'d'=>$data->jwt
    ));
    $return = 'false';
}
 
}
 
// show error message if jwt is empty
else{
 
    // set response code
    //http_response_code(401);
 
    // tell the user access denied
    echo json_encode(array("message" => "Empty ."));
    $return = 'notgenerated';
} 
  return $return; 
//echo $return; 
}
}