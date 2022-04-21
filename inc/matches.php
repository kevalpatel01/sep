<?php
	$errorMessages = array();
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
	
	if (sizeof($errorMessages) == 0 && $name != "" && $cusine != "" && $address != "") {
		addRestaurant($name, $cusine, $address, $_SESSION['user']['username']);
		$name = "";
		$cusine = "";
		$address = "";
	}
	
?>
<h3>Restaurants available</h3>
<?php
	$matches = getMatches();
	if (sizeof($matches) > 0) {
		print "<table class='common' cellpadding='5'>";
		print "<thead><tr>";
		print "<th id='id'>&nbsp;</th>";
		print "<th id='name'>Name</th>";
		print "<th id='cusine'>Cusine</th>";
		print "<th id='address'>Address</th>";
		print "</tr></thead>";
		print "<tbody>";
		foreach($matches as $i=> $match) {
			print "<tr>";
			print "<td headers='id'>".(int)($i+1)."</td>";
			print "<td headers='name'>".$match["name"]."</td>";
			print "<td headers='cusine'>".$match["cusine"]."</td>";
			print "<td headers='address'>".$match["address"]."</td>";
			print "</tr>";
		}
		print "</tbody>";
		print "</table>";
	}	else print "<p align='center'>No restaurants available!</p>";

	if (!empty($_SESSION["user"])) {
?>
<h4>Add new restaurant</h4>
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
			<td>&nbsp;</td>
			<td align="center">
				<br/>
				<input class="btn" type="submit" name="addrestaurant_btn" value="Add"/>
			</td>
			<td>&nbsp;</td>
		</tr>
	</table>
	<p><input type="hidden" name="q"  value="matches"/></p>
</form>
<?php
}
?>