<?php

$current_page = basename($_SERVER['PHP_SELF']);
$total = 0;
function dogCart() {

	echo "<div class='row stuff'>";

	$string = file_get_contents('items.json');
	$items = json_decode($string, true);

	if(isset($_SESSION['cart_items'])){

		global $total;
		foreach ($_SESSION['cart_items'] as $key => $quantity) {

			// $index = array_search($key,array_column($items, 'key'));
			// $key = $items[$key]['key'];
			$photo = $items[$key]['Photo'];
			$item = $items[$key]['Item'];
			$price = $items[$key]['Price'];
			$category = $items[$key]['Category'];
			$p = (double)substr(str_replace(",", "", $price),1);
			$subtotal = $p * $quantity;
			$total += $subtotal;

			echo "<div id='div$key' class='thumbnail col-xs-6 col-lg-4 item' onclick='removeCart($key);'>
					<img src='".$photo."'>
					<span class='description product'>$item &middot;</span>
					<span class='description'>$price &middot;</span>
					<span class='description'><strong>$quantity piece/s</strong> =</span>	
					<span class='description'>P".number_format($subtotal)."</span>		
				</div>";
		} //close foreach
	} //close if
	echo "</div>";

	echo "<script> 
				function removeCart(key) {
					$('#removeFromCartAnchor').attr('href','removefromcart.php?key='+key);
					$('.item').css('border','none');
					$('#div'+key).css('border','2px solid #7c3a13');
				}
			</script>";

	function removeFromCart() {
		global $total;
		echo 	"<span style='font-family: Comfortaa; font-size: 20px; padding-top: 10px;'>
					Total &middot; P" . number_format($total);
		echo 	"</span><br>
				<a href='#' style='color: inherit;'>
					<input type='button' name='checkout' value='Check Out'>
				</a>
				<a id='removeFromCartAnchor' href='#' style='color: inherit;'>
					<input type='button' name='remove' value='Remove from Cart' onclick='removeItem();'>
				</a>
				<a href='index.php#shopnav' style='color: inherit;'>
					<input type='button' name='back' value='Back'>
				</a>";
		echo "<script> 
				function removeItem() {
					alert('Are you sure?');
				}
			</script>";
	}
} //close dogCart function()

require_once("index.php");

?>


