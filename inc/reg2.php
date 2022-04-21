<?php
	$hobby_names = getHobbies();
	if (!isset($_POST['reg_btn']) && !isset($_POST['res_btn'])) {
		$_SESSION['form_data']['next'] = 0;
	}
	
	if ($_POST["res_btn"]) {
		$_POST['form_data']["username"] = "";
		$_POST['form_data']["password1"] = "";
		$_POST['form_data']["password2"] = "";
		$_POST['form_data']["year"] = "";
		$_POST['form_data']["gender"] = "";	
		$_POST['form_data']["hobbies"] = "";
		$_POST['form_data']["family"] = "";
		$_POST['form_data']["intro"] = "";
	}

	if (isset($_POST['reg_btn'])) {
		switch ($_SESSION['form_data']['next']) {
			case 0:
				$_username = (!empty($_POST['username']) ? $_POST['username'] : $_SESSION['form_data']['username'] );
				if (empty($_username)) {
					$errorMessages["username"] = "* Hiányzó felhasználónév!";
				}
				else if ((strlen($_username)< 5) || (strlen($_username)> 20)) {
					$errorMessages["username"] = "* A felhasználónév hossza 5-20 karakter!";
				}
				else if (checkUserExist($_username)) {
					$errorMessages["username"] = "* A felhasználónév már létezik!";
				} else {
					$_SESSION['form_data']['username'] = $_username;
					$_SESSION['form_data']['next'] = 1;
				}
				break;
			case 1:
				$_password1 = (!empty($_POST['password1']) ? $_POST['password1'] : $_SESSION['form_data']['password_1']);
				$_password2 = (!empty($_POST['password2']) ? $_POST['password2'] : $_SESSION['form_data']['password_2']);
				if (empty($_password1) || empty($_password2)) {
					$errorMessages["password1"] = "* Hiányzó jelszó!";
					$errorMessages["password2"] = "* Hiányzó jelszó!";
				}
				else if (strlen($_password1)< 5 || strlen($_password1)> 20) {
					$errorMessages["password1"] = "* A jelszó hossza 5-20 karakter!";
					$errorMessages["password2"] = "* A jelszó hossza 5-20 karakter!";
				}
				else if (strcmp($_password1,$_password2) != 0) {
					$errorMessages["password1"] = "* Nem egyezõ jelszavak!";
					$errorMessages["password2"] = "* Nem egyezõ jelszavak!";
				} else {
					$_SESSION['form_data']['password1'] = $_password1;
					$_SESSION['form_data']['password2'] = $_password2;
					$_SESSION['form_data']['next'] = 2;
				}
				break;
			case 2:
				$_year = (isset($_POST['year']) ? $_POST['year'] : $_SESSION['form_data']['year']);
				$_SESSION['form_data']['year'] = $_year;
				$_SESSION['form_data']['next'] = 3;
				break;
			case 3:
				$_gender = (isset($_POST['gender']) ? $_POST['gender'] : $_SESSION['form_data']['gender']);
				if (empty($_gender)) {
					$errorMessages["gender"] = "Add meg a nemed!";
				} else {
					$_SESSION['form_data']['gender'] = $_gender;	
					$_SESSION['form_data']['next'] = 4;
				}
				break;
			case 4:
				$_hobbies = (isset($_POST['hobbies']) ? $_POST['hobbies'] : $_SESSION['form_data']['hobbies']);
				$_SESSION['form_data']['hobbies'] = $_hobbies;
				$_SESSION['form_data']['next'] = 5;
				break;
			case 5:
				$_family = (isset($_POST['family']) ? $_POST['family'] : $_SESSION['form_data']['family']);
				if (empty($_family)) {
					$errorMessages["family"] = "Add meg a testvérek számát!";
				}
				else if (!is_numeric($_family)) {
					$errorMessages["family"] = "Számot adjál meg!";
				} else {
					$_SESSION['form_data']['family'] = $_family;
					$_SESSION['form_data']['next'] = 6;
				}
				break;
			case 6:
				$_intro = (isset($_POST['intro']) ? $_POST['intro'] : $_SESSION['form_data']['intro']);
				$_SESSION['form_data']['intro'] = $_intro;
				$_SESSION['form_data']['next'] = 7;
				break;
		}
	}
	
	if (isset($_POST['reg_btn']) && sizeof($errorMessages) == 0 && $_SESSION['form_data']['next'] == 7) {
		registerUser($_SESSION['form_data']['username'], $_SESSION['form_data']['password1'], $_SESSION['form_data']['year'], $_SESSION['form_data']['gender'], $_SESSION['form_data']['hobbies'], $_SESSION['form_data']['family'], $_SESSION['form_data']['intro']);
	}

	if (isset($_POST['res_btn'])) {
		$errorMessages = array();
	}
	
	//debug($_SESSION);
?>

<h3>Regisztráció</h3>
<?php 
	if($_SESSION['form_data']['next'] < 7) { 
?>
<p>Add meg néhány adatod és máris jelentkezhetsz!</p>

<form action="<?php print $_SERVER["PHP_SELF"].'?'.$_SERVER['QUERY_STRING'];?>" method="post">
	<table  style='margin: auto;'>
<?php 
	}
	switch ($_SESSION['form_data']['next']) {
	case 0:
?>
		<tr>
			<td align="right"><label for="username">Felhasználónév:</label></td>
			<td><input type="text" name="username" id="username" value="<?php print $_SESSION['form_data']['username'];?>"/></td>
			<td class="error_col"><?php print $errorMessages["username"];?></td>
		</tr>
<?php
	break;
	case 1:  
?>
		<tr>
			<td align="right"><label for="password1">Jelszó:</label></td>
			<td><input type="password" name="password1" id="password1" value=""/></td>
			<td class="error_col"><?php print $errorMessages["password1"];?></td>
		</tr>
		<tr>
			<td align="right"><label for="password2">Jelszó újra:</label></td>
			<td><input type="password" name="password2" id="password2" value=""/></td>
			<td class="error_col"><?php print $errorMessages["password2"];?></td>
		</tr>
<?php
	break;
	case 2:
?>
		<tr>
			<td align="right"><label for="year">Születési év:</label></td>
			<td><select name="year" id="year">
			<?php for ($i=1900; $i<2004; $i++) {
				print "<option value='".$i."'";
				if ($i == $_SESSION['form_data']['year']) print " selected='selected'";
				print ">".$i."</option>";
			} ?>
			</select>
			</td>
			<td class="error_col"></td>
		</tr>
<?php
	break;
	case 3:
?>
		<tr>
			<td align="right">Nem:</td>
			<td>
			<input type="radio" name="gender" id="male" value="M" <?php if ($_SESSION['form_data']['gender'] == "M") print "checked"; ?> /><label for="male">Férfi</label>
			<input type="radio" name="gender" id="female" value="F" <?php if ($_SESSION['form_data']['gender'] == "F") print "checked"; ?> /><label for="female">Nõ</label>
			</td>
			<td class="error_col"><?php print $errorMessages["gender"];?></td>
		</tr>
<?php
	break;
	case 4:
?>
		<tr>
			<td align="right">Hobbi:</td>
			<td style="text-align: justify">
			<?php
				$i = 1;
				foreach($hobby_names as $value) {
					echo '<input type="checkbox" name="hobbies[]" value="'.$value['id'].'" id="'.$value['label'].'"';
					if (!empty($_SESSION['form_data']['hobbies']) && in_array($value['id'], $_SESSION['form_data']['hobbies'])) echo ' checked';
					echo ' /><label for="'.$value['label'].'">'.$value['name'].'</label>';
					if (($i++ % 3) == 0) echo '<br /><br />';
				} 
			?>
			</td>
			<td class="error_col"></td>
		</tr>
<?php
	break;
	case 5:
?>
		<tr>
			<td align="right"><label for="family">Testvérek száma:</label></td>
			<td><input type="text" name="family" id="family" value="<?php print $_SESSION['form_data']['family']; ?>"/></td>
			<td class="error_col"><?php print $errorMessages["family"];?></td>
		</tr>
<?php
	break;
	case 6:
?>
		<tr>
			<td align="right"><label for="intro">Bemutatkozás:</label></td>
			<td><textarea cols="20" rows="3" name="intro" id="intro"><?php print $_SESSION['form_data']['intro']; ?></textarea></td>
			<td class="error_col"><?php print $errorMessages["intro"];?></td>
		</tr>
<?php
	break;
	}
	
	if($_SESSION['form_data']['next'] < 7) {
?>
		<tr>
			<td>&nbsp;</td>
			<td align="center">
				<br/>
				<input class="btn" type="submit" name="reg_btn" value="Küldés"/>
				<input class="btn" type="submit" name="res_btn" value="Alapállapot"/>
			</td>
			<td>&nbsp;</td>
		</tr>
	</table>
	<p><input type="hidden" name="q"  value="register2"/></p>
</form>
<?php
	} else {
		print "<p style='text-align: center;'>Köszönjük a regisztrációd!</p>";
		$_SESSION['form_data'] = array();
	}
?>