
<?php
session_start();

include ("dbcontroller.php");
include("dbconfig.php");

$database = new DBController();

$bankaccountErr = $emailErr = $passwordErr = $o_error = ""; 
$bank_account_number = $email = $password = "";
if(isset($_POST['submit'])){
      if (empty($_POST["email"])) {
        $emailErr = "Email is required";
      } else {
        $email = $_POST["email"];
      }
      if (empty($_POST["password"])) {
        $passwordErr = "password is required";
      } else {
        $password = $_POST["password"];
      }


if(!empty($email) && !empty($password)){

$encrypted_password = md5($password);

$sess_id = uniqid('SES',true);
$role = "admin";
$b = $database->adminlogin($email,$encrypted_password,$sess_id,$role);
switch ($b){
    case "true";
    //$all = $bank->fetchassoc();
    //$_SESSION['my_id'] = $all;
    //$_SESSION['a'] = '1234';
    header('Location: adminhomepage.php');
    exit();
    break;
    case "false";
    
    $o_error = "The email and password combination is incorrect";
    
    break;
    default:
    $o_error = "The email password combination is incorrect";
    }
  }else{
	$o_error = "All fields are required";

  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Login </title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="Login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="Login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="Login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Login/css/util.css">
	<link rel="stylesheet" type="text/css" href="Login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('shoplite.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Admin Login
				</span>
				<div style="color: red;"><?php echo $o_error?></div>
				<form method='post' class="login100-form validate-form p-b-33 p-t-5">
					<div style="color: red;"><?php echo $emailErr?></div>
					<div class="wrap-input100 validate-input" data-validate = "Enter email">
						<input class="input100" type="text" name="email" placeholder="Email Here">
						<span class="focus-input100	" data-placeholder="&#xe82a;"></span>
					</div>
					<div style="color: red;"><?php echo $passwordErr?></div>
					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>


					<div class="container-login100-form-btn m-t-32">
						<input type="submit" name="submit" class="login100-form-btn"	 value="Login">
					</div>
                    <p allign="center">
                    </p>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>