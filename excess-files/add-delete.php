<?php 
session_start();
	$key = $_GET['key'];
	//JSON FILE
	$string = file_get_contents("items.json");
	$items = json_decode($string, true);


	if($_SESSION['role'] == 'admin'){

		if(isset($_POST['save'])){
			$string = file_get_contents("items.json");
			$items = json_decode($string, true);

			$new_item['Photo'] = "photos/".$_POST['image'];
			$new_item['Item'] = $_POST['name'];
			$new_item['Price'] = $_POST['price'];
			$new_item['Category'] = $_POST['category'];

//replace an entire array
			$items[$key] = $new_item;
			
//save
			$fp = fopen('items.json', 'w');
			fwrite($fp, json_encode($items, JSON_PRETTY_PRINT));
			fclose($fp);
//relocate after click
			header('location:index.php');
		}
	}

	function editItem() {

	echo "
		<form id='add-item' method='POST' class='login'>
		<h3>Edit Items</h3>
			<span>
				<input type='text' name='name' placeholder='Item Name'>
			</span>
			<span>
				<input type='text' name='price' placeholder='Price'>
			</span>
			<span>
				<input type='text' name='category' placeholder='Category'></span>
			<span>
				<input type='file' name='image'>
			</span>
			<span>
				<input type='submit' name='save' value='Save'>
				<input type='submit' name='cancel' value='Cancel' onclick='cancelEdit()'>
				<a href='deleteitem.php?key=$key'><input type='submit' name='delete' value='Delete'></a>
			</span>
		</form>";

	}
			


require_once("library-draft.php");

require_once("index.php");

?>