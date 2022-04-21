<?php

	$restaurant_id = $_REQUEST["rid"];
	$item_id = $_REQUEST["itemid"];
	$basket = array();
	$errorMessages = array();
	debug($basket);
	debug($_POST);
	debug($_REQUEST);
	
	if (isset($_POST["cancel"])) {
		$item_id = "";
		$_REQUEST['itemid'] = "";
	}
	
	if (isset($_POST["itemname"])) {
		if (empty($_POST["itemname"])) {
			$errorMessages["itemname"] = "* Missing name!";
		}
		$itemname = $_POST["itemname"];
	} else $itemname = "";

	if (isset($_POST["ingredients"])) {
		if (empty($_POST["ingredients"])) {
			$errorMessages["ingredients"] = "* Missing ingredients!";
		}
		$ingredients = $_POST["ingredients"];
	} else $ingredients = "";
	
	if (isset($_POST["price"])) {
		if (empty($_POST["price"])) {
			$errorMessages["price"] = "* Missing price!";
		}
		else if (!is_numeric($_POST["price"])) {
			$errorMessages["price"] = "* It should be a number!";		
		}
		$price = $_POST["price"];
	} else $price = "";

	if (isset($_POST["category_select"]) || isset($_POST["category_text"])) {
		if (empty($_POST["category_text"])) {
			if ($_POST["category_select"] == "novalue") {
				$errorMessages["category_text"] = "* Missing category!";
			}
			else {
				$category = $_POST["category_select"];
			}
		}
		else {
			$category = $_POST["category_text"];
		}
	} else $category = "";
	
	if (sizeof($errorMessages) == 0 && $itemname != "" && $ingredients != "" && $price != "" && $category != "") {
		if (!empty($item_id)) {
			updateItem($item_id, $itemname, $ingredients, $price, $category);
			$item_id = "";
			$_REQUEST['itemid'] = "";
		}
		else if (empty($item_id) && !isset($_POST["cancel"])){
			addItem($restaurant_id, $category, $itemname, $ingredients, $price);
			
		}
		$itemname = "";
		$ingredients = "";
		$price = "";
		$category = "";
	}
	
	$restaurant = getRestaurant($restaurant_id);
	$menu = getMenu($restaurant_id);
	$categories = getCategories($restaurant_id);
	$item = getItem($item_id);
	
	print "<h1>".$restaurant["name"]."</h1>";
	
	if ($_REQUEST['itemid'] || ($_POST['update_item'] && sizeof($errorMessages) != 0)){
		foreach($item as $i=> $value) { }
		print "<form action=".$_SERVER["PHP_SELF"]." method='post'>";
				print "<table cellpadding='5'>";
				print "<tr><td>Name : </td>";
				print "<td><input type=text name=itemname id=itemname value='".$value['itemname']."'>";
				print "<a href='".$_SERVER["PHP_SELF"]."?q=menus&amp;itemid=".$menu["id"]."'>".$menu["name"]."</a>";
				print "</td>";
				print "<td class=error_col>".$errorMessages['itemname']."</td></tr>";
				
				print "<tr><td>Ingredients : </td>";
				print "<td><input type=text name=ingredients id=ingredients value='".$value['ingredients']."'></td>";
				print "<td class=error_col>".$errorMessages['ingredients']."</td></tr>";
				
				print "<tr><td>Category : </td>";
				print "<td><input type=text name=category_text id=category_text value='".$value['category']."'></td>";
				print "<td class=error_col>".$errorMessages['category_text']."</td></tr>";
				
				print "<tr><td>Price : </td>";
				print "<td><input type=text name=price id=price value='".$value['price']."'></td>";
				print "<td class=error_col>".$errorMessages['price']."</td></tr>";		
			print "</table>";
?>
				<p>
				<input class="btn" type="submit" name="cancel" value="Back"/>
				<input class="btn" type="submit" name="update_item" value="Modify"/>
				<input type="hidden" name="q" value="menus"/>
				<input type="hidden" name="rid" value="<?php print $restaurant_id;?>"/>
				<input type="hidden" name="itemid" value="<?php print $item_id;?>"/>
				</p>
			</form>		
<?php
	}
	else if (sizeof($menu) > 0) {
		print "<h2>Available menu</h2>";
		foreach($categories as $i=> $category) {
			print "<h3>".$category["category"]."</h3>";
			print "<form action=".$_SERVER["PHP_SELF"]." method='post'>";
				print "<table cellpadding='5' class='common'>";
				print "<thead><tr>";
				print "<th id='id'>&nbsp;</th>";
				print "<th id='itemname'>Name</th>";
				print "<th id='ingredients'>Ingredients</th>";
				print "<th id='price'>Price</th>";
				print "<th id='category'>Category</th>";
				print "<th id='basket'></th>";
				print "</tr></thead>";
				print "<tbody>";
					foreach($menu as $i=> $item) {
						if ($category["category"] == $item["category"]){
							print "<tr>";
							print "<td headers='id'>".(int)($i+1)."</td>";
							print "<td headers='itemname'>";
							print "<a href='".$_SERVER["PHP_SELF"]."?q=menus&amp;rid=".$restaurant["id"]."&amp;itemid=".$item["id"]."'>".$item["itemname"]."</a>";	
							print "</td>";
							print "<td headers='ingredients'>".$item["ingredients"]."</td>";
							print "<td headers='price'>".$item["price"]."</td>";
							print "<td headers='category'>".$item["category"]."</td>";
							print "<td headers='basket'><select name=quantity id=quantity>";
							for ($i=0; $i<10; $i++) {
								print "<option value='".$i."'>".$i."</option>";
							}
							print "</select></td></tr>";
						}
					}
				print "</tbody>";
				print "</table>";
			}
?>
			<p>
				<input class="btn" type="submit" name="submit_order" value="Place order"/>
				<input type="hidden" name="q" value="menus"/>
				<input type="hidden" name="rid" value="<?php print $restaurant_id;?>"/>
				<input type="hidden" name="itemid" value="<?php print $item_id;?>"/>
				</p>
			</form>
<?php			
	}
	else {
		print "<p align='center'>No menus available, register one!</p>";
	}

	if (!empty($_SESSION["user"]) && empty($_REQUEST['itemid'])) {
?>
	<h3>Add new item</h3>
	<form action="<?php print $_SERVER["PHP_SELF"];?>" method="post">
		<table style='margin: auto;'>
			<tr>
				<td align="right"><label for="itemname">Name:</label></td>
				<td><input type="text" name="itemname" id="itemname" value="<?php print $itemname; ?>"/></td>
				<td class="error_col"><?php print $errorMessages["itemname"];?></td>
			</tr>
			<tr>
				<td align="right"><label for="ingredients">Ingredients:</label></td>
				<td><input type="text" name="ingredients" id="ingredients" value="<?php print $ingredients; ?>"/></td>
				<td class="error_col"><?php print $errorMessages["ingredients"];?></td>
			</tr>
			<tr>
				<td align="right"><label for="price">Price:</label></td>
				<td><input type="text" name="price" id="price" value="<?php print $price; ?>"/></td>
				<td class="error_col"><?php print $errorMessages["price"];?></td>
			</tr>
			<tr>
				<td align="right" rowspan=2><label for="category_select">Category:</label></td>
				<td>
				<select name="category_select" id="category_select">
					<option value='novalue'>Choose a category...</option>
					<?php foreach ($categories as $i=> $category) {
						print "<option value='".$category["category"]."'>".$category["category"]."</option>";
					} ?>
				</select>
				</td>
				<td class="error_col" rowspan=2><?php print $errorMessages["category_text"];?></td>
			</tr>
			<tr>
				<td><input type="text" name="category_text" id="category_text" value="<?php print $category_text; ?>"/></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td align="center">
					<br/>
					<input class="btn" type="submit" name="addmenu_btn" value="Submit"/>
				</td>
				<td>&nbsp;</td>
			</tr>
		</table>
		<p><input type="hidden" name="q"  value="menus"/></p>
		<p><input type="hidden" name="rid"  value="<?php print $restaurant_id;?>"/></p>
	</form>
<?php
	}
?>