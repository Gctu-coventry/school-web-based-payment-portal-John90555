<?php
session_start();
include ("../config/dbconnect.php");
include ("../model/CheckOut.php");
include ("../model/Interactions.php");
$database = new Database;
$db = $database->connect();
$checkout = new CheckOut($db);
$interact = new Interaction($db);
if (!isset($_SESSION['api_key'])){
header('Location: unauthorized.php');   
//header('X_PHP_Response_Code: 401', true, 401);

}
else{
	$amount = $_SESSION['amount'];
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
		
    
    <section id="topbar" class="d-flex align-items-center bg-blue-600">
    <div class="container1 d-flex justify-content-center justify-content-md-between bg-blue-600">
      <div class="contact-info d-flex align-items-center bg-blue-600">
      </div>
    </div>
  </section>
   
		<div class="container">
		
			<div class="right column bg-blue-600">
			Welcome to TransitPay	
			</div>
			<div class="counter" data-animation>
  <svg id="tracker" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
    <circle id="outer_circle" class="st0" cx="50%" cy="50%" r="var(--outer-radius, 2)" fill="none" stroke="#3F88C5" />
    <circle id="circle" class="circle_animation" cx="50%" cy="50%" r="var(--radius, 1)" stroke="#3F88C5" fill="none" />
    <circle id="inner_circle" class="st0" cx="50%" cy="50%" r="var(--inner-radius, 0.5)" fill="none" stroke="#3F88C5" />
  </svg>
  <span data-repetition=""></span>
  <div class="mypay" style="background-color: #ffffff; padding:10%; border-radius: 5%">Time to complete payment</div>

</div>
		</div>
		
		
		<!--
Include Tailwind JIT CDN compiler
More info: https://beyondco.de/blog/tailwind-jit-compiler-via-cdn
-->
<script src="https://unpkg.com/tailwindcss-jit-cdn"></script>

<!-- Specify a custom Tailwind configuration -->
<script type="tailwind-config">
{
  theme: {
    extend: {
      colors: {
        gray: colors.blueGray,
        pink: colors.fuchsia,  
      }
    }
  }
}
</script>

<!-- Snippet -->
<section class="flex flex-col justify-center antialiased bg-gray-200 text-gray-600 min-h-screen p-4">
    <div class="h-full">
        <!-- Card -->
        <div class="max-w-[360px] mx-auto">
            <div class="bg-white shadow-lg rounded-lg mt-9">
                <!-- Card header -->
                <header class="text-center px-5 pb-5">
                    <!-- Avatar -->
                    <svg class="inline-flex -mt-9 w-[72px] h-[72px] fill-current rounded-full border-4 border-white box-content shadow mb-3" viewBox="0 0 72 72">
                        <path class="text-gray-700" d="M0 0h72v72H0z" />
                        <path class="text-pink-400" d="M30.217 48c.78-.133 1.634-.525 2.566-1.175.931-.65 1.854-1.492 2.769-2.525a30.683 30.683 0 0 0 2.693-3.575c.88-1.35 1.66-2.792 2.337-4.325-1.287 3.3-1.93 5.9-1.93 7.8 0 2.467.914 3.7 2.743 3.7.508 0 1.084-.083 1.727-.25.644-.167 1.169-.383 1.575-.65-.474-.267-.812-.708-1.016-1.325-.203-.617-.305-1.392-.305-2.325 0-.833.11-1.817.33-2.95.22-1.133.534-2.35.94-3.65.407-1.3.898-2.658 1.474-4.075A71.574 71.574 0 0 1 48 28.45c0-.167-.127-.35-.381-.55a5.313 5.313 0 0 0-.94-.575 6.394 6.394 0 0 0-1.245-.45 4.925 4.925 0 0 0-1.194-.175 110.56 110.56 0 0 1-2.49 4.8c-.44.8-.872 1.567-1.295 2.3-.423.733-.804 1.4-1.143 2-1.83 3.033-3.387 5.275-4.675 6.725-1.287 1.45-2.421 2.275-3.404 2.475-.474-.167-.711-.567-.711-1.2 0-1.533.373-3.183 1.118-4.95a23.24 23.24 0 0 1 2.87-4.975c1.169-1.55 2.473-2.875 3.913-3.975s2.836-1.75 4.191-1.95c-.034-.3-.186-.658-.457-1.075a8.072 8.072 0 0 0-.99-1.225c-.39-.4-.797-.75-1.22-1.05-.424-.3-.805-.5-1.143-.6-1.39.067-2.829.692-4.319 1.875-1.49 1.183-2.87 2.658-4.14 4.425a26.294 26.294 0 0 0-3.126 5.75C26.406 38.117 26 40.083 26 41.95c0 1.733.39 3.158 1.169 4.275.779 1.117 1.795 1.708 3.048 1.775Z" />
                    </svg>
                    <!-- Card name --><div class="text-sm font-medium text-gray-500"></div>
                    <h3 class="text-xl font-bold text-white-900 bg-blue-600 mb-1">Proceed To Make Payment</h3>
                    
                </header>
				
                <!-- Card body -->
                <div class="bg-gray-100 text-center px-5 py-6">
                    <div class="text-sm mb-6"><strong class="font-semibold">&#8373 <?php echo $amount;?></strong><div>Order date:<div id="ti"></div></div> </div>
                    
                        <button type="submit" onclick="loginForm();" class="font-semibold text-sm inline-flex items-center justify-center px-3 py-2 border border-transparent rounded leading-5 shadow transition duration-150 ease-in-out w-full bg-blue-600 hover:bg-blue-400 text-white focus:outline-none focus-visible:ring-2">Pay Now</button>
						<br>
						<br>
						<div class="center">
						<a href='stop_payment.php'><label id='stop'>
				<span class='las la-window-close' id='close1'></span></label></a>
						</div>
			</div>
            </div>
        </div>
    </div>
</section>

<!-- More components -->


       
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
	// document.onreadystatechange = function() {
    //         if (document.readyState !== "complete") {
    //             document.querySelector(
    //               "body").style.visibility = "hidden";
    //             document.querySelector(
    //               "#spinner").style.visibility = "visible";
    //         } else {
    //             document.querySelector(
    //               "#spinner").style.display = "none";
	// 			  document.querySelector(
    //               ".center").style.visibility = "none";
    //             document.querySelector(
    //               "body").style.visibility = "visible";
    //         }
    //     };
</script>
	</body>
</html>
<script>

$(document).ready(function(){

const REPETITIONS = 30;
const DURATION = 1100;

const animated = document.querySelector(".circle_animation");
const spanRepetition = document.querySelector("span[data-repetition]");
const elem = document.querySelector(".counter");

spanRepetition.dataset.repetition = REPETITIONS;
elem.style.setProperty("--duration", `${DURATION}ms`);
elem.style.setProperty("--repetitions", `${REPETITIONS}`);

animated.addEventListener("animationiteration", () => {
  const r = parseInt(spanRepetition.dataset.repetition);
  spanRepetition.dataset.repetition = r - 1;
});

animated.addEventListener("animationend", () => {
  spanRepetition.dataset.repetition = 0;
});
setTimeout(function(){ close()},30000)
})

	function loginForm(){
			$(".bg-white").replaceWith
                    ("<div class='bg-white shadow-lg rounded-lg mt-9'><svg class='inline-flex -mt-9 w-[72px] h-[72px] fill-current rounded-full border-4 border-white box-content shadow mb-3' viewBox='0 0 72 72'>\
                        <path class='text-gray-700' d='M0 0h72v72H0z' />\
                        <path class='text-pink-400' d='M30.217 48c.78-.133 1.634-.525 2.566-1.175.931-.65 1.854-1.492 2.769-2.525a30.683 30.683 0 0 0 2.693-3.575c.88-1.35 1.66-2.792 2.337-4.325-1.287 3.3-1.93 5.9-1.93 7.8 0 2.467.914 3.7 2.743 3.7.508 0 1.084-.083 1.727-.25.644-.167 1.169-.383 1.575-.65-.474-.267-.812-.708-1.016-1.325-.203-.617-.305-1.392-.305-2.325 0-.833.11-1.817.33-2.95.22-1.133.534-2.35.94-3.65.407-1.3.898-2.658 1.474-4.075A71.574 71.574 0 0 1 48 28.45c0-.167-.127-.35-.381-.55a5.313 5.313 0 0 0-.94-.575 6.394 6.394 0 0 0-1.245-.45 4.925 4.925 0 0 0-1.194-.175 110.56 110.56 0 0 1-2.49 4.8c-.44.8-.872 1.567-1.295 2.3-.423.733-.804 1.4-1.143 2-1.83 3.033-3.387 5.275-4.675 6.725-1.287 1.45-2.421 2.275-3.404 2.475-.474-.167-.711-.567-.711-1.2 0-1.533.373-3.183 1.118-4.95a23.24 23.24 0 0 1 2.87-4.975c1.169-1.55 2.473-2.875 3.913-3.975s2.836-1.75 4.191-1.95c-.034-.3-.186-.658-.457-1.075a8.072 8.072 0 0 0-.99-1.225c-.39-.4-.797-.75-1.22-1.05-.424-.3-.805-.5-1.143-.6-1.39.067-2.829.692-4.319 1.875-1.49 1.183-2.87 2.658-4.14 4.425a26.294 26.294 0 0 0-3.126 5.75C26.406 38.117 26 40.083 26 41.95c0 1.733.39 3.158 1.169 4.275.779 1.117 1.795 1.708 3.048 1.775Z'/>\
                    </svg><div class='replaced'><h3 class='bg-blue-600'>Log In</h3><button type='button' onclick='closeform();' id='closebutton'  hidden></button> <label id='close' for='closebutton'>\
				<span class='las la-chevron-circle-left' id='close1'></span></label>\
				<div class='error'></div>\
				 <div class='input'>Email address<input class='binput' type='text' name='acc_number' placeholder='Enter Email'></div>\
				 <div class='input'>Password<input class='binput' type = 'password' name = 'password' placeholder = 'Enter password'></div>\
				<br><br><button id= 'sub' onclick='submitForm1();' class='font-semibold text-sm inline-flex items-center justify-center px-3 py-2 border border-transparent rounded leading-5 shadow transition duration-150 ease-in-out w-full bg-blue-600 hover:bg-blue-400 text-white focus:outline-none focus-visible:ring-2'>Log In</button>\
				</div> </div></div>")
		}
		function closeform(){
			$(".bg-white").replaceWith
                    ('<div class="bg-white shadow-lg rounded-lg mt-9">\
                <!-- Card header -->\
                <header class="text-center px-5 pb-5">\
                    <!-- Avatar -->\
                    <svg class="inline-flex -mt-9 w-[72px] h-[72px] fill-current rounded-full border-4 border-white box-content shadow mb-3" viewBox="0 0 72 72">\
                        <path class="text-gray-700" d="M0 0h72v72H0z" />\
                        <path class="text-pink-400" d="M30.217 48c.78-.133 1.634-.525 2.566-1.175.931-.65 1.854-1.492 2.769-2.525a30.683 30.683 0 0 0 2.693-3.575c.88-1.35 1.66-2.792 2.337-4.325-1.287 3.3-1.93 5.9-1.93 7.8 0 2.467.914 3.7 2.743 3.7.508 0 1.084-.083 1.727-.25.644-.167 1.169-.383 1.575-.65-.474-.267-.812-.708-1.016-1.325-.203-.617-.305-1.392-.305-2.325 0-.833.11-1.817.33-2.95.22-1.133.534-2.35.94-3.65.407-1.3.898-2.658 1.474-4.075A71.574 71.574 0 0 1 48 28.45c0-.167-.127-.35-.381-.55a5.313 5.313 0 0 0-.94-.575 6.394 6.394 0 0 0-1.245-.45 4.925 4.925 0 0 0-1.194-.175 110.56 110.56 0 0 1-2.49 4.8c-.44.8-.872 1.567-1.295 2.3-.423.733-.804 1.4-1.143 2-1.83 3.033-3.387 5.275-4.675 6.725-1.287 1.45-2.421 2.275-3.404 2.475-.474-.167-.711-.567-.711-1.2 0-1.533.373-3.183 1.118-4.95a23.24 23.24 0 0 1 2.87-4.975c1.169-1.55 2.473-2.875 3.913-3.975s2.836-1.75 4.191-1.95c-.034-.3-.186-.658-.457-1.075a8.072 8.072 0 0 0-.99-1.225c-.39-.4-.797-.75-1.22-1.05-.424-.3-.805-.5-1.143-.6-1.39.067-2.829.692-4.319 1.875-1.49 1.183-2.87 2.658-4.14 4.425a26.294 26.294 0 0 0-3.126 5.75C26.406 38.117 26 40.083 26 41.95c0 1.733.39 3.158 1.169 4.275.779 1.117 1.795 1.708 3.048 1.775Z" />\
                    </svg>\
                    <!-- Card name --><div class="text-sm font-medium text-gray-500"></div>\
                    <h3 class="text-xl font-bold text-white-900 bg-blue-600 mb-1">Proceed To Make Payment</h3>\
                </header>\
                <!-- Card body -->\
                <div class="bg-gray-100 text-center px-5 py-6">\
                    <div class="text-sm mb-6"><strong class="font-semibold">&#8373 <?php echo $amount;?></strong>  <div>Order date: <div id="ti"></div></div></div>\
                        <button onclick="loginForm();" class="font-semibold text-sm inline-flex items-center justify-center px-3 py-2 border border-transparent rounded leading-5 shadow transition duration-150 ease-in-out w-full bg-blue-600 hover:bg-blue-400 text-white focus:outline-none focus-visible:ring-2">Pay Now</button>\
						<br>\
						<br>\
						<div class="center">\
						<a href="stop_payment.php"><label id="stop">\
				<span class="las la-window-close" id="close1"></span></label></a>\
						</div>\
			</div>\
            </div>');
			
		}
		
		function submitForm1(){
			
			var account_number = $('input[name=acc_number]').val();
			var password = $('input[name=password]').val();
			//var password = md5(b_password);
			if(account_number != '' && password != ''){
				var formData = {account_number: account_number, password: password};
                $.ajax({url: "../includes/check_login.php", type:'POST',data: formData, dataType: "text", success: function(response){
					
					console.log(response);
					switch (response){
    					case "true":
							$('.bg-white').replaceWith(' <div class= "bg-white"><a href="cancelled.php"><label id="close" for="closebutton">\
				<span class="las la-chevron-circle-left" id="close1"></span></label></a>\
						<div class="error"></div>\
						<div class="form">\
                		<div class="form-row2">\
                		<div>Your payment of</div>\
						<span id="p">&#8373 <?php echo $amount;?></span>\
						<div>is pending</div>\
                		</div>\
            		    <hr>\
							</div>\
							<div><button class="check_balance" id="check_balance" onclick="balance(); recipient();" ></button></div>\
							<div id="message"></div>\
							<br>\
							<br>\
							<div id="recipient"></div>\
							<button onclick="pay();" class="font-semibold text-sm inline-flex items-center justify-center px-3 py-2 border border-transparent rounded leading-5 shadow transition duration-150 ease-in-out w-full bg-indigo-500 hover:bg-indigo-600 text-white focus:outline-none focus-visible:ring-2">Approve Transaction</button>\
							</div></div>\
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
					var re = $('<div class="message" id="message">Your balance: &#8373 	'+obj['balance']+'</div>');
			$('#message').replaceWith(re);
				}
	});
		}
		
		function recipient(){
		var password = "";
				var formData = {password: password};
                $.ajax({url: "../includes/recipient.php", type:'POST',data: formData, dataType: "text", success: function(response){			
					var obj = JSON.parse(response);
					var re = $('<div class="recipient" id="recipient">Sending &#8373 <?php echo $amount;?>.00 to	'+obj['firstname']+'&nbsp'+ obj['lastname']+'</div>');
			$('#recipient').replaceWith(re);
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
						$('.bg-white').replaceWith("<div class='bg-white'>\
						<div class='error'></div>\
						<div class='form'>\
                		<div class='form-row2'>\
						<div class='complete text-blue-600'>\
						<div>You have completed the payment</div>\
						</div>\
                		</div>\
							</div>\
							");
							$('.right').replaceWith("<div class='right'>\
							PAYMENT COMPLETED\
                		</div>\
							</div>\
							");
							//window.history.go(-1);
							setTimeout(window.open("stop_payment.php"),6000);	
							setTimeout(function(){ close()},5000)
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
		var today = new Date();
var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = date+' '+time;
document.getElementById("ti").innerHTML = dateTime;

		
</script>
<?php
}
?>