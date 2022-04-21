<?php

	$errorMessages = array();

	if ($_POST["res_btn"]) {
		$_POST["username"] = "";
		$_POST["password1"] = "";
		$_POST["password2"] = "";
		$_POST["fullname"] = "";
		$_POST["phone"] = "";
		$_POST["email"] = "";
		$_POST["gender"] = "";	
	}

	if (isset($_POST["username"])) {
		if (empty($_POST["username"])) {
		$errorMessages["username"] = "* Missing username!";
		}
		else if ((strlen($_POST["username"])< 5) || (strlen($_POST["username"])> 20)) {
			$errorMessages["username"] = "* Username should be between 5 and 20 characters!";
		}
		else if (checkUserExist($_POST['username'])) {
			$errorMessages["username"] = "* Existing username!";
		}
		$username = $_POST["username"];
	}
	else $username = "";

	if (isset($_POST["password1"]) && isset($_POST["password2"])) {
		if (empty($_POST["password1"]) || empty($_POST["password2"])) {
			$errorMessages["password1"] = "* Missing password!";
			$errorMessages["password2"] = "* Missing password!";
		}
		else if (strlen($_POST["password1"])< 5 || strlen($_POST["password1"])> 20) {
			$errorMessages["password1"] = "* Password should be between 5 and 20 characters!";
			$errorMessages["password2"] = "* Password should be between 5 and 20 characters!";
		}
		else if (strcmp($_POST["password1"],$_POST["password2"]) != 0) {
			$errorMessages["password1"] = "* Password do not match!";
			$errorMessages["password2"] = "* Password do not match!";
		}
		$password1 = $_POST["password1"];
		$password2 = $_POST["password2"];
	}

	if (isset($_POST["fullname"])) {
		if (empty($_POST["fullname"])) {
		$errorMessages["fullname"] = "* Missing full name!";
		}
		$fullname = $_POST["fullname"];
	}
	else $fullname = "";

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
		$errorMessages["email"] = "* Missing email address!";
		}
		$email = $_POST["email"];
	}
	else $email = "";

	if (!empty($_POST)) {
		$year = $_POST["year"];
	}

	if (!empty($_POST) && !isset($_POST["gender"])) {
		$errorMessages["gender"] = "Select your gender!";
	}
	else $gender = $_POST["gender"];	
	
	if (isset($_POST['reg_btn']) && sizeof($errorMessages) == 0) {
		registerUser($username, $password1, $year, $fullname, $phone, $email, $gender);
		$username = "";
		$password1 = "";
		$password2 = "";
		$year = "";
		$fullname = "";
		$phone = "";
		$email = "";
		$gender = "";
	}

	if (isset($_POST['res_btn'])) $errorMessages = array(); 	
?>

<h3>Registration</h3>
<?php
	if (!(isset($_POST["reg_btn"]) && sizeof($errorMessages) == 0)) {
?>
<p>Fill out the form and you can register!</p>

<form action="<?php print $_SERVER["PHP_SELF"];?>" method="post">
	<table style='margin: auto;'>
		<tr>
			<td align="right"><label for="username">Username:</label></td>
			<td><input type="text" name="username" id="username" value="<?php print $username; $username="";?>"/></td>
			<td class="error_col"><?php print $errorMessages["username"];?></td>
		</tr>
		<tr>
			<td align="right"><label for="password1">Password:</label></td>
			<td><input type="password" name="password1" id="password1" value=""/></td>
			<td class="error_col"><?php print $errorMessages["password1"];?></td>
		</tr>
		<tr>
			<td align="right"><label for="password2">Password again:</label></td>
			<td><input type="password" name="password2" id="password2" value=""/></td>
			<td class="error_col"><?php print $errorMessages["password2"];?></td>
		</tr>
		<tr>
			<td align="right"><label for="fullname">Full name:</label></td>
			<td><input type="text" name="fullname" id="fullname" value=""/></td>
			<td class="error_col"><?php print $errorMessages["fullname"];?></td>
		</tr>
		<tr>
			<td align="right"><label for="phone">Phone number:</label></td>
			<td><input type="text" name="phone" id="phone" value=""/></td>
			<td class="error_col"><?php print $errorMessages["phone"];?></td>
		</tr>
		<tr>
			<td align="right"><label for="email">Email address:</label></td>
			<td><input type="text" name="email" id="email" value=""/></td>
			<td class="error_col"><?php print $errorMessages["email"];?></td>
		</tr>
		<tr>
			<td align="right"><label for="year">Year of birth:</label></td>
			<td>
			<select name="year" id="year">
			<?php for ($i=1900; $i<2004; $i++) {
				print "<option value='".$i."'";
				if ($i == $year) print " selected='selected'";
				print ">".$i."</option>";
			} ?>
			</select>
			</td>
			<td class="error_col"></td>
		</tr>
		<tr>
			<td align="right">Gender:</td>
			<td>
			<input type="radio" name="gender" value="M" id="male" <?php if ($gender == "M") print "checked"; ?> /><label for="male">Male</label>
			<input type="radio" name="gender" value="F" id="female" <?php if ($gender == "F") print "checked"; ?> /><label for="female">Female</label>
			</td>
			<td class="error_col"><?php print $errorMessages["gender"];?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td align="center">
				<br/>
				<input class="btn" type="submit" name="reg_btn" value="Submit"/>
				<input class="btn" type="submit" name="res_btn" value="Clear form"/>
			</td>
			<td>&nbsp;</td>
		</tr>
	</table>
	<p><input type="hidden" name="q"  value="register"/></p>
</form>
<?php
	} else print "<p align='center'>Thanks for registering!</p>";
?>