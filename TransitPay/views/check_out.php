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
	$amount = $_SESSION['amount']	;
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
    
    <section id="topbar" class="d-flex align-items-center">
    <div class="container1 d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
      </div>
    </div>
  </section>
   
		<div class="container">
		
			<div class="right column">
			<a href='stop_payment.php'><label id='stop'>
				<span class='las la-window-close' id='close1'></span>Cancel Payment</label></a>
			<br>
			<br>
			<br><div class="nav">
					
					<div class="nav-item active">Proceed To Pay</div>
				</div>
				<div class="card-img">
					<!--<img src="card.png" alt="" />-->
				</div>
				<div class="form">
                <div class="form-row2">

                
                <div>Total Price</div>
				<span id="p">&#8373 <?php echo $amount;?></span>
                
                </div>
                <hr>
					
						
					
					
                    <!---->
				</div>
				<div class="center">
				<p class="spinner" id="spinner"><img src="../images/1484.gif" alt="Computer man"></p>

				</div>
				
				<br>
				<div class="btn">

					<button id="myBtn" onclick="loginForm();">Pay with Cash Warp<br><br><img style="width: 100px; height: 50px;" src="../images/warp.png"></button>
				</div>
				<div class="center">
                <div class="price">

					OR
				</div>
				</div>
				<br>
				<form class="form1" method="post">
				<div class="center">Pay with Card</div>
				<div class="card-img">
					<img src="card.png" alt="" />
				</div>
				
					<div class="input">Card Number
					<input class="binput" type="text" name="card_number" placeholder="card number">
					</div>
					<div class="input">Name on Card
					<input class="binput" type="text" name="card_name" placeholder="Name on card">
					</div>
					<div class="input">
					<input class="cinput" type="password" name="security_code" placeholder=" security_code">
					
					<input class="cinput" type="date" name="expiry" placeholder=" expiry date">
					</div>
					<div>
					<button id="myBtn">Pay</button>
					</div>
				</form>
				
			</div>
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
	function loginForm(){
			$(".right").replaceWith
                    ("<div class='replaced'><h3><img style='width: 50px; height: 25px;' src='../images/warp.png'> Log In</h3><button type='button' onclick='closeform();' id='closebutton'  hidden></button> <label id='close' for='closebutton'>\
				<span class='las la-chevron-circle-left' id='close1'></span>Back</label>\
				<div class='error'></div>\
				<form class ='form' method='post'> <div class='input'>Email address<input class='binput' type='text' name='acc_number' placeholder='Enter Email'></div>\
				 <div class='input'>Password<input class='binput' type = 'password' name = 'password' placeholder = 'Enter password'></div>\
    			<button type='button' onclick='submitForm1();  removebtn()' name= 'submit' value='SUBMIT' id='sub' >Log In </button>\
          </div> </form> </div>")
		}
		function closeform(){
			$(".replaced").replaceWith
                    ("<div class='right column'>\
					<a href='stop_payment.php'><label id='stop'>\
				<span class='las la-window-close' id='close1'></span>Cancel Payment</label></a>\
				<br>\
				<br>\
				<div class='nav'>\
					<div class='nav-item active'>Proceed To Pay</div>\
				</div>\
				<div class='card-img'>\
					<!--<img src='card.png' alt='' />-->\
				</div>\
				<div class='form'>\
                <div class='form-row2'>\
                <div>Total Price</div>\
				<span id='p'>&#8373 <?php echo $amount;?></span>\
                </div>\
                <hr>\
				</div>\
				<br>\
				<div class='btn'>\
				<button id='myBtn' onclick='loginForm();'>Pay with Cash Warp<br><br><img style='width: 100px; height: 50px;' src='../images/warp.png'></button>\
				</div>\
				<div class='center'>\
                <div class='price'>\
					OR\
				</div>\
				</div>\
				<br>\
				<form class='form1' method='post'>\
				<div class='center'>Pay with Card</div>\
				<div class='card-img'>\
					<img src='card.png' alt='' />\
				</div>\
					<div class='input'>Card Number\
					<input class='binput' type='text' name='card_number' placeholder='card number'>\
					</div>\
					<div class='input'>Name on Card\
					<input class='binput' type='text' name='card_name' placeholder='Name on card'>\
					</div>\
					<div class='input'>\
					<input class='cinput' type='password' name='security_code' placeholder='security_code'>\
					<input class='cinput' type='date' name='expiry' placeholder='expiry date'>\
					</div>\
					<div>\
					<button id='myBtn' >Pay</button>\
					</div>\
				</form>\
			</div>");
			
		}
		
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
							$('.replaced').replaceWith('<div class="right column"><a href="cancelled.php"><label id="close" for="closebutton">\
				<span class="las la-chevron-circle-left" id="close1"></span>Cancel</label></a>\<h1>ENTER OTP</h1><div class="error"></div>\
	  <div class="userInput">\
        <input name ="one" class="otpinput" type="text" data-maxlength="1"  oninput="this.value=this.value.slice(0,this.dataset.maxlength)" id="ist" onkeyup="clickEvent(this,sec)"/>\
        <input name ="two" type="text" data-maxlength="1" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" id="sec"  class="otpinput" onkeyup="clickEvent(this,third)"/>\
        <input name ="three" type="text" data-maxlength="1" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" id="third"  class="otpinput"  onkeyup="clickEvent(this,fourth)"/>\
        <input name ="four" type="text" data-maxlength="1" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" id="fourth"  class="otpinput" onkeyup="clickEvent(this,fifth)"/>\
        <input name ="five" type="text" id="fifth" data-maxlength="1" oninput="this.value=this.value.slice(0,this.dataset.maxlength)"  class="otpinput" onkeyup="clickEvent(this,sixth)"/>\
        <input name ="six" type="text" data-maxlength="1" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" id="sixth"  class="otpinput" />\
      </div>\
      <br />\
      <button id="btn2" onclick="submit_otp();">CONFIRM</button></div>');
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
		var password = "";
				var formData = {password: password};
                $.ajax({url: "../includes/recipient.php", type:'POST',data: formData, dataType: "text", success: function(response){			
					var obj = JSON.parse(response);
					var re = $('<div class="recipient" id="recipient">Sending &#8373 <?php echo $amount;?> to	'+obj['firstname']+'&nbsp'+ obj['lastname']+'(Account No.- '+obj['bank_account_number']+')</div>');
			$('#recipient').replaceWith(re);
				}
	});
		}
		function submit_otp(){
			var one = $('input[name=one]').val();
			var two = $('input[name=two]').val();
			var three = $('input[name=three]').val();
			var four = $('input[name=four]').val();
			var five = $('input[name=five]').val();
			var six = $('input[name=six]').val();
				var formData = {one: one, two: two, three: three, four: four, five: five, six: six};
                $.ajax({url: "../includes/submit_otp.php", type:'POST',data: formData, dataType: "text",beforeSend: function(){
					$('#btn2').off();
				}, success: function(response){	
					console.log(response);
					switch (response){
    					case "atrue":
				$('.right').replaceWith('<div class="right column"><div class="logged">Logged In</div><a href="cancelled.php"><label id="close" for="closebutton">\
				<span class="las la-chevron-circle-left" id="close1"></span>Cancel</label></a>\
						<div class="error"></div>\
						<div class="form">\
                		<div class="form-row2">\
                		<div>Total Price</div>\
						<span id="p">&#8373 <?php echo $amount;?></span>\
                		</div>\
            		    <hr>\
							</div>\
							<div><button class="check_balance" id="check_balance" onclick="balance(); recipient();" >Check Balance</button></div>\
							<div id="message"></div>\
							<br>\
							<br>\
							<div id="recipient"></div>\
							<div><button  id="pay_amount" onclick="pay();">Pay Amount</button></div>\
							</div>\
							');
							$.getScript("check_b.js", );
							
							break;
							case "afalse":
								$('.error').replaceWith("<div class='error'>Wrong OTP</div>");
							break;
							case "empty":
								$('.error').replaceWith("<div class='error'>Empty</div>")
						}	
			}	
		});
		}
		function pay(){
		var amount_to = '<?= $amount; ?>';
		var amount_to_pay =  parseInt(amount_to);

			
				var formData = {amount_to_pay: amount_to_pay};
                $.ajax({url: "../includes/to_validate.php", type:'POST',data: formData, dataType: "text",beforeSend: function(){
					$('#pay_amount').off();
				} ,success: function(response){	
				switch(response){
					case 'true':
						$('.right').replaceWith("<div class='right column'><div class='logged'>Complete</div>\
						<div class='error'></div>\
						<div class='form'>\
                		<div class='form-row2'>\
						<i class='las la-check-circle'></i>\
						<div>PAYMENT WAS SUCCESSFUL</div>\
                		</div>\
						<div> Head back to Issuing page</div>\
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
						$('.error').replaceWith("<div class='error'>Insufficient balance</div>");
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