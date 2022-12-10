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
$interact->requester_id = $obj->bank_account_number;


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
				<li><a href="adminHistory.php" class="active"><span class="las la-plus"></span><span>All Transaction History</span></a></li>
				<li><a href="adminAdduser.php"><span class="las la-history"></span><span>Add New User</span></a></li>
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
<h2 id="account">History</h2>
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
    <?php if($interact->admincountPending() >= 1 ){ ?>

    <div class="recent-grid">
			<div class="projects">
				<div class="card">
					<div class="card-header">
						<h2>All Transaction History</h2>
					</div>
					<div class="card-body">

					<div class="table-responsive">
									<table width="100%">
							<thead>
								<tr>
									<td>Transaction ID</td>
									<td>Recipient ID</td>
									<td>Amount</td>
									<td>Status</td>
									<td>Time Requested</td>
                                    <td>Transaction Type</td>

								</tr>
							</thead>
							<tbody>
																
								<?php echo $interact->adminhistory(); }else{?><div class="nothing"><?php echo "No Transaction History";?></div><?php }?>
								
							</tbody>
						</table>
					</div>
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