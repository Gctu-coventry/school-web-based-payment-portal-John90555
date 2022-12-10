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
        <title>Admin HomePage | Life Line Bank </title>
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
        <link rel="stylesheet" type="text/css" href="../styles/mainpage.css">
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">


    </head>
    <body>
    <input type="checkbox" id="nav-toggle" onclick="lock();" >
	<div class="sidebar">
		
		<div class="sidebar-menu">
			<ul>

				<li><a href="adminMain.php" class="active"><span class="las la-bars"></span><span>Dashboard</span></a></li>
				<li><a href="adminArrears.php"><span class="las la-file-invoice-dollar"></span><span>View Arrears</span></a></li>
				<li><a href="adminPending.php"><span class="las la-hourglass-half"></span><span>Pending Refunds</span></a></li>
				<li><a href="adminHistory.php"><span class="las la-history"></span><span>All Transaction History</span></a></li>
				<li><a href="adminAdduser.php"><span class="las la-plus"></span><span>Add New User</span></a></li>
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
<h2 id="account">Dashboard</h2>
<div id="account"> ADMIN DASHBOARD</div>
<div id="account">Account No: <?php echo $obj->bank_account_number;?></div>		
<div class="user-wrapper">
				
				<p id="greeting"></p>
				 <p id="balance">Current balance: &#8373 <b><?php echo $obj->balance;?></b></p>
				
			</div>
			<div class="user-wrapper">
			Welcome Admin <?php echo $obj->firstname; echo '&nbsp'. $obj->lastname; ?>
				
			
				 
			</div>
	</header>
    </div>
	<main>

		<div class="cards">
		
		<a href="adminPending.php" style="text-decoration: none; color: black;">
			<div class="card-single">
				<div class="n">
					<span><?php 
  $c = curl_init(); 
  curl_setopt($c, CURLOPT_URL,'http://localhost/work/pendingRefundsCount.php');
  curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
  echo $page = curl_exec($c);
  if (curl_errno($c)) {
    $error_msg = curl_error($c);
  }
  curl_close($c);
?> Pending Refunds</span><span class="las la-hourglass-half"></span>
					<h1></h1>
				
				</div>
			</div>
		</a>
		
		</div>
		
		<br>
		<?php if($interact->count() >= 1 ){ ?>
		<a href="adminHistory.php" style="text-decoration: none; color: black;">
		 	<div class="recent-grid">
			<div class="projects">
				<div class="card">
					<div class="card-header">
						<h2>All Users History</h2>
					</div>
					<div class="card-body">

					<div class="table-responsive">
									<table width="100%">
							<thead>
								<tr>
									<td>Transaction ID</td>
									<td>Recipient Account Number</td>
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

		var today = new Date();
		let hour = today.getHours();
		
		let paragraph = document.getElementById("greeting");
		console.log(hour);
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