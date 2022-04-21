<?php

	$restaurant_id = $_REQUEST["rid"];
	$item_id = $_REQUEST["itemid"];
	$basket = array();
	
	$restaurant = getRestaurant($restaurant_id);
	$menu = getMenu($restaurant_id);
	$categories = getCategories($restaurant_id);
	#$item = getItem($item_id);
	print "<h1>".$restaurant["name"]."</h1>";
	
	if ($_POST['place_order']) {
		
		print "<h2>Available menu</h2>";

		foreach($_POST as $i => $value) {
			if (is_numeric($i)) {
				$j = $i;
				$temp[$j]['id'] = $value;
			}
			$pos = strpos($i, 'name');
			if ($pos !== false) {
				$temp[$j]['name'] = $value;
			}
			$pos2 = strpos($i, 'price');
			if ($pos2 !== false) {
				$temp[$j]['price'] = $value;
			}
			$pos3 = strpos($i, 'quantity');
			if ($pos3 !== false) {
				$temp[$j]['quantity'] = $value;	
			}
		}
		debug($temp);
		foreach($temp as $i => $item) {
			if ($item['quantity'] > 0) {
				$basket[$i][
			}
		}
?>
		<form action="<?php print $_SERVER["PHP_SELF"];?>" method="post">
<?php
		print "<table cellpadding='5' class='common'>";
		print "<thead><tr>";
		print "<th id='itemname'>Name</th>";
		print "<th id='price'>Price</th>";
		print "<th id='quantity'>Quantity</th>";
		print "</tr></thead>";
		print "<tbody>";
		foreach($basket as $i => $item) {
			if ($item['quantity'] > 0) {
				print "<tr>";
				print "<td headers='itemname'>".$item['name']."</td>";
				print "<td headers='price'>".$item['price']*$item['quantity']."</td>";
				print "<td headers='quantity'>".$item['quantity']."</td>";
				print "</tr>";
			}
		}
		print "</tbody>";
		print "</table>";
?>
			<p>
			<input class="btn" type="submit" name="place_order" value="Confirm order"/>
			<input type="hidden" name="q" value="menus_orderfrom"/>
			<input type="hidden" name="rid"  value="<?php print $restaurant_id;?>"/>
			</p>
		</form>			
<?php		
		
		
	
	
	}
	
	else if (sizeof($menu) > 0) {
		print "<h2>Available menu</h2>";
?>
		<form action="<?php print $_SERVER["PHP_SELF"];?>" method="post">
<?php
		foreach($categories as $i=> $category) {
			print "<h3>".$category["category"]."</h3>";
			print "<table cellpadding='5' class='common'>";
			print "<thead><tr>";
			print "<th id='id'>&nbsp;</th>";
			print "<th id='itemname'>Name</th>";
			print "<th id='ingredients'>Ingredients</th>";
			print "<th id='price'>Price</th>";
			print "<th id='quantity'>Quantity</th>";
			print "</tr></thead>";
			print "<tbody>";
				foreach($menu as $i=> $item) {
					if ($category["category"] == $item["category"]){
						print "<tr>";
						print "<td headers='id'><input type=hidden name=".$item["id"]." value=".$item["id"].">".$item["id"]."</td>";
						print "<td headers='itemname'><input type=hidden name=name".$item["id"]." value=".$item["itemname"].">".$item["itemname"]."</td>";
						print "<td headers='ingredients'>".$item["ingredients"]."</td>";
						print "<td headers='price'><input type=hidden name=price".$item["id"]." value=".$item["price"].">".$item["price"]."</td>";
						print "<td headers='quantity'>";
						print "<select name=quantity".$item["id"]." id='".$item["id"]."'>";
						for ($i=0; $i<10; $i++) {
							print "<option value='".$i."'>".$i."</option>";
						}
						print "</select>";
						print "</td>";
						print "</tr>";
					}
				}
			print "</tbody>";
			print "</table>";
		}
?>
			<p>
			<input class="btn" type="submit" name="place_order" value="Place order"/>
			<input type="hidden" name="q" value="menus_orderfrom"/>
			<input type="hidden" name="rid"  value="<?php print $restaurant_id;?>"/>
			</p>
		</form>		
<?php	
	}
	else {
		print "<p align='center'>No menus available, register one!</p>";
	}