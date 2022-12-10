<?php  
 require('db_connect.php');
session_start();
	

if (isset($_POST['cc_name']) and isset($_POST['cc_number']) and isset($_POST['ccv']) and isset($_POST['exp_date'])){

// Assigning POST values to variables.

$cc_name = $_POST['cc_name'];
$cc_number = $_POST['cc_number'];
$ccv = $_POST['ccv'];
$exp_date = $_POST['exp_date'];



// CHECK FOR THE RECORD FROM TABLE

	$query = "SELECT * FROM `credit_cards` WHERE cc_name='$cc_name' and cc_number='$cc_number'and exp_date='$exp_date' and sec_code='$ccv' and account";

	
		
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$count = mysqli_num_rows($result);
$row = mysqli_fetch_row($result);
$row= $row[5];
	
//$ccnumber= $row[2];


$_SESSION['accountbb']= $row;// the acct...
$_SESSION['ccnumber']= $cc_number; // the cc frm user
	
if ($count == 1){
	
	
//echo "Login Credentials verified";
echo "<script type='text/javascript'>alert('Login Credentials verified')</script>";
	 header("Location: thanks.php");

}else{
echo "<script type='text/javascript'>alert('Invalid Login Credentials')</script>";
	 header("Location: index.php");
//echo "Invalid Login Credentials";
}
	
}

?>