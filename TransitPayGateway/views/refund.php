<?php
session_start();
include ("../config/dbconnect.php");
include ("../model/CheckOut.php");
include ("../model/Interactions.php");
$database = new Database;
$db = $database->connect();
$checkout = new CheckOut($db);
$interact = new Interaction($db);
if (!isset($_SESSION['jwt'])){
header('Location: unauthorized.php');   
//header('X_PHP_Response_Code: 401', true, 401);

}
else{
	$product_id = $_SESSION['product_id'];

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Check Out</title>
		<link rel="stylesheet" href="../styles/checkoutstyle.css" />
		<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">



	</head>
	<body>
        <?php
?>    
    <section id="topbar" class="d-flex align-items-center">
    <div class="container1 d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
      </div>
    </div>
  </section>
   
		<div class="container">

		
        <div class="replaced"><h3><img style="width: 50px; height: 25px;" src="../images/warp.png"> Log In</h3> <a href="stop_payment.php" style="color: black;"><label id="close" >
				<span class="las la-chevron-circle-left" id="close1"></span>Cancel Refund</label></a>
				<div class="error"></div>
				<form class ="form" method="post"> <div class="input">Email address<input class="binput" type="text" name="acc_number" placeholder="Enter Email"></div>
				 <div class="input">Password<input class="binput" type = "password" name = "password" placeholder = "Enter password"></div>
    			<button type="button" onclick="submitForm1();  removebtn();" name= "submit" value="SUBMIT" id="sub" >Log In </button>
          </div> </form> </div>
		</div>
		
		<div class="center">
				<p class="spinner" id="spinner"><img src="../images/1484.gif" alt="Computer man"></p>

				</div>
				
		
       
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
<script>
	document.onreadystatechange = function() {
            if (document.readyState !== "complete") {
                document.querySelector(
                  "body").style.visibility = "hidden";
                document.querySelector(
                  "#spinner").style.visibility = "visible";
            } else {
                document.querySelector(
                  "#spinner").style.display = "none";
				  document.querySelector(
                  ".center").style.visibility = "none";
                document.querySelector(
                  "body").style.visibility = "visible";
            }
        };
</script>
	</body>
</html>
<script>
		
		function submitForm1(){
			
			var account_number = $('input[name=acc_number]').val();
			var password = $('input[name=password]').val();
			//var password = md5(b_password);
			if(account_number != '' && password != ''){
				var formData = {account_number: account_number, password: password};
                $.ajax({url: "../includes/check_login.php", type:'POST',data: formData, dataType: "text",beforeSend: function () {
					$('#sub').replaceWith( '<div class="center">\
				<p class="spinner" id="spinner"><img src="../images/Hourglass.gif" alt="Computer man"></p></div>');
}, success: function(response){
					
					console.log(response);
					switch (response){
    					case "true":
							$('.right').replaceWith('<div class="right column"><div class="logged">Logged In</div><a href="stop_payment.php"><label id="close" for="closebutton">\
				<span class="las la-chevron-circle-left" id="close1"></span>Cancel</label></a>\
						<div class="error"></div>\
						<div class="form">\
                		<div class="form-row2">\
                		<div>Total Price</div>\
						<span id="p">&#8373  </span>\
                		</div>\
            		    <hr>\
							</div>\
							<div><button class="check_balance" id="check_balance" onclick="balance(); recipient();" >Check Balance</button></div>\
							<div id="message"></div>\
							<br>\
							<br>\
							<div id="recipient"></div>\
							<div><button  id="pay_amount" onclick="refund();">Make Refund</button></div>\
							</div>\
							');
							$.getScript("check_b.js", );
							
    					break;
    					case "false":
							$('.error').replaceWith("<div class='error'> Your Email and Password combo is invalid </div>");
    					break;
					}
                 
				
				}
			});
			 
	}else{
			$('.error').replaceWith("<div class='error'>All fields are required</div>");

		}
	}

	function balance(){
		var password = "";
				var formData = {password: password};
                $.ajax({url: "../includes/balance.php", type:'POST',data: formData, dataType: "text", success: function(response){			
					var obj = JSON.parse(response);
					var re = $('<div class="message" id="message">Your balance is &#8373 	'+obj['balance']+'</div>');
			$('#message').replaceWith(re);
				}
	});
		}
		function removebtn(){
			$('.error').replaceWith("<div class='noterror'>OTP will be sent if Credentials are correct <div>");
				}
		function recipient(){
            var p_id = '<?= $product_id; ?>';
		var password = "";
				var formData = {password: password};
                $.ajax({url: "../includes/recipient.php", type:'POST',data: formData, dataType: "text", success: function(response){			
					var obj = JSON.parse(response);
					var re = $("<div class='recipient' id='recipient'>Refunding &#8373 " + p_id + " from " +obj['firstname'] +" Account Number( " + obj['bank_account_number']+ " )</div>");
			$('#recipient').replaceWith(re);
				}
	});
		}
		
		function refund(){
		var p_id = '<?= $product_id; ?>';
		var int_p_id =  parseInt(p_id);

			
				var formData = {int_p_id: int_p_id};
                $.ajax({url: "../includes/to_refund.php", type:'POST',data: formData, dataType: "text", success: function(response){	
				switch(response){
					case 'true':
						$('.right').replaceWith("<div class='right column'><div class='logged'>Complete</div>\
						<div class='error'></div>\
						<div class='form'>\
                		<div class='form-row2'>\
						<i class='las la-check-circle'></i>\
						<div>REQUEST WAS SUCCESSFUL</div>\
                		</div>\
						<div> Head back to the Issuing page</div>\
							</div>\
							");
							//window.history.go(-1);
							setTimeout(window.open("stop_payment.php"),6000);	
					break;
					case 'false':
						$('.error').replaceWith("<div class='error'>Payment Error</div>");
						setTimeout(window.open("stop_payment.php"),6000);
					break;
					case 'not_enough':
						$('.error').replaceWith("<div class='error'>Insufficient balance error</div>");
				}
				}
			});
			}
		function clickEvent(first,last){
			if(first.value.length){
				document.getElementById(last).focus();
			}
		}
		
</script>
<?php
}
?>