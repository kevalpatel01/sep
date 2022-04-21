<?php

	$restaurant_id = $_REQUEST["rid"];
	$restaurant_profile = getRestaurant($restaurant_id);
	$errorMessages = array();

	if ($_POST['update_restaurant'] || $_POST['add_restaurant']) {

		if (isset($_POST["name"])) {
			if (empty($_POST["name"])) {
			$errorMessages["name"] = "* Missing name!";
			}
			$name = $_POST["name"];
		} else $name = "";
		
		if (isset($_POST["cusine"])) {
			if (empty($_POST["cusine"])) {
			$errorMessages["cusine"] = "* Missing cusine!";
			}
			$cusine = $_POST["cusine"];
		} else $cusine = "";

		if (isset($_POST["address"])) {
			if (empty($_POST["address"])) {
			$errorMessages["address"] = "* Missing address!";
			}
			$address = $_POST["address"];
		} else $address = "";
		
		if (isset($_POST["phone"])) {
			if (empty($_POST["phone"])) {
			$errorMessages["phone"] = "* Missing phone!";
			}
			else if (!is_numeric($_POST["phone"])) {
				$errorMessages["phone"] = "It should be a number!";
			}

			$phone = $_POST["phone"];
		} else $phone = "";

		if (isset($_POST["email"])) {
			if (empty($_POST["email"])) {
			$errorMessages["email"] = "* Missing email!";
			}
			$email = $_POST["email"];
		} else $email = "";
		
		if (sizeof($errorMessages) == 0 && $name != "" && $cusine != "" && $address != "" && $phone != "" && $email != "") {
			if ($_POST['add_restaurant']) {
				addRestaurant($name, $cusine, $address, $phone, $email, $restaurant_id);
			}
			else if ($_POST['update_restaurant']) {
				updateRestaurant($name, $cusine, $address, $phone, $email, $restaurant_id);	
			}
			$name = "";
			$cusine = "";
			$address = "";
			$phone = "";
			$email = "";
			$restaurant_profile = getRestaurant($restaurant_id);
		}

	}
	if ($_POST['yes']) {
		deleteRestaurant($restaurant_id);
		print "<p style='text-align: center;'>".$restaurant_profile['name']." is deleted!</p>";
	}

	else if ($_POST['delete_restaurant']) {
?>
	<form action="<?php print $_SERVER["PHP_SELF"]; ?>" method="post">
		<table>
			<tr>
				<?php
				print "<td align='center'>Are you sure you want to delete the ".$restaurant_profile['name']." restaurant?</td>";
				?>
			</tr>
			<tr>
			<td align="center">
				<input class="btn" type="submit" name="yes" value="Yes"/>
				<input class="btn" type="submit" name="no" value="No"/>
				<input type="hidden" name="q" value="restaurants"/>
				<input type="hidden" name="rid"  value="<?php print $restaurant_id;?>"/>
			</td>
			</tr>
		</table>
	</form>
<?php	
	}

	else if ($_POST['modify_restaurant'] || ($_POST['update_restaurant'] && sizeof($errorMessages) != 0)){

		print "<form action=".$_SERVER["PHP_SELF"]." method='post'>";
				print "<table cellpadding='5'>";
				print "<tr><td>Name : </td>";
				print "<td><input type=text name=name id=name value='".$restaurant_profile['name']."'></td>";
				print "<td class=error_col>".$errorMessages['name']."</td></tr>";
				
				print "<tr><td>Cusine : </td>";
				print "<td><input type=text name=cusine id=cusine value='".$restaurant_profile['cusine']."'></td>";
				print "<td class=error_col>".$errorMessages['cusine']."</td></tr>";
				
				print "<tr><td>Address : </td>";
				print "<td><input type=text name=address id=address value='".$restaurant_profile['address']."'></td>";
				print "<td class=error_col>".$errorMessages['address']."</td></tr>";
				
				print "<tr><td>Phone : </td>";
				print "<td><input type=text name=phone id=phone value='".$restaurant_profile['phone']."'></td>";
				print "<td class=error_col>".$errorMessages['phone']."</td></tr>";
				
				print "<tr><td>Email : </td>";
				print "<td><input type=text name=email id=email value='".$restaurant_profile['email']."'></td>";
				print "<td class=error_col>".$errorMessages['email']."</td></tr>";		
			print "</table>";
?>
				<p>
				<input class="btn" type="submit" name="cancel" value="Cancel"/>
				<input class="btn" type="submit" name="update_restaurant" value="Modify"/>
				<input type="hidden" name="q" value="restaurants"/>
				<input type="hidden" name="rid"  value="<?php print $restaurant_id;?>"/>
				</p>
			</form>		
<?php
	}
	
	else if (!empty($restaurant_id)) {
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
			<input type="hidden" name="q" value="restaurants"/>
			<input type="hidden" name="rid"  value="<?php print $restaurant_id;?>"/>
			</p>
		</form>
		
<?php

	}

	else {
?>
<h2>Restaurants available</h2>
<?php

		if ($_SESSION['user']['userlevel'] == 1 ) {
			$restaurants = getRestaurantsAdmin();
		}
		else {
			$restaurants = getRestaurants($_SESSION['user']['id']);
		}
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
			print "<th id='menu'></th>";
			print "</tr></thead>";
			print "<tbody>";
			foreach($restaurants as $i=> $restaurant) {
				print "<tr>";
				print "<td headers='id'>".(int)($i+1)."</td>";
				print "<td headers='name'>";
				print "<a href='".$_SERVER["PHP_SELF"]."?q=restaurants&amp;rid=".$restaurant["id"]."'>".$restaurant["name"]."</a>";			
				print "</td>";
				print "<td headers='cusine'>".$restaurant["cusine"]."</td>";
				print "<td headers='address'>".$restaurant["address"]."</td>";
				print "<td headers='phone'>".$restaurant["phone"]."</td>";
				print "<td headers='email'>".$restaurant["email"]."</td>";
				if ($_SESSION['user']['userlevel'] == 1 ) {
					print "<td headers='username'>".$restaurant["username"]."</td>";
				}
				print "<td headers='menu'><a href='".$_SERVER["PHP_SELF"]."?q=menus&amp;rid=".$restaurant["id"]."'>Menu</a></td>";
				print "</tr>";
			}
			print "</tbody>";
			print "</table>";
		}	else print "<p align='center'>No restaurants available!</p>";
	}
	if (!empty($_SESSION["user"]) && empty($restaurant_id)) {
?>
<h3>Add new restaurant</h3>
<form action="<?php print $_SERVER["PHP_SELF"];?>" method="post">
	<table style='margin: auto;'>
		<tr>
			<td align="right"><label for="name">Name:</label></td>
			<td><input type="text" name="name" id="name" value="<?php print $name; ?>"/></td>
			<td class="error_col"><?php print $errorMessages["name"];?></td>
		</tr>
		<tr>
			<td align="right"><label for="cusine">Cusine:</label></td>
			<td><input type="text" name="cusine" id="cusine" value="<?php print $cusine; ?>"/></td>
			<td class="error_col"><?php print $errorMessages["cusine"];?></td>
		</tr>
		<tr>
			<td align="right"><label for="address">Address:</label></td>
			<td><input type="text" name="address" id="address" value="<?php print $address; ?>"/></td>
			<td class="error_col"><?php print $errorMessages["address"];?></td>
		</tr>
		<tr>
			<td align="right"><label for="mphone">Phone:</label></td>
			<td><input type="text" name="phone" id="mphone" value="<?php print $phone; ?>"/></td>
			<td class="error_col"><?php print $errorMessages["phone"];?></td>
		</tr>
		<tr>
			<td align="right"><label for="memail">Email:</label></td>
			<td><input type="text" name="email" id="memail" value="<?php print $email; ?>"/></td>
			<td class="error_col"><?php print $errorMessages["email"];?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td align="center">
				<br/>
				<input class="btn" type="submit" name="add_restaurant" value="Add"/>
			</td>
			<td>&nbsp;</td>
		</tr>
	</table>
	<p><input type="hidden" name="q"  value="restaurants"/></p>
</form>
<?php
}
?>