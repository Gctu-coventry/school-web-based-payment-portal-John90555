<?php

session_start();

if(isset($_SESSION['acc_number'])){
	unset($_SESSION['acc_number']);
}

header("Location: stop_payment.php");
die;