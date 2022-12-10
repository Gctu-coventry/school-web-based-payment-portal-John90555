<?php
session_start();
include('../dbcontroller.php');
$db_handle = new DBController();
$_SESSION['api_key'] = $_POST['api_key'];
$_SESSION['amount'] = $_POST['total'];
foreach($_SESSION["cart_item"] as $k => $values) {
    $name = $values['name'];
    $code = $values['code'];
    $quantity = $values['quantity'];
    $price = $values['price'];
    $total = $_SESSION['total_price'];
    $order_id = uniqid('ORD',true);
    $sess_id = $_SESSION['sess_id'];
    $status = "Complete";
    $product_array = $db_handle->store("INSERT INTO orders SET order_id= '$order_id', product_id = '$code', sess_id = '$sess_id', item_name = '$name',item_quantity='$quantity',item_price='$price',sub_total = '$total', order_status = '$status' ");
    if($product_array == 1){
        $res = "true";
    }else if($product_array == 0 ){
        $res = "false";
    }
    else{
        $res = "flase";
    }
}

echo $res;

?>