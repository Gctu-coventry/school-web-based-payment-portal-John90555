<?php

session_start();

//if(isset($_SESSION['token']) && isset($_SESSION['jwt']) && isset($_SESSION['amount']) && isset($_SESSION['email'])){
    //unset($_SESSION['total_price']);
    unset($_SESSION['token']);
    unset($_SESSION['jwt']);
    unset($_SESSION['amount']);
    unset($_SESSION['email']);
    unset($_SESSION['merchant_balance']);
    unset($_SESSION['api_key']);
    unset($_SESSION['acc_number']);
    unset($_SESSION['shopping_cart']);
    unset($_SESSION['total_price']);
    
//}

//header('Location: http://localhost/E-Sales/selling.php');
echo '<script>close();</script>';
die;