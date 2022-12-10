<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require '../vendor/autoload.php';
include_once '../vendor/phpmailer/phpmailer/src/PHPMailer.php';


class Interaction{
    
    private $con;
    private $table = "users";
    private $table1 = "topup";
    private $table2 = "arrears";
    //setting attributes
    
    public $bank_account_number;
    public $firstname;
    public $lastname;
    public $phone_number;
    public $email;
    public $password;
    public $amount;
    public $recipient_id;
    public $reference;
    public $transaction_id;
    public $status;
    public $requester_id;
    public $type;
    public $balance;
    public $newbalance;
    public $acc_number;
    public $otp;
    public $sales_id;
    public function __construct($db){
        $this->con=$db;
    }
    function check_login($id){

        if (isset($_SESSION['my_id'])){
        
            $id = $_SESSION['my_id'];
            $query = "SELECT COUNT(*) from users where id= :id limit 1";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row){
                $user_data = $row;
                return $user_data;
            }else{
                return null;
            }
        
        }
        else{
        //redirect to login
        header("Location: index.php");
        die;}
        }
        function api_check_login(){ 
             
                $query = "SELECT COUNT(*) from users where email= :id AND password= :password limit 1";
                $stmt = $this->con->prepare($query);
                $md = md5($this->password);
                $stmt->bindParam(':id', $this->acc_number);
                $stmt->bindParam(':password',$md);
                $stmt->execute();
                if($stmt -> fetchColumn() == 1){
                    $t = true;
                    return $t;
                }else if($stmt -> fetchColumn() < 1){
                    $t = false;
                    return $t;
                }
               
            }
        public function history(){
            $query = "SELECT * FROM " . $this->table1 . " WHERE requester_id = :id  ";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(':id', $this->requester_id);
            $stmt->execute();
            //echo '<tr>' ;
            echo '</tr>';
            while($row = $stmt->fetch()){
									echo '<td>' .  $row ["transaction_id"] . '</td>';
									echo '<td>' .  $row ["recipient_id"] . '</td>';
									echo '<td>' .  $row ["amount"] . '</td>';
									echo '<td>' .  $row ["status"] . '</td>';
                                    echo '<td>' .  $row ["time_requested"] . '</td>';
                                    echo '<td>' .  $row ["type"] . '</td>';
                                    echo '</tr>';
                                }   
            
        
        }
        public function adminhistory(){
            $query = "SELECT * FROM " . $this->table1 ;
            $stmt = $this->con->prepare($query);
            //$stmt->bindParam(':id', $this->requester_id);
            $stmt->execute();
            //echo '<tr>' ;
            echo '</tr>';
            while($row = $stmt->fetch()){
									echo '<td>' .  $row ["transaction_id"] . '</td>';
									echo '<td>' .  $row ["recipient_id"] . '</td>';
									echo '<td>' .  $row ["amount"] . '</td>';
									echo '<td>' .  $row ["status"] . '</td>';
                                    echo '<td>' .  $row ["time_requested"] . '</td>';
                                    echo '<td>' .  $row ["type"] . '</td>';
                                    echo '</tr>';
                                }   
            
        
        }
        
        public function viewarrears(){
            $query = "SELECT * FROM " . $this->table ;
            $stmt = $this->con->prepare($query);
            //$stmt->bindParam(':id', $this->requester_id);
            $stmt->execute();
            //echo '<tr>' ;
            echo '</tr>';
            while($row = $stmt->fetch()){
                echo '<td>' .  $row ["bank_account_number"] . '</td>';
                echo '<td>' .  $row ["email"] . '</td>';
                echo '<td>' .  $row ["arrears"] . '</td>';
                echo '</tr>';
                                }   
            
        
        }
        public function pending(){
            $query = "SELECT * FROM " . $this->table1 . " WHERE requester_id = :id AND status = :status ";
            $stmt = $this->con->prepare($query);
            $this->status = "Pending";
            $stmt->bindParam(':id', $this->requester_id);
            $stmt->bindParam(':status', $this->status );
            $stmt->execute();
            //echo '<tr>' ;
            
            while($row = $stmt->fetch()){
                echo '<tr class="tr">';
									echo '<td>' .  $row ["transaction_id"] . '</td>';
									echo '<td>' .  $row ["recipient_id"] . '</td>';
									echo '<td>' .  $row ["amount"] . '</td>';
                                    echo '<td>' .  $row ["time_requested"] . '</td>';
                                    echo '<td> <button class="approve" id="' . $row["transaction_id"] . '">Approve</button> </td>';
                                    echo '<td> <button class="decline" id="' . $row["transaction_id"] . '">Decline</button> </td>';
                                    echo '</tr>';
                                }   
            
        
        }
        
        public function count(){
            $query = "SELECT * FROM " . $this->table1 . " WHERE requester_id = :id ";
            $stmt = $this->con->prepare($query);
            
            $stmt->bindParam(':id', $this->requester_id);
            $stmt->execute();
            $row = $stmt -> rowCount();
            
            return $row;
        
        }
        public function admincountPending(){
            $query = "SELECT * FROM " . $this->table1 ;
            $stmt = $this->con->prepare($query);
            $this->status = "Pending";
            // $stmt->bindParam(':id', $this->requester_id);
            // $stmt->bindParam(':status', $this->status );
            $stmt->execute();
            $row = $stmt -> rowCount();
            
            return $row;
        
        }
        public function countPending(){
            $query = "SELECT * FROM " . $this->table1 . " WHERE requester_id = :id AND status = :status ";
            $stmt = $this->con->prepare($query);
            $this->status = "Pending";
            $stmt->bindParam(':id', $this->requester_id);
            $stmt->bindParam(':status', $this->status );
            $stmt->execute();
            $row = $stmt -> rowCount();
            
            return $row;
        
        }
        public function fetcharray(){
            $query = "SELECT * FROM " . $this->table1 . " WHERE requester_id = :id AND status = :status ";
            $stmt = $this->con->prepare($query);
            $this->status = "Pending";
            $stmt->bindParam(':id', $this->requester_id);
            $stmt->bindParam(':status', $this->status );
            $stmt->execute();
            $row = $stmt -> fetch(PDO::FETCH_BOTH);
            $details = array(
                "transaction_id" => $row['transaction_id'],
                "requester_id" => $row['requester_id'],
                "recipient_id" =>$row['recipient_id'],
                "amount" =>$row['amount'],
                "status" => $row['status'],
                "reference" => $row['reference'],
                "type" => $row['type'],
                "time_requested" => $row['time_requested']
            );
            return json_encode($details);
            
        
        }
        public function fetchassoc(){
            $query = "SELECT * FROM " . $this->table . " WHERE id = :id  limit 0,1";
            $stmt = $this->con->prepare($query);
            
            $stmt->bindParam(':id', $_SESSION['my_id']);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $details = array(
                "id" => $row['id'],
                "bank_account_number" => $row['bank_account_number'],
                "firstname" =>$row['firstname'],
                "lastname" =>$row['lastname'],
                "phone_number" => $row['phone_number'],
                "email" => $row['email'],
                "balance" => $row['balance'],
                "api_key" => $row['api_key']
            );
            return json_encode($details);
    
        }
        public function notify(){
$mail = new PHPMailer(true);
try{
$mail->SMTPDebug = 0;                   // Enable verbose debug output
$mail->isSMTP();                        // Set mailer to use SMTP
$mail->Host       = 'smtp.gmail.com;';    // Specify main SMTP server
$mail->SMTPAuth   = true;               // Enable SMTP authentication
$mail->Username   = 'lifelinebank1@gmail.com';     // SMTP username
$mail->Password   = 'l!feLineBank1';         // SMTP password
$mail->SMTPSecure = 'tls';              // Enable TLS encryption, 'ssl' also accepted
$mail->Port       = 587;               // TCP port to connect to
$mail->setFrom('lifelinebank1@gmail.com', 'LifeLineBank-Refunds');           // Set sender of the mail
$mail->addAddress($this->email);           // Add a recipient
//$mail->addAddress('receiver2@gfg.com', 'Name');   // Name is optional
$mail->isHTML(true);                                  
$mail->Subject = 'Refund Request';
$mail->Body    = '<div>Hello Merchant,</div> <div>A refund request of <b>'.$this->amount.'</b> was made to your account from '.$this->email.'<div> <b>Log in to your accoount to check</b>!';
$mail->AltBody = 'Refund of <b>'.$this->amount.'</b>';
$mail->send();


//echo "Mail has been sent successfully!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
        }
        
        public function sendOtp(){
            $otp = rand(100000,999999);
            $query2 = "UPDATE " . $this->table . " SET otp = :otp where email = :email ";
            $stmt = $this->con->prepare($query2);
            $stmt->bindParam(':otp', $otp);
            $stmt->bindParam(':email', $_SESSION['email']);
           $stmt->execute();

$mail = new PHPMailer(true);
try{
$mail->SMTPDebug = 0;                   // Enable verbose debug output
$mail->isSMTP();                        // Set mailer to use SMTP
$mail->Host       = 'smtp.gmail.com;';    // Specify main SMTP server
$mail->SMTPAuth   = true;               // Enable SMTP authentication
$mail->Username   = 'lifelinebank1@gmail.com';     // SMTP username
$mail->Password   = 'l!feLineBank1';         // SMTP password
$mail->SMTPSecure = 'tls';              // Enable TLS encryption, 'ssl' also accepted
$mail->Port       = 587;               // TCP port to connect to
$mail->setFrom('lifelinebank1@gmail.com', 'LifeLineBank-Login');           // Set sender of the mail
$mail->addAddress($_SESSION['email']);           // Add a recipient
//$mail->addAddress('receiver2@gfg.com', 'Name');   // Name is optional
$mail->isHTML(true);                                  
$mail->Subject = 'OTP';
$mail->Body    = '<div>Hello user,</div> <div>You recently requested to log in Your OTP is<div> <b>'.$otp.'</b>!';
$mail->AltBody = 'Your OTP is <b>'.$otp.'</b>';
$mail->send();


//echo "Mail has been sent successfully!";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

        }
        public function api_fetchassoc(){
            $query = "SELECT * FROM " . $this->table . " WHERE email= :id";
            $stmt = $this->con->prepare($query);
            
            $stmt->bindParam(':id', $this->email);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $details = array(
                "id" => $row['id'],
                "bank_account_number" => $row['bank_account_number'],
                "firstname" =>$row['firstname'],
                "lastname" =>$row['lastname'],
                "phone_number" => $row['phone_number'],
                "email" => $row['email'],
                "balance" => $row['balance']
                //"api_key" => $row['api_key']
            );
            return json_encode($details);
        
        }
        public function check_otp(){
            $query = "SELECT * FROM " . $this->table . " WHERE otp= :otp AND email= :email";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(':otp', $this->otp);
            $stmt->bindParam(':email', $_SESSION['email']);
            $stmt->execute();
            if($stmt -> fetchColumn() >= 1){
                $t = true;
                return $t;
            }else if($stmt -> fetchColumn() < 1){
                $t = false;
                return $t;
            }


        }
        public function token_fetchassoc(){
            $query = "SELECT * FROM " . $this->table . " WHERE api_key= :id";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(':id', $_SESSION['token']);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $details = array(
                "id" => $row['id'],
                "bank_account_number" => $row['bank_account_number'],
                "firstname" =>$row['firstname'],
                "lastname" =>$row['lastname'],
                "phone_number" => $row['phone_number'],
                "email" => $row['email'],
                "balance" => $row['balance']
                //"api_key" => $row['api_key']
            );
            return json_encode($details);
        
        }
        public function transfer(){
            $query = "INSERT INTO " . $this->table1 .  " SET  transaction_id= :transaction_id, requester_id= :requester_id, recipient_id= :recipient_id, amount= :amount, status= :status, reference= :reference, type= :type";
            $stmt = $this->con->prepare($query);
            $this->amount = htmlspecialchars(strip_tags($this->amount));
            $this->reference = htmlspecialchars(strip_tags($this->reference));
            $this->transaction_id = uniqid('TXD',true);
            $this->requester_id = htmlspecialchars(strip_tags($this->requester_id));
            $this->recipient_id = htmlspecialchars(strip_tags($this->recipient_id));
            

            $stmt->bindParam(':transaction_id', $this->transaction_id);
            $stmt->bindParam(':requester_id', $this->requester_id);
            $stmt->bindParam(':recipient_id', $this->recipient_id);
            $stmt->bindParam(':amount', $this->amount);
            $stmt->bindParam(':reference', $this->reference);
            $stmt->bindParam(':status', $this->status);
            $stmt->bindParam(':type', $this->type);
           
            if($stmt->execute()){
                $query2 = "UPDATE " . $this->table . " SET balance = :newbalance where bank_account_number = :request_id ";
                $stmt2 = $this->con->prepare($query2);
                $bal = intval($this->balance);
                $newb = intval($this->amount);
                $this->newbalance =  $bal - $newb; 
                $stmt2->bindParam(':request_id', $this->requester_id);
                $stmt2->bindParam(':newbalance', $this->newbalance);
                $stmt2->execute();
                $query3 = "UPDATE " . $this->table . " SET balance = :m_newbalance where bank_account_number = :bank_account_number ";
                $stmt3 = $this->con->prepare($query3);
                $m_bal = intval($_SESSION['merchant_balance']);
                $m_newbal = $m_bal + $newb;
                $stmt3->bindParam(':m_newbalance',$m_newbal);
                $stmt3->bindParam(':bank_account_number',$this->recipient_id);
                $stmt3->execute();

            return true;
            }
            else{
                printf("Error: %s\n", $stmt->error);
            return false;
            }
        }
        public function transfer3(){
            $query = "INSERT INTO " . $this->table1 .  " SET  transaction_id= :transaction_id, requester_id= :requester_id, recipient_id= :recipient_id, amount= :amount, status= :status, reference= :reference, type= :type";
            $stmt = $this->con->prepare($query);
            $this->amount = htmlspecialchars(strip_tags($this->amount));
            $this->reference = htmlspecialchars(strip_tags($this->reference));
            $this->transaction_id = uniqid('TXD',true);
            $this->requester_id = htmlspecialchars(strip_tags($this->requester_id));
            $this->recipient_id = htmlspecialchars(strip_tags($this->recipient_id));
            

            $stmt->bindParam(':transaction_id', $this->transaction_id);
            $stmt->bindParam(':requester_id', $this->requester_id);
            $stmt->bindParam(':recipient_id', $this->recipient_id);
            $stmt->bindParam(':amount', $this->amount);
            $stmt->bindParam(':reference', $this->reference);
            $stmt->bindParam(':status', $this->status);
            $stmt->bindParam(':type', $this->type);
           if($stmt->execute()){
            $query2 = "UPDATE " . $this->table . " SET balance = :newbalance where bank_account_number = :request_id ";
                $stmt2 = $this->con->prepare($query2);
                $bal = intval($_SESSION['merchant_balance']);
                $newb = intval($this->amount);
                $this->newbalance =  $bal - $newb; 
                $stmt2->bindParam(':request_id', $this->requester_id);
                $stmt2->bindParam(':newbalance', $this->newbalance);
                $stmt2->execute();
                $query3 = "UPDATE " . $this->table . " SET balance = :m_newbalance where bank_account_number = :bank_account_number ";
                $stmt3 = $this->con->prepare($query3);
                $m_bal = intval($this->balance);
                $m_newbal = $m_bal + $newb;
                $stmt3->bindParam(':m_newbalance',$m_newbal);
                $stmt3->bindParam(':bank_account_number',$this->recipient_id);
                if($stmt3->execute()){
                return true;
                }
                else{
                    printf("Error: %s\n", $stmt3->error);
                return false;
                }
            }
            else{
                printf("Error: %s\n", $stmt->error);
            return false;
            }
        }
        public function findTransaction(){
            $query1 = "SELECT * FROM " . $this->table1 . " WHERE transction_id = :sales_id";
            $stmt = $this->con->prepare($query1);
            $stmt->bindParam(':transaction_id',$this->sales_id);
            $stmt->exexute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $details = array(
                'transaction_id' => $row['transaction_id'],
                'requester_id' => $row['requester_id'],
                'recipient_id' => $row['recipient_id'],
                'amount' => $row['amount'],
                'status' => $row['status']
            );
            return $details;
        }
        public function approveRequest(){
            
                $query2 = "UPDATE " . $this->table . " SET balance = :newbalance where bank_account_number = :request_id ";
                $stmt2 = $this->con->prepare($query2);
                $bal = intval($_SESSION['merchant_balance']);
                $newb = intval($this->amount);
                $this->newbalance =  $bal - $newb; 
                $stmt2->bindParam(':request_id', $this->requester_id);
                $stmt2->bindParam(':newbalance', $this->newbalance);
                $stmt2->execute();
                $query3 = "UPDATE " . $this->table . " SET balance = :m_newbalance where bank_account_number = :bank_account_number ";
                $stmt3 = $this->con->prepare($query3);
                $m_bal = intval($this->balance);
                $m_newbal = $m_bal + $newb;
                $stmt3->bindParam(':m_newbalance',$m_newbal);
                $stmt3->bindParam(':bank_account_number',$this->recipient_id);
                if($stmt3->execute()){

            return true;
            }
            else{
                printf("Error: %s\n", $stmt3->error);
            return false;
            }
        }
        public function deposit(){
            $query = "INSERT INTO " . $this->table1 .  " SET  transaction_id= :transaction_id, requester_id= :requester_id, recipient_id= :recipient_id, amount= :amount, status= :status, reference= :reference, type= :type";
            $stmt = $this->con->prepare($query);
            $this->amount = htmlspecialchars(strip_tags($this->amount));
            $this->reference = htmlspecialchars(strip_tags($this->reference));
            $this->transaction_id = uniqid('TXD',true);
            $this->status = 'Complete';
            $this->requester_id = htmlspecialchars(strip_tags($this->requester_id));
            $this->recipient_id = htmlspecialchars(strip_tags($this->recipient_id));
            $this->type = "Deposit";


            $stmt->bindParam(':transaction_id', $this->transaction_id);
            $stmt->bindParam(':requester_id', $this->requester_id);
            $stmt->bindParam(':recipient_id', $this->recipient_id);
            $stmt->bindParam(':amount', $this->amount);
            $stmt->bindParam(':reference', $this->reference);
            $stmt->bindParam(':status', $this->status);
            $stmt->bindParam(':type', $this->type);

            if($stmt->execute()){
                $query2 = "UPDATE " . $this->table . " SET balance = :newbalance where bank_account_number = :request_id ";
                $stmt2 = $this->con->prepare($query2);
                $bal = intval($this->balance);
                $newb = intval($this->amount);
                $this->newbalance =  $newb+$bal; 
                $stmt2->bindParam(':request_id', $this->requester_id);
                $stmt2->bindParam(':newbalance', $this->newbalance);
                $stmt2->execute();
                
            return true;
            }
            else{
                printf("Error: %s\n", $stmt->error);
            return false;
            }
        }
        public function transfer2(){
            $query = "INSERT INTO " . $this->table1 .  " SET  transaction_id= :transaction_id, requester_id= :requester_id, recipient_id= :recipient_id, amount= :amount, status= :status, reference= :reference, type= :type";
            $stmt = $this->con->prepare($query);
            $this->amount = htmlspecialchars(strip_tags($this->amount));
            $this->reference = htmlspecialchars(strip_tags($this->reference));
            $this->transaction_id = uniqid('TXD',true);
            $this->status = 'Pending';
            $this->requester_id = htmlspecialchars(strip_tags($this->requester_id));
            $this->recipient_id = htmlspecialchars(strip_tags($this->recipient_id));
            $this->type = "Internal";


            $stmt->bindParam(':transaction_id', $this->transaction_id);
            $stmt->bindParam(':requester_id', $this->requester_id);
            $stmt->bindParam(':recipient_id', $this->recipient_id);
            $stmt->bindParam(':amount', $this->amount);
            $stmt->bindParam(':reference', $this->reference);
            $stmt->bindParam(':status', $this->status);
            $stmt->bindParam(':type', $this->type);

            if($stmt->execute()){
                $query2 = "UPDATE " . $this->table . " SET balance = :newbalance where bank_account_number = :request_id ";
                $stmt2 = $this->con->prepare($query2);
                $bal = intval($this->balance);
                $newb = intval($this->amount);
                $this->newbalance =  $bal-$newb; 
                $stmt2->bindParam(':request_id', $this->requester_id);
                $stmt2->bindParam(':newbalance', $this->newbalance);
                $stmt2->execute();
                
            return true;
            }
            else{
                printf("Error: %s\n", $stmt->error);
            return false;
            }
        }
    
}
