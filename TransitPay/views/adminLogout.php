<?php

session_start();

if(isset($_SESSION['my_id'])){
	unset($_SESSION['my_id']);
	
}

header("Location: adminLogin.php");
die;