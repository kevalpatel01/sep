<?php

	$restaurant_id = $_REQUEST["rid"];
	$restaurant_profile = getRestaurant($restaurant_id);
	$errorMessages = array();
	
	if (!empty($restaurant_id)) {
		print "<h2>".$restaurant_profile['name']."</h2>";
		print "<table cellpadding='5'>";
		foreach($restaurant_profile as $i => $value) {}
			print "<tr><td>Name : </td>";
			print "<td>".$restaurant_profile['name']."</td></tr>";
			print "<tr><td>Cusine : </td>";
			print "<td>".$restaurant_profile['cusine']."</td></tr>";
			print "<tr><td>Address : </td>";
			print "<td>".$restaurant_profile['address']."</td></tr>";
			print "<tr><td>Phone : </td>";
			print "<td>".$restaurant_profile['phone']."</td></tr>";
			print "<tr><td>Email : </td>";
			print "<td>".$restaurant_profile['email']."</td></tr>";
		print "</table>";
?>
		<form action="<?php print $_SERVER["PHP_SELF"]; ?>" method="post">
			<p>
			<input class="btn" type="submit" name="modify_restaurant" value="Modify"/>
			<input class="btn" type="submit" name="delete_restaurant" value="Delete"/>
			<input type="hidden" name="q" value="restaurants_orderfrom"/>
			<input type="hidden" name="rid"  value="<?php print $restaurant_id;?>"/>
			</p>
		</form>
		
<?php

	}
	else {
?>
<h2>Restaurants available</h2>
<?php
		$restaurants = getRestaurantsAdmin();
		if (sizeof($restaurants) > 0) {
			print "<table class='common' cellpadding='5'>";
			print "<thead><tr>";
			print "<th id='id'>&nbsp;</th>";
			print "<th id='name'>Name</th>";
			print "<th id='cusine'>Cusine</th>";
			print "<th id='address'>Address</th>";
			print "<th id='phone'>Phone</th>";
			print "<th id='email'>Email</th>";
			if ($_SESSION['user']['userlevel'] == 1 ) {
				print "<th id='username'>User</th>";
			}
			print "</tr></thead>";
			print "<tbody>";
			foreach($restaurants as $i=> $restaurant) {
				print "<tr>";
				print "<td headers='id'>".(int)($i+1)."</td>";
				print "<td headers='name'>";
				print "<a href='".$_SERVER["PHP_SELF"]."?q=menus_orderfrom&amp;rid=".$restaurant["id"]."'>".$restaurant["name"]."</a>";			
				print "</td>";
				print "<td headers='cusine'>".$restaurant["cusine"]."</td>";
				print "<td headers='address'>".$restaurant["address"]."</td>";
				print "<td headers='phone'>".$restaurant["phone"]."</td>";
				print "<td headers='email'>".$restaurant["email"]."</td>";
				if ($_SESSION['user']['userlevel'] == 1 ) {
					print "<td headers='username'>".$restaurant["username"]."</td>";
				}
				print "</tr>";
			}
			print "</tbody>";
			print "</table>";
		}	else print "<p align='center'>No restaurants available!</p>";
	}