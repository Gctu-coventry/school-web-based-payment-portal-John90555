<?php
class DBController {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "tblproduct";
	private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
	function login($email,$password,$sess_id){
		$query = "SELECT * FROM customers WHERE email_address = '$email' AND account_password= '$password'";
		$result = mysqli_query($this->conn,$query);
		if($result){
		$rowcount = mysqli_num_rows($result);
		if($rowcount >=1){
			$query1 = "UPDATE customers SET sess_id='$sess_id' WHERE email_address = '$email' AND account_password = '$password' ";
			$result1 = mysqli_query($this->conn,$query1);
			if($result1){
				$_SESSION['sess_id'] = $sess_id;
				$re = "true";
			return $re;
			}else{
				$re = "false";
				return $re;
			}
		}else{
			$re = "false";
			return $re;
		}
		}else{
			$re = "false";
			return $re;
		}
	}
	public function store($query){
		$result = mysqli_query($this->conn,$query);
		if($result){
			return 1;
		}
		else{
			return 0;
		}
        
	}
	//public function 
	public function exist($query){
		$result = mysqli_query($this->conn,$query);
		if($result){
			$r = "true";
			return $r;
		}else{
			$r = "false";
			return $r;
		}
	}
	public function upd_store($query){
		$result = mysqli_query($this->conn,$query);
		if($result){
			$r = "true";
			return $r;
		}else{
			$r = "false";
			return $r;
		}
	}
	public function history($query){
		$result = mysqli_query($this->conn,$query);
		$n_row = mysqli_num_rows($result);
		$output = '';
		if($n_row > 0 ){
			$row = mysqli_fetch_assoc($result);
			foreach ($result as $row){
				$output .=  '
				<tr> <td scope="row"> <span class="fa fa-shopping-basket mr-1"></span>'.$row["order_id"].'</td> <td>' . $row['item_name'] . '</td> <td>' . $row['item_quantity'] . '</td> <td>'. $row['item_price'] . '</td> <td class="text-muted">'. $row['order_status'] . '</td> <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-up mr-1"></span> GH₵ ' .  $row['sub_total'] . ' </td> <td class="text-muted"> <button class="btn btn-danger" id="'.$row['order_id'].'" onclick="refund(this.id); ref(this.id);">Refund</button></td></tr>
				 ';
			 //$i++;
			}
			echo $output;

		}
	}
	public function adminhistory($query){
		$result = mysqli_query($this->conn,$query);
		$output = '';
		$row = mysqli_fetch_assoc($result);
		foreach ($result as $row){
			$output .=  '
			<tr> <form method="POST" action="refundPost.php"><td scope="row"> <span class="fa fa-shopping-basket mr-1"></span>'.$row["order_id"].'</td> <td>' . $row['item_name'] . '</td> <td>' . $row['item_quantity'] . '</td> <td>'. $row['item_price'] . '</td> <td class="text-muted">'. $row['order_status'] . '</td> <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-up mr-1"></span> GH₵ ' .  $row['sub_total'] . ' </td> <td class="text-muted"><button class="btn btn-danger" id="'.$row['order_id'].'" name="'.$row['sub_total'].'" onclick="refund(this.id, this.name); ref(this.id);">Approve Refund</button><input type="hidden" name="amountToRefund" value="'.  $row['sub_total'] .'"></input> <input type="hidden" name="userOrderID" value="'.  $row['order_id'] .'"></input></td></form></tr>
			 ';
		 //$i++;
		}
			echo $output;
	}
	public function admincompletedrefunds($query){
		$result = mysqli_query($this->conn,$query);
		$output = '';
		$row = mysqli_fetch_assoc($result);
		foreach ($result as $row){
			$output .=  '
			<tr> <form method="POST" action="refundPost.php"><td scope="row"> <span class="fa fa-shopping-basket mr-1"></span>'.$row["order_id"].'</td> <td>' . $row['item_name'] . '</td> <td>' . $row['item_quantity'] . '</td> <td>'. $row['item_price'] . '</td> <td class="text-muted">'. $row['order_status'] . '</td> <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-up mr-1"></span> GH₵ ' .  $row['sub_total'] . ' </td> <td class="text-muted"><input type="hidden" name="amountToRefund" value="'.  $row['sub_total'] .'"></input> <input type="hidden" name="userOrderID" value="'.  $row['order_id'] .'"></input></td></form></tr>
			 ';
		 //$i++;
		}
			echo $output;
	}
	public function userCount($query){
		$result = mysqli_query($this->conn,$query);
		$n_row = mysqli_num_rows($result);
		
		echo $n_row;
	}

	public function pendingRefunds($query){
		$result = mysqli_query($this->conn,$query);
		$n_row = mysqli_num_rows($result);
		echo $n_row;
	}

	function adminlogin($email,$password,$sess_id,$role){
		$query = "SELECT * FROM customers WHERE email_address = '$email' AND account_password= '$password' AND role = '$role' ";
		$result = mysqli_query($this->conn,$query);
		if($result){
		$rowcount = mysqli_num_rows($result);
		if($rowcount >=1){
			$query1 = "UPDATE customers SET sess_id='$sess_id' WHERE email_address = '$email' AND account_password = '$password' ";
			$result1 = mysqli_query($this->conn,$query1);
			if($result1){
				$_SESSION['sess_id'] = $sess_id;
				$re = "true";
			return $re;
			}else{
				$re = "false";
				return $re;
			}
		}else{
			$re = "false";
			return $re;
		}
		}else{
			$re = "false";
			return $re;
		}
	}
}
?>