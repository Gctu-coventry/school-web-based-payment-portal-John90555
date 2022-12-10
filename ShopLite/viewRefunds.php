<?php 
include('dbcontroller.php');
$db_handle = new DBController();
$history = $db_handle->admincompletedrefunds("SELECT * FROM orders WHERE order_status ='Refund Complete' ");?>


