<?php
session_start();
include('dbcontroller.php');
$db_handle = new DBController();
//$P_id = $_POST['uID'];
$data = file_get_contents('php://input');
//$amount = $_POST['amount'];
    $status = "Refund Complete";
    $product_array = $db_handle->upd_store("UPDATE orders SET order_status = '$status' WHERE order_id = '$data'");
    if($product_array == "true"){
        $res = "true";
    }else if($product_array == "false"){
        $res = "false";
    }
    else{
        $res = "false";
    }


//echo $P_id;

?>