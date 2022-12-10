<?php 
include('dbcontroller.php');
$db_handle = new DBController();
$history = $db_handle->pendingRefunds("SELECT * FROM orders WHERE order_status ='Requested_Refund' ");?>


