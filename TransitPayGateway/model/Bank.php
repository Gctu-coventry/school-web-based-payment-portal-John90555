<?php
include_once '../vendor/firebase/php-jwt/src/BeforeValidException.php';
include_once '../vendor/firebase/php-jwt/src/ExpiredException.php';
include_once '../vendor/firebase/php-jwt/src/SignatureInvalidException.php';
include_once '../vendor/firebase/php-jwt/src/JWT.php';

use Firebase\JWT\JWT;

class Bank{
    

/*use D_Env\DotEnv;


(new DotEnv(__DIR__ . '/.env'))->load();
*/

    
    private $con;
    private $table = "users";
    //setting attributes
    public $bank_account_number;
    public $firstname;
    public $lastname;
    public $phone_number;
    public $email;
    public $password;
    public $balance;
    public $my_api_key;

    public function __construct($db){
        $this->con=$db;
    }
    public function generate_jwt(){
        
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
        // generate json web token
        $token = array(
            "iat" => $issued_at,
            "exp" => $expiration_time,
            "iss" => $issuer
         );
         $jwt = JWT::encode($token,$key,'HS256');
    //echo json_encode(
    //        array(
     //           "message" => "Successful creation.",
     //           "jwt" => $jwt
     //       )
     //   );
 
// generate jwt will be here
return $jwt;
    }
    public function checkemail(){
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email  limit 0,1";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
    $result = $stmt->fetchAll();
	$records = count($result);
        if($records >= 1){
            $t = "false";
            return $t;
        }else if($records == 0){
            $t = "true";
            return $t;
        }

    }
    //check api_key
    public function check_api_key(){
        $query = "SELECT * FROM " . $this->table . " WHERE api_key = :api_key ";
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(':api_key', $this->my_api_key);
        $stmt->execute();
        $result = $stmt->fetchAll();
	$records = count($result);
        if($records >= 1){
           $re = true;
        }else if($records == 0){
            $re = false;
            }
            return $re;
    }
    //creating users
    public function createuser(){
    $query = "INSERT INTO " . $this->table . " SET bank_account_number= :bank_account_number, firstname= :firstname, lastname= :lastname, phone_number= :phone_number, email= :email, password= :password, balance= :balance, api_key= :api_key";
    $stmt = $this->con->prepare($query);
    //clean data
    $this->bank_account_number = htmlspecialchars(strip_tags($this->bank_account_number));
    $this->firstname = htmlspecialchars(strip_tags($this->firstname));
    $this->lastname = htmlspecialchars(strip_tags($this->lastname));
    $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->password = htmlspecialchars(strip_tags($this->password));
    $this->balance = 0.00;        
    $this->my_api_key = implode('-', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
        //bind
    $stmt->bindParam(':bank_account_number', $this->bank_account_number);
    $stmt->bindParam(':firstname', $this->firstname);
    $stmt->bindParam(':lastname', $this->lastname);
    $stmt->bindParam(':phone_number', $this->phone_number);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':password', $this->password);
    $stmt->bindParam(':balance', $this->balance);
    $stmt->bindParam(':api_key', $this->my_api_key);

    if($stmt->execute()){
        return true;
    }
    else{
        printf("Error: %s\n", $stmt->error);
        return false;
    }
}
public function login($email,$password){
    $query = "SELECT COUNT(*) FROM " . $this->table . " WHERE email = :email AND password = :password limit 0,1";
    $stmt = $this->con->prepare($query);
        //bind id to placeholder
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':password', $this->password);
    $stmt->execute();
    //if($stmt -> fetchColumn() > 0){
    //$row = $stmt->fetch(PDO::FETCH_ASSOC);
        //$row['email'] === $this->email && $row['password'] === $this->password
    if($stmt -> fetchColumn() == 1){
        $t = "true";
        return $t;
    }else if($stmt -> fetchColumn() < 1){
        $t = "false";
        return $t;
    }
}
public function fetchassoc(){
    $query = "SELECT * FROM " . $this->table . " WHERE email = :email  limit 0,1";
    $stmt = $this->con->prepare($query);
    $stmt->bindParam(':email', $this->email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $id =  $row['id'];
    return $id;

}
public function check_status(){
    //check is transaction has a valid status i.e. failed or canceled if pendign keep waiting
}


}