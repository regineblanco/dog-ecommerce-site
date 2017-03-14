<?php 

$key = $_GET['key'];
//JSON FILE
$string = file_get_contents("items.json");
$items = json_decode($string, true);

//to delete
unset($items[$key]);

//to show again the new array
$fp = fopen('items.json', 'w');
fwrite($fp, json_encode($items, JSON_PRETTY_PRINT));
fclose($fp);

//no need to refresh
header('location:index.php#shopnav');

?>