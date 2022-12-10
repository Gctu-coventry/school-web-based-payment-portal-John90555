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
        <title>Dashboard- Life Line Bank </title>
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
				<li><a href="adminAdduser.php"><span class="las la-plus"></span><span>Add New User</span></a></li>
				<li><a href="adminDeposit.php"><span class="las la-check-circle"></span><span>Completed Refunds</span></a></li>
				<li><a href="adminU_profile.php" class="active"><span class="las la-user-circle"></span><span>Account & Settings</span></a></li>
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
	<main>
    <div class="recent-grid">
			<div class="projects">
				<div class="card">
					<div class="replace">
					<input type="button" name="choice1" id="choice1" value="Transfer to Life line bank User" onclick="content();" hidden>
					<label for="choice1"><div class="bcard2"><div class="bcard-single2">Show API Key<span class="las la-eye"></span></div></label>
					</div>
                   
				</div>
			</div>
	</div>
	<div class="recent-grid">
		<div class="projects">
	<div class="card" style="padding: 2%;">
	Your Api Key is:
	<div style="padding:3%;" id="content">**************</div>
	</div>
		</div>
	</div>
    </main>
	
    </body>
    <script type="text/javascript">

function copytext() {
  /* Get the text field */
  var copyText = document.getElementById("copy").innerText;

  /* Select the text field */
  //copyText.select();

   /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText);

  /* Alert the copied text */
  alert("Copied the text: " + copyText);
}


		function content(){
			var c_api_key = '<?=$obj->api_key?>';
			$("#content").replaceWith
                    ("<div id='content' style='padding:3%;'> <div id='hide' style='display:none;' onclick='copytext();'>Click to copy</div><label for = 'copyit' ><span class='las la-clipboard' style='font-size: 2em;' onMouseOver='c_text();' onmouseout='no_c_text();'></span></label><i id='copy' onclick='copytext();' onMouseOver='c_text();' onmouseout='no_c_text();'> "+c_api_key+" </i><button id='copyit' onclick='copytext();' hidden>Yo</button><button type='button' onclick='closeform();' id='closebutton'  hidden></button>\
				</div>")
			$(".replace").replaceWith
			("<div class='replace'>\
			<input type='button' name='choice1' id='choice1' value='' onclick='closeform();' hidden>\
			<label for='choice1'><div class='bcard2'><div class='bcard-single2'>Hide API Key<span class='las la-eye-slash'></span></div></label>\
			</div>")
		}
		function c_text(){
			document.getElementById("hide").style.display = "block";
		}
		function no_c_text(){
			document.getElementById("hide").style.display = "none";
		}
		function closeform(){
			$("#content").replaceWith
                    ("<div id='content' style='padding:3%;'>*********</div>");
					
			$(".replace").replaceWith
			("<div class='replace'>\
			<input type='button' name='choice1' id='choice1' value='' onclick='content();' hidden>\
			<label for='choice1'><div class='bcard2'><div class='bcard-single2'>Show API Key<span class='las la-eye'></span></div></label>\
			</div>")
			
		}
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