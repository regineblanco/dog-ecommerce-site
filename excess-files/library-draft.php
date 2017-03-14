<?php

	session_start();

//decode items and users from json
	$string = file_get_contents('items.json');
	$items = json_decode($string, true);

	$string = file_get_contents('users.json');
	$users = json_decode($string, true);

//ADMIN & USER LOGIN
	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		foreach ($users as $user) {

			if($username == $user['username'] && $password == $user['password']) {
				$_SESSION['username'] = $username;
				// the $username will serve as the current session
			
				$_SESSION['role'] = $user['role'];
			} 
		} 
	} 

//ADMIN & USER PERKS
	//navone (logout for admin, cart/wishlist/logout for users)
	function userShopping() {

		if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
			echo "<li><a href='logout.php'>Log Out</a></li>";
		}
	
		if(isset($_SESSION['role']) && $_SESSION['role'] !== 'admin'){
			echo "<li><a href='#'>Doggie Cart<span><i class='fa  fa-shopping-cart' aria-hidden='true'></i></span></a></li>
				<li><a href='#'>Wishlist</a></li>
				<li><a href='logout.php'>Log Out</a></li>";
		}

	}

	//navtwo to appear (to admin and users)
	function navTwo() {

		if(isset($_SESSION['role'])){

			echo "<nav class='navbar navbar-default nav-justified nav-two'>
				<ul class='nav navbar-nav'>
					<li><a href='munchies.php'>Munchies</a></li>
					<li><a href='toys.php'>Toys</a></li>
					<li><a href='cribs.php'>Cribs</a></li>
					<li><a href='essentials.php'>Essentials</a></li>
					<li><a href='interactions.php'>Interactions</a></li>
					<li><a href='dogyayas.php'>Dog Yayas</a></li>
				</ul>
				</nav>";
			}
	}

	//left page (welcome remarks for admin/users)
	function welcomeText() {

		if(isset($_SESSION['role'])){

			echo "Happy browsing, " . $_SESSION['username'] ."!";
		}
		else {
			echo "Welcome to Stuff Dogs Like! Register or sign in to get exclusive deals and discounts.";
		}
	}

	//process adding or editing items (note: no need to be with forms)
	function processRequests(){

		//adding items
		if(isset($_POST['add'])){

			$string = file_get_contents('items.json');
			$items = json_decode($string, true);

			$new_item['Photo'] = "photos/".$_POST['image'];
			$new_item['Item'] = $_POST['name'];
			$new_item['Price'] = $_POST['price'];
			$new_item['Category'] = $_POST['category'];
		
			$items[] = $new_item;

			$fp = fopen('items.json', 'w');
			fwrite($fp, json_encode($items, JSON_PRETTY_PRINT));
			fclose($fp);
		} //close if for pushing items to JSON array

		//saving edited items
		if(isset($_POST['save'])){
			$string = file_get_contents("items.json");
			$items = json_decode($string, true);

			$new_item['Photo'] = "photos/".$_POST['image'];
			$new_item['Item'] = $_POST['name'];
			$new_item['Price'] = $_POST['price'];
			$new_item['Category'] = $_POST['category'];

			//replace an entire array
			$key = $_POST['key'];
			$items[$key] = $new_item;
			
			//save
			$fp = fopen('items.json', 'w');
			fwrite($fp, json_encode($items, JSON_PRETTY_PRINT));
			fclose($fp);

			//relocate after click
			header('location:index.php');
		} //close if for saving edited items
	} //close function processRequests()

	//right page (LOGIN & SIGNUP FORMS)
	function logIn() {

		if(!isset($_SESSION['role'])){

			//login form
			echo "<form id='login-form' method='POST' class='login'>
					<span>
						<input type='text' name='username' placeholder='Username'>
					</span>
					<span>
						<input type='password' name='password' placeholder='Password'>
					</span>
					<span>
						<input type='submit' name='login' value='Log In'>
					</span>
						<input type='checkbox' checked='checked'> Remember me
					<span class='forgot'>Forgot password?</span>
					<span class='forgot'>Not a member yet? <a onclick='signUp()'>Sign up</a></span>
				</form>";

				//signup form
				echo "<form id='signup-form' method='POST' class='login' style='display: none;'>
				<span>
					<input type='text' name='username' placeholder='Username'>
				</span>
				<span>
					<input type='password' name='password' placeholder='Password'>
				</span>
				<span>
					<input type='password' name='confirmpw' placeholder='Confirm password'>
				</span><br>
					<input type='submit' name='cancel' value='Cancel' onclick='cancelSignUp()'>
				</span>
				</span>
					<input type='submit' name='signup' value='Sign Up'>
				</span>
			</form>";

		} //close if for log in/sign up

		//ADDING ITEMS
		else {

			if ($_SESSION['role'] == 'admin') {
			echo "
				<form id='add-item' method='POST' class='login'>
					<h3>Add Items</h3>
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
						<input type='submit' name='add' value='Add'>				
					</span>
				</form>";

				echo "
				<form id='edit-item' method='POST' class='login' style='display:none;'>
				<h3>Edit Items</h3>
					<span>
						<input hidden type='text' id='key' name='key'>
					</span>
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
						<a id='deleteItemAnchor' href='#'><input type='button' name='delete' value='Delete' onclick='deleteItem()'></a>
					</span>
				</form>";
			} //close if for add items form

		} //close else for admin adding item



	} //close whole logIn() function

//landing page (new position)
	function showLatest() {

		echo "<h3>Latest Stuff Dogs Like</h3>
				<div class='row stuff'>";

		global $items;

		foreach ($items as $key => $row) {

			$photo = $row['Photo'];
			$item = $row['Item'];
			$price = $row['Price'];
			$category = $row['Category'];

			echo
				"<div class='thumbnail col-xs-6 col-lg-4 item' onclick='showEditForm($key);'>
				<img src='".$photo."'>
				<span class='description product'>$item &middot;</span>
				<span class='description'>$price &middot;</span>
				<span class='description'>$category</span>			
				</div>";
		} //close foreach landing page
		echo "</div>";
		echo "<script> function showEditForm(key){
				$('#add-item').hide();
				$('#edit-item').show();
				$('#key').val(key);
				$('#deleteItemAnchor').attr('href','deleteitem.php?key='+key);
			} </script>";
	} //close showLatest() function

//REGISTRATION
	if(isset($_POST['signup'])) {
	$new_user = ['username' => $_POST['username'], 'password' => $_POST['password'], 'role' => 'regular'];

		if($_POST['password'] == $_POST['confirmpw']) {

			$string = file_get_contents('users.json');
			$users = json_decode($string, true);	

			$users[] = $new_user;

			$fp = fopen('users.json', 'w');
			fwrite($fp, json_encode($users, JSON_PRETTY_PRINT));
			fclose($fp);

			$_SESSION['username'] = $_POST['username'];
			$_SESSION['role'] = 'regular';
		} 
	}	

?>