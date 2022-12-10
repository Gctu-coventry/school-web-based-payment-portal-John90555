<?php
session_start();
unset($_SESSION['sess_id']);
unset($_SESSION["cart_item"]);
header('Location: index.php');