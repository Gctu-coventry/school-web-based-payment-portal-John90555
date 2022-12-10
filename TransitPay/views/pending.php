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

				<li><a href="main.php" ><span class="las la-bars"></span><span>Dashboard</span></a></li>
				<li><a href="transfer.php" ><span class="las la-exchange-alt"></span><span>Transfer Money</span></a></li>
				<li><a href="pending.php" class="active"><span class="las la-hourglass-half"></span><span>Pending Transactions</span></a></li>
				<li><a href="history.php" ><span class="las la-history"></span><span>Transaction History</span></a></li>
				<li><a href="deposit.php"><span class="las la-piggy-bank"></span><span>Deposit</span></a></li>
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
<h2 id="account">Pending Transaction</h2>
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
    <?php if($interact->countPending() >= 1 ){ ?>

    <div class="recent-grid">
			<div class="projects">
				<div class="card">
					<div class="card-header">
						<h2>Pending Transactions </h2>
					</div>
					<div class="card-body">

					<div class="table-responsive">
									<table width="100%">
							<thead>
								<tr>
									<td>Transaction ID</td>
									<td>Recipient ID</td>
									<td>Amount</td>
									<td>Time Requested</td>
									<td>Approve</td>
									<td>Decline</td>
								</tr>
							</thead>
							<tbody>
																
								<?php echo $interact->pending(); }else{?><div class="nothing"><?php echo "No Pending Transactions";?></div><?php }?>
								
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
		$('.approve').click(function(){
			var id = this.id;
			$.ajax(
            {
                   type: "POST",
                   url: "../includes/approve_pending.php",
                   data: {id:id},
                   success: function(response)
                   {}
			})
		})
		$('.decline').click(function(){

})
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