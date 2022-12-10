<?php
session_start();
    unset($_SESSION['amount']);
    unset($_SESSION['cart_item']);
    unset($_SESSION['total_price']);
    unset($_SESSION['fullname']);
    unset($_SESSION['apk']);

echo "UnSET";
var_dump($_SESSION);


?>