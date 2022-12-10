<?php
session_start();
include ("../config/dbconnect.php");
include ("../model/Interactions.php");
$database = new Database;
$db = $database->connect();
$interact = new Interaction($db);
$id = $_SESSION['my_id'];
$user_data = $interact->check_login($id);
$all = $interact->fetchassoc();
$obj = json_decode($all);


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

				<li><a href="main.php" ><span class="las la-bars"></span><span>Dashboard</span></a></li>
				<li><a href="transfer.php" ><span class="las la-exchange-alt"></span><span>Transfer Money</span></a></li>
				<li><a href="pending.php"><span class="las la-hourglass-half"></span><span>Pending Transactions</span></a></li>
				<li><a href="history.php"><span class="las la-history"></span><span>Transaction History</span></a></li>
				<li><a href="deposit.php" class="active"><span class="las la-piggy-bank"></span><span>Deposit</span></a></li>
				<li><a href="u_profile.php"><span class="las la-user-circle"></span><span>Account & Settings</span></a></li>
				<li><a href="logout.php"><span class="las la-sign-out-alt"></span><span>Logout</span> </a></li>
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
<h2 id="account">Deposit</h2>
<div id="account">Account No: <?php echo $obj->bank_account_number;?></div>			<div class="user-wrapper">
				
				<p id="greeting"></p>
				<p id="balance">Current balance: &#8373 <b><?php echo $obj->balance;?></b></p>
				
			</div>
			<div class="user-wrapper">
			 <?php echo $obj->firstname; echo '&nbsp'. $obj->lastname; ?>
				
			
				 
			</div>
			
	</header>
    </div>
	<br>
	<main>
	<div class="recent-grid">
			<div class="projects">
				<div class="card">
					<div class="replace">
					<input type="button" name="choice1" id="choice1" value="Transfer to Life line bank User" onclick="callinside()" hidden>
					<label for="choice1"><div class="bcard2"><div class="bcard-single2">Make Deposit<span class="las la-piggy-bank"></span></div></label>
					</div>
				</div>
			</div>
	</div>
	</main>
	
    </body>
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
                    ("<div class='replaced'><h3>Make Deposit</h3><button type='button' onclick='closeform();' id='closebutton'  hidden></button> <label for='closebutton'>\
				<span class='las la-times-circle' id='close'></span></label>\
				<form class ='form' method='post'> <div class='input'>Amount to Deposit<input class='in' type='number' name='amount' placeholder='Enter Amount'></div>\
				 <div class='input'>Reference<input class='in' type='text' name='reference' placeholder='Enter Reference'></div>\
				  <input type='hidden' name='account_number' value='<?php echo $obj->bank_account_number; ?>'><div class='but'>\
    			<button type='button' onclick='submitForm1();' name= 'submit' value='SUBMIT' id='sub' >Send Money</button>\
          </div> </form> </div>")
		}
		
		function closeform(){
			$(".replaced").replaceWith
                    ("<div class='replace'>\
					<input type='button' name='choice1' id='choice1' value='Transfer to Life line bank User' onclick='callinside()' hidden>\
					<label for='choice1'><div class='bcard2'><div class='bcard-single2'>Make Deposit<span class='las la-piggy-bank'></span></div></label>\
					</div>");
			
		}
		function submitForm1(){
			var c_balance = '<?=$obj->balance?>';
			c_balance = parseInt(c_balance);
			var amount = $('input[name=amount]').val();
			var actual = parseInt(amount);
			var bank_account = $('input[name=account_number]').val();
			var reference = $('input[name=reference]').val();
			var requester_id = $('input[name=account_number]').val();
			var balance = '<?=$obj->balance?>';

			if(amount != '' && bank_account != '' && reference !=''){
				
				var formData = {amount: amount, bank_account: bank_account, reference: reference, requester_id: requester_id, balance: balance};
                $.ajax({url: "../includes/depositform.php", type:'POST',data: formData, dataType: "text", success: function(response){
					
					console.log(response);
					switch (response){
    					case "true":
							$('.replaced').replaceWith("<div>Deposit Completed</div>");
							 
    					break;
    					case "false":
							$('.replaced').replaceWith("<div>Deposit Error</div>");
    					break;
					}
                 
				
				}
			});
			 
		}else{
			$('.replaced').append("<div>All fields are required</div>");

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