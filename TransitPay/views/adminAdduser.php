<?php
session_start();
include ("../config/dbconnect.php");
include ("../model/Interactions.php");
include ("../model/Bank.php");
$database = new Database;
$db = $database->connect();
$interact = new Interaction($db);
$id = $_SESSION['my_id'];
$user_data = $interact->check_login($id);
$all = $interact->fetchassoc();
$obj = json_decode($all);
$interact->requester_id = $obj->bank_account_number;


$firstnameErr = $lastnameErr = $phonenumberErr = $emailErr = $passwordErr = $o_error =  ""; 
$firstname = $lastname = $phonenumber = $email = $password = "";
if(isset($_POST['submit'])){
    if (empty($_POST["firstname"])) {
        $firstnameErr = "First name is required";
      } else {
        $firstname = $_POST["firstname"];
      }
      if (empty($_POST["lastname"])) {
        $lastnameErr = "Last name is required";
      } else {
        $lastname = $_POST["lastname"];
      }
      if (empty($_POST["phonenumber"])) {
        $phonenumberErr = "Phone number is required";
      } else {
        $phonenumber = $_POST["phonenumber"];
      }
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
      $repeatpassword = $_POST["repeatpassword"];


if(!empty($firstname) && !empty($lastname) && !empty($phonenumber) && !empty($email) && !empty($password)){
    if($password === $repeatpassword){

$bank = new Bank($db);
$bank_account_number = rand(100000,999999);
$arrears = rand(0, 2000);
$encrypted_password = md5($password);
$positon = "user";

$bank->bank_account_number = $bank_account_number;
$bank->firstname = $firstname;
$bank->lastname = $lastname;
$bank->phone_number = $phonenumber;
$bank->email = $email;
$bank->password = $encrypted_password;
$bank->arrears = $arrears;
$bank->position = $positon;

 $b = $bank->checkemail();
switch ($b){
    case "true":
    $create = $bank->createuser();
    switch ($create){
        case true:
        // header('Location: main.php');
        echo '<script>alert("User Created Successfully")</script>';
        break;
        case false:
        $o_error = "The email has already been used";
        break;
        default:
        $o_error = "The email password combination is incorrect";
    }
break;
    case "false":
    $o_error = "The email has already been used ";
    break;
    default:
    $o_error = "The email has already been used";
}
}else{    $o_error = "The passwords do not match";}
    
    }
}
?>

<html>
    <head>
    <link rel="shortcut icon" type="image" href="../images/lifeline.png">
        <title>Transfer Life Line Bank </title>
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
        <link rel="stylesheet" type="text/css" href="../styles/mainpage.css">
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    </head>
    <body>
    <input type="checkbox" id="nav-toggle" onclick="lock();" >
	<div class="sidebar">
		
		<div class="sidebar-menu">
			<ul>

				<li><a href="adminMain.php"><span class="las la-bars"></span><span>Dashboard</span></a></li>
				<li><a href="adminArrears.php"><span class="las la-file-invoice-dollar"></span><span>View Arrears</span></a></li>
				<li><a href="adminPending.php"><span class="las la-hourglass-half"></span><span>Pending Refunds</span></a></li>
				<li><a href="adminHistory.php"><span class="las la-history"></span><span>All Transaction History</span></a></li>
				<li><a href="adminAdduser.php" class="active"><span class="las la-plus"></span><span>Add New User</span></a></li>
				<li><a href="adminDeposit.php"><span class="las la-check-circle"></span><span>Completed Refunds</span></a></li>
				<li><a href="adminU_profile.php"><span class="las la-user-circle"></span><span>Account & Settings</span></a></li>
				<li><a href="adminlogout.php"><span class="las la-sign-out-alt"></span><span>Logout</span> </a></li>
			</ul>
		</div>
	</div>
    <div class="main-content">
	<header>
		<div class="h4">
			<label for="nav-toggle">
				<span class="las la-unlock" id="lock"></span>
			</label>
			Click to <b style="color:red">lock</b>/<b style="color:green">unlock</b> dashboard menu
</div>
<h2 id="account">ADD USER</h2>
<div id="account"> ADMIN DASHBOARD</div>
<!-- <div id="account">Account No: <?php echo $obj->bank_account_number;?></div>	 -->		
<div class="user-wrapper">
				
				<p id="greeting"></p>
				<!-- <p id="balance">Current balance: &#8373 <b><?php echo $obj->balance;?></b></p> -->
				
			</div>
			<div class="user-wrapper">
			Welcome Admin <?php echo $obj->firstname; echo '&nbsp'. $obj->lastname; ?>
				
			
				 
			</div>
	</header>
    </div>
	<br>
	<main>
    <div class="incorrect"><?php echo $o_error?></div>
            <div class="form">
               
                <form method="post">
                <h1>Complete the form </h1>
                <br>
                    <span id="repeat_error" ></span>
                    <br>
                
                    <div class="input">
                    <span class="error"> <?php echo $firstnameErr;?></span>
                    <input class="in" type="text" name="firstname" placeholder="Enter First name">
                    </div>
                    <div class="input">
                    <span class="error"> <?php echo $lastnameErr;?></span>
                    <input class="in" type="text" name="lastname" placeholder="Enter Last name">
                    </div>
                    <div class="input">
                    <span class="error"> <?php echo $phonenumberErr;?></span>
                    <input class="in" type="number" name="phonenumber" placeholder="Enter Phone Number">
                    </div>
                    <div class="input">
                    <span class="error"> <?php echo $emailErr;?></span>
                    <input class="in" type="email" name="email" placeholder="Enter email">
                    </div>
                    <div class="input">
                    <span class="error"> <?php echo $passwordErr;?></span> 
                    <input class="in" type="password" name="password" id="firstpassword" onkeyup="check()" placeholder="Enter Password">
                    <input type="button" id="showpassword"  onclick="show()" style="display: none;">  
                    <label for="showpassword">
				<span class="las la-eye" id="show"></span>
			</label>
                  </div>
                    
                    <div class="input">
                    <span class="error"> <?php echo $passwordErr;?></span>
                    <input class="in" type="password" name="repeatpassword" id="secondpassword" onkeyup="check()" placeholder="Repeat Password">
                    </div>
                    
                    
                    <div class="binput">
                    <input class="but" type="submit" name="submit" value="Sign up" onclick="confirm('Are you sure ?')">
                    </div>
                </form>
            </div>	</main>
	
    </body>
    <script>
   
var check = function() {
  if (document.getElementById('secondpassword').value ==
    document.getElementById('firstpassword').value) {
    document.getElementById('repeat_error').style.color = 'white' ;
    document.getElementById('repeat_error').innerHTML = 'Passwords are matching';
    document.getElementById('repeat_error').style.background = '#52cc00';
    document.getElementById('repeat_error').style.borderRadius = '30px';
    
  } else {
    document.getElementById('repeat_error').style.color = 'white';
    document.getElementById('repeat_error').style.background = '#EE4B2B';
    document.getElementById('repeat_error').style.borderRadius = '30px';
    document.getElementById('repeat_error').style.float = 'right';



    document.getElementById('repeat_error').innerHTML = 'Passwords are not matching';
  }
}
var show = function(){
    
    if(document.getElementById('firstpassword').type ==="password"){
      document.getElementById('firstpassword').type ="text";
      document.getElementById('show').className = "las la-eye-slash";

   }else if(document.getElementById('firstpassword').type ==="text"){
     document.getElementById('firstpassword').type ="password";
     document.getElementById('show').className = "las la-eye";

   }
  }

  
</script>

    <script type="text/javascript">
        function lock(){
        var unlock = document.getElementById('lock');
        switch (unlock.className){
            case "las la-unlock":
                unlock.className = "las la-lock";
                break;
            case "las la-lock":
                unlock.className = "las la-unlock";
                break;
        }
        }
		function callinside(){
			$(".replace").replaceWith
                    ("<div class='replaced'><h3>Internal Bank Transfer</h3><button type='button' onclick='closeform();' id='closebutton'  hidden></button> <label for='closebutton'>\
				<span class='las la-times-circle' id='close'></span></label>\
				<form class ='form' method='post'> <div class='input'>Amount to Transfer<input class='in' type='number' name='amount' placeholder='Enter Amount'></div>\
				 <div class='input'>Recipients Account Number<input class='in' type = 'number' name = 'b_account' placeholder = 'Enter bank account number'></div>\
				 <div class='input'>Reference<input class='in' type='text' name='reference' placeholder='Enter Reference'></div>\
				  <input type='hidden' name='account_number' value='<?php echo $obj->bank_account_number; ?>'><div class='but'>\
    			<button type='button' onclick='submitForm1();' name= 'submit' value='SUBMIT' id='sub' >Send Money</button>\
          </div> </form> </div>")
		}
		function calloutside(){
			$(".replace").replaceWith
                    ("<div class='replaced'><h3>External Bank Transfer</h3><button type='button' onclick='closeform();' id='closebutton'  hidden></button> <label for='closebutton'>\
				<span class='las la-times-circle' id='close'></span></label>\
				</label><form class ='form' method='post'> <div class='input'>Amount to Transfer<input class='in' type='number' name='amount' placeholder='Enter Amount'></div>\
				 <div class='input'>Select Recipients bank<select class='in' name='bank' id='b'><option value='none'>SELECT</option><option>d</option></select></div>\
				 <div class='input'>Recipients Account Number<input class ='in' type='number' name='recipient_id' placeholder='Enter Recipients Bank Account Number'></div>\
				 <div class='input'>Reference<input class = 'in' type='text' name='reference' placeholder='Enter Reference'></div>\
				 <input type='hidden' name='account_number' value='<?php echo $obj->bank_account_number; ?>'><div class='but'>\
    			<button type='button' onclick='submitForm2();' name= 'submit' value='SUBMIT' id='sub' >Send Money</button>\
          </div> </form></div>");
		}
		function closeform(){
			$(".replaced").replaceWith
                    ("<div class='replace'>\
					<input type='button' name='choice1' id='choice1' value='Transfer to Life line bank User' onclick='callinside()' hidden>\
					<label for='choice1'><div class='bcard'><div class='bcard-single'><span class='las la-file-import'>Internal Transfer</span></div></label><label for='choice2'><div class='bcard-single'>\
					<span class='las la-external-link-alt'>External Transfer</span></div></div></label>\
					<input type='button' name='choice2' id='choice2' value='Transfer to other bank ' onclick='calloutside()' hidden>\
					</div>");
			
		}
		function submitForm1(){
			var c_balance = '<?=$obj->balance?>';
			c_balance = parseInt(c_balance);
			var amount = $('input[name=amount]').val();
			var actual = parseInt(amount);
			var bank_account = $('input[name=b_account]').val();
			var reference = $('input[name=reference]').val();
			var requester_id = $('input[name=account_number]').val();
			if(amount != '' && bank_account != '' && reference !=''){
				if(actual <= c_balance ){
				var formData = {amount: amount, bank_account: bank_account, reference: reference, requester_id: requester_id};
                $.ajax({url: "../includes/transfer2form.php", type:'POST',data: formData, dataType: "text", success: function(response){
					
					console.log(response);
					switch (response){
    					case "true":
							$('.replaced').replaceWith("<div>Internal Transfer DONE</div>");
    					break;
    					case "false":
							$('.replaced').replaceWith("<div>Internal transfer ERROR</div>");
    					break;
					}
                 
				
				}
			});
			 
		}else if(actual >= c_balance){
			console.log(amount);
			console.log(c_balance);
			
			$('.replaced').append("<div>Insufficient Balance</div>");

		}}else{
			$('.replaced').append("<div>All fields are required</div>");

		}
	}
		function submitForm2(){
			var c_balance = '<?=$obj->balance?>';
			c_balance = parseInt(c_balance);
			var amount = $('input[name=amount]').val();
			var actual = parseInt(amount);
			var bank = $('input[name=recipient_id]').val();
			var reference = $('input[name=reference]').val();
			var requester_id = $('input[name=account_number]').val();
			
			if(amount != '' && bank != '' && reference !=''){
				if(actual <= c_balance ){
				var formData = {amount: amount, bank: bank ,reference: reference, requester_id: requester_id};
				$.ajax({url: "../includes/transfer1form.php", type:'POST',data: formData, dataType: "text", success: function(response){
					
					console.log(response);
					switch (response){
    					case "true":
							$('.replaced').replaceWith("<div>External transfer DONE</div>");
    					break;
    					case "false":
							$('.replaced').replaceWith("<div>External transfer ERROR</div>");
    					break;
					}
                 
				
				}
			});
			 
		}else if(actual >= c_balance){
			$('.replaced').append("<div>Insufficient Balance</div>");

		}}
		else{
			$('.replaced').append("<div>Empty</div>");

		}
		}
		var today = new Date();
		let hour = today.getHours();
		
		let paragraph = document.getElementById("greeting");
		
		if(hour <=11 ){
			greeting="Good Morning";
		}
		if (hour <=18){
			greeting="Good Afternoon";
		}
		else if (hour > 18){
			greeting="Good Evening";
		}
		else{greeting = "Hello";}

		paragraph.innerHTML = greeting;
	</script>
</html>