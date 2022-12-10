<?php


class CheckOut{
    private $con;
    private $table = "users";
    private $table1 = "products";
    private $table2 = "sales";
    //setting attributes
    public $email;
    public $password;
    public $amount;
    public $product_name;
    public $product_price;
    public $quantity;
    public $product_id;
    public $session_id;
    public $is_available;

    

    public function __construct($db){
        $this->con=$db;
    }

    function check_login($id){

        if (isset($_SESSION['user_id'])){
        
            $id = $_SESSION['user_id'];
            $query = "SELECT COUNT(*) from users where session_id= :session_id limit 1";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(':session_id', $this->session_id);
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
        
        /*public function purchased(){
            $query = "SELECT * FROM " . $this->table2 . " WHERE session_id = :session_id" ;
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(':session_id', $_SESSION['user_id']);
            $stmt->execute();
            #$row = $stmt -> fetch(PDO::FETCH_BOTH);
            #$row = $stmt->fetchAll();
            $i=1;
	        while($row = $stmt->fetch()){
                
                echo '<div class="form-row">';
                echo '<div >' .$row["products_bought"].'</div>';
                echo '<div>&#x20B5&nbsp' .$row["product_price"] .'</div>';
                echo '<div >' .$row["quantity_bought"] .'</div>';
                echo '</div>';
                $i++;
            }   
    }
    public function total(){
    $query = "SELECT * FROM " . $this->table2 . " WHERE session_id = :session_id" ;
    $stmt = $this->con->prepare($query);
    $stmt->bindParam(':session_id', $_SESSION['user_id']);
    $stmt->execute();
    #$row = $stmt -> fetch(PDO::FETCH_BOTH);
    #$row = $stmt->fetchAll();
    $i=1;
    $total_price = 0;
    while($row = $stmt->fetch()){
        $total_price = $total_price + ($row["quantity_bought"] * $row["product_price"]);
        
    }
    echo $total_price;
}
*/
}
