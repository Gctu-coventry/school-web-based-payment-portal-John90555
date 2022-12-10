<?php

session_start();

if(isset($_SESSION['acc_number'])){
	unset($_SESSION['acc_number']);
}

header("Location: check_out.php");
die;