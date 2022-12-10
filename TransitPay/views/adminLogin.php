<?php
session_start();

include ("../model/Bank.php");
include ("../model/Interactions.php");
include ("../config/dbconnect.php");

$database = new Database;
$db = $database->connect(); 

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

$bank = new Bank($db);
$interact = new Interaction($db);
$encrypted_password = md5($password);

$role = "admin";

$bank->email = $email;
$bank->password = $encrypted_password;
$bank->role = $role;

$b = $bank->adminlogin($email,$password,$role);
switch ($b){
    case "true";
    $all = $bank->fetchassoc();
    $_SESSION['my_id'] = $all;
    header('Location: adminMain.php');
    exit();
    break;
    case "false";
    
    $o_error = "The email and password combination is incorrect";
    
    break;
    default:
    $o_error = "The email password combination is incorrect";
    }
  }
}
?>
<html>
    <head>
        <title>
            Admin Log In - TransitPay
        </title>
        <link rel="shortcut icon" type="image" href="../images/lifeline.png">
        <link rel="stylesheet" href="../styles/style.css">
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">


        </head>
        <body>
        <nav>
        TransitPay        <p>
            <a href="index.php">Home</a>
            <a href="signup.php" >Sign Up</a>
            <a href="login.php" class="active">Login</a>
        </p>
        </nav>
        <div style="overflow: hidden;">
  <svg
    preserveAspectRatio="none"
    viewBox="0 0 1200 120"
    xmlns="http://www.w3.org/2000/svg"
    style="fill: #7d5ba6; width: 100%; height: 57px;"
  >
    <path
    d="M0 0v46.29c47.79 22.2 103.59 32.17 158 28 70.36-5.37 136.33-33.31 206.8-37.5 73.84-4.36 147.54 16.88 218.2 35.26 69.27 18 138.3 24.88 209.4 13.08 36.15-6 69.85-17.84 104.45-29.34C989.49 25 1113-14.29 1200 52.47V0z"
    opacity=".25"
  />
    <path
      d="M0 0v15.81c13 21.11 27.64 41.05 47.69 56.24C99.41 111.27 165 111 224.58 91.58c31.15-10.15 60.09-26.07 89.67-39.8 40.92-19 84.73-46 130.83-49.67 36.26-2.85 70.9 9.42 98.6 31.56 31.77 25.39 62.32 62 103.63 73 40.44 10.79 81.35-6.69 119.13-24.28s75.16-39 116.92-43.05c59.73-5.85 113.28 22.88 168.9 38.84 30.2 8.66 59 6.17 87.09-7.5 22.43-10.89 48-26.93 60.65-49.24V0z"
      opacity=".5"
    />
    <path d="M0 0v5.63C149.93 59 314.09 71.32 475.83 42.57c43-7.64 84.23-20.12 127.61-26.46 59-8.63 112.48 12.24 165.56 35.4C827.93 77.22 886 95.24 951.2 90c86.53-7 172.46-45.71 248.8-84.81V0z" />
  </svg>
</div>  

        <div class="incorrect"><?php echo $o_error?></div>
            <div class="form">
                <form method="post" >
                <h1>Admin Log In</h1>
                    <div class="input">
                    <span class="error"> <?php echo $emailErr;?></span>
                    <input  class="in" type="email" name="email" placeholder="Enter email here" >
                    </div>
                    <div class="input">
                    <span class="error"> <?php echo $passwordErr;?></span>
                    <input class="in" type="password" name="password"  placeholder="Enter password here" id="firstpassword" >
                    <input type="button" id="showpassword"  onclick="show()" style="display: none;">  
                    <label for="showpassword"><div class="show">
				<span class="las la-eye" id="show"></span></div>
			</label>  
                  </div>
                    <div class="binput">
                    <input class="but" type="submit" name="submit" value="Login as Admin" onclick="confirm('Are you sure about the details you have entered?')">
                    </div>
                </form>
            </div>
            <br>
            <div style="overflow: hidden;">
  <svg
    preserveAspectRatio="none"
    viewBox="0 0 1200 120"
    xmlns="http://www.w3.org/2000/svg"
    style="fill: #7d5ba6; width: 100%; height: 57px; transform: rotate(180deg);"
  >
    <path
    d="M0 0v46.29c47.79 22.2 103.59 32.17 158 28 70.36-5.37 136.33-33.31 206.8-37.5 73.84-4.36 147.54 16.88 218.2 35.26 69.27 18 138.3 24.88 209.4 13.08 36.15-6 69.85-17.84 104.45-29.34C989.49 25 1113-14.29 1200 52.47V0z"
    opacity=".25"
  />
    <path
      d="M0 0v15.81c13 21.11 27.64 41.05 47.69 56.24C99.41 111.27 165 111 224.58 91.58c31.15-10.15 60.09-26.07 89.67-39.8 40.92-19 84.73-46 130.83-49.67 36.26-2.85 70.9 9.42 98.6 31.56 31.77 25.39 62.32 62 103.63 73 40.44 10.79 81.35-6.69 119.13-24.28s75.16-39 116.92-43.05c59.73-5.85 113.28 22.88 168.9 38.84 30.2 8.66 59 6.17 87.09-7.5 22.43-10.89 48-26.93 60.65-49.24V0z"
      opacity=".5"
    />
    <path d="M0 0v5.63C149.93 59 314.09 71.32 475.83 42.57c43-7.64 84.23-20.12 127.61-26.46 59-8.63 112.48 12.24 165.56 35.4C827.93 77.22 886 95.24 951.2 90c86.53-7 172.46-45.71 248.8-84.81V0z" />
  </svg>
</div>
        <footer class="footer">
			<p class="copyright1">TransitPay</p>
			<br>
			<div class="social">
				<a href="#" class="lab la-instagram"></a>
				<a href="#" class="lab la-facebook-f"></a>
				<a href="#" class="lab la-twitter"></a>
			</div>
			<ul class="list">
				<li><a href="#">Home</a></li>
				<li><a href="#">About</a></li>
				<li><a href="#">Terms</a></li>
				<li><a href="#">Privacy Policy</a></li>
			</ul>
			<p class="copyright">
      TransitPay 2022
			</p>
			
			<br>
		</footer>
        </body>
    
</html>


<script>
  var show = function(){
    
    if(document.getElementById('firstpassword').type ==="password"){
      document.getElementById('firstpassword').type ="text";
      document.getElementById('show').className = "las la-eye-slash";

   }else if(document.getElementById('firstpassword').type ==="text"){
     document.getElementById('firstpassword').type ="password";
     document.getElementById('show').className = "las la-eye";

   }
  }
var check = function() {
  if (document.getElementById('secondpassword').value ==
    document.getElementById('firstpassword').value) {
    document.getElementById('repeat_error').style.color = 'green' ;
    document.getElementById('repeat_error').innerHTML = 'Passwords are matching';
    
  } else {
    document.getElementById('repeat_error').style.color = 'red';
    document.getElementById('repeat_error').innerHTML = 'Passwords are not matching';
  }
}
  
</script>