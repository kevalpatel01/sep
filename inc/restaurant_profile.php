<h2>Profile</h2>

<?php
	$restaurant_id = $_REQUEST["rid"];
	
	$errorMessages = array();

	if ($_POST['modify_btn']) {
		
		$username = $_SESSION['user']['username'];
		$userid = $_SESSION['user']['id'];
		
		if (isset($_POST["password1"]) && isset($_POST["password2"])) {
			if (empty($_POST["password1"]) && empty($_POST["password2"])) {
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

		$year = $_POST["year"];

		$gender = $_POST["gender"];	

		for ($i=0; $i<6; $i++) {
			if (!empty($_POST["hobbies$i"])) {
				$hobbies[] = $_POST["hobbies$i"];
			}
		}
				
		if (isset($_POST["family"])) {
			if (empty($_POST["family"])) {
				$errorMessages["family"] = "Give us the number of brothers and sisters!";
			}
			else if (!is_numeric($_POST["family"])) {
				$errorMessages["family"] = "It should be a number!";
			}
			$family = $_POST["family"];
		}
		
		$intro = $_POST["intro"];
		
		if (isset($_POST['modify_btn']) && sizeof($errorMessages) == 0) {
			updateUser($userid, $username, $password, $year, $fullname, $phone, $email, $gender, $hobbies, $family, $intro);
			$username = "";
			$password1 = "";
			$password2 = "";
			$year = "";
			$fullname = "";
			$phone = "";
			$email = "";
			$gender = "";
			$hobbies = array();
			$family = "";
			$intro = "";
		}
	}

	if ($q == "unregister" && $_POST['yes']) {
		print "<p style='text-align: center;'>Account unregistered!</p>";
	}

	else if ($_POST['unregister']) {
?>
	<form action="<?php print $_SERVER["PHP_SELF"]; ?>" method="post">
		<table>
			<tr>
				<td align="center">Are you sure you want to unregister?</td>
			</tr>
			<tr>
			<td align="center">
				<input class="btn" type="submit" name="yes" value="Yes"/>
				<input class="btn" type="submit" name="no" value="No"/>
				<input type="hidden" name="q" value="unregister"/>
			</td>
			</tr>
		</table>
	</form>
<?php	
	}
	
	else if ($_POST['modify'] || ($_POST['modify_btn'] && sizeof($errorMessages) != 0)) {
	$profile = getProfile($_SESSION['user']['username']);
	$hobbies = getProfileHobbies($_SESSION['user']['username']);
	$hobby_names = getHobbies();
	print "<form action=".$_SERVER["PHP_SELF"]." method='post'>";
		print "<table cellpadding='5'>";
		foreach($profile as $i => $value) {}
		print "<tr><td>Username : </td>";
		print "<td>".$value['username']."</td>";
		print "<td class=error_col>".$errorMessages['username']."</td></tr>";
		print "<tr><td>Password : </td>";
		print "<td><input type=password name=password1 id=password1 value=".$value['password1']." ></td>";
		print "<td class=error_col>".$errorMessages['password1']."</td></tr>";
		print "<tr><td>Password again : </td>";
		print "<td><input type=password name=password2 id=password2 value=".$value['password2']." ></td>";
		print "<td class=error_col>".$errorMessages['password2']."</td></tr>";
		print "<tr><td>Full name : </td>";
		print "<td><input type=text name=fullname id=fullname value=".$value['fullname']." /></td>";
		print "<td class=error_col>".$errorMessages['fullname']."</td></tr>";
		print "<tr><td>Phone number : </td>";
		print "<td><input type=text name=phone id=phone value=".$value['phone']." /></td>";
		print "<td class=error_col>".$errorMessages['phone']."</td></tr>";
		print "<tr><td>Email address : </td>";
		print "<td><input type=text name=email id=email value=".$value['email']." /></td>";
		print "<td class=error_col>".$errorMessages['email']."</td></tr>";
		print "<tr><td>User level : </td>";
		if ($value['userlevel'] == 1) {
			print "<td>Administrator</td></tr>";
		}
		else {
			print "<td>User</td></tr>";
		}
		print "<tr><td>Year of birth : </td>";
		print "<td><select name=year id=year>";
			for ($i=1900; $i<2004; $i++) {
				print "<option value='".$i."'";
				if ($i == $value['year']) print " selected='selected'";
				print ">".$i."</option>";
			}
		print "</select></td>";
		print "<td class=error_col>".$errorMessages['year']."</td></tr>";
		print "<tr><td>Gender : </td>";
		print "<td><select name=gender id=gender>";
		print "<option value=M"; if ($value['gender'] == 'M') print " selected=selected";
		print ">Male</option>";
		print "<option value=F"; if ($value['gender'] == 'F') print " selected=selected";
		print ">Female</option>";
		print "</select></td>";
		print "<td class=error_col>".$errorMessages['gender']."</td></tr>";
		print "<tr><td>Hobbies : </td>";
		print "<td style='text-align: justify'>";
				$i = 1;
				foreach($hobby_names as $hobby_name) {
					echo '<input type="checkbox" name="hobbies'.$i.'" value="'.$hobby_name['id'].'" id="'.$hobby_name['label'].'"';
					foreach($hobbies as $hobby) {
						if (!empty($hobby) && in_array($hobby_name['id'], $hobby)) echo ' checked';
					}
					echo ' /><label for="'.$hobby_name['label'].'">'.$hobby_name['name'].'</label>';
					if (($i++ % 3) == 0) echo '<br /><br />';
				}
		print "</td>";
		print "<td class=error_col>".$errorMessages['hobbies']."</td></tr>";
		print "<tr><td>Number of brothers and sisters : </td>";
		print "<td><input type=text name=family id=family value=".$value['family']." ></td>";
		print "<td class=error_col>".$errorMessages['family']."</td></tr>";
		print "<tr><td>Introduction : </td>";
		print "<td><input type=text name=intro id=intro value=".$value['intro']." ></td>";
		print "<td class=error_col>".$errorMessages['intro']."</td></tr>";
	print "</table>";
?>
		<p>
		<input class="btn" type="submit" name="cancel" value="Cancel"/>
		<input class="btn" type="submit" name="modify_btn" value="Submit"/>
		<input type="hidden" name="q" value="profile"/>
		</p>
	</form>

<?php
	}
	else {
	$profile = getProfile($_SESSION['user']['username']);
	$hobbies = getProfileHobbies($_SESSION['user']['username']);
	print "<table cellpadding='5'>";
	foreach($profile as $i => $value) {}
		print "<tr><td>Username : </td>";
		print "<td>".$value['username']."</td></tr>";
		print "<tr><td>Full name : </td>";
		print "<td>".$value['fullname']."</td></tr>";
		print "<tr><td>Phone number : </td>";
		print "<td>".$value['phone']."</td></tr>";
		print "<tr><td>Email address : </td>";
		print "<td>".$value['email']."</td></tr>";
		print "<tr><td>User level : </td>";
		if ($value['userlevel'] == 1) {
			print "<td>Administrator</td></tr>";
		}
		else {
			print "<td>User</td></tr>";
		}
		print "<tr><td>Year of birth : </td>";
		print "<td>".$value['year']."</td></tr>";
		print "<tr><td>Gender : </td>";
		print "<td>";
			if ($value['gender'] == 'M') print "Male";
			else if ($value['gender'] == 'F') print "Female";
			else {}
		print "</td></tr>";
		print "<tr><td>Hobbies : </td>";
		print "<td>";
		if (!is_null($hobbies)) {
			foreach($hobbies as $hobby) {
				print $hobby['name'];
				if ($hobby != end($hobbies)) print ", ";
			}
		}
		print "</td></tr>";
		print "<tr><td>Number of brothers and sisters : </td>";
		print "<td>".$value['family']."</td></tr>";
		print "<tr><td>Introduction : </td>";
		print "<td>".$value['intro']."</td></tr>";
	print "</table>";
?>
	<form action="<?php print $_SERVER["PHP_SELF"]; ?>" method="post">
		<p>
		<input class="btn" type="submit" name="unregister" value="Unregister"/>
		<input class="btn" type="submit" name="modify" value="Modify"/>
		<input type="hidden" name="q" value="profile"/>
		</p>
	</form>
<?php
	}
?>
<!--
<form action="<?php print $_SERVER["PHP_SELF"]; ?>?q=unregister" method="post">
	<p><input type="submit" name="unregister" value="Unregister" /></p>
</form>
--!>

