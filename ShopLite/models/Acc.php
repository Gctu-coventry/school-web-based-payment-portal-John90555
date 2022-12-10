<?php
class B_acc{

private $conn;
private $customertable = 'customers';
private $transactiontable = 'transactions';
private $orderstable = 'orders';
private $normalisedorderstable = 'normalised_orders';

public $id;
public $tsn_type;
public $account_number;
public $to_account_number;
public $accbal;
public bool $isexist = false;
public $order_id;
public $item_name; 
public $item_quantity;  
public $item_price;
public $sub_total;  
public $customer_id;
public $order_total; 
public $item_count;  
public $order_status;
public $total_amount;
public $mainacc_bal;
public $mainacc_id= '3';
public $refundcode='300';
public $api_key;

//Transaction Table Columns
public $tsn_date;
public $amount;
public $tsn_status = '2000';

public function __construct($db)
{
    $this->conn = $db;
}

public function checkbalance()
{

    $query = 'SELECT * FROM ' . $this->customertable . ' WHERE email_address =:email';

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":email", $_SESSION['email']);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row != null)
    {
        $this->id = $row['id'];
        $this->accbal = $row['account_balance'];
        $this->account_number = $row['account_number'];
        $this->isexist = true;
    }

   

}

public function getCurrentBalance($accno)
{
    $query = 'SELECT * FROM ' . $this->customertable . ' WHERE account_number ='. $accno . ' LIMIT 0,1';

    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
    return $row['account_balance'];
        
   

}
public function getCurrentBalanceById($email)
{
    $query = 'SELECT * FROM ' . $this->customertable . ' WHERE id ='. $email . ' LIMIT 0,1';

    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
    return $row['account_balance'];
        
   

}
public function getAmount($myid)
{
    $query = 'SELECT * FROM ' . $this->transactiontable . ' WHERE id ='. $myid . ' LIMIT 0,1';

    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
    return $row['amount'];
        
   

}

public function updateRefundTsnCode($myId)
{
    $query = 'UPDATE ' . $this->transactiontable . '
    SET
       tsn_status= 300 
       WHERE id = :id';

   
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':id', $myId);

    if ($stmt->execute())
    {
         return true;
    }
    else{
        return false;
    }

   

}
public function show_recipient(){
    $query = 'SELECT * FROM ' . $this->customertable . ' WHERE api_key= :api_key';
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':api_key',$this->api_key);
    $stmt->execute();
    $row = $stmt -> fetch(PDO::FETCH_BOTH);
    $details = array(
        "firstname" => $row['account_firstname'],
        "lastname" => $row['account_lastname'],
        "account_number" => $row['account_number']
    );
    return json_encode($details);

}
public function makepayment()
{
;  
    
    $query = 'INSERT INTO ' . $this->transactiontable . '
    SET
       account_number= :account_number,
       to_account_number= :to_account_number,
       amount= :amount,
       tsn_type= :tsn_type,
       tsn_status= :tsn_status';

    $stmt = $this->conn->prepare($query);

     $this->account_number =  htmlspecialchars(strip_tags($this->account_number));
     $this->amount =  htmlspecialchars(strip_tags($this->amount));
     $this->tsn_status =  htmlspecialchars(strip_tags($this->tsn_status));
     $this->tsn_type =  htmlspecialchars(strip_tags($this->tsn_type));

     $this->accbal = $this->getCurrentBalance($this->account_number) - $this->amount;
     if ($this->accbal < 0)
     {
         return false;
     }
    $stmt->bindParam(':account_number', $this->account_number);
    $stmt->bindParam(':amount', $this->amount);
    $stmt->bindParam(':tsn_status', $this->tsn_status);
    $stmt->bindParam(':tsn_type', $this->tsn_type);
    $stmt->bindParam(':to_account_number', $this->to_account_number);
    //$stmt->bindParam(':order_id', $this->order_id);
    

    if ($stmt->execute())
    {
        $query2 = 'UPDATE ' . $this->customertable . '
        SET
           account_balance= :account_balance 
           WHERE account_number = :to_account_number';
    
        $stmt2 = $this->conn->prepare($query2);
    
         $this->accbal = $this->amount + $this->getCurrentBalance($this->to_account_number);
         
    
        $stmt2->bindParam(':account_balance', $this->accbal);
        $stmt2->bindParam(':to_account_number', $this->to_account_number);
    
        if ($stmt2->execute())
        {
            $query2 = 'UPDATE ' . $this->customertable . '
            SET
               account_balance= :account_balance 
               WHERE account_number = :account_number';
        
            $stmt2 = $this->conn->prepare($query2);
        
             $this->accbal = $this->getCurrentBalance($this->account_number) - $this->amount;
             
        
            $stmt2->bindParam(':account_balance', $this->accbal);
            $stmt2->bindParam(':account_number', $this->account_number);
        
            if ($stmt2->execute())
            {
                return true;
            }
            
        }
    
       printf("Error in updating account balance: %s.\n", $stmt2->error);
        return false;
    }

   printf("Error: %s.\n", $stmt->error);

    return false;

   

}

public function receiveorders()
{

    if($this->item_name != "NULL")
{
    $query = 'INSERT INTO ' . $this->orderstable . '
    SET
    order_id= :order_id,
    item_name= :item_name,
    item_quantity= :item_quantity,
    item_price= :item_price,
    sub_total= :sub_total,
    customer_id= :customer_id';

    $stmt = $this->conn->prepare($query);

     $this->order_id =  htmlspecialchars(strip_tags($this->order_id));
     $this->item_name =  htmlspecialchars(strip_tags($this->item_name));
     $this->item_quantity =  htmlspecialchars(strip_tags($this->item_quantity));
     $this->item_price =  htmlspecialchars(strip_tags($this->item_price));
     $this->sub_total =  htmlspecialchars(strip_tags($this->sub_total));
     $this->customer_id =  htmlspecialchars(strip_tags($this->customer_id));

 
    $stmt->bindParam(':order_id', $this->order_id);
    $stmt->bindParam(':item_name', $this->item_name);
    $stmt->bindParam(':item_quantity', $this->item_quantity);
    $stmt->bindParam(':item_price', $this->item_price);
    $stmt->bindParam(':sub_total', $this->sub_total);
    $stmt->bindParam(':customer_id', $this->customer_id);

    $this->order_total =  $this->order_total + $this->sub_total;
    
    if ($stmt->execute())
    {         
       return true;
    }

   printf("Error: %s.\n", $stmt->error);

}
    return false;

   

}


public function normaliseorder()
{

    $query = 'INSERT INTO ' . $this->normalisedorderstable . '
    SET
    order_id= :order_id,
    order_date= :order_date,
    item_count= :item_count,
    amount= :amount,
    order_status= :order_status,
    customer_id= :customer_id';

    $stmt = $this->conn->prepare($query);

     $this->order_id =  htmlspecialchars(strip_tags($this->order_id));
     $this->order_date =  htmlspecialchars(strip_tags( $this->order_date));
     $this->item_count =  htmlspecialchars(strip_tags($this->item_count));
     $this->order_status =  htmlspecialchars(strip_tags($this->order_status));
     $this->total_amount =  htmlspecialchars(strip_tags($this->total_amount));
     $this->customer_id =  htmlspecialchars(strip_tags($this->customer_id));

 
    $stmt->bindParam(':order_id', $this->order_id);
    $stmt->bindParam(':order_date', $this->order_date);
    $stmt->bindParam(':item_count', $this->item_count);
    $stmt->bindParam(':amount', $this->total_amount);
    $stmt->bindParam(':order_status', $this->order_status);
    $stmt->bindParam(':customer_id', $this->customer_id);

    if ($stmt->execute())
    {         
       return true;
    }

   printf("Error: %s.\n", $stmt->error);

    return false;

   

}
public function transactionHistory()
{
    $query = 'SELECT * FROM ' . $this->orderstable . ' WHERE order_id =? ';

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(1, $this->order_id);
    $stmt->execute();

    return $stmt;

    
}

public function allpayments()
{
    $query = 'SELECT * FROM ' . $this->transactiontable . '';

    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    return $stmt;

}
public function authenticatelogin($emailaddress,$password)
{
    $query = 'SELECT * FROM ' . $this->customertable . ' WHERE email_address =:email_address AND  
    account_password =:password';

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':email_address', $emailaddress);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    if($stmt->fetchColumn() >= 1){
        $re = "true";
        return $re;
    }
    else if($stmt -> fetchColumn() <= 0){
        $re = "false";
        return $re;
    }

    

}
public function authenticatesignup($emailaddress,$password,$firstname,$lastname,$phone_number,)
{
    $query = 'INSERT INTO ' . $this->customertable . ' SET account_number= :account_number, account_firstname= :account_firstname, account_lastname= :account_lastname, account_balance= :account_balance, phone_number= :phone_number, email_address= :email_address, account_password= :password, isBank= :isBank, api_key= :api_key';
    $api_key = implode('-', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
    $isbank ="no";
    $account_number = uniqid();
    $account_balance = 0;

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':email_address', $emailaddress);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':isBank', $isbank);
    $stmt->bindParam(':api_key',$api_key);
    $stmt->bindParam(':account_balance',$account_balance);
    $stmt->bindParam(':account_number',$account_number);
    $stmt->bindParam(':account_firstname',$firstname);
    $stmt->bindParam(':account_lastname',$lastname);
    $stmt->bindParam(':phone_number',$phone_number);
    $stmt->execute();

    return $stmt;

}


public function refundtransaction()
{

   
    $query = 'SELECT * FROM ' . $this->normalisedorderstable . ' WHERE order_id =? LIMIT 0,1';

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(1, $this->order_id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    
    if ($row['order_status'] == '200')
    {
        
        

        $query = 'UPDATE ' . $this->normalisedorderstable . '
        SET
        order_status= :order_status  
           WHERE order_id = :order_id';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_status', $this->refundcode);
        $stmt->bindParam(':order_id', $this->order_id);
    
         $this->accbal = $this->getCurrentBalanceById($row['customer_id']) + $row['amount'];
         $this->mainacc_bal= $this->getCurrentBalanceById('3') - $row['amount'];
       
    
        if ($stmt->execute())
        {
            $query = 'UPDATE ' . $this->customertable . '
            SET
               account_balance= :account_balance  
               WHERE id = :id';
        
            $stmt = $this->conn->prepare($query);
        
            $stmt->bindParam(':id', $row['customer_id']);
            $stmt->bindParam(':account_balance', $this->accbal);

            
        
            if ($stmt->execute())
            {
                $query = 'UPDATE ' . $this->customertable . '
            SET
               account_balance= :account_balance  
               WHERE id = :id';
        
            $stmt = $this->conn->prepare($query);
        
            $stmt->bindParam(':id', $this->mainacc_id);
            $stmt->bindParam(':account_balance', $this->mainacc_bal);
            if ($stmt->execute())
            {
                $query = 'UPDATE ' . $this->transactiontable . '
        SET
        tsn_status= :tsn_status  
           WHERE order_id = :order_id';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':tsn_status', $this->refundcode);
        $stmt->bindParam(':order_id', $this->order_id);
        if ($stmt->execute())
        {
            return true;
        }
             return true;
            }

            }
            return true;
        }
    
       printf("Error: %s.\n", $stmt->error);
   

    }
        
       
   

    return false;

   

}

}