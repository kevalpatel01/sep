<?php
	$errorMessages = array();
	if (isset($_POST["name"])) {
		if (empty($_POST["name"])) {
		$errorMessages["name"] = "* Missing name!";
		}
		$name = $_POST["name"];
	} else $name = "";

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
		$phone = $_POST["phone"];
	} else $phone = "";

	if (isset($_POST["email"])) {
		if (empty($_POST["email"])) {
		$errorMessages["email"] = "* Missing email!";
		}
		$email = $_POST["email"];
	} else $email = "";
	
	if (sizeof($errorMessages) == 0 && $name != "" && $address != "" && $phone != "" && $email != "") {
		addPlace($name, $address, $phone, $email);
		$name = "";
		$address = "";
		$phone = "";
		$email = "";
	}
	
?>
<h3>Places of meetings</h3>

<?php
	if (!empty($_SESSION["user"])) {
?>
<h4>Add new place</h4>
<form action="<?php print $_SERVER["PHP_SELF"];?>" method="post">
	<table style='margin: auto;'>
		<tr>
			<td align="right"><label for="mname">Name of place:</label></td>
			<td><input type="text" name="name" id="mname" value="<?php print $name; ?>"/></td>
			<td class="error_col"><?php print $errorMessages["name"];?></td>
		</tr>
		<tr>
			<td align="right"><label for="maddress">Address:</label></td>
			<td><input type="text" name="address" id="maddress" value="<?php print $address; ?>"/></td>
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
				<input class="btn" type="submit" name="addplace_btn" value="Submit"/>
			</td>
			<td>&nbsp;</td>
		</tr>
	</table>
	<p><input type="hidden" name="q"  value="places"/></p>
</form>
<?php
}
?>
<h4>Places</h4>
<?php
	$places = getPlaces();
	if (sizeof($places) > 0) {
		print "<table cellpadding='5' class='common'>";
		print "<thead><tr>";
		print "<th id='id'>&nbsp;</th>";
		print "<th id='name'>Name</th>";
		print "<th id='address'>Address</th>";
		print "<th id='phone'>Phone</th>";
		print "<th id='email'>Email</th>";
		print "</tr></thead>";
		print "<tbody>";
		foreach($places as $i=> $place) {
			print "<tr>";
			print "<td headers='id'>".(int)($i+1)."</td>";
			print "<td headers='name'>".$place["name"]."</td>";
			print "<td headers='address'>".$place["address"]."</td>";
			print "<td headers='phone'>".$place["phone"]."</td>";
			print "<td headers='email'>".$place["email"]."</td>";
			print "</tr>";
		}
		print "</tbody>";
		print "</table>";
	}	else print "<p align='center'>No places available, register one!</p>";
?>
