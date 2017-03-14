<?php 

$key = $_GET['key'];

//to remove from cart
session_start();
unset($_SESSION['cart_items'][$key]);

//to show again the new array

//no need to refresh
header('location:doggiecart.php#shopnav');

?>